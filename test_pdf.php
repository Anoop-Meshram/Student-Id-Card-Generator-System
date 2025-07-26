<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>Hello, this is a test PDF!</h1>');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("test.pdf", ["Attachment" => false]);
