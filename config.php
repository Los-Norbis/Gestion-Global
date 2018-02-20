<?php
ob_start();
$iniUrl = '';
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$m_gasoil = $_POST['m_gasoil'];
	$m_nafta = $_POST['m_nafta'];

  $query = $mysqli->prepare("UPDATE opciones SET Gasoil = ?, Nafta = ? WHERE Id = 1");
	$query->bind_param('dd', $m_gasoil, $m_nafta);

	if($query->execute()) {
			header('Location: index.php');
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
	$mysqli->close();

} else {
	$sql = "SELECT * FROM opciones WHERE Id = 1";
	if (!$resultado = $mysqli->query($sql)) {
			// cupala la concha dxe l a loraa�.
			echo '<h2>Error... Tabla Opciones</h2>';
			exit;
	} else {
			$fila = $resultado->fetch_assoc();
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

  <!-- Content Header (Page header trolAA) -->
  <section class="content-header">
    <h1>Opciones <small>Configuraci&oacute;n General</small></h1>
  </section>

  <!-- Main content -->
  <section class="content">

  <div class="row">
    <div class="col-md-6 col-xs-12">

      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title pull-left">Valores Globales</h3>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form" lang="es-ES">
							 <?php
              if(isset( $msg )){
                  echo $msg;
              }
              ?>

							<div class="row">
								<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label>Valor Dolar</label>
									<div class="input-group" style="margin: 5px 0 20px;">
										<span class="input-group-addon">
											<i class="fa fa-usd" style="width: 16px;" id="num_icon"></i>
										</span>
										<input tabindex="1" type="number" step="any" class="form-control" placeholder="Importe" name="m_gasoil"  value="<?php echo $fila['Gasoil']; ?>" required />
									</div>
								</div>
								</div>

								<div class="col-md-6 col-xs-12">
								<div class="form-group">
									<label>Valor Euro</label>
									<div class="input-group" style="margin: 5px 0 20px;">
										<span class="input-group-addon">
											<i class="fa fa-usd" style="width: 16px;" id="num_icon"></i>
										</span>
										<input tabindex="2" type="number" step="any" class="form-control" placeholder="Importe" name="m_nafta"  value="<?php echo $fila['Nafta']; ?>" required />
									</div>
								</div>
								</div>
							</div>


              <div class="form-group">
              	<button tabindex="5" type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button tabindex="4" type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Modificar Opciones</button>
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

<script type="text/javascript">

$(document).ready(function(){


});

</script>

<?php
include($iniUrl . 'footer.php');
ob_end_flush();
?>
