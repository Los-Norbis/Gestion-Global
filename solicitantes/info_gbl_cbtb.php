<?php
$iniUrl = '../';
//var_dump($_POST);
//exit;

include($iniUrl . 'includes/db_connect.php');

$m_tipos = Array('','Gasoil','Nafta');
$msg = Array();

$tipos = $_POST['tipo'];
$lt = count($tipos);

for($i=0; $i<$lt; $i++) { 
		$msg[] = $m_tipos[$tipos[$i]];
    $tipos[$i] = 'Aux = ' . $tipos[$i];
}


$sqltipo = '(' . implode(" OR " , $tipos) . ')';
$sqlfecha = '(Fecha BETWEEN "' . $_POST['m_dfecha'] . '" AND "' . $_POST['m_hfecha'] . '")';
$sql = 'SELECT * FROM trans_cc WHERE Tipo = 1 AND ' . $sqlfecha . ' AND ' . $sqltipo;
//var_dump($sql);
//exit;

$result = $mysqli->query($sql . " ORDER BY Fecha DESC");
	
$sql = "SELECT Gasoil, Nafta FROM opciones WHERE Id = 1";
if (!$opciones = $mysqli->query($sql)) {
	echo "<h2>Error en la Consulta SQL | Opciones.</h2>";
	exit;
}
$opciones = $opciones->fetch_assoc();
		
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pageLayout = array('130', '200');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); // PDF_PAGE_FORMAT

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Luis Favre');
$pdf->SetTitle('Informe de Combustible Entregado por Periodo | ' . $Nombre);
$pdf->SetSubject('');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 12, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}



$saldo_g = $saldo_n = 0;
$cab = true;
while ($fila = $result->fetch_assoc()) {
	
	if ($cab) {
		// Hacemos Header
		$pdf->AddPage();
		// ---------------------------------------------------------
		
		$todo = $pdf->getPageWidth();
		$margen = $pdf->getMargins();
		$todo = $todo - $margen['left'] - $margen['right'];
		$pdf->SetFont('helvetica', '', 12);
		$div = intval($todo) / 2;
		$pdf->Image('../img/logo-cab.jpg', $margen['left'], $margen['top'], 70, 10.5, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
		
		$pdf->Cell($todo, 0, date('d/m/Y'), 0, 0, 'R', 0, '', 0);
		$pdf->Ln(12);
		
		$pdf->SetFont('helvetica', '', 14);
		$html = 'Informe de Combustible Entregado por Per&iacute;odo | ' . date('d/m/Y', strtotime($_POST['m_dfecha'])) . ' a ' . date('d/m/Y', strtotime($_POST['m_hfecha']));
		
		$pdf->writeHTMLCell(0, 0, '', '', $html, '', 1, false, true, 'C', true);
		$pdf->Ln(3);
		
		$pdf->SetFont('helvetica', '', 12);
		$div = intval($todo) / 5;
		$pdf->Cell($div, 0, 'Fecha', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Gasoil | Lts', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Nafta | Lts', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Gasoil | $', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Nafta | $', 1, 0, 'C', 0, '', 0);
		$pdf->Ln(8);
		$cab = false;		
		
	}
	
	// Linea al PDF

	$pdf->Cell($div, 0, date('d/m/Y', strtotime($fila['Fecha'])), 0, 0, 'L', 0, '', 0);
	$p_tipo = $m_tipos[$fila['Aux']];
	$p_importe = $fila['Importe'];
	
	if ($fila['Aux'] == 1) {
		$pdf->Cell($div, 0, number_format($p_importe, 0), 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, '', 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, number_format($p_importe * $opciones['Gasoil'], 2, ',','.'), 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, '', 0, 0, 'R', 0, '', 0);
	} else {
		$pdf->Cell($div, 0, '', 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, number_format($p_importe, 0), 0, 0, 'R', 0, '', 0);
		
		$pdf->Cell($div, 0, '', 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, number_format($p_importe * $opciones['Nafta'], 2, ',','.'), 0, 0, 'R', 0, '', 0);
		
	}
	
	
	if ($fila['Aux'] == 1) {
		$saldo_g += $fila['Importe'];
	} else {
		$saldo_n += $fila['Importe'];
	}			
	
	$pdf->Cell($div, 0, ($fila['Aux'] == 1 ? $p_importe * $opciones['Gasoil'] : $p_importe * $opciones['Nafta']), 0, 0, 'R', 0, '', 0);
	$pdf->Ln(7);

	
	$pos = $pdf->GetY();
	$altprn = $pdf->getPageHeight() - $margen['top'] - $margen['bottom'];
	
	if ($pos > $altprn) {
		$cab = true;
	}
	
	
}

$pdf->Cell(0, 0, '', 'T', 0, 'L', 0, '', 0);
$pdf->Ln(1);
$pdf->Cell($div, 0, 'Totales:', 0, 0, 'L', 0, '', 0);
$pdf->Cell($div, 0, number_format($saldo_g, 0), 0, 0, 'R', 0, '', 0);
$pdf->Cell($div, 0, number_format($saldo_n, 0), 0, 0, 'R', 0, '', 0);
$pdf->Cell($div, 0, number_format($saldo_g * $opciones['Gasoil'], 2, ',','.'), 0, 0, 'R', 0, '', 0);
$pdf->Cell($div, 0, number_format($saldo_n * $opciones['Nafta'], 2, ',','.'), 0, 0, 'R', 0, '', 0);

	
$result->close();
$mysqli->close();

$pdf->Output('icp.pdf', 'I');

?>

