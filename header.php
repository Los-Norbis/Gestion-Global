<?php
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('America/Argentina/Buenos_Aires');

include_once $iniUrl . 'includes/db_connect.php';
session_start();

// Check Login
if( !isset($_SESSION['userSession']) ) {
  $_SESSION['redirect'] = $_SERVER["REQUEST_URI"]; // "http://" . $_SERVER["SERVER_NAME"] . adelante al pasar a web
  header('Location: ' . $iniUrl . 'login.php');
  // echo('check falso...' . $_SESSION['redirect']);
}

$niveles = array('', 'Super Usuario', 'Administrador', 'Especial', 'Usuario');
$level = $_SESSION['levelSession'];
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fescom | Sistema de Gestión</title>

	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $iniUrl;?>img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $iniUrl;?>img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $iniUrl;?>img/favicon-16x16.png">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $iniUrl;?>bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $iniUrl;?>bootstrap/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $iniUrl;?>css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo $iniUrl;?>css/skins/skin-red.min.css">

	<link rel="stylesheet" href="<?php echo $iniUrl;?>css/SourceSansPro.css">

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo $iniUrl;?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo $iniUrl;?>bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $iniUrl;?>js/app.min.js"></script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-red sidebar-collapse sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $iniUrl;?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SG</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Sistema de <b>Gestión</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Alternar Navegación</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo $iniUrl;?>img/<?php echo $_SESSION['imgSession'];?>" class="user-image" alt="Usuario">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['nameSession'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo $iniUrl;?>img/<?php echo $_SESSION['imgSession'];?>" class="img-circle" alt="Usuario">

                <p><?php echo $_SESSION['nameSession'];?>
                	<small>Nivel: <?php echo $_SESSION['levelSession'] . ' (' . $niveles[$_SESSION['levelSession']] . ')';?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="btn-group btn-group-justified">

                  <a href="<?php echo $iniUrl;?>usr-profile.php?Id=<?php echo $_SESSION['userSession'];?>" class="btn btn-default"><i class="fa fa-user" style="margin-right: 10px;"></i> <span>Perfil</span></a>

                  <a href="<?php echo $iniUrl;?>logout.php?logout=true" class="btn btn-default"><i class="fa fa-sign-out" style="margin-right: 10px;"></i> <span>Salir</span></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVEGACION PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->

        <li>
        	<a href="<?php echo $iniUrl;?>index.php"><i class="fa fa-home"></i> <span>Inicio</span></a>
        </li>

        <li>
        	<a href="<?php echo $iniUrl . 'clientes/'; ?>"><i class="fa fa-users"></i> <span>Clientes</span></a>
        </li>

        <li>
        	<a href="<?php echo $iniUrl . 'stock/'; ?>"><i class="fa fa-shopping-cart"></i> <span>Articulos</span></a>
        </li>

        <li>
        	<a href="<?php echo $iniUrl . 'categorias/'; ?>"><i class="fa fa-tag"></i> <span>Categorias</span></a>
        </li>

        <li>
        	<a href="<?php echo $iniUrl . 'marcas/'; ?>"><i class="fa fa-trademark"></i> <span>Marcas</span></a>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-file"></i> <span>Informes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $iniUrl . 'expedientes/qr-masivo.php'; ?>"><i class="fa fa-circle-o"></i> Códigos QR</a></li>
          </ul>
        </li>

    <?php
    if ($level < 3) { ?>

        <li class="header">OPCIONES GENERALES</li>
				<li>
        	<a href="<?php echo $iniUrl;?>config.php"><i class="fa fa-gear"></i> <span>Configuraci&oacute;n</span></a>
        </li>
        <li>
        	<a href="<?php echo $iniUrl;?>includes/db_backup.php"><i class="fa fa-download"></i> <span>Backup de Datos</span></a>
        </li>

        <li>
           <a href="<?php echo $iniUrl . 'adm/'; ?>"><i class="fa fa-user"></i> <span>Usuarios</span></a>
        </li>
        <?php
		} ?>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
