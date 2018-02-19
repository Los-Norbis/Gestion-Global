<?php
ob_start();

if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: index.php');
}
$iniUrl = '../';
include($iniUrl . 'header.php');
$orden = $_GET['Orden'];


$destino = 0;
$notas = 'Ingreso al Area';
$usuario = $_SESSION['userSession'];
$dateTime = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
$add_date = $dateTime->format("Y-m-d H:i:s");
$fecha = $add_date;

$sql = "INSERT INTO me_ruta_exp (Orden, Usuario, Fecha, Destino, Notas) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sisis', $orden, $usuario, $fecha, $destino, $notas);
	
if($stmt->execute()) {
		$msg = '<div class="callout callout-success"><i class="fa fa-check"></i> &nbsp; Expediente Registrado...</div>';
}	else {
		$msg = '<div class="callout callot-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
}
$stmt->close();
		
$mysqli->close();

?>
  
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Registrar Expediente <?php echo substr($orden,0,4) . '|' . substr($orden,4,4); ?></h1>
    </section>

  <!-- Main content -->
  <section class="content">
    
  	<div class="row">
		<div class="col-md-12">

			<?php echo $msg; ?> 
			<div class="form-group">
				<button type="button" class="btn btn-default pull-left" onclick="location.href='<?php echo $iniUrl; ?>index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
			</div>

		</div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->  
    
<?php include($iniUrl . 'footer.php');
ob_end_flush();
?>