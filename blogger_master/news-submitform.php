<?php
include("config.php");

function createSlug($title) {
    // Convert to lowercase
    $slug = strtolower(trim($title));
    // Replace spaces with hyphens
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    return $slug;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    // Handle file uploads
    $image1 = $_FILES['image1']['name'];  
    $image2 = $_FILES['image2']['name'];
    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    move_uploaded_file($_FILES['image1']['tmp_name'], $uploadDir . basename($image1));
    move_uploaded_file($_FILES['image2']['tmp_name'], $uploadDir . basename($image2));

    // Get other form inputs
    $title = $_POST['title']; // Get the title from the form
    $slug = createSlug($title); // Create the slug from the title
    
    // Sanitize blog content
    $blog_content = strip_tags($_POST['blog_content'], '<p><a><b><strong><i><em><blockquote><br><ul><ol><li>');

    // Set the current date
    $date = date('Y-m-d'); // You can change the format to suit your needs

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO blogs (title, image1, image2, date, blog_content, slug) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $image1, $image2, $date, $blog_content, $slug);

    if ($stmt->execute()) {
        echo "New blog post created successfully.";
        header("Location: components-tabs.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
