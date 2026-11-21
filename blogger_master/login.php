<?php
session_start();
include 'config.php'; // Database connection

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Valid credentials, start session
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];

        // Remember me functionality
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
        }

        // Redirect to a protected page (like a dashboard)
        header("Location: index1.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password</div>";
    }
}
?>
