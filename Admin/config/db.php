<?php

$host = "localhost";
$user = "u223360224_hiskytechali07";     // change if needed
$pass = "Hiskytechs_Management23";         // change if needed
$db   = "u223360224_hiskytech_data";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

