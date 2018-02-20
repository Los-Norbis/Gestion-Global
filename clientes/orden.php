<?php
$iniUrl = '../';
$Cant = $_GET['Cant'];
$Nombre = $_GET['Nombre'];
$Tipo = intval($_GET['Tipo']);
$Fecha = $_GET['Fecha'];

include($iniUrl . 'includes/db_connect.php');

$result = $mysqli->query("SELECT Orden FROM opciones WHERE Id = 1");
$fila = $result->fetch_assoc();
$result->close();

$result = $mysqli->prepare("UPDATE opciones SET Orden = ? WHERE Id = ?");
$new_orden =  $fila['Orden'] + 1;
$Id = 1;
$result->bind_param('ii', $new_orden, $Id);
$result->execute();
$result->close();

$mysqli->close();
		
require_once('../tcpdf/tcpdf.php');		
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Luis Favre');
$pdf->SetTitle('Orden de Combustible | ' . $Nombre);
$pdf->SetSubject('Zarate');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set font


$pdf->AddPage();
$todo = $pdf->getPageWidth();
$margen = $pdf->getMargins();
$todo = $todo - $margen['left'] - $margen['right'];
$pdf->SetFont('helvetica', '', 18);

$pdf->Image('../img/logo-cab.jpg', '', $margen['top'], 120, 18, 'JPG', '', '', true, 300, 'C', false, false, 0, false, false, false);
$pdf->Ln(25);
$pdf->Cell($todo, 0, '', 'T', 0, 'L', 0, '', 0);
$pdf->Ln(4);
$pdf->Cell($div, 0, 'Nº Orden: ' . $fila['Orden'] . ' | Cuenta Nº 550', 0, 0, 'L', 0, '', 0);
$pdf->Cell($div, 0, 'Fecha: ' . date('d/m/Y', strtotime($Fecha)), 0, 0, 'R', 0, '', 0);
$pdf->Ln(12);
$pdf->Cell($todo, 0, 'Transporte: ' . $Nombre, 0, 0, 'L', 0, '', 0);
$pdf->Ln(12);
$pdf->Cell($todo, 0, 'Se autoriza a cargar ' . $Cant . ' Lts. de ' . ($Tipo == 1 ? 'Gasoil' : 'Nafta'), 0, 0, 'L', 0, '', 0);
$pdf->Ln(60);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell($todo * .7, 0, '', '', 0, 'L', 0, '', 0);
$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 2, 'color' => array(0, 0, 0)));
$pdf->Cell($todo * .3, 0, 'Firma', 'T', 0, 'C', 0, '', 0);

$centro = $pdf->getPageHeight();
$pdf->SetXY($margen['left'], $centro / 2);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
$pdf->Cell($todo, 0, '', 'T', 0, 'L', 0, 0);

// ---------------------------------------------------------

$pdf->Output('orden.pdf', 'I');