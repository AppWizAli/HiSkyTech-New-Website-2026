<?php
$servername = "localhost";
$username = "u223360224_blogdb";
$password = "Blogdb@123";
$dbname = "u223360224_blogdb"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
