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

// Student photo
$photoPath = $user['photo'] && file_exists($user['photo']) ? $user['photo'] : 'placeholder.jpg';
$photoSrc = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($photoPath));

// College logo
$logoPath = "uploads/rgi-logo.png";
$logoSrc = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));

// Template info
$templateName = $user['template']; // e.g., 'template1'
$templateImagePath = "templates/" . $templateName . ".png"; // Background image
$templateFile = "templates/" . $templateName . ".php";      // HTML layout

// Base64 template background
$templateSrc = file_exists($templateImagePath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($templateImagePath)) : "";

// Verify template file exists
if (!file_exists($templateFile)) {
    echo "Template file not found.";
    exit;
}

// Pass these variables to the template
ob_start();
include($templateFile);
$html = ob_get_clean();

// Generate PDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper([0, 0, 600, 350]);
$dompdf->render();
$dompdf->stream("ID_Card_" . $user['first_name'] . ".pdf", ["Attachment" => false]);
exit;
?>
