<?php
include 'config.php'; // Database connection

// Fetch all blogs
$sql = "SELECT * FROM fashion_blogs ORDER BY created_at DESC";
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
        .admin-panel h1 {
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
            color: black;
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
        .add-blog-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .add-blog-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="admin-panel">
    <h1>Admin Panel - Blog Management</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Image1</th>
                <th>Image2</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0) : ?>
            <?php while($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td class="image-container">
                        <?php if (!empty($row['image1'])): ?>
                            <img src="<?php echo $row['image1']; ?>" alt="Image1">
                        <?php else: ?>
                            No Image1
                        <?php endif; ?>
                    </td>
                    <td class="image-container">
                        <?php if (!empty($row['image2'])): ?>
                            <img src="<?php echo $row['image2']; ?>" alt="Image2">
                        <?php else: ?>
                            No Image2
                        <?php endif; ?>
                    </td>
                    <td class="action-buttons">
                        <a class="action-btn edit-btn" href="fashion-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="action-btn delete-btn" href="fashion-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">No blogs found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
