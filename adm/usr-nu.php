<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
//include_once '../lib/password.php';

if(isset($_POST['btn-signup'])) {
	$name = $mysqli->real_escape_string(trim($_POST['m_name']));
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	$password = $mysqli->real_escape_string(trim($_POST['m_password']));
	$level = trim($_POST['m_level']);
	
	$new_password = password_hash($password, PASSWORD_DEFAULT);
	$result = $mysqli->query("SELECT user_email FROM usuarios WHERE user_email='$email'");
	$filas = $result->num_rows;
	
	if (!empty( $filas )) {

		//printf("Result set has %d rows.\n", $filas);
		//die();

		$msg = '<div class="alert alert-danger"><i class="fa fa-remove"></i> &nbsp; ' . $email . ' ya se encuentra registrado...</div>';		
		
	} else {

		// die($name . ' ' . $email . ' ' . $new_password);
		$query = $mysqli->prepare("INSERT INTO usuarios(user_name,user_email,user_password,user_level) VALUES (?,?,?,?)");
		$query->bind_param('sssi',
		$name,
		$email,
		$new_password,
		$level);

		if($query->execute()) {
				$msg = '<div class="alert alert-success"><i class="fa fa-check"></i> &nbsp; ' . $name . ' ha completado el registro.</div>';
		}	else {
				$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
		}
		$query->close();
			
	}
	$mysqli->close();
	?>
	
	<div class="content-wrapper">
		<section class="content">
			<?php echo $msg; ?>
			<div class="form-group">
				<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver a Usuarios</button>
				<button type="button" class="btn btn-default pull-right" onclick="location.href='<?php echo $iniUrl; ?>index.php'"><i class="fa fa-arrow-up"></i> &nbsp; Inicio</button>				
      </div>			
		</section>
	</div>
	
	<?php
	exit;	

}
?>

<div class="content-wrapper">

	<?php  
  $userlevel = $_SESSION['levelSession'];
	if ($userlevel <> 1) {
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
    <h1>Registrar Nuevo Usuario</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-6">
    
      <div class="box box-info">
          <div class="box-header with-border">
            <h1 class="panel-title text-muted">Todos los campos son Obligatorios...</h1>
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
                  <i class="fa fa-envelope" style="width: 16px;"></i>
                </span>
                <input type="email" class="form-control" placeholder="Email" name="m_email" required autofocus />
                <span id="check-e"></span>
              </div>
                
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-user" style="width: 16px;"></i>
                </span>
    	          <input type="text" class="form-control" placeholder="Usuario" name="m_name" required />
              </div>
              
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt" style="width: 16px;"></i>
                </span>
              	<input type="password" class="form-control" placeholder="Contraseña" name="m_password" required  />
              </div>
              
              <div class="form-group">
              

                <div class="btn-group btn-group-justified" data-toggle="buttons" id="prior">
                    <label class="btn btn-primary">
                        <input type="radio" name="m_level" value="1">Super Usuario
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="m_level" value="2">Especial
                    </label>
                    <label class="btn btn-primary active">
                        <input type="radio" name="m_level" value="3" checked="checked">Normal
                    </label>
                </div>
                
              </div>
              
              
              <div class="form-group">
                  <button type="submit" class="btn btn-default pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-user-plus"></i> &nbsp; Crear Cuenta</button> 
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