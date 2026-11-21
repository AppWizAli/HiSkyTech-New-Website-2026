<?php
session_start();
session_destroy();
setcookie('username', '', time() - 3600, "/"); // Unset the remember me cookie
header("Location: login.php");
exit;
?>
