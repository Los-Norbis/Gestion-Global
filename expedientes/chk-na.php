<?php
	include('../includes/db_connect.php');

	$numero = $_POST['num_ant'];

	if(!empty($numero)) {

		$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $numero;
		 
		if ($resultado = $mysqli->query($sql)) {
			$filas = $resultado->num_rows;
		 
			if($filas == 0){
					$arr['codigo'] = 1;
					$arr['mensaje'] = '<i class="fa fa-check-square" style="color: green;"></i>';
					// echo '<i class="fa fa-check-square" style="color: green;"></i>';
			} else {
					$arr['codigo'] = 0;
					$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: red;"></i>';
					// echo '<i class="fa fa-exclamation-circle" style="color: red;"></i>';
			}
			echo json_encode($arr);
		}
	}     
?>