<?php
include("config.php");

// Handle publish/unpublish actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    // Example: Toggle publish/unpublish logic
    // Update query for publish/unpublish would go here if applicable

    // Redirect to avoid resubmission on page refresh
    header("Location: admin-panel.php");
    exit();
}

// Fetch blogs from database
$sql = "SELECT id, image1, image2, date, title, blog_content, created_at FROM blogs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Blog Posts</title>
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
    <h2>Manage Blog Posts</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
               
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    
                    <td>
                        <img src="uploads/<?php echo htmlspecialchars($row['image1']); ?>" alt="Image 1" style="width: 50px;">
                    </td>
                    <td>
                        <img src="uploads/<?php echo htmlspecialchars($row['image2']); ?>" alt="Image 2" style="width: 50px;">
                    </td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="edit-blog.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                        <a href="delete-blog.php?id=<?php echo $row['id']; ?>" class="action-btn delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
