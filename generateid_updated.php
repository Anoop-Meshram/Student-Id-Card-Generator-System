
<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include("db.php");

if (!isset($_GET['id'])) {
    echo "No user selected.";
    exit;
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "User not found.";
    exit;
}

$user = $result->fetch_assoc();

// Get user photo
$photoPath = $user['photo'] && file_exists($user['photo']) ? $user['photo'] : 'placeholder.jpg';
$photoBase64 = base64_encode(file_get_contents($photoPath));
$photoSrc = 'data:image/jpeg;base64,' . $photoBase64;

// Template image (based on saved selection)
$templateName = $user['template'];
$templatePath = "templates/" . $templateName . ".png"; // example: template1.png

$templateBase64 = base64_encode(file_get_contents($templatePath));
$templateSrc = 'data:image/png;base64,' . $templateBase64;

// HTML with background
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .id-card {
            width: 350px;
            height: 220px;
            position: relative;
            background-image: url("' . $templateSrc . '");
            background-size: cover;
            color: #000;
        }
        .photo {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .photo img {
            width: 70px;
            height: 90px;
            object-fit: cover;
            border-radius: 5px;
        }
        .details {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 240px;
        }
        .details p {
            margin: 3px 0;
            font-size: 12px;
        }
        .details .id {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="id-card">
        <div class="photo">
            <img src="' . $photoSrc . '" />
        </div>
        <div class="details">
            <p class="id">ID: ' . $user['id_number'] . '</p>
            <p>Name: ' . $user['first_name'] . ' ' . $user['last_name'] . '</p>
            <p>DOB: ' . $user['dob'] . '</p>
            <p>Blood: ' . $user['blood_group'] . '</p>
            <p>Phone: ' . $user['phone'] . '</p>
            <p>Dept: ' . $user['department'] . '</p>
            <p>Valid Till: ' . $user['expiry_date'] . '</p>
        </div>
    </div>
</body>
</html>
';

// Generate PDF
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper([0, 0, 350, 220], 'portrait'); // Custom size
$dompdf->render();
$dompdf->stream("ID_Card_" . $user['first_name'] . ".pdf", ["Attachment" => false]);
exit;
?>
