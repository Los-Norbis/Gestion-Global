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

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$this->Image('../img/logo-cab.jpg', 10, 10, 120, 18, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->SetXY(0,30);
		$this->Cell(30, 15, '<< TCPDF Example 003 >>', 1, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
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

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->AddPage();


// ---------------------------------------------------------

$saldo_g = $saldo_n = 0;
$todo = $pdf->getPageWidth();
$margen = $pdf->getMargins();
$todo = $todo - $margen['left'] - $margen['right'];
$div = intval($todo) / 2;

while ($fila = $result->fetch_assoc()) {
	
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

