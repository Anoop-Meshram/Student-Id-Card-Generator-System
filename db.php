<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'id_card_system_enhanced';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
