<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include("db.php");

function generateIDNumber($conn) {
    $year = date("Y");
    $prefix = "ID" . $year;
    $sql = "SELECT id_number FROM users WHERE id_number LIKE '$prefix%' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $lastId = $result->fetch_assoc()['id_number'];
        $num = (int)substr($lastId, -4) + 1;
    } else {
        $num = 1;
    }
    return $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_number = generateIDNumber($conn);
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

    $photo_path = "";
    if ($_FILES['photo']['name']) {
        $target_dir = "uploads/";
        $photo_path = $target_dir . time() . "_" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);
    }

    $sql = "INSERT INTO users (id_number, first_name, last_name, dob, email, phone, address, blood_group, department, issue_date, expiry_date, photo, template) 
            VALUES ('$id_number', '$first_name', '$last_name', '$dob', '$email', '$phone', '$address', '$blood_group', '$department', '$issue_date', '$expiry_date', '$photo_path', '$template')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            margin: 0;
            padding: 40px 20px;
        }

        .form-container {
            background: white;
            max-width: 800px;
            margin: auto;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        form input,
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        button {
            grid-column: 1 / -1;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #0056b3;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>🎓 Add New Student</h2>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>First Name:</label>
            <input type="text" name="first_name" required>
        </div>

        <div>
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
        </div>

        <div>
            <label>Date of Birth:</label>
            <input type="date" name="dob">
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>

        <div>
            <label>Phone:</label>
            <input type="text" name="phone">
        </div>

        <div>
            <label>Blood Group:</label>
            <input type="text" name="blood_group">
        </div>

        <div class="full-width">
            <label>Address:</label>
            <textarea name="address" rows="2"></textarea>
        </div>

        <div>
            <label>Department:</label>
            <input type="text" name="department">
        </div>

        <div>
            <label>Photo:</label>
            <input type="file" name="photo" required>
        </div>

        <div>
            <label>Issue Date:</label>
            <input type="date" name="issue_date">
        </div>

        <div>
            <label>Expiry Date:</label>
            <input type="date" name="expiry_date">
        </div>

        <div class="full-width">
            <label>Template:</label>
            <select name="template" required>
                <option value="">-- Select Template --</option>
                <option value="template1">Template 1</option>
                <option value="template2">Template 2</option>
                <option value="template3">Template 3</option>
                <option value="template4">Template 4</option>
                <option value="template5">Template 5</option>
            </select>
        </div>

        <button type="submit">✅ Add Student</button>
    </form>

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
