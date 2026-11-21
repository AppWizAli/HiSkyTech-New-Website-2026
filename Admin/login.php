
<?php

/* =====================================================================
   SESSION
===================================================================== */

session_start();


/* =====================================================================
   CSRF TOKEN
===================================================================== */

if (
    empty($_SESSION['csrf_token']) ||
    !is_string($_SESSION['csrf_token'])
) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];


/* =====================================================================
   BLOCK ALREADY LOGGED-IN ADMIN
===================================================================== */

if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Login</title>

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

/* LOGIN CARD */

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

/* INPUT GROUP */

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

/* ERROR */

.login-error { margin-bottom: 1.2rem; border-radius: var(--radius-sm, 10px); }

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

    <!-- =========================================================
         LEFT BRANDED PANEL
    ========================================================== -->
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
            <h1>Welcome back to your control center</h1>
            <p>Sign in to manage your content, services, and team — all from one place.</p>
            <ul class="auth-features">
                <li><i class="fas fa-shield-halved"></i> Secure, role-based access</li>
                <li><i class="fas fa-gauge-high"></i> Real-time dashboard insights</li>
                <li><i class="fas fa-layer-group"></i> Every section in one place</li>
            </ul>
        </div>
    </div>

    <!-- =========================================================
         LOGIN CARD
    ========================================================== -->
    <div class="auth-form-panel">

            <div class="login-card">


                <!-- TITLE -->

                <h2 class="login-title">
                    Welcome Back
                </h2>

                <p class="login-subtitle">
                    Login to continue to your dashboard
                </p>


                <!-- =================================================
                     ERROR MESSAGE
                ================================================== -->

                <?php if (!empty($_GET['error'])): ?>

                    <div
                        class="alert alert-danger small py-2 login-error"
                        role="alert"
                    >
                        Invalid email or password.
                    </div>

                <?php endif; ?>


                <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                <form
                    method="POST"
                    action="login_action.php"
                    autocomplete="off"
                >


                    <!-- =================================================
                         CSRF TOKEN
                    ================================================== -->

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars(
                            $csrfToken,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >


                    <!-- =================================================
                         EMAIL
                    ================================================== -->

                    <div class="input-group-custom">

                        <i class="fas fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            placeholder="Email address"
                            required
                            maxlength="255"
                            autocomplete="username"
                        >

                    </div>


                    <!-- =================================================
                         PASSWORD
                    ================================================== -->

                    <div class="input-group-custom">

                        <i class="fas fa-lock"></i>

                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                            minlength="6"
                            maxlength="4096"
                            autocomplete="current-password"
                        >

                    </div>


                    <!-- =================================================
                         LOGIN BUTTON
                    ================================================== -->

                    <button
                        type="submit"
                        name="login"
                        class="btn-login"
                    >
                        Sign In
                    </button>


                </form>


            </div>

    </div>

</div>


<?php include 'partials/js.php'; ?>


</body>

</html>
