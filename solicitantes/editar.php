<?php
ob_start();
$iniUrl = '../';
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$id = $_POST['m_id'];
	$tipo = $_POST['m_tipo'];
	$nom = $mysqli->real_escape_string(trim($_POST['m_nom']));
	$cuit = $mysqli->real_escape_string(trim($_POST['m_cuit']));
	$tel = $mysqli->real_escape_string(trim($_POST['m_tel']));
	$dir = $mysqli->real_escape_string(trim($_POST['m_dir']));
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	
	// die($name . ' ' . $email . ' ' . $new_password);
	$query = $mysqli->prepare("UPDATE me_solicitantes SET Nombre = ?, Tipo = ?, Cuit = ?, Telefono = ?, Direccion = ?, Email = ? WHERE Id = ?");
	$query->bind_param('sissssi', $nom, $tipo, $cuit, $tel, $dir, $email, $id);

	if($query->execute()) {
			header('Location: index.php');
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
			
	$mysqli->close();

} else {
	$m_id = $_GET['Id'];
	$sql = "SELECT * FROM me_solicitantes WHERE Id = " . $m_id;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo '<h2>Error... Transporte no encontrado (Id: ' . $m_id . '</h2>';
			exit;
	} else {
			$fila = $resultado->fetch_assoc();
	}	
}
?>

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>plugins/iCheck/all.css">
  <script src="<?php echo $iniUrl; ?>plugins/iCheck/icheck.min.js"></script>

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
    <h1>Modificar Solicitante <small>Id: <?php echo $m_id; ?></small></h1>
    
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-6">
    
      <div class="box box-info">
          <div class="box-header with-border">
            <span class="text-muted pull-right">El Nombre es obligatorio...</span>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form">
							 <?php
              if(isset( $msg )){
                  echo $msg;
              }
              ?>
                
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-user" style="width: 16px;"></i>
                </span>
    	          <input type="text" class="form-control" placeholder="Nombre" name="m_nom" required value="<?php echo $fila['Nombre']; ?>" autofocus/>
              </div>
							
                  <!-- Origen -->
                  <div class="form-group">
                    <div class="input-group" style="margin: 5px 0 0; text-align: center; width: 100%;">
                      <label style="margin-right: 24px;">
                          <input tabindex="2" type="radio" name="m_tipo" value="0" class="square-blue" <?php echo ($fila['Tipo'] == 0 ? 'checked' : ''); ?> />  Persona F&iacute;sica
                      </label>
                      <label>
                          <input tabindex="3" type="radio" name="m_tipo" value="1" class="square-blue" <?php echo ($fila['Tipo'] == 1 ? 'checked' : ''); ?> />  Persona Jur&iacute;dica
                      </label>
                    </div>
                  </div>
							
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-hashtag" style="width: 16px;"></i>
                </span>
                <input type="text" class="form-control" placeholder="N&deg; de CUIT" name="m_cuit" maxlength="13" value="<?php echo $fila['Cuit']; ?>" />
              </div>
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-phone" style="width: 16px;"></i>
                </span>
              	<input type="text" class="form-control" placeholder="Tel&eacute;fono" name="m_tel" value="<?php echo $fila['Telefono']; ?>" />
              </div>

              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker" style="width: 16px;"></i>
                </span>
              	<input type="text" class="form-control" placeholder="Direcci&oacute;n" name="m_dir" value="<?php echo $fila['Direccion']; ?>" />
              </div>

              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-envelope" style="width: 16px;"></i>
                </span>
              	<input type="email" class="form-control" placeholder="Email" name="m_email" value="<?php echo $fila['Email']; ?>" />
              </div>              
              
              <div class="form-group">
					      <input type="hidden" name="m_id" value="<?php echo $fila['Id']; ?>" />
              	<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Modificar Solicitante</button> 
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
													 
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-yellow, input[type="radio"].flat-yellow').iCheck({
      checkboxClass: 'icheckbox_flat-yellow',
      radioClass: 'iradio_flat'
    });
		
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });
		
});
	
</script> 

<?php
include('footer.php');
ob_end_flush();
?>