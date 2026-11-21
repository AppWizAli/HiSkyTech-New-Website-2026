<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete the blog post
    $sql = "DELETE FROM blogs_travel WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location:forms-editors.php"); // Redirect after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    die("Invalid request.");
}

$conn->close();
?>
