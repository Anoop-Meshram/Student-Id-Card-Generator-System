<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "User ID is missing.";
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

// Fetch user to remove associated photo
$sql = "SELECT photo FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $photoPath = $user['photo'];
    
    if (file_exists($photoPath)) {
        unlink($photoPath); // Delete photo file
    }

    // Delete the user from the database
    $delete = "DELETE FROM users WHERE id = '$id'";
    if ($conn->query($delete) === TRUE) {
        header("Location: dashboard.php?msg=User+Deleted+Successfully");
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "User not found.";
}
?>
