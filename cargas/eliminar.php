<?php
ob_start();
$iniUrl = '../';
$Id =$_GET['Id'];
$Nombre = $_GET['Nombre'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	// Borra Transporte
  $query = $mysqli->prepare("DELETE FROM cargas WHERE Id = ?");
	$query->bind_param('i', $Id);

	if(!$query->execute()) {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error borrando Carga...</div>';
			exit;
	}
	$query->close();
	
	$mysqli->close();
	header('Location: index.php?');
	
} else {
	$sql = "SELECT * FROM cartas WHERE TipoCarga = " . $Id;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo '<h2>Error ejecutando busqueda... </h2>';
			exit;
	} else {
			$cp_tipo = $resultado->num_rows;
	}		
}
?>

<div class="content-wrapper">

	<?php  
  $userlevel = $_SESSION['levelSession'];
	if ($userlevel > 2) {
		?>
			<section class="content">	
				<div class="col-md-12">
					<div class="callout callout-danger">
						<i class="fa fa-lock"></i> &nbsp; <strong>Acceso Denegado...</strong> <?php echo $_SESSION['nameSession'];?> no tiene privilegios para acceder a estas funciones.
					</div>
				</div>
			</section>
		<?php
		exit;
	}
	?>
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Eliminar Carga <small>Id: <?php echo $Id; ?></small></h1>
  </section>

  <!-- Main content -->
  <form method="post" id="login-form">
			<section class="content">	
				<div class="col-md-12">
				<?php if ($cp_tipo == 0) { ?>
					<div class="callout callout-info">
						<i class="fa fa-exclamation-circle"></i> &nbsp; Esta a punto de Eliminar la Carga <strong><?php echo $Nombre; ?></strong>...
					</div>
          <button tabindex="5" type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
          <button tabindex="4" type="submit" class="btn btn-danger" name="btn-signup" id="btn-signup"><i class="fa fa-remove"></i> &nbsp; Eliminar Carga</button>

				<?php	} else { ?>

					<div class="callout callout-danger">
						<i class="fa fa-ban"></i> &nbsp; No se puede Eliminar la Carga <strong><?php echo $Nombre; ?></strong>... ya que al menos una Carta de Porte la utiliza.
					</div>
          <button tabindex="5" type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
				
				<?php } ?>
				</div>
			</section>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include($iniUrl . 'footer.php');
ob_end_flush();
?>