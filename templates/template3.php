<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .id-card {
            width: 600px;
            height: 350px;
            position: relative;
            font-family: Arial, sans-serif;
            background-color: white;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 90px;
        }

        .logo img {
            width: 100%;
        }

        .college-name {
            position: absolute;
            top: 20px;
            left: 130px;
            right: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #222;
            line-height: 1.3;
        }

        .college-name span {
            display: block;
            font-size: 13px;
            font-weight: normal;
            color: #666;
        }

        .photo {
            position: absolute;
            top: 100px;
            left: 30px;
            width: 100px;
            height: 120px;
            border: 1px solid #333;
            overflow: hidden;
            background: #fff;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .id-number {
            position: absolute;
            top: 230px;
            left: 30px;
            font-size: 13px;
            font-weight: bold;
            color: red;
        }

        .details {
            position: absolute;
            top: 100px;
            left: 150px;
            right: 20px;
            font-size: 13px;
            color: #000;
            line-height: 1.5;
        }

        .details p {
            margin: 4px 0;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            font-size: 11px;
            text-align: center;
            color: #555;
        }

    </style>
</head>
<body>
    <div class="id-card">
        <div class="logo">
            <img src="<?= $logoSrc ?>">
        </div>
        <div class="college-name">
            GH Raisoni College of Engineering & Management, Nagpur
        </div>
        <div class="photo">
            <img src="<?= $photoSrc ?>">
        </div>
        <div class="id-number">ID: <?= $user['id_number'] ?></div>
        <div class="details">
            <p><strong>Name:</strong> <?= $user['first_name'] ?> <?= $user['last_name'] ?></p>
            <p><strong>DOB:</strong> <?= $user['dob'] ?> &nbsp;&nbsp; <strong>Blood Group:</strong> <?= $user['blood_group'] ?></p>
            <p><strong>Department:</strong> <?= $user['department'] ?></p>
            <p><strong>Valid Till:</strong> <?= $user['expiry_date'] ?></p>
            <p><strong>Address:</strong> <?= $user['address'] ?></p>
            <p><strong>Phone:</strong> <?= $user['phone'] ?> &nbsp;&nbsp;</p>
        </div>
        <div class="footer">
            Nagpur | Pune | Jalgaon | Amravati | Parbhani | Bhandara
        </div>
    </div>
</body>
</html>
