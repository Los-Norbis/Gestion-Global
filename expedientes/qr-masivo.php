<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$iniUrl = '../';

include($iniUrl . 'header.php');
$sql = "SELECT Orden FROM me_expedientes ORDER BY Id DESC LIMIT 36";

if (!$expd = $mysqli->query($sql)) {
	echo "<h2>Error en la Consulta SQL | Expedientes.</h2>";
	exit;
}
?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/check.css">
  
<style>
.cellcode {
	text-align: center;
	font-size: 18px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>C&oacute;digos QR | Impresi&oacute;n Masiva</h1>
  </section>

  <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
						<div class="box-body">
			
		 
							<?php
							if ($expd->num_rows === 0) {
								echo '<div class="col-md-12"><h4 class="cell-center">No se encontraron movimientos...</h4></div>';
							} else {
							?>
							<form method="post" action="lst-qr-masivo.php" target="_blank">
							<div class="col-md-12">
										<?php
										$actual = 1;
										$cols = 4;
										while ($mov = $expd->fetch_assoc()) {
											
												$html = "<div class='col-md-3 cellcode' >";
												$html .= "<div class='checkbox checkbox-primary'>";
												$html .= "<input id='" . $mov['Orden'] . "' name='ordenes[]' value='" . $mov['Orden'] . "' type='checkbox' class='styled' " . ($actual <= 12 ? 'checked' : '') . ">";
												$html .= '<label for="' . $mov['Orden'] . '"></label>';
												$html .= "<span>" . $mov['Orden'] . "</span>";
												$html .= "</div>";
												$html .= "</div>\n";											
											
											/*
											if ($actual % $cols == 0) {
												echo $html;
												echo "</tr>\n<tr>\n";
											} else {*/
												echo $html;
												if (($actual % 12) == 0) {
													echo "<div style='clear: both; height: 1px; background-color: #00c0ef;'></div>\n";
												}
											/*}*/
											++$actual;
										
										}
										--$actual;
										if (($actual % $cols) != 0) {
											$rtd = $cols - ($actual % $cols);
											for ($i = 1; $i <= $rtd; $i++) {
												echo "<div class='col-md-3'></div>\n";
											}
											
										}
										?>
                                        
							</div>
                            <div class="col-md-12">
							<?php
							}
							$mysqli->close();
							?>
                            	<h3><span class="pull-left label label-primary" id="cantinfo">Seleccionados: 12</span></h3>
								<button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
                            </div>
                            
						</div>
                        
                        </form>
				</div>
			</div>
		</div>
	</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

var cantidad = 12;
$(document).ready(function(){
	
	$('input[name="ordenes[]"]').change(function() {
		//alert($('input[name="importe[]"]').index(this) + '   ' + $(this).prop('checked'));
		//var idx = $('input[name="cpvalor[]"]').index(this);
		//var val_act = Cartas[$('input[name="cpvalor[]"]').index(this)] [0];
		var est_act = $(this).prop('checked');
		
		if (est_act) {
			++cantidad;
		} else {
			--cantidad;
		}
		
		$('#cantinfo').html('Seleccionados: ' + cantidad);
    });
});

</script>

<?php
include($iniUrl . 'footer.php');
ob_endflush();
?>