<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student ID Card Generator</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #007BFF, #00C6FF);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .btn {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Student ID Card Generator</h1>
        <p>Click below to log in as an admin and start managing student IDs.</p>
        <a class="btn" href="login.php">Go to Admin Login</a>
    </div>
</body>
</html>

