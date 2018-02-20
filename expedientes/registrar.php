<?php
ob_start();

if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: index.php');
}
$iniUrl = '../';
include($iniUrl . 'header.php');
$orden = $_GET['Orden'];

$alcance = 0;
if (strlen($orden > 8)) {
	// Tiene alcance
	$alcance = substr($orden, 9);
	$orden = substr($orden, 0, 8);
}

$destino = 0;
$notas = 'Ingreso al Area';
$usuario = $_SESSION['userSession'];
$dateTime = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
$add_date = $dateTime->format("Y-m-d H:i:s");
$fecha = $add_date;

// Obtener Area
$sql = "SELECT user_area FROM usuarios WHERE user_id = " . $usuario;
if ($t_query = $mysqli->query($sql)) {
		$fila = $t_query->fetch_row();
		$destino = $fila[0];
} else {
		echo "<h2>Error en la Consulta SQL | Usuarios.</h2>";
		exit;
}

$sql = "INSERT INTO me_ruta_exp (Orden, Alcance, Usuario, Fecha, Destino, Notas) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('siisis', $orden, $alcance, $usuario, $fecha, $destino, $notas);
	
if($stmt->execute()) {
	$msg = '<div class="callout callout-success"><i class="fa fa-check"></i> &nbsp; Expediente Registrado...</div>';
}	else {
	$msg = '<div class="callout callot-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	exit;
}
$stmt->close();

// Actualizar Expediente Principal
$query = $mysqli->prepare("UPDATE me_expedientes SET Destino = ? WHERE Orden = ? AND Alcance = ?");
$query->bind_param('isi', $destino, $orden, $alcance);

if($query->execute()) {
	$query->close();
} else {
	$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar Nuevo Destino en Expediente...</div>';
	exit;
}
		
$mysqli->close();

?>
  
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Registrar <?php echo (!empty($alcance) ? ' Alcance de ' : '');?>Expediente <?php echo substr($orden,0,4) . '|' . substr($orden,4,4); ?></h1>
    </section>

  <!-- Main content -->
  <section class="content">
    
  	<div class="row">
		<div class="col-md-12">

			<?php echo $msg; ?> 
			<div class="form-group">
				<button type="button" class="btn btn-default pull-left" onclick="location.href='<?php echo $iniUrl; ?>index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button type="button" class="btn btn-primary pull-right" onclick="location.href='movimientos.php?Id=<?php echo $orden; ?>&Alcance=<?php echo $alcance; ?>'"><i class="fa fa-list"></i> &nbsp; Ver Movimientos</button>
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