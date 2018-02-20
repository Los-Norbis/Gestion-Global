<?php
	
if (isset($_POST['ordenes'])) {
	
	$ordenes = $_POST['ordenes'];

	require_once('../tcpdf/tcpdf.php');
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Luis Favre');
	$pdf->SetTitle('Impresion de Codigo QR');
	
	
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(10, 10, 10);
	
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
	$style1 = array('width' => 0.25, 'cap' => 'square', 'join' => 'miter', 'dash' => 3, 'color' => array(0, 0, 0));
	$pdf->SetFont('neuehaas', '', 14);
	//die($todo);
	// new style
	$style = array(
		'border' => false,
		'padding' => 1,
		'fgcolor' => array(0,0,0),
		'bgcolor' => false
	);
	
	$ax = array(0, 10, ($todo/2) - 15, $todo - 40);
	$my = 10;
	$mv = 1;
	foreach ($ordenes as $pos => $orden) {
		
		$mx = $ax[$mv];
		$pdf->Rect( $mx, $my, 50, 57, 'D', array('all' => $style1));
		// QRCODE,H : QR-CODE Best error correction
		$pdf->write2DBarcode($orden, 'QRCODE,H', $mx, $my, 50, 50, $style, 'N');
		$pdf->writeHTMLCell( 50, 5, $mx , $my + 50, $orden, 0, 0, 0, true, 'C', false);
		
		if ($mv == 3) {
			$mv = 1;
			$my = $my + 70;
		} else {
			++$mv;
		}
		
		if ( ($pos + 1) == sizeof($ordenes) ) {
			break;
		} else if ( (($pos + 1) % 12) == 0 ) {
			$pdf->AddPage();
			$my = 10;
		}
	
	}

	$pdf->Output('ordenes.pdf', 'I');
}