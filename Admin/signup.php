<?php

/* ---------------------------------------------------------
   SECURE SESSION
--------------------------------------------------------- */

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

/* ---------------------------------------------------------
   ADMIN LOGIN REQUIRED
--------------------------------------------------------- */

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ---------------------------------------------------------
   DATABASE
--------------------------------------------------------- */

require_once "config/db.php";

/* ---------------------------------------------------------
   DATABASE CHARSET
--------------------------------------------------------- */

if (isset($conn) && $conn instanceof mysqli) {
    $conn->set_charset("utf8mb4");
}

/* ---------------------------------------------------------
   CSRF TOKEN
--------------------------------------------------------- */

if (
    empty($_SESSION['csrf_token']) ||
    !is_string($_SESSION['csrf_token']) ||
    strlen($_SESSION['csrf_token']) < 32
) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Signup</title>

<?php include 'partials/css.php'; ?>

<?php include 'partials/preloader.php'; ?>

<style>

/* BODY */

.auth-body {
    background: var(--bg-main, #f2f4fa);
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    min-height: 100vh;
}

.auth-shell {
    min-height: 100vh;
    display: flex;
}

/* LEFT BRANDED PANEL */

.auth-visual {
    position: relative;
    flex: 1 1 46%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4rem 3.5rem;
    background: linear-gradient(160deg, #12172b 0%, #1c2540 100%);
    overflow: hidden;
}

.auth-visual-content { position: relative; z-index: 2; max-width: 420px; }

.auth-brand { display: flex; align-items: center; gap: 14px; margin-bottom: 3rem; }
.auth-brand-logo {
    width: 46px; height: 46px; border-radius: 13px; overflow: hidden;
    flex-shrink: 0; box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
}
.auth-brand-logo img { width: 100%; height: 100%; object-fit: cover; display: block; }
.auth-brand strong { display: block; color: #fff; font-size: 1.05rem; font-weight: 700; }
.auth-brand small { color: #9aa3c0; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; }

.auth-visual h1 {
    color: #fff; font-size: 2rem; font-weight: 800; line-height: 1.25; letter-spacing: -0.4px;
    margin-bottom: 1rem;
}
.auth-visual p { color: #aab2c8; font-size: 0.98rem; line-height: 1.6; margin-bottom: 2.4rem; }

.auth-features { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.1rem; }
.auth-features li { display: flex; align-items: center; gap: 12px; color: #d7dbea; font-size: 0.92rem; font-weight: 500; }
.auth-features i {
    width: 38px; height: 38px; border-radius: 11px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    background: rgba(var(--accent-rgb, 79,70,229), 0.28); color: #fff; font-size: 0.95rem;
}

.auth-blob {
    position: absolute; border-radius: 50%; filter: blur(2px);
    background: radial-gradient(circle at 30% 30%, rgba(var(--accent-rgb, 79,70,229), 0.45), transparent 70%);
    z-index: 1;
}
.auth-blob-1 { width: 340px; height: 340px; top: -120px; right: -100px; }
.auth-blob-2 { width: 260px; height: 260px; bottom: -100px; left: -80px;
    background: radial-gradient(circle at 30% 30%, rgba(6, 182, 212, 0.35), transparent 70%); }

/* RIGHT FORM PANEL */

.auth-form-panel {
    flex: 1 1 54%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2.5rem;
}

/* CARD */

.login-card {
    width: 100%;
    max-width: 400px;
    background: var(--bg-card, #ffffff);
    border-radius: var(--card-radius, 14px);
    padding: 2.6rem;
    box-shadow: var(--shadow-card, 0 12px 28px rgba(17,24,46,0.10));
    border: var(--border-solid, 1px solid rgba(17,24,46,0.09));
    border-top: 3px solid var(--accent, #4f46e5);
    animation: fadeSlideIn 0.5s ease forwards;
}

/* TITLES */

.login-title {
    text-align: left;
    font-weight: 800;
    font-size: 1.5rem;
    letter-spacing: -0.3px;
    color: var(--text-light, #1c2333);
    margin-bottom: 0.3rem;
}

.login-subtitle {
    text-align: left;
    color: var(--text-muted, #6b7280);
    font-size: 0.92rem;
    margin-bottom: 2rem;
}

/* INPUT */

.input-group-custom {
    position: relative;
    margin-bottom: 1.2rem;
}

.input-group-custom i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--input-placeholder, #9aa1b3);
    font-size: 0.9rem;
    pointer-events: none;
}

.input-group-custom input {
    width: 100%;
    padding: 0.8rem 0.9rem 0.8rem 2.6rem;
    border-radius: var(--radius-sm, 10px);
    border: 2px solid rgba(17, 24, 46, 0.12);
    background: #fbfbfe;
    font-size: 0.95rem;
    color: var(--text-light, #1c2333);
    transition: all 0.25s ease;
    box-sizing: border-box;
    box-shadow: inset 0 1px 3px rgba(17, 24, 46, 0.05);
}

.input-group-custom input:focus {
    outline: none;
    border-color: var(--accent, #4f46e5);
    background: #fff;
    box-shadow: inset 0 1px 3px rgba(17, 24, 46, 0.04), 0 0 0 4px var(--accent-light, #eef2ff);
}

/* BUTTON */

.btn-login {
    width: 100%;
    padding: 0.85rem;
    background: var(--accent, #4f46e5);
    border: none;
    border-radius: var(--radius-sm, 10px);
    color: #fff;
    font-weight: 700;
    font-size: 0.98rem;
    box-shadow: 0 6px 16px rgba(var(--accent-rgb, 79,70,229), 0.32);
    transition: all 0.22s ease;
    cursor: pointer;
}

.btn-login:hover {
    background: var(--accent-hover, #4338ca);
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(var(--accent-rgb, 79,70,229), 0.4);
}
.btn-login:active { transform: translateY(0); }

/* ALERT */

.alert { border-radius: var(--radius-sm, 10px); }

@keyframes fadeSlideIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* RESPONSIVE */

@media (max-width: 991.98px) {
    .auth-visual { display: none; }
    .auth-form-panel { flex: 1 1 100%; padding: 1.5rem; }
}

@media (max-width: 576px) {
    .login-card { padding: 2rem 1.5rem; }
}

</style>

</head>

<body class="auth-body">

<div class="auth-shell">

    <!-- LEFT BRANDED PANEL -->
    <div class="auth-visual">
        <div class="auth-blob auth-blob-1"></div>
        <div class="auth-blob auth-blob-2"></div>
        <div class="auth-visual-content">
            <div class="auth-brand">
                <span class="auth-brand-logo"><img src="images/black-logo.png" alt="HiSkyTech"></span>
                <div>
                    <strong>HiSkyTech</strong>
                    <small>Admin Panel</small>
                </div>
            </div>
            <h1>Join the team behind the platform</h1>
            <p>Create a new admin account to help manage content, services, and day-to-day operations.</p>
            <ul class="auth-features">
                <li><i class="fas fa-shield-halved"></i> Secure, role-based access</li>
                <li><i class="fas fa-gauge-high"></i> Real-time dashboard insights</li>
                <li><i class="fas fa-layer-group"></i> Every section in one place</li>
            </ul>
        </div>
    </div>

    <!-- SIGNUP CARD -->
    <div class="auth-form-panel">

        <div class="login-card">

            <h2 class="login-title">
                Create Account
            </h2>

            <p class="login-subtitle">
                Create a new admin account
            </p>


            <!-- ERROR MESSAGES -->

            <?php if (!empty($_GET['error'])): ?>

                <div class="alert alert-danger small py-2 text-center">

                    <?php

                    $error = (string) $_GET['error'];

                    switch ($error) {

                        case 'invalid':
                            echo "❌ Invalid input.";
                            break;

                        case 'exists':
                            echo "❌ Email already registered.";
                            break;

                        case 'failed':
                            echo "❌ Signup failed. Please try again.";
                            break;

                        case 'csrf':
                            echo "❌ Security validation failed. Please reload the page.";
                            break;

                        default:
                            echo "❌ Unable to create account.";
                            break;
                    }

                    ?>

                </div>

            <?php endif; ?>


            <!-- SIGNUP FORM -->

            <form
                method="POST"
                action="signup_action.php"
                novalidate
                autocomplete="off"
            >

                <!-- CSRF TOKEN -->

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?php echo htmlspecialchars(
                        $csrfToken,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>"
                >


                <!-- NAME -->

                <div class="input-group-custom">

                    <i class="fas fa-user"></i>

                    <input
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        required
                        maxlength="50"
                        autocomplete="name"
                        pattern="^[A-Za-z\s'-]+$"
                        title="Only letters, spaces, hyphens and apostrophes are allowed"
                    >

                </div>


                <!-- EMAIL -->

                <div class="input-group-custom">

                    <i class="fas fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email address"
                        required
                        maxlength="100"
                        autocomplete="email"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                    >

                </div>


                <!-- PASSWORD -->

                <div class="input-group-custom">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        minlength="8"
                        maxlength="100"
                        autocomplete="new-password"
                    >

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    name="signup"
                    class="btn-login"
                >
                    Create Account
                </button>

            </form>

        </div>

    </div>

</div>


<?php include 'partials/js.php'; ?>

</body>

</html>
