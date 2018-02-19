<?php
include('../includes/db_connect.php');

if (empty($_GET)) {
  $ingreso = $_POST['ingreso'];
  $periodo = $_POST['periodo'];
  $numero = $_POST['numero'];
  $alcance = $_POST['alcance'];
  $cuerpo = $_POST['cuerpo'];
  $caratula = $_POST['caratula'];
  $solicitante = $_POST['solicitante'];
  $notas = $_POST['notas'];
  
  $id = $periodo . $numero;
} else {
	$orden = $_GET['Id'];
	$alcance = $_GET['Alcance'];
	$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $orden . " AND Alcance = " . $alcance;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo '<h2>Error... Expediente no encontrado (Orden: ' . $orden . '</h2>';
			exit;
	} else {
			$a_exp = $resultado->fetch_assoc();
			$periodo = substr($a_exp['Orden'], 0, 4);
			$numero  = substr($a_exp['Orden'], 4, 4);
	}	

	
	$ingreso = $a_exp['Ingreso'];
	$alcance = $a_exp['Alcance'];
	$cuerpo = $a_exp['Cuerpo'];
	$caratula = $a_exp['Caratula'];
	$solicitante = $a_exp['Solicitante'];
	$notas = $a_exp['Notas'];
	$id = $periodo . $numero;
	//var_dump($a_exp);	
	//die();
}


$sql = "SELECT * FROM me_solicitantes WHERE Id = " . $solicitante;
if ($resultado = $mysqli->query($sql)) {
	$fila = $resultado->fetch_row();
}
$mysqli->close();

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Luis Favre');
$pdf->SetTitle('Caratula para Expediente ' . $numero . ' | ' . $periodo );


// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 12, 20);

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
$pdf->AddPage('P', 'A4');
$todo = $pdf->getPageWidth();
$margen = $pdf->getMargins();
$todo = $todo - $margen['left'] - $margen['right'];
$style1 = array('width' => 0.35, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(180, 180, 180));
$pdf->SetFont('neuehaas', '', 16);

// new style
$style = array(
	'border' => false,
	'padding' => 1,
	'fgcolor' => array(0,0,0),
	'bgcolor' => false
);

$pdf->Image('../img/logo-pq.png', 20, 10, 100, 0, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($periodo . $numero . (!empty($alcance) ? '|' . $alcance : ''), 'QRCODE,H', 140, 20, 50,	50, $style, 'N');
$pdf->setXY(140, 72);
$pdf->Cell(50, 0, $id . (!empty($alcance) ? ' | ' . $alcance : ''), 'LTRB', 1, 'C');

// Numero & Año
$pdf->SetFont('neuehaasb', '', 23);
$pdf->SetFillColor(180,180,180);

$pdf->setXY(20, 44);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(100, 0, 'USO INTERNO', 0, 1, 'C', true);

$pdf->setXY(20, 56);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(100, 0, 'Expediente ' . $numero . ' | ' . $periodo, 0, 2, 'C');

$pdf->SetFont('neuehaas', '', 14);
$pdf->setXY(20, 68);

$html = 'Fecha de Ingreso: <strong>' . date('d/m/Y' , strtotime($ingreso)) . '</strong>';
$pdf->writeHTMLCell(100, 0, '', '', $html,'', 1, 0, true, 'C', false);
$pdf->writeHTMLCell(50, 0, '', '', 'Alcance: <strong>' . $alcance . '</strong>','', 0, 0, true, 'L', false);
$pdf->writeHTMLCell(50, 0, '', '', 'Cuerpo: <strong>' . $cuerpo . '</strong>','', 1, 0, true, 'R', false);
//$pdf->Cell(100, 0, 'Fecha de Ingreso: ' . date('d/m/Y' , strtotime($ingreso)), 0, 2, 'C');

$pdf->SetLineStyle($style1);

// Solicitante
$pdf->RoundedRect(20, 90, 45, 7,3, '1000','DF','',true);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('neuehaas', '', 16);
$pdf->Text(22,90,'SOLICITANTE');

$pdf->setXY(20, 97);
$pdf->setCellPaddings(4, 4, 4, 4);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('neuehaasb', '', 18);
$pdf->Cell($todo, 0, $fila[2], 1, 0, 'L', '');
$pdf->setCellPaddings(0,0,0,0);

// Caratula
$pdf->RoundedRect(20, 120, 36, 7,3, '1000','DF','',true);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('neuehaas', '', 16);
$pdf->Text(22, 120,'CARATULA');

$pdf->setXY(20, 127);
$pdf->setCellPaddings(4, 4, 4, 4);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('neuehaasb', '', 18);
$pdf->MultiCell($todo, 0, $caratula . "\n", 1, 'J', 0, 2, '' ,'', true);
$pdf->setCellPaddings(0,0,0,0);

// Notas
if (!empty($notas)) {
	$act_y = $pdf->GetY() + 7;
	$pdf->RoundedRect(20, $act_y, 55, 7,3, '1000','DF','',true);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('neuehaas', '', 16);
	$pdf->Text(22, $act_y,'OBSERVACIONES');
	
	$pdf->setXY(20, $act_y + 7);
	$pdf->setCellPaddings(4, 4, 4, 4);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('neuehaasb', '', 18);
	$pdf->MultiCell($todo, 0, $notas . "\n", 1, 'J', 0, 2, '' ,'', true);
	$pdf->setCellPaddings(0,0,0,0);
}

$pdf->setXY(20, 265);
$pdf->SetFont('neuehaasb', '', 14);
$pdf->Cell($todo, 0, 'CONSORCIO DE GESTION DE PUERTO QUEQUEN', 0, 0, 'C', '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($id . '.pdf', 'I');