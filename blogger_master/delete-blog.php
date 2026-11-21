<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the blog post to delete the images from the server
    $sql = "SELECT image1, image2 FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Delete images from the server
        if (file_exists("uploads/" . $row['image1'])) {
            unlink("uploads/" . $row['image1']);
        }
        if (file_exists("uploads/" . $row['image2'])) {
            unlink("uploads/" . $row['image2']);
        }
    }

    // Delete the blog post from the database
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirect after deletion
    header("Location: components-tabs.php");
    exit();
}
?>

