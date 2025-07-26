<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = $_POST['username'];
    $admin_pass = $_POST['password'];

    if ($admin_user == "admin" && $admin_pass == "admin123") {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(45deg, #ff6b6b, #f06595);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .login-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-50px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #ddd;
            font-size: 16px;
            transition: border 0.3s ease;
        }
        .input-group input:focus {
            border-color: #f06595;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #f06595;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e04a80;
        }
        .error-message {
            text-align: center;
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 10px;
        }
        .login-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            z-index: -1;
            animation: blurEffect 2s infinite ease-in-out;
        }
        @keyframes blurEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @media (max-width: 600px) {
            .login-box {
                padding: 30px;
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    </div>
</body>
</html>
