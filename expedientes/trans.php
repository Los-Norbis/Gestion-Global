<?php
ob_start();

if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: index.php');
}
$iniUrl = '../';
include($iniUrl . 'header.php');
$numero = $_GET['Id'];
$alcance = $_GET['Alcance'];

if(isset($_POST['btn-signup'])) {

	$destino = $_POST['destino'];
	$notas = $_POST['notas'];
	$usuario = $_SESSION['userSession'];
	$dateTime = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
	$add_date = $dateTime->format("Y-m-d H:i:s");
	$fecha = $add_date;
	
	$sql = "INSERT INTO me_ruta_exp (Orden, Alcance, Usuario, Fecha, Destino, Notas) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('siisis', $numero, $alcance, $usuario, $fecha, $destino, $notas);
		
	if(!$stmt->execute()) {
		$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
		exit;
	}
	$stmt->close();
	
	// Actualizar Expediente Principal
	$query = $mysqli->prepare("UPDATE me_expedientes SET Destino = ? WHERE Orden = ? AND Alcance = ?");
	$query->bind_param('isi', $destino, $numero, $alcance);

	if($query->execute()) {
		$query->close();
		header('Location: index.php');
	} else {
		$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar Nuevo Destino en Expediente...</div>';
		exit;
	}	
			
	$mysqli->close();

} else {

	$sql = "SELECT ALL Id, Nombre FROM me_destino_exp";
	if (!$tbl_destinos = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo "<h2>Error en la Consulta SQL | Destino.</h2>";
			exit;
	}
	
	$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $numero . " AND Alcance = " . $alcance;
	if (!$tbl_exp = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo "<h2>Error en la Consulta SQL | Destino.</h2>";
			exit;
	} else {
			$a_exp = $tbl_exp->fetch_assoc();
	}

	$mysqli->close();
}
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Transferir <?php echo (!empty($alcance) ? ' Alcance de ' : '');?>Expediente <?php echo substr($numero,0,4) . '|' . substr($numero,4,4); ?></h1>
    </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-12">
    
      <div class="box box-info">

          <div class="box-body">
  	
						<form method="post" id="login-form">
						
						<div class="col-md-8 col-md-offset-2"> 
						 
							
							<!-- Destino -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="destino">Nuevo Destino:</label>
								
								<div class="col-md-9">
									<select required class="form-control" name="destino" id="destino">
										<option value="">Seleccione Destino</option>
										<?php
										while ($destinos = $tbl_destinos->fetch_assoc()) {
											echo '<option value=' . $destinos['Id'] . ($destinos['Id'] == $a_exp['Destino'] ? ' selected ' : '') . '>' . $destinos['Nombre'] . '</option><br />';
										}
										?>
									</select>
								</div>
								
							</div>
							
							<!-- Notas -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="notas">Observaciones:</label>
								
								<div class="col-md-9">
									<textarea class="form-control" rows="3" name="notas" id="notas"></textarea>
								</div>
							</div>
							
							
								<input type="hidden" name="numero" value="<?php echo $numero; ?>" />
								<div class="form-group">
									<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
									<button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Transferir Expediente</button> 
								</div>
								
						</div>
						
						</form>

          </div>
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