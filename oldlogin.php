<?php
session_start();
include_once 'includes/db_connect.php';
include_once 'lib/password.php';

if(isset($_SESSION['userSession']) && $_SESSION['userSession'] > 0) {
	header("Location: home.php");
	exit;
}

if(isset($_POST['btn-login']))
{
	
	$email = $mysqli->real_escape_string(trim($_POST['m_email']));
	$password = $mysqli->real_escape_string(trim($_POST['m_password']));
	//$password = $_POST['m_password'];
	
	$query = $mysqli->query("SELECT * FROM me_usuarios WHERE user_email='$email'");
	$row = $query->fetch_array();
	//die($row['user_password']);
	if(password_verify($password, $row['user_password'])) {
		
		$_SESSION['userSession'] = $row['user_id'];
		$_SESSION['nameSession'] = $row['user_name'];
		$_SESSION['levelSession'] = $row['user_level'];
		if(isset($_SESSION['redirect'])) {
			header("Location: " . $_SESSION['redirect']);
		} else {
			$_SESSION['redirect'] = '';
			header("Location: home.php");
		}
	} else {
		$msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email | Contraseña incorrectos...</div>";
	}
	
	$mysqli->close();
	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mesa | Ingresar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>

  </head>

<body>

	<div class="container">
    
    <div class="col-md-4 col-md-offset-4">
    
      <img class="img-responsive" src="img/hcd-me-cab.png" alt="Mesa de Entradas" style="margin: 20px auto;">
      
      <div class="panel panel-primary">
          <div class="panel-heading">
            <h1 class="panel-title">Acceso al Sistema</h1>
          </div>
          <div class="panel-body">
          	<form method="post" id="login-form">
        
							<?php if(isset($msg)){
                echo $msg;
              }	?>
        
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email..." name="m_email" required autofocus />
                <span id="check-e"></span>
              </div>
              
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Contraseña..." name="m_password" required />
              </div>
       
              <hr />
                
              <div class="form-group">
                  <button type="submit" class="btn btn-primary pull-right" name="btn-login" id="btn-login">
                    <span class="glyphicon glyphicon-chevron-right"></span> &nbsp; Ingresar
                  </button> 
              </div>  

		    	  </form>
            <div class="clearfix"></div>

        </div>
      </div>
    </div>
  </div>

</body>
</html>