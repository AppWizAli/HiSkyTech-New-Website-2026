<?php
include 'config.php'; // Database connection

// Check if blog ID is set in the URL
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Delete the blog post from the database
    $sql = "DELETE FROM fashion_blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);

    if ($stmt->execute()) {
        echo "Blog deleted successfully!";
        header("Location: tables-general.php");
        exit;
    } else {
        echo "Error deleting blog!";
    }
} else {
    echo "Invalid request!";
}
?>

<?php
$conn->close();
?>
