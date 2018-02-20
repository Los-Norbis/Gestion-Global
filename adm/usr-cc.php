<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
//include_once $iniUrl . 'lib/password.php';

if(isset($_POST['btn-signup'])) {
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	$name = $mysqli->real_escape_string(trim($_POST['m_name']));
	$password = $mysqli->real_escape_string(trim($_POST['m_password']));
	$level = $_POST['m_level'];
	$area = $_POST['m_destino'];
	
	if (!empty($password)) {
		$new_password = password_hash($password, PASSWORD_DEFAULT);
	}
	
	$result = $mysqli->query("SELECT user_email FROM usuarios WHERE user_email='$email'");
	$filas = $result->num_rows;
	
	if (empty( $filas )) {

		//printf("Result set has %d rows.\n", $filas);
		//die();

		$msg = '<div class="alert alert-danger"><i class="fa fa-remove"></i> &nbsp; ' . $email . ' no se encuentra registrado...</div>';		
		
	} else {

		//die($name . ' ' . $email . ' ' . $new_password . ' ' . $level);
		if (!empty($password)) {
			$query = $mysqli->prepare("UPDATE usuarios SET user_name = ?, user_password = ?, user_level = ?, user_area = ? WHERE user_email = ?");
			$query->bind_param('ssiis', $name, $new_password, $level, $area, $email);
		} else {
			$query = $mysqli->prepare("UPDATE usuarios SET user_name = ?, user_level = ?, user_area = ? WHERE user_email = ?");
			$query->bind_param('siis', $name, $level, $area, $email);
		}

		if($query->execute()) {
				$msg = '<div class="alert alert-success"><i class="fa fa-check"></i> &nbsp; ' . $name . ' ha sido modificado.</div>';
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

} else {
	
	$sql = "SELECT ALL Id, Nombre FROM me_destino_exp";
	if (!$tbl_destinos = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Destino.</h2>";
			exit;
	}
		
	// Cargar Data del Usuario	
	$usr_id = $_GET['Id'];
	$sql = "SELECT * FROM usuarios WHERE user_id = " . $usr_id;
	if (!$result = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Usuarios.</h2>";
			exit;
	}	else {
		$usr_act = $result->fetch_assoc();
		$usr_lvl = $usr_act['user_level'];
	}
	// Para desactivar Levels
	$userlevel = $_SESSION['levelSession'];
	$disable_class = ($userlevel <> 1 ? ' disabled' : '');
	
}
?>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Modificar Usuario <small>Id: <?php echo $usr_id; ?></small></h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-6">
    
				<div class="box box-info">
          <div class="box-header with-border">
            <span class="text-muted pull-right">Todos los campos son Obligatorios...</span>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form">
            
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-envelope" style="width: 16px;"></i>
                </span>
                <input type="email" class="form-control" placeholder="Email" name="m_email" value="<?php echo $usr_act['user_email']; ?>" />
                <span id="check-e"></span>
              </div>
              
							<div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-user" style="width: 16px;"></i>
                </span>
              <input type="text" class="form-control" placeholder="Usuario" name="m_name"  value="<?php echo $usr_act['user_name']; ?>" required  autofocus />
              </div>
							
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt" style="width: 16px;"></i>
                </span>
              	<input type="password" class="form-control" placeholder="Contraseña | Dejar en blanco para conservar la anterior" name="m_password" />
              </div>

              <!-- Destino -->
              <div class="form-group">
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt" style="width: 16px;"></i>
                </span>
                  
                <select required class="form-control" name="m_destino" id="destino" required>
                    <option value="">Area del Usuario</option>
                    <?php
                   	while ($destinos = $tbl_destinos->fetch_assoc()) {
						echo '<option value=' . $destinos['Id'] . ($destinos['Id'] == $usr_act['user_area'] ? ' selected ' : '') . '>' . $destinos['Nombre'] . '</option><br />';
					}
                    ?>
                </select>
                  
              </div>

              <div class="form-group">
                <div class="btn-group btn-group-justified <?php echo ($userlevel <> 1 ? 'disabled-group' : ''); ?>" data-toggle="buttons" id="prior">
                    <label class="btn btn-primary <?php echo ($usr_lvl == 1 ? 'active' : '') . $disable_class; ?>">
                        <input type="radio" name="m_level" value="1" <?php echo ($usr_lvl == 1 ? 'checked="checked"' : ''); ?>>Super Usuario
                    </label>
                    <label class="btn btn-primary <?php echo ($usr_lvl == 2 ? 'active' : '') . $disable_class; ?>">
                        <input type="radio" name="m_level" value="2" <?php echo ($usr_lvl == 2 ? 'checked="checked"' : ''); ?>>Especial
                    </label>
                    <label class="btn btn-primary <?php echo ($usr_lvl == 3 ? 'active' : '') . $disable_class; ?>">
                        <input type="radio" name="m_level" value="3" <?php echo ($usr_lvl == 3 ? 'checked="checked"' : ''); ?>>Normal
                    </label>
                </div>
                
              </div>

              
              <div class="form-group">
									<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                  <button type="submit" class="btn btn-default pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Guardar Cambios</button> 
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
include($iniUrl . 'footer.php');
?>