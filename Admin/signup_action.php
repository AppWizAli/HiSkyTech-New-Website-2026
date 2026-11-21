
<?php

/* =====================================================================
   SECURE SESSION
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
   AUTHENTICATION CHECK
===================================================================== */

if (
    !isset($_SESSION['admin_id']) ||
    !is_numeric($_SESSION['admin_id']) ||
    (int)$_SESSION['admin_id'] <= 0
) {
    header("Location: login.php");
    exit;
}


/* =====================================================================
   DATABASE
===================================================================== */

require_once __DIR__ . "/config/db.php";


/* =====================================================================
   DATABASE CONNECTION CHECK
===================================================================== */

if (!isset($conn) || !($conn instanceof mysqli)) {

    error_log("Create admin: Invalid database connection.");

    http_response_code(500);

    exit("Server error. Please try again later.");
}


if ($conn->connect_errno) {

    error_log(
        "Create admin database connection error: " .
        $conn->connect_errno
    );

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   DATABASE CHARACTER SET
===================================================================== */

if (!$conn->set_charset("utf8mb4")) {

    error_log("Create admin: Failed to set utf8mb4.");

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   CSRF FUNCTIONS
===================================================================== */

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
   POST ONLY
===================================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    $conn->close();

    http_response_code(405);

    header('Allow: POST');

    exit("Method Not Allowed");
}


/* =====================================================================
   CSRF VALIDATION
===================================================================== */

if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {

    $conn->close();

    http_response_code(403);

    exit("Invalid or expired form. Please reload the page.");
}


/* =====================================================================
   GET INPUT
===================================================================== */

$name = trim($_POST['name'] ?? '');

$email = trim($_POST['email'] ?? '');

/*
|--------------------------------------------------------------------------
| NEVER trim password
|--------------------------------------------------------------------------
*/

$password = $_POST['password'] ?? '';


/* =====================================================================
   BASIC VALIDATION
===================================================================== */

if ($name === '') {

    $conn->close();

    header("Location: add_admin.php?error=name_required");
    exit;
}


if ($email === '') {

    $conn->close();

    header("Location: add_admin.php?error=email_required");
    exit;
}


if ($password === '') {

    $conn->close();

    header("Location: add_admin.php?error=password_required");
    exit;
}


/* =====================================================================
   LENGTH VALIDATION
===================================================================== */

if (strlen($name) > 100) {

    $conn->close();

    header("Location: add_admin.php?error=invalid_name");
    exit;
}


if (strlen($email) > 255) {

    $conn->close();

    header("Location: add_admin.php?error=invalid_email");
    exit;
}


/*
|--------------------------------------------------------------------------
| Prevent extremely large password input
|--------------------------------------------------------------------------
*/

if (strlen($password) > 4096) {

    $conn->close();

    header("Location: add_admin.php?error=invalid_password");
    exit;
}


/* =====================================================================
   NAME VALIDATION
===================================================================== */

/*
|--------------------------------------------------------------------------
| Allows:
| - English letters
| - Spaces
| - Hyphen
| - Apostrophe
|--------------------------------------------------------------------------
*/

if (!preg_match("/^[A-Za-z\s'-]+$/", $name)) {

    $conn->close();

    header("Location: add_admin.php?error=invalid_name");
    exit;
}


/* =====================================================================
   EMAIL VALIDATION
===================================================================== */

$email = strtolower($email);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $conn->close();

    header("Location: add_admin.php?error=invalid_email");
    exit;
}


/* =====================================================================
   PASSWORD VALIDATION
===================================================================== */

if (strlen($password) < 8) {

    $conn->close();

    header("Location: add_admin.php?error=weak_password");
    exit;
}


/*
|--------------------------------------------------------------------------
| Strong password requirements
|--------------------------------------------------------------------------
*/

if (!preg_match('/[A-Z]/', $password)) {

    $conn->close();

    header("Location: add_admin.php?error=weak_password");
    exit;
}


if (!preg_match('/[a-z]/', $password)) {

    $conn->close();

    header("Location: add_admin.php?error=weak_password");
    exit;
}


if (!preg_match('/[0-9]/', $password)) {

    $conn->close();

    header("Location: add_admin.php?error=weak_password");
    exit;
}


/* =====================================================================
   CHECK DUPLICATE EMAIL
===================================================================== */

$check = $conn->prepare(
    "SELECT id
     FROM admin
     WHERE email = ?
     LIMIT 1"
);


if (!$check) {

    error_log(
        "Create admin duplicate-check prepare error: " .
        $conn->error
    );

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


$check->bind_param(
    "s",
    $email
);


if (!$check->execute()) {

    error_log(
        "Create admin duplicate-check execute error: " .
        $check->error
    );

    $check->close();
    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


$check->store_result();


if ($check->num_rows > 0) {

    $check->close();
    $conn->close();

    header("Location: add_admin.php?error=email_exists");
    exit;
}


$check->close();


/* =====================================================================
   HASH PASSWORD
===================================================================== */

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);


if ($hashedPassword === false) {

    error_log("Create admin: Password hashing failed.");

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


/* =====================================================================
   INSERT ADMIN
===================================================================== */

$stmt = $conn->prepare(
    "INSERT INTO admin
        (name, email, password)
     VALUES
        (?, ?, ?)"
);


if (!$stmt) {

    error_log(
        "Create admin INSERT prepare error: " .
        $conn->error
    );

    $conn->close();

    http_response_code(500);

    exit("Server error. Please try again later.");
}


$stmt->bind_param(
    "sss",
    $name,
    $email,
    $hashedPassword
);


/* =====================================================================
   EXECUTE INSERT
===================================================================== */

if (!$stmt->execute()) {

    /*
    |--------------------------------------------------------------------------
    | Duplicate email race-condition
    |--------------------------------------------------------------------------
    */

    if ($stmt->errno === 1062) {

        $stmt->close();
        $conn->close();

        header("Location: add_admin.php?error=email_exists");
        exit;
    }


    error_log(
        "Create admin INSERT error: " .
        $stmt->error
    );

    $stmt->close();
    $conn->close();

    http_response_code(500);

    exit("Unable to create admin. Please try again later.");
}


/* =====================================================================
   SUCCESS
===================================================================== */

$stmt->close();

$conn->close();


/* =====================================================================
   ROTATE CSRF TOKEN
===================================================================== */

$_SESSION['csrf_token'] = bin2hex(
    random_bytes(32)
);


/* =====================================================================
   REDIRECT
===================================================================== */

header("Location: index.php?success=admin_created");
exit;

?>
```
