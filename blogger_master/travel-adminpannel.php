<?php
include("config.php");

// Fetch blogs from database
$sql = "SELECT id, title, description, image1, image2, created_at FROM blogs_travel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blog Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .admin-panel {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .admin-panel h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .admin-panel table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-panel table th, .admin-panel table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .admin-panel table th {
            background-color: #f2f2f2;
        }
        .image-container img {
            width: 50px;
            height: 50px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-btn {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            width: 100%;
            text-align: center;
            font-weight: 600;
        }
        .edit-btn {
            background-color: #007bff;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .edit-btn:hover, .delete-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="admin-panel">
    <h2>Blog Management Admin Panel</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td class='image-container'>
                            <img src='uploads/{$row['image1']}' alt='Image 1'>
                        </td>
                        <td class='image-container'>
                            <img src='uploads/{$row['image2']}' alt='Image 2'>
                        </td>
                        <td>{$row['created_at']}</td>
                        <td class='action-buttons'>
                            <a class='action-btn edit-btn' href='travel-edit.php?id={$row['id']}'>Edit</a> 
                            <a class='action-btn delete-btn' href='travel-delete.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No blog posts found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
