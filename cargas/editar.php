<?php
ob_start();
$iniUrl = '../';
$Id =$_GET['Id'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$m_nombre = $mysqli->real_escape_string(trim($_POST['m_nombre']));
	$m_precio = $_POST['m_precio'];
	
	// die($name . ' ' . $email . ' ' . $new_password);
	$query = $mysqli->prepare("UPDATE cargas SET Nombre = ?, Precio = ? WHERE Id = ?");
	$query->bind_param('sdi', $m_nombre, $m_precio, $Id);

	if($query->execute()) {
			header('Location: index.php');
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
	$mysqli->close();

} else {
	$sql = "SELECT * FROM cargas WHERE Id = " . $Id;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo '<h2>Error... Carga no encontrada</h2>';
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
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Modificar Carga <small>Id: <?php echo $Id; ?></small></h1>
    
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
    	          <input type="text" class="form-control" placeholder="Nombre" name="m_nombre" required value="<?php echo $fila['Nombre']; ?>" autofocus/>
              </div>
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-usd" style="width: 16px;"></i>
                </span>
                <input type="number" step="any" class="form-control" placeholder="Precio x Tn" name="m_precio" required value="<?php echo $fila['Precio']; ?>" />
              </div>
              
              <div class="form-group">
              	<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Modificar Carga</button> 
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
ob_end_flush();
?>