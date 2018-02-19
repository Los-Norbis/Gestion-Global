<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $iniUrl; ?>js/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/sweetalert.css">

<?php
session_start();
include_once 'includes/db_connect.php';
// include_once 'lib/password.php';

if(isset($_SESSION['userSession']) && $_SESSION['userSession'] > 0) {
	header("Location: index.php");
	exit;
}

if(isset($_POST['btn-login'])) {
	
	$secret = '6LfbHxUUAAAAAMGU5yWl1xuQQFpitWtvLQW6hibc';
	
	$response=$_POST["g-recaptcha-response"];
	$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
	$captcha_success=json_decode($verify);
 
	if ($captcha_success->success==false) {
			echo "<p>You are a bot! Go away!</p>";
			exit;
	}
	
	$name = $mysqli->real_escape_string(trim($_POST['m_name']));
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	$password = $mysqli->real_escape_string(trim($_POST['m_password']));
	
	$new_password = password_hash($password, PASSWORD_DEFAULT);
	$result = $mysqli->query("SELECT user_email FROM usuarios WHERE user_email='$email'");
	$filas = $result->num_rows;
	
	if (!empty( $filas )) {

		echo '<script>jQuery(function(){
				swal({
					title: "Error",
					text: "<strong>' . $email . '</strong> ya se encuentra registrado...",
					type: "warning",
					html: true,
					confirmButtonColor: "#00aa9a",
					confirmButtonText: "Cerrar",
					showConfirmButton: true
				},
				function(){
				  $("#email").focus();
				});			
			});</script>';
	
	} else {

		// die($name . ' ' . $email . ' ' . $new_password);
		$valid = 0;
		$level = 3;
		$query = $mysqli->prepare("INSERT INTO usuarios (user_name, user_email, user_password, user_level, user_validate) VALUES (?,?,?,?,?)");
		$query->bind_param('sssii', $name, $email, $new_password, $level, $valid);

		if($query->execute()) {
			echo '<script>jQuery(function(){
				swal({
					title: "Registro Completado",
					text: "El Administrador le avisara via email cuando se encuentre habilitado para ingresar al sistema.",
					type: "success",
					html: true,
					confirmButtonColor: "#00aa9a",
					confirmButtonText: "Cerrar",
					showConfirmButton: true,
					closeOnConfirm: false
				},
				function(){
				  window.location.href = "login.php";
				});			
			});</script>';
		}	else {
				$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
		}
		$query->close();
			
	}
	$mysqli->close();	
	
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PQ Transportes | Registrar Nuevo Usuario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/SourceSansPro.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"></div>
  <!-- /.login-logo -->
	<h3 style="text-align: center; color: #fff;">Sistema de <strong>Transportes</strong></h3>

  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Registrar Nuevo Usuario</h3>
    </div>
    <div class="box-body">

			<?php
      if(isset($msg)){
         echo $msg;
      }	?>
    

    <form action="" method="post" style="margin: 0;">
    
      <div class="input-group" style="margin: 15px 0;">
        <span class="input-group-addon">
          <i class="fa fa-envelope" style="width: 16px;"></i>
        </span>
        <input type="email" class="form-control" placeholder="Email" name="m_email" id="email" required autofocus>
      </div>
			
      <div class="input-group" style="margin: 15px 0;">
        <span class="input-group-addon">
          <i class="fa fa-user" style="width: 16px;"></i>
        </span>
        <input type="text" class="form-control" placeholder="Empresa" name="m_name" required>
      </div>			
    
      <div class="input-group" style="margin: 15px 0;">
        <span class="input-group-addon">
          <i class="fa fa-unlock-alt" style="width: 16px;"></i>
        </span>
        <input type="password" class="form-control" placeholder="Contraseña" name="m_password" required>
      </div>
			
			<div class="g-recaptcha" data-sitekey="6LfbHxUUAAAAAD1YZp6wXp5svYoVzRNeMln1C7lT" style="text-align: center;"></div>
            
      <div class="row">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary btn-block" name="btn-login" id="btn-login">Registrarse</button>
        </div>
			</div>
			
        
      </div>
    </form>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->




</body>
</html>
