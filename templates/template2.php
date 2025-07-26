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
            background-image: url('<?php echo $templateSrc; ?>');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .header {
            position: absolute;
            top: 15px;
            left: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo img {
            width: 90px;
        }
        .college-name {
            font-size: 16px;
            font-weight: bold;
            color: #002147;
            text-align: center;
            flex-grow: 1;
            margin-left: 20px;
        }
        .photo {
            position: absolute;
            top: 110px;
            left: 25px;
            width: 100px;
            height: 120px;
            border: 2px solid #444;
            background: #fff;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .details {
            position: absolute;
            top: 110px;
            left: 140px;
            font-size: 14px;
            color: #000;
            line-height: 1.4em;
            max-width: 430px;
        }
        .details p {
            margin: 4px 0;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="header">
            <div class="logo"><img src="<?php echo $logoSrc; ?>" alt="College Logo"></div>
            <div class="college-name">GH Raisoni College of Engineering & Management, Nagpur</div>
        </div>
        <div class="photo"><img src="<?php echo $photoSrc; ?>" alt="Student Photo"></div>
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
            This card is the property of GHRCEM Nagpur. If found, please return to the college.
        </div>
    </div>
</body>
</html>
