<?php
$iniUrl = '../';

if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: ' .$iniUrl . 'index.php');
}

include($iniUrl . 'header.php');
$numero = $_GET['Id'];
$alcance = $_GET['Alcance'];

// $sql = "SELECT ALL Usuario, Fecha FROM me_ruta_exp WHERE Numero = " . $numero . " ORDER BY Fecha DESC";
   $sql = "SELECT ALL me_ruta_exp.Usuario, me_ruta_exp.Fecha, me_ruta_exp.Destino, me_ruta_exp.Notas, usuarios.user_name, usuarios.user_email FROM me_ruta_exp LEFT JOIN usuarios ON me_ruta_exp.Usuario = usuarios.user_id WHERE me_ruta_exp.Orden = '" . $numero . "' AND me_ruta_exp.Alcance = " . $alcance . " ORDER BY me_ruta_exp.Fecha DESC";
//die($sql);

if (!$movs = $mysqli->query($sql)) {
		// ¡Oh, no! La consulta falló. 
		echo "<h2>Error en la Consulta SQL | Ruta.</h2>";
		exit;
}

$sql = "SELECT ALL Id, Nombre FROM me_destino_exp";
if (!$tbl_destinos = $mysqli->query($sql)) {
		// ¡Oh, no! La consulta falló. 
		echo "<h2>Error en la Consulta SQL | Destino.</h2>";
		exit;
} else {
	$resultSet = array();
	while($result = $tbl_destinos->fetch_assoc()) {
    $resultSet[$result['Id']] = $result['Nombre'];
	}
}

?>
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Movimientos del Expediente <?php echo substr($numero,0,4) . '|' . substr($numero,4,4); ?></h1>
  </section>

  <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
						<div class="box-body">
			
		 
							<?php
							if ($movs->num_rows === 0) { ?>
								<div class="col-md-12"><h4 class="cell-center">No se encontraron movimientos...</h4>
                                  <div class="form-group">
                                      <button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                                  </div>                                
                                </div>
                            <?php
							} else {
							?>
	
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table">
									
										<th width="9%">Fecha</th>
										<th width="6%">Hora</th>
										<th width="10%">Usuario</th>
										
										<th width="35%">Destino</th>
										<th width="40%">Notas</th>
										<?php
										$actual = true;
										while ($mov = $movs->fetch_assoc()) {
											if ($actual) {
												echo '<tr class="success" alt="' . $mov['Notas'] . '">';
												$actual = false;
											} else {
												echo '<tr>';
											}
											$fecha = date_create($mov['Fecha']);
											echo '<td>' . date_format($fecha, 'd/m/Y') . '</td>';
											echo '<td>' . date_format($fecha, 'H:i:s') . '</td>';
											echo '<td>' . $mov['user_name'] . '</td>';
											
											echo '<td>' . ( empty($mov['Destino']) ? 'Area propia' : $resultSet [$mov['Destino']] ) . '</td>';
											echo '<td>' . $mov['Notas'] . '</td>';
											echo '</tr>';
										}
										?>
									</table>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
								</div>                                      
							</div>
							<?php
							}
							$mysqli->close();
							?>
	
						</div>
				</div>
			</div>
		</div>
	</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->      

<?php include($iniUrl . 'footer.php'); ?>