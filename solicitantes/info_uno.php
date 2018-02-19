<?php
$iniUrl = '../';
$Id = $_POST['Id'];
$Nombre = $_POST['Nombre'];

include($iniUrl . 'includes/db_connect.php');

$result = $mysqli->query("SELECT * FROM cartas WHERE Tr_Id = " . $Id . " AND Fin = 0 ORDER BY Fecha DESC");
if ($result->num_rows == 0) {
	?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zarate Transportes</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>bootstrap/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/SourceSansPro.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<style>
html, body {
    width: 100%;
    height: 100%;
}

body{
    margin: 0;
    display: table
}

body>div {
    display: table-cell;
    text-align: center;
    vertical-align: middle
}	
	</style>
</head>

<body class="login-page">
	<div>
		<div class="col-md-4 col-md-offset-4">
			<div class="callout callout-warning">
				<i class="fa fa-exclamation-circle"></i> &nbsp; <strong><?php echo $Nombre; ?></strong> no tiene Cartas de Porte pendientes...
			</div>
			<button tabindex="5" type="button" class="btn btn-danger btn-block btn-lg" onclick="window.close();"><i class="fa fa-remove"></i> &nbsp; Cerrar</button>
		</div>
	</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo $iniUrl; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $iniUrl; ?>bootstrap/js/bootstrap.min.js"></script>

</body>
</html>	

<?php
			
} else {
		
		require_once('../tcpdf/tcpdf.php');		
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Luis Favre');
		$pdf->SetTitle('Informe de Cartas de Porte Pendientes | ' . $Nombre);
		$pdf->SetSubject('TCPDF Tutorial');
		
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
		$pdf->SetFont('helvetica', '', 12);
		$div = intval($todo) / 2;
		$pdf->Image('../img/logo-cab.jpg', $margen['left'], $margen['top'], 70, 10.5, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

		$pdf->Cell($todo, 0, date('d/m/Y'), 0, 0, 'R', 0, '', 0);
		$pdf->Ln(12);
		
		$pdf->SetFont('helvetica', '', 16);
		$html = 'Informe de Cartas de Porte Pendientes<br /><strong>' . $Nombre . '</strong>';
		
		$pdf->writeHTMLCell(0, 0, '', '', $html, '', 1, false, true, 'C', true);
		$pdf->Ln(3);
		
		$pdf->SetFont('helvetica', '', 12);
		$div = intval($todo) / 5;
		$pdf->Cell($div, 0, 'Fecha', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Numero', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Subtotal', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Iva', 1, 0, 'C', 0, '', 0);
		$pdf->Cell($div, 0, 'Total', 1, 0, 'C', 0, '', 0);
		$pdf->Ln(8);
		
		// ---------------------------------------------------------
		
		
		
		while ($fila = $result->fetch_assoc()) {
			$filas[] = $fila;
		}
		
		$totalA = $totalB = $totalC = 0;
		
		foreach ($filas as $fila) {
			
			$subdesc = cp_subdesc($fila['KgDescarga'], $fila['Tarifa'], $fila['Bonificacion']);
			if ($fila['Iva'] == 1) {
				$iva = $subdesc * 0.21;
			} else {
				$iva = 0;
			}
			
			// Kilos faltantes
			$kgs = $fila['KgCarga'] - $fila['KgDescarga'] - $fila['KgDevolucion'];
			if ($kgs >= $fila['Origen']) {
				$cargas = $mysqli->query("SELECT Precio FROM cargas WHERE Id = " . $fila['TipoCarga']);
				$valcarga = $cargas->fetch_assoc();
				$dif = $kgs * ($valcarga['Precio'] / 1000);
				$cargas->close();
			} else {
				$dif = 0;
			}
			
			$total = $subdesc + $iva - $dif;
			
			$totalA += $subdesc;
			$totalB += $iva;
			$totalC += $total;
			
			// Linea al PDF
			$pdf->Cell($div, 0, date('d/m/Y', strtotime($fila['Fecha'])), 0, 0, 'L', 0, '', 0);
			$pdf->Cell($div, 0, $fila['Numero'], 0, 0, 'R', 0, '', 0);
			$pdf->Cell($div, 0, number_format($subdesc, 2), 0, 0, 'R', 0, '', 0);
			$pdf->Cell($div, 0, number_format($iva, 2), 0, 0, 'R', 0, '', 0);
			$pdf->Cell($div, 0, number_format($total, 2), 0, 0, 'R', 0, '', 0);
			
			$pdf->Ln(7);
			
			
		}
		
		$pdf->Cell(0, 0, '', 'T', 0, 'L', 0, '', 0);
		$pdf->Ln(1);
		$pdf->Cell($div * 2, 0, 'Totales:', 0, 0, 'L', 0, '', 0);
		$pdf->Cell($div, 0, number_format($totalA, 2), 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, number_format($totalB, 2), 0, 0, 'R', 0, '', 0);
		$pdf->Cell($div, 0, number_format($totalC, 2), 0, 0, 'R', 0, '', 0);
			
		$result->close();
		$mysqli->close();
		
		$pdf->Output('icp.pdf', 'I');
		


}		

// Funciones de Calculo CP
function cp_subdesc($kilos, $tarifa, $bono) {
	
	$sub = ($kilos / 1000) * $tarifa;
	$des = ($sub / 100) * $bono;
	return $sub - $des;
}
?>
