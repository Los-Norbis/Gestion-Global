<?php
ob_start();
$iniUrl = '../';
$Id =$_GET['Id'];
$Nombre = $_GET['Nombre'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {

  $query = $mysqli->prepare("DELETE FROM trans_cc WHERE Id = ?");
	$query->bind_param('i', $Id);

	if($query->execute()) {
			header('Location: cc.php?Id=' . $_POST['TrId'] . '&Nombre=' . $Nombre);
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
			exit;
	}
	$query->close();
	$mysqli->close();

} else {
	$Id = $_GET['Id'];
	$sql = "SELECT * FROM trans_cc WHERE Id = " . $Id;
	if (!$resultado = $mysqli->query($sql)) {
			// �Oh, no! La consulta fall�. 
			echo '<h2>Error... Movimiento no encontrado (Id: ' . $Id . '</h2>';
			exit;
	} else {
			$fila = $resultado->fetch_assoc();
	}	
}
$Tipos = Array('Carta de Porte','Combustible','Adelanto Efectivo', 'Cheque', 'Orden de Compra', 'Pago');

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
    <h1>Eliminar Movimiento <small>Cuenta Corriente</small></h1>
  </section>

  <!-- Main content -->
  <form method="post" id="login-form">
			<section class="content">	
				<div class="col-md-12">
					<div class="callout callout-info">
						<i class="fa fa-exclamation-circle"></i> &nbsp; Esta a punto de Eliminar un Movimiento (<strong><?php echo $Tipos[$fila['Tipo']]; ?></strong>) de $ <strong><?php echo $fila['Importe']; ?></strong> en la Cuenta Corriente de <?php echo $Nombre; ?>...
            
					</div>
          <input type="hidden" id="TrId" name="TrId" value="<?php echo $fila['Tr_Id']; ?>" />
          <button tabindex="5" type="button" class="btn btn-default" onclick="location.href='cc.php?Id=<?php echo $fila['Tr_Id']; ?>&Nombre=<?php echo $Nombre;?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
          <button tabindex="4" type="submit" class="btn btn-danger" name="btn-signup" id="btn-signup"><i class="fa fa-remove"></i> &nbsp; Eliminar Movimiento</button>
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