<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the blog post data
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Blog post not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $blog_content = $_POST['blog_content'];

    // Handle image uploads
    $image1 = $row['image1'];
    $image2 = $row['image2'];

    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        $image1 = $_FILES['image1']['name'];
        move_uploaded_file($_FILES['image1']['tmp_name'], "uploads/" . $image1);
    }

    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2 = $_FILES['image2']['name'];
        move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/" . $image2);
    }

    // Update the blog post in the database
    $sql = "UPDATE blogs SET title = ?, date = ?, blog_content = ?, image1 = ?, image2 = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $date, $blog_content, $image1, $image2, $id);
    $stmt->execute();

    // Redirect after update
    header("Location:components-tabs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <script src="https://cdn.ckeditor.com/4.20.0/full-all/ckeditor.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Blog Post</h2>
    <form action="edit-blog.php" method="post" enctype="multipart/form-data">
        <label for="title">Blog Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>

        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($row['date']); ?>" required>

        <label for="blog_content">Blog Content</label>
        <textarea name="blog_content" id="blog_content" required><?php echo htmlspecialchars($row['blog_content']); ?></textarea>

        <label for="image1">Upload Image 1 (Leave blank to keep current)</label>
        <input type="file" name="image1">

        <label for="image2">Upload Image 2 (Leave blank to keep current)</label>
        <input type="file" name="image2">

        <button type="submit">Update Blog</button>
    </form>
</div>

<script>
    // Initialize CKEditor for blog content
    CKEDITOR.replace('blog_content', {
        extraPlugins: 'image2',
        height: 300
    });
</script>

</body>
</html>
