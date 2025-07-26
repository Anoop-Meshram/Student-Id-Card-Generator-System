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
            background-image: url('<?php echo $templateSrc; ?>');
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 20px;
        }
        .logo img {
            width: 90px;
        }
        .college-name {
            position: absolute;
            top: 15px;
            left: 130px;
            width: 440px;
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }
        .photo {
            position: absolute;
            top: 80px;
            left: 30px;
            width: 90px;
            height: 110px;
            border: 1.5px solid #000;
            background: #fff;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .details {
            position: absolute;
            top: 80px;
            left: 140px;
            width: 420px;
            font-size: 12px;
            color: #000;
            line-height: 1.4em;
        }
        .details p {
            margin: 4px 0;
        }
        .footer {
            position: absolute;
            bottom: 15px;
            left: 20px;
            font-size: 10px;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="logo">
            <img src="<?php echo $logoSrc; ?>" />
        </div>
        <div class="college-name">
            GH Raisoni College of Engineering & Management, Nagpur
        </div>
        <div class="photo">
            <img src="<?php echo $photoSrc; ?>" />
        </div>
        <div class="details">
            <p><strong>ID:</strong> <?php echo $user['id_number']; ?></p>
            <p><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
            <p><strong>DOB:</strong> <?php echo $user['dob']; ?></p>
            <p><strong>Blood Group:</strong> <?php echo $user['blood_group']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
            <p><strong>Department:</strong> <?php echo $user['department']; ?></p>
            <p><strong>Issue Date:</strong> <?php echo $user['issue_date']; ?></p>
            <p><strong>Valid Till:</strong> <?php echo $user['expiry_date']; ?></p>
        </div>
        <div class="footer">
            Issued by GHRCEM Nagpur. If found, please return to college.
        </div>
    </div>
</body>
</html>
