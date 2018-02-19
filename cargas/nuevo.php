<?php
$iniUrl = '../';
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$m_nombre = $mysqli->real_escape_string(trim($_POST['m_nombre']));
	$m_precio = $_POST['m_precio'];
	
	
	// die($name . ' ' . $email . ' ' . $new_password);
	$query = $mysqli->prepare("INSERT INTO cargas (Nombre, Precio) VALUES (?,?)");
	$query->bind_param('sd', $m_nombre, $m_precio);

	if($query->execute()) {
			$msg = '<div class="alert alert-success"><i class="fa fa-check"></i> &nbsp; ' . $m_nombre . ' ha sido agregado.</div>';
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
	$mysqli->close();

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
    <h1>Nueva Carga</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-6">
    
      <div class="box box-info">
          <div class="box-header with-border">
            <span class="text-muted pull-right">Todos los campos son obligatorios...</span>
          </div>
          <div class="box-body">
        	<form method="post" id="login-form" lang="es-ES">
			<?php
              if(isset( $msg )){
                  echo $msg;
              }
            ?>
                
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-leaf" style="width: 16px;"></i>
                </span>
    	          <input type="text" class="form-control" placeholder="Nombre" name="m_nombre" required  autofocus/>
              </div>
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-usd" style="width: 16px;"></i>
                </span>
                <input type="number" step="any" class="form-control" placeholder="Precio x Tn" name="m_precio" required />
              </div>
              
             
              <div class="form-group">
              	<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Agregar Carga</button> 
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

<?php
include('footer.php');
?>