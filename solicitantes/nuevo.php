<?php
ob_start();
$iniUrl = '../';
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$tipo = $_POST['m_tipo'];
	$nom = $mysqli->real_escape_string(trim($_POST['m_nom']));
	$cuit = $mysqli->real_escape_string(trim($_POST['m_cuit']));
	$tel = $mysqli->real_escape_string(trim($_POST['m_tel']));
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	$dir = $mysqli->real_escape_string(trim($_POST['m_dir']));
	
	
	// die($name . ' ' . $email . ' ' . $new_password);
	$query = $mysqli->prepare("INSERT INTO me_solicitantes(Nombre, Tipo, Cuit, Telefono, Direccion, Email) VALUES (?,?,?,?,?,?)");
	$query->bind_param('sissss', $nom, $tipo, $cuit, $tel, $dir, $email);

	if($query->execute()) {
			header('Location: index.php');
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
			
	$mysqli->close();

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
    <h1>Nuevo Solicitante</h1>
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
    	          <input type="text" class="form-control" placeholder="Nombre" name="m_nom" required  autofocus/>
              </div>
							
                  <!-- Origen -->
                  <div class="form-group">
                    <div class="input-group" style="margin: 5px 0 0; text-align: center; width: 100%;">
                      <label style="margin-right: 24px;">
                          <input tabindex="2" type="radio" name="m_tipo" value="0" class="square-blue" checked />  Persona F&iacute;sica
                      </label>
                      <label>
                          <input tabindex="3" type="radio" name="m_tipo" value="1" class="square-blue" />  Persona Jur&iacute;dica
                      </label>
                    </div>
                  </div>							
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-hashtag" style="width: 16px;"></i>
                </span>
                <input type="text" class="form-control" placeholder="N&deg; de CUIT" name="m_cuit" maxlength="13"  />
              </div>
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-phone" style="width: 16px;"></i>
                </span>
              	<input type="text" class="form-control" placeholder="Tel&eacute;fono" name="m_tel"   />
              </div>

              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-map-marker" style="width: 16px;"></i>
                </span>
              	<input type="text" class="form-control" placeholder="Direcci&oacute;n" name="m_dir" />
              </div>

              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-envelope" style="width: 16px;"></i>
                </span>
              	<input type="email" class="form-control" placeholder="Email" name="m_email" />
              </div>               
              
              <div class="form-group">
              	<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Agregar Solicitante</button> 
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