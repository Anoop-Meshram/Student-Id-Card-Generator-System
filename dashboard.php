<?php
session_start();
include("db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-bar .button {
            padding: 10px 18px;
            font-size: 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .top-bar .button:hover {
            background: #0056b3;
        }

        .logout-btn {
            background-color: #6c757d !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions a {
            margin: 0 4px;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 14px;
            color: white;
            display: inline-block;
            transition: background 0.2s ease;
        }

        .edit {
            background-color: #28a745;
        }

        .edit:hover {
            background-color: #218838;
        }

        .delete {
            background-color: #dc3545;
        }

        .delete:hover {
            background-color: #c82333;
        }

        .generate {
            background-color: #17a2b8;
        }

        .generate:hover {
            background-color: #138496;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                text-align: left;
                font-weight: bold;
                color: #555;
            }
        }
    </style>
</head>
<body>

    <h2>Welcome to Admin Dashboard</h2>

    <div class="top-bar">
        <a href="add_user.php" class="button">➕ Add Student</a>
        <a href="logout.php" class="button logout-btn">🔒 Logout</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Full Name</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="ID Number"><?php echo $row['id_number']; ?></td>
                    <td data-label="Full Name"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td data-label="DOB"><?php echo $row['dob']; ?></td>
                    <td data-label="Email"><?php echo $row['email']; ?></td>
                    <td data-label="Phone"><?php echo $row['phone']; ?></td>
                    <td data-label="Department"><?php echo $row['department']; ?></td>
                    <td data-label="Actions" class="actions">
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        <a href="generateid.php?id=<?php echo $row['id']; ?>" class="generate" target="_blank">Generate ID</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No users found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
