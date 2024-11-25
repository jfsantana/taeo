<?php
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize Dompdf with options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Load HTML content
ob_start();
include 'informeEvaluacionAprendiz.php';
$html = ob_get_clean();

// Set paper size to letter and orientation to landscape
$dompdf->setPaper('letter', 'landscape');

// Load HTML to Dompdf
$dompdf->loadHtml($html);

// Render the PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("informeEvaluacionAprendiz.pdf", ["Attachment" => false]);
?>