```php
<?php

/* =====================================================================
   SECURE SESSION SETUP
===================================================================== */

ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.use_trans_sid', '0');

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();


/* =====================================================================
   DATABASE
===================================================================== */

require_once __DIR__ . "/config/db.php";


/* =====================================================================
   BLOCK IF ALREADY LOGGED IN
===================================================================== */

if (isset($_SESSION['admin_id'])) {

    header("Location: index.php");
    exit;
}


/* =====================================================================
   POST ONLY
===================================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: login.php");
    exit;
}


/* =====================================================================
   CSRF PROTECTION
===================================================================== */

/*
|--------------------------------------------------------------------------
| The login form must contain:
|
| <input type="hidden"
|        name="csrf_token"
|        value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
|--------------------------------------------------------------------------
*/

function csrf_token()
{
    if (
        empty($_SESSION['csrf_token']) ||
        !is_string($_SESSION['csrf_token'])
    ) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}


function verify_csrf_token($token)
{
    if (
        empty($_SESSION['csrf_token']) ||
        empty($token) ||
        !is_string($token)
    ) {
        return false;
    }

    return hash_equals(
        $_SESSION['csrf_token'],
        $token
    );
}


/* =====================================================================
   VERIFY CSRF TOKEN
===================================================================== */

if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {

    http_response_code(403);

    exit("Invalid or expired form. Please reload the page.");
}


/* =====================================================================
   GET INPUT
===================================================================== */

$email = trim($_POST['email'] ?? '');

/*
|--------------------------------------------------------------------------
| NEVER trim passwords.
|--------------------------------------------------------------------------
| Spaces can technically be part of a password.
|--------------------------------------------------------------------------
*/

$password = $_POST['password'] ?? '';


/* =====================================================================
   BASIC VALIDATION
===================================================================== */

if ($email === '' || $password === '') {

    header("Location: login.php?error=invalid");
    exit;
}


/* =====================================================================
   EMAIL VALIDATION
===================================================================== */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    header("Location: login.php?error=invalid");
    exit;
}


/* =====================================================================
   INPUT LENGTH PROTECTION
===================================================================== */

if (strlen($email) > 255) {

    header("Location: login.php?error=invalid");
    exit;
}

if (strlen($password) > 4096) {

    header("Location: login.php?error=invalid");
    exit;
}


/* =====================================================================
   DATABASE CONNECTION CHECK
===================================================================== */

if (!isset($conn) || !($conn instanceof mysqli)) {

    error_log("Login error: Invalid database connection.");

    http_response_code(500);

    exit("Server error. Please try again later.");
}


if ($conn->connect_errno) {

    error_log(
        "Login database connection error: " .
        $conn->connect_errno
    );

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   UTF-8 DATABASE CONNECTION
===================================================================== */

if (!$conn->set_charset("utf8mb4")) {

    error_log("Login error: Could not set utf8mb4 charset.");

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   FIND ADMIN
===================================================================== */

/*
|--------------------------------------------------------------------------
| PREPARED STATEMENT
|--------------------------------------------------------------------------
| This protects the query from SQL injection.
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare(
    "SELECT id, name, email, password
     FROM admin
     WHERE email = ?
     LIMIT 1"
);


if (!$stmt) {

    error_log(
        "Login prepare error: " . $conn->error
    );

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   BIND EMAIL
===================================================================== */

$stmt->bind_param("s", $email);


/* =====================================================================
   EXECUTE QUERY
===================================================================== */

if (!$stmt->execute()) {

    error_log(
        "Login execute error: " . $stmt->error
    );

    $stmt->close();
    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   GET ADMIN RECORD
===================================================================== */

$result = $stmt->get_result();

$admin = $result->fetch_assoc();

$stmt->close();


/* =====================================================================
   PASSWORD VERIFICATION
===================================================================== */

/*
|--------------------------------------------------------------------------
| Dummy bcrypt hash
|--------------------------------------------------------------------------
|
| Used when the email doesn't exist.
| This means password_verify() is still performed instead of immediately
| revealing whether an email exists.
|--------------------------------------------------------------------------
*/

$dummyHash =
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye' .
    '4oKoEa3Ro9ll5Q3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x3x';


/*
|--------------------------------------------------------------------------
| Select hash
|--------------------------------------------------------------------------
*/

$hash = $admin['password'] ?? $dummyHash;


/*
|--------------------------------------------------------------------------
| Verify password
|--------------------------------------------------------------------------
*/

$passwordValid = password_verify(
    $password,
    $hash
);


/* =====================================================================
   LOGIN FAILED
===================================================================== */

if (!$admin || !$passwordValid) {

    /*
    |--------------------------------------------------------------------------
    | Generic error
    |--------------------------------------------------------------------------
    |
    | Don't tell attacker whether:
    | - Email exists
    | - Password is incorrect
    |--------------------------------------------------------------------------
    */

    $conn->close();

    header("Location: login.php?error=invalid");
    exit;
}


/* =====================================================================
   PASSWORD HASH UPGRADE
===================================================================== */

/*
|--------------------------------------------------------------------------
| Automatically upgrade old password hashes when necessary.
|--------------------------------------------------------------------------
*/

if (password_needs_rehash(
    $hash,
    PASSWORD_DEFAULT
)) {

    $newHash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    if ($newHash !== false) {

        $update = $conn->prepare(
            "UPDATE admin
             SET password = ?
             WHERE id = ?
             LIMIT 1"
        );

        if ($update) {

            $adminId = (int)$admin['id'];

            $update->bind_param(
                "si",
                $newHash,
                $adminId
            );

            if (!$update->execute()) {

                error_log(
                    "Login password rehash error: " .
                    $update->error
                );
            }

            $update->close();
        }
    }
}


/* =====================================================================
   SESSION FIXATION PROTECTION
===================================================================== */

if (!session_regenerate_id(true)) {

    error_log(
        "Login error: session_regenerate_id() failed."
    );

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   CREATE ADMIN SESSION
===================================================================== */

$_SESSION['admin_id'] = (int)$admin['id'];

$_SESSION['admin_name'] = (string)$admin['name'];

$_SESSION['admin_email'] = (string)$admin['email'];

$_SESSION['logged_in'] = true;

$_SESSION['login_time'] = time();


/* =====================================================================
   ROTATE CSRF TOKEN
===================================================================== */

$_SESSION['csrf_token'] = bin2hex(
    random_bytes(32)
);


/* =====================================================================
   CLOSE DATABASE
===================================================================== */

$conn->close();


/* =====================================================================
   LOGIN SUCCESS
===================================================================== */

header("Location: index.php");
exit;

?>
```
