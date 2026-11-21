<?php
// Include the config.php file for database connection
include 'config.php';

// Function to create a slug from the title
function createSlug($title) {
    // Convert to lowercase, trim, and replace spaces and special characters with hyphens
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug); // Replace non-alphanumeric characters with hyphens
    $slug = trim($slug, '-'); // Trim hyphens from the start and end
    return $slug;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Prepare data from the form and escape to prevent SQL injection
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $blog_content = $conn->real_escape_string($_POST['blog_content']);
    $date = $_POST['date'] ?? date('Y-m-d'); // Use submitted date or current date

    // Generate slug from the title
    $slug = createSlug($title);

    // Check if the slug already exists in the database
    $check_slug = $conn->query("SELECT COUNT(*) FROM fashion_blogs WHERE slug = '$slug'");
    if ($check_slug->fetch_row()[0] > 0) {
        echo "A blog with this slug already exists. Please choose a different title.";
        exit; // Stop execution if the slug already exists
    }

    // Handle image1 upload
    $target_dir = "uploads/";
    $image1 = '';
    $image2 = '';

    if (isset($_FILES["image1"]) && $_FILES["image1"]["error"] === UPLOAD_ERR_OK) {
        // Get the file extension for image1
        $image1_ext = pathinfo($_FILES["image1"]["name"], PATHINFO_EXTENSION);
        // Create a unique name for image1 and move the file
        $image1_name = uniqid("img1_") . "." . $image1_ext;
        $image1 = $target_dir . $image1_name;
        move_uploaded_file($_FILES["image1"]["tmp_name"], $image1);
    } else {
        echo "Error uploading image1.";
    }

    // Handle image2 upload (optional)
    if (isset($_FILES["image2"]) && $_FILES["image2"]["error"] === UPLOAD_ERR_OK) {
        // Get the file extension for image2
        $image2_ext = pathinfo($_FILES["image2"]["name"], PATHINFO_EXTENSION);
        // Create a unique name for image2 and move the file
        $image2_name = uniqid("img2_") . "." . $image2_ext;
        $image2 = $target_dir . $image2_name;
        move_uploaded_file($_FILES["image2"]["tmp_name"], $image2);
    } else {
        $image2 = null; // No second image uploaded
    }

    // Insert the blog data into the database
    $sql = "INSERT INTO fashion_blogs (image1, image2, date, title, description, blog_content, slug) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $image1, $image2, $date, $title, $description, $blog_content, $slug);

    if ($stmt->execute()) {
        // Redirect to the general table page after successful insertion
        header("Location: tables-general.php");
        exit; // Always call exit after header redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
