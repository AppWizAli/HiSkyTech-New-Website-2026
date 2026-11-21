<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
include "config/db.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status']=='read' ? 'read' : 'unread';

    mysqli_query($conn, "UPDATE contact_messages SET status='$status' WHERE id=$id");
}

header("Location: show.php?table=contact_messages");
exit;