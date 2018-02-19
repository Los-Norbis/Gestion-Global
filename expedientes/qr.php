<?php

$exp_numero = $_GET['Id'];
$alcance = $_GET['Alcance'];

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('P', 'mm', array('65','58'), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('HCD Necochea');
$pdf->SetTitle('Codigo QR para Expediente ' . $exp_numero);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 0, 0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

// new style
$style = array(
	'border' => false,
	'padding' => 1,
	'fgcolor' => array(0,0,0),
	'bgcolor' => false
);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($exp_numero . (!empty($alcance) ? '|' . $alcance : ''), 'QRCODE,H', 5, 5, 47,	47, $style, 'N');
$pdf->setXY(5, 54);
$pdf->Cell(47, 4, $exp_numero . (!empty($alcance) ? ' | ' . $alcance : ''), 'LTRB', 2, 'C');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($exp_numero . '.pdf', 'I');