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
            background-color: #fff;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 80px;
        }

        .logo img {
            width: 100%;
        }

        .college-name {
            position: absolute;
            top: 25px;
            left: 120px;
            font-size: 20px;
            font-weight: bold;
            color: #2d2d2d;
            width: 450px;
        }

        .college-name span {
            display: block;
            font-size: 14px;
            color: #f26522;
            font-weight: normal;
        }

        .photo {
            position: absolute;
            top: 100px;
            left: 25px;
            width: 100px;
            height: 120px;
            border: 1px solid #333;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details {
            position: absolute;
            top: 100px;
            left: 140px;
            font-size: 14px;
            color: #000;
            width: 430px;
            line-height: 1.6;
        }

        .id-number {
            position: absolute;
            top: 230px;
            left: 25px;
            font-size: 13px;
            font-weight: bold;
            color: red;
        }

        .footer {
            position: absolute;
            bottom: 15px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="logo">
            <img src="<?= $logoSrc ?>">
        </div>
        <div class="college-name">
            GH Raisoni College of Engineering & Management
            <span>Engineering and Management, Nagpur</span>
        </div>
        <div class="photo">
            <img src="<?= $photoSrc ?>">
        </div>
        <div class="id-number"><?= $user['id_number'] ?></div>
        <div class="details">
            <p><strong>Name:</strong> <?= $user['first_name'] ?> <?= $user['last_name'] ?></p>
            <p><strong>DOB:</strong> <?= $user['dob'] ?> &nbsp;&nbsp; <strong>Blood Grp.:</strong> <?= $user['blood_group'] ?></p>
            <p><strong>Dept.:</strong> <?= $user['department'] ?></p>
            <p><strong>Valid Till:</strong> <?= $user['expiry_date'] ?></p>
            <p><strong>Address:</strong> <?= $user['address'] ?></p>
            <p><strong>Phone:</strong> <?= $user['phone'] ?> &nbsp;&nbsp; <strong>Parent NO.:</strong> <?= $user['parent_contact'] ?? '' ?></p>
        </div>
        <div class="footer">
            Nagpur | Pune | Jalgaon | Amravati | Parbhani | Bhandara
        </div>
    </div>
</body>
</html>
