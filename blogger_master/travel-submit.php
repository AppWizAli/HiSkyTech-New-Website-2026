<?php
// Include database configuration
include("config.php");

// Function to create a slug from the title
function createSlug($title) {
    // Convert to lowercase, trim whitespace, and replace spaces with hyphens
    $slug = strtolower(trim($title));
    // Replace any character that is not a letter, number, or hyphen with a hyphen
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    // Remove any trailing or leading hyphens
    $slug = trim($slug, '-');
    return $slug;
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $blog_content = $_POST['blog_content'];

    // Generate slug from the title
    $slug = createSlug($title);

    // Check if the slug already exists in the database
    $check_slug = $conn->query("SELECT COUNT(*) FROM blogs_travel WHERE slug = '$slug'");
    if ($check_slug->fetch_row()[0] > 0) {
        echo "A blog with this slug already exists. Please choose a different title.";
        exit; // Stop execution if the slug already exists
    }

    // Handle image uploads
    $image1 = '';
    $image2 = '';

    // Process Image 1 Upload
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        $image1 = basename($_FILES['image1']['name']); // Get only the file name
        $target_file1 = "uploads/" . $image1; // Set the target path
        move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1);
    }

    // Process Image 2 Upload
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2 = basename($_FILES['image2']['name']); // Get only the file name
        $target_file2 = "uploads/" . $image2; // Set the target path
        move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2);
    }

    // Insert data into the database
    $sql = "INSERT INTO blogs_travel (title, description, blog_content, image1, image2, slug) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $title, $description, $blog_content, $image1, $image2, $slug);

    if ($stmt->execute()) {
        echo "Blog post inserted successfully!";
        header("Location: forms-editors.php");
        exit; // Always call exit after header redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
