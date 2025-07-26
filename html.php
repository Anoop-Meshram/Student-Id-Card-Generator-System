<?php
require 'vendor/autoload.php'; // Dompdf autoload

use Dompdf\Dompdf;
use Dompdf\Options;

include("db.php"); // Database connection

if (!isset($_GET['id'])) {
    echo "No user selected.";
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

// Fetch user data
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "User not found.";
    exit;
}

$user = $result->fetch_assoc();

// Load and encode photo
$photoPath = 'uploads/' . $user['photo'];
if (!file_exists($photoPath)) {
    $photoPath = 'placeholder.jpg'; // fallback
}
$photoBase64 = base64_encode(file_get_contents($photoPath));
$photoSrc = 'data:image/jpeg;base64,' . $photoBase64;

// Load and encode logo
$logoPath = 'uploads/college_logo.png'; // your college logo path
$logoBase64 = base64_encode(file_get_contents($logoPath));
$logoSrc = 'data:image/png;base64,' . $logoBase64;

// HTML content
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .id-card {
            width: 100%;
            height: 100%;
            border: 2px solid #000;
            border-radius: 10px;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            padding: 10px;
            box-sizing: border-box;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header img {
            width: 40px;
            height: 40px;
            vertical-align: middle;
        }
        .header span {
            font-size: 16px;
            font-weight: bold;
            margin-left: 10px;
            vertical-align: middle;
        }
        .photo {
            position: absolute;
            top: 60px;
            right: 15px;
        }
        .photo img {
            width: 80px;
            height: 100px;
            border: 1px solid #333;
            border-radius: 5px;
            object-fit: cover;
        }
        .details {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 110px;
        }
        .details p {
            margin: 3px 0;
            font-size: 12px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="header">
            <img src="' . $logoSrc . '" alt="College Logo">
            <span>National Institute of Technology</span>
        </div>
        <div class="photo">
            <img src="' . $photoSrc . '" alt="User Photo">
        </div>
        <div class="details">
            <p><span class="label">ID:</span> ' . $user['id_number'] . '</p>
            <p><span class="label">Name:</span> ' . $user['first_name'] . ' ' . $user['last_name'] . '</p>
            <p><span class="label">DOB:</span> ' . $user['dob'] . '</p>
            <p><span class="label">Blood Group:</span> ' . $user['blood_group'] . '</p>
            <p><span class="label">Phone:</span> ' . $user['phone'] . '</p>
            <p><span class="label">Department:</span> ' . $user['department'] . '</p>
            <p><span class="label">Valid Till:</span> ' . $user['expiry_date'] . '</p>
        </div>
    </div>
</body>
</html>
';

// DomPDF setup
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->setPaper([0, 0, 420, 297], 'landscape'); // A7 in points (landscape)
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("ID_Card_" . $user['first_name'] . ".pdf", ["Attachment" => false]);
exit;
?>
