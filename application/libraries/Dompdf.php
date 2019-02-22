<?php
require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>DOMPDF Demo</h1><br><p>Hello World !</p>');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>
