<?php
	include('../includes/db_connect.php');

	$orden = $_POST['orden'];
	$usuario = intval($_POST['usuario']);

	if(!empty($orden)) {
		$alcance = 0;
		if (strlen($orden > 8)) {
			// Tiene alcance
			$alcance = substr($orden, 9);
			$orden = substr($orden, 0, 8);
		}
		
		$arr['mensaje'] = 'Mal evaluado';
		$arr['codigo'] = 0;
		$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $orden . " AND Alcance = " . $alcance;
		 
		if ($resultado = $mysqli->query($sql)) {
			$filas = $resultado->num_rows;
		 
			if($filas > 0){ // El expediente existe...
				$expact = $resultado->fetch_assoc(); // guardo datos expediente
				$arr['codigo'] = 1; // Validar boton de registro
				$sql = "SELECT * FROM me_ruta_exp WHERE Orden = " . $orden . " AND Alcance = " . $alcance . " ORDER BY Fecha Desc";
				
				if ($resultado = $mysqli->query($sql)) {
					$filas = $resultado->num_rows;
					if($filas > 0){ // El expediente tiene movimientos...
						$ultmov = $resultado->fetch_assoc();
						$fecha = date_create($ultmov['Fecha']);
						
						// Buscar nombre de usuario
						$sql = "SELECT Nombre FROM me_destino_exp WHERE Id = " . intval($ultmov['Destino']);
						if ($users = $mysqli->query($sql)) {
							$ac_user = $users->fetch_assoc();
						}
						
						if ($usuario == intval($ultmov['Usuario'])) { // Si ya esta a su nombre
						
							$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: white;"></i>&nbsp; Ya se encuentra registrado en su Cuenta...<br />El d&iacute;a ' . date_format($fecha, 'd/m/Y') . ' a las ' . date_format($fecha, 'H:i') . ' Hs.';
							$arr['codigo'] = 0; // Error... lo tiene el
							
						} else {
							
							$arr['mensaje'] = '<i class="fa fa-info-circle" style="color: white;"></i>&nbsp; Ultimo Movimiento: ' . date_format($fecha, 'd/m/Y') . '  |  ' . date_format($fecha, 'H:i') . ' Hs. <br>Area: ' . $ac_user['Nombre'];
							
						}
					} else {
						$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: yellow;"></i>&nbsp; Expediente sin Movimientos...';
					}
					
				} else { // Error de DB
				
					$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: yellow;"></i>&nbsp; Error al acceder a los Datos...';
					$arr['codigo'] = 0;
				
				}
				
			} else {
			
				$arr['codigo'] = 0;
				$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: yellow;"></i>&nbsp; Expediente Inexistente...';
				
			}
			
		} else {
			
			$arr['mensaje'] = '<i class="fa fa-exclamation-circle" style="color: yellow;"></i>&nbsp; Error al acceder a los Datos...';
			$arr['codigo'] = 0;	
					
		}
		echo json_encode($arr);
	}     
?>