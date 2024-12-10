<?php
require '../../vendor/autoload.php'; 

class MYPDF extends TCPDF {
    // Load header content
    public function Header() {
        include('evaHeaderReport.php');
    }

    // Load footer content
    public function Footer() {
        include('footerReport.php');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Eva Evaluaciones Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
$pdf->AddPage();

// Set some content to print
$html = '<h1>Eva Evaluaciones Report</h1>';
$html .= '<table border="1" cellpadding="4">';
$html .= '<thead><tr><th>Header 1</th><th>Header 2</th></tr></thead>';
$html .= '<tbody>';
foreach ($arrayResumen as $datoResumen) {
    $html .= '<tr>';
    $html .= '<td>' . $datoResumen['nombreNivelEvaluacion'] . '</td>';
    $html .= '<td>' . $datoResumen['edadCronologica'] . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('eva_evaluaciones_report.pdf', 'I');
?>