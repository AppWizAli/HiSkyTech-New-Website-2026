<?php
include 'config.php'; // Database connection

// Check if blog ID is set in the URL
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Fetch the blog post details from the database
    $sql = "SELECT * FROM fashion_blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    if (!$blog) {
        echo "Blog not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Check if the update form is submitted
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $blog_content = $_POST['blog_content'];
    
    // Handle file uploads
    $image1 = $blog['image1']; // Default to existing image
    $image2 = $blog['image2']; // Default to existing image

    // Process Image 1 upload
    if (!empty($_FILES['image1']['name'])) {
        $image1 = 'uploads/' . basename($_FILES['image1']['name']);
        move_uploaded_file($_FILES['image1']['tmp_name'], $image1);
    }

    // Process Image 2 upload
    if (!empty($_FILES['image2']['name'])) {
        $image2 = 'uploads/' . basename($_FILES['image2']['name']);
        move_uploaded_file($_FILES['image2']['tmp_name'], $image2);
    }

    // Update blog in the database
    $sql = "UPDATE fashion_blogs SET title = ?, date = ?, image1 = ?, image2 = ?, description = ?, blog_content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $title, $date, $image1, $image2, $description, $blog_content, $blog_id);

    if ($stmt->execute()) {
        echo "Blog updated successfully!";
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "Error updating blog!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fashion Blog</title>

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .submit-btn {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 style="text-align: center;">Edit Fashion Blog</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Image 1 -->
        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" id="image1" name="image1" accept="image/*">
            <p>Current Image: <img src="<?php echo htmlspecialchars($blog['image1']); ?>" width="100" alt="Current Image 1" /></p>
        </div>

        <!-- Image 2 -->
        <div class="form-group">
            <label for="image2">Image 2:</label>
            <input type="file" id="image2" name="image2" accept="image/*">
            <p>Current Image: <img src="<?php echo htmlspecialchars($blog['image2']); ?>" width="100" alt="Current Image 2" /></p>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($blog['date']); ?>" required>
        </div>

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($blog['description']); ?></textarea>
        </div>

        <!-- Blog Content with CKEditor -->
        <div class="form-group">
            <label for="blog_content">Blog Content:</label>
            <textarea id="blog_content" name="blog_content" rows="10" required><?php echo htmlspecialchars($blog['blog_content']); ?></textarea>
        </div>

        <button type="submit" name="update" class="submit-btn">Update Blog</button>
    </form>
</div>

<!-- Initialize CKEditor for the blog content field -->
<script>
    CKEDITOR.replace('blog_content');
</script>
</body>
</html>

<?php
$conn->close();
?>
