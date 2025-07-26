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
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "User not found.";
    exit;
}

$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $department = $_POST['department'];
    $issue_date = $_POST['issue_date'];
    $expiry_date = $_POST['expiry_date'];
    $template = $_POST['template'];

    $photo_path = $user['photo'];
    if ($_FILES['photo']['name']) {
        $target_dir = "uploads/";
        $photo_path = $target_dir . time() . "_" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);
    }
    $update = "UPDATE users SET 
        first_name='$first_name', 
        last_name='$last_name', 
        dob='$dob',
        email='$email', 
        phone='$phone', 
        address='$address', 
        blood_group='$blood_group',
        department='$department', 
        issue_date='$issue_date', 
        expiry_date='$expiry_date', 
        photo='$photo_path',
        template='$template'
        WHERE id = '$id'";
          if ($conn->query($update) === TRUE) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Update failed: " . $conn->error;
        }
    }
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            padding: 40px;
        }
        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
        img.preview {
            width: 100px;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Student</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= $user['first_name'] ?>" required>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= $user['dob'] ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?>">

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= $user['phone'] ?>">

        <label>Address:</label>
        <textarea name="address"><?= $user['address'] ?></textarea>

        <label>Blood Group:</label>
        <input type="text" name="blood_group" value="<?= $user['blood_group'] ?>">

        <label>Department:</label>
        <input type="text" name="department" value="<?= $user['department'] ?>">

        <label>Issue Date:</label>
        <input type="date" name="issue_date" value="<?= $user['issue_date'] ?>">

        <label>Expiry Date:</label>
        <input type="date" name="expiry_date" value="<?= $user['expiry_date'] ?>">
        <label>Change Photo (optional):</label>
        <input type="file" name="photo">
        <img class="preview" src="<?= $user['photo'] ?>" alt="Current Photo"><br>

        <label>Template:</label>
        <select name="template" required>
            <option value="template1" <?= $user['template'] == 'template1' ? 'selected' : '' ?>>Template 1</option>
            <option value="template2" <?= $user['template'] == 'template2' ? 'selected' : '' ?>>Template 2</option>
            <option value="template3" <?= $user['template'] == 'template3' ? 'selected' : '' ?>>Template 3</option>
            <option value="template4" <?= $user['template'] == 'template4' ? 'selected' : '' ?>>Template 4</option>
            <option value="template5" <?= $user['template'] == 'template5' ? 'selected' : '' ?>>Template 5</option>
        </select>
        <button type="submit">Update Student</button>
    </form>

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>