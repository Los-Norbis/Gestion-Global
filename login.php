<?php
session_start();
include_once 'includes/db_connect.php';
// include_once 'lib/password.php';

if(isset($_SESSION['userSession']) && $_SESSION['userSession'] > 0) {
	header("Location: index.php");
	exit;
}

if(isset($_POST['btn-login'])) {

	$user = $mysqli->real_escape_string(trim($_POST['m_user']));
	$password = $mysqli->real_escape_string(trim($_POST['m_password']));
	//$password = $_POST['m_password'];

	$query = $mysqli->query("SELECT * FROM usuarios WHERE BINARY user_name='$user'");
	if ($query->num_rows > 0) {

		$row = $query->fetch_array();
		//die($row['user_password']);
		// Controlar Pass y que se encuentre activo
		if(password_verify($password, $row['user_password']) && $row['user_validate'] > 0) {

			$_SESSION['userSession'] = $row['user_id'];
			$_SESSION['nameSession'] = $row['user_name'];
			$_SESSION['levelSession'] = $row['user_level'];
			$_SESSION['imgSession'] = (!empty($row['user_img']) ? $row['user_img'] : 'empty-avatar.png');
			if(isset($_SESSION['redirect'])) {
				header("Location: " . $_SESSION['redirect']);
			} else {
				$_SESSION['redirect'] = '';
				header("Location: index.php");
			}

		} else if ($row['user_validate'] == 0) { // Usuario no habilitado

				$msg = '<div class="callout callout-danger"><i class="icon fa fa-ban"></i> &nbsp; Ud. aun no ha sido habilitado...</div>';

		} else { // Pass incorrecto...

			$msg = '<div class="callout callout-warning"><i class="icon fa fa-ban"></i> &nbsp; Contraseña incorrecta...</div>';

		}

	} else { // Usuario incorrecto...

			$msg = '<div class="callout callout-warning"><i class="icon fa fa-ban"></i> &nbsp; Usuario incorrecto o inexistente...</div>';
	}

	$mysqli->close();

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fescom | Ingreso al Sistema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/SourceSansPro.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.css">

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
	<h3 style="text-align: center; color: #fff;">Sistema de <strong>Gesti&oacute;n</strong></h3>

  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">Ingreso al Sistema</h3>
    </div>
    <div class="box-body">

			<?php
      if(isset($msg)){
         echo $msg;
      }	?>


    <form action="" method="post">

      <div class="input-group" style="margin: 15px 0;">
        <span class="input-group-addon">
          <i class="fa fa-user" style="width: 16px;"></i>
        </span>
        <input type="text" class="form-control" placeholder="Usuario" name="m_user" required autofocus>
      </div>

      <div class="input-group" style="margin: 15px 0;">
        <span class="input-group-addon">
          <i class="fa fa-unlock-alt" style="width: 16px;"></i>
        </span>
        <input type="password" class="form-control" placeholder="Contraseña" name="m_password" required>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary btn-block" name="btn-login" id="btn-login">Continuar</button>
        </div>
			</div>

			<div class="row">
        <div class="col-xs-12 col-sm-6">
					<button class="btn btn-default btn-block">Olvidé mi Contraseña</button>
				</div>
				<div class="col-xs-12 col-sm-6">
					<a href="registro.php" class="btn btn-default btn-block">Registrarse</a>
        </div>
			</div>



      </div>
    </form>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
