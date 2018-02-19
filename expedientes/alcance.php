<?php
ob_start();
$iniUrl = '../';
include($iniUrl . 'header.php');
$usuario = $_SESSION['userSession'];

$orden = $_GET['Id'];

if (isset($_POST['btn-signup'])) {
	
	$ingreso = $mysqli->real_escape_string(trim($_POST['fecha']));	
	$alcance = $_POST['alcance'];
	$cuerpo = $_POST['cuerpo'];
	$solicitante = $_POST['solicitante'];
	$caratula = $_POST['motivo'];
	$ubicacion = $_POST['destino'];
	$archivo = $_POST['archivo'];
	$notas = $_POST['notas'];	

	// die($name . ' ' . $email . ' ' . $new_password);
	
	
	
	$query = $mysqli->prepare("INSERT INTO me_expedientes(Ingreso, Orden, Alcance, Cuerpo, Archivo, Solicitante, Caratula, Destino, Notas) VALUES (?,?,?,?,?,?,?,?,?)");
	$query->bind_param('ssiisisis', $ingreso, $orden, $alcance, $cuerpo, $archivo, $solicitante, $caratula, $ubicacion, $notas);
	
	
	// Crear Expediente en DB
	if($query->execute()) {
		$query->close();
	} else {
		echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar Nuevo Expediente... error: ' . $query->error . '</div>';
		exit;
	}
	
	// Crea Movimiento
	$dateTime = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
	$add_date = $dateTime->format("Y-m-d H:i:s");
	$fecha = $add_date;	
	$nota = 'Alta de Alcance de Expediente';
	$sql = "INSERT INTO me_ruta_exp (Orden, Usuario, Fecha, Destino, Notas) VALUES (?, ?, ?, ?, ?)";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('sisis', $orden, $usuario, $fecha, $ubicacion, $nota);
		
	if($stmt->execute()) {
		$stmt->close();
	}	else {
		echo '<div class="callout callot-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al guardar Movimiento... error: ' . $stmt->error . '</div>';
		exit;
	}

	$mysqli->close();
		
	?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Nuevo Expediente | Car&aacute;tula</h1>
      </section>    
    	<section class="content">
        
			<div class="row">
        
        	  <form action="caratula.php" method="post" target="_blank">
                  <input type="hidden" name="ingreso" value="<?php echo $ingreso; ?>" />
                  <input type="hidden" name="periodo" value="<?php echo substr($orden,0,4); ?>" />
                  <input type="hidden" name="numero" value="<?php echo substr($orden,4); ?>" />
                  <input type="hidden" name="alcance" value="<?php echo $alcance; ?>" />
                  <input type="hidden" name="cuerpo" value="<?php echo $cuerpo; ?>" />
                  <input type="hidden" name="caratula" value="<?php echo $caratula; ?>" />
                  <input type="hidden" name="solicitante" value='<?php echo $solicitante; ?>' />
                  <input type="hidden" name="ubicacion" value='<?php echo $ubicacion; ?>' />
                  <input type="hidden" name="notas" value='<?php echo $notas; ?>' />

				<div class="col-md-12">
                	<div class="callout callout-info">
						<i class="fa fa-exclamation-circle"></i> &nbsp; El Expediente ha sido creado exitosamente...
					</div>
					<button type="button" class="btn btn-default" onclick="location.href='../index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>								
					<button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><span class="glyphicon glyphicon-save"></span> Imprimir Car&aacute;tula</button>
				</div>                                  
              </form>
            </div>      
        
        </section>
    </div>

	<?php
	include($iniUrl . 'footer.php');
	ob_flush();


} else {


	$sql = "SELECT ALL Id, Nombre FROM me_solicitantes";
	if (!$tbl_temas = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Solicitantes.</h2>";
			exit;
	}

	
	$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $orden . " ORDER BY Alcance DESC";
	if (!$tbl_mayor = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Expedientes.</h2>";
			exit;
	} else {
			$exp = $tbl_mayor->fetch_assoc();
			$alcance = $exp['Alcance'] + 1;
	}

	// Obtener Area actual
	
	$sql = "SELECT user_area FROM usuarios WHERE user_id = " . $usuario;
	if ($t_query = $mysqli->query($sql)) {
			$fila = $t_query->fetch_row();
			$destino = $fila[0];
	} else {
			echo "<h2>Error en la Consulta SQL | Usuarios.</h2>";
			exit;
	}
	
	$sql = "SELECT Nombre FROM me_destino_exp WHERE ID = " . $destino;
	if ($t_query = $mysqli->query($sql)) {
			$fila = $t_query->fetch_row();
			$destino_nombre = $fila[0];
	} else {
			echo "<h2>Error en la Consulta SQL | Destinos.</h2>";
			exit;
	}	

	//var_dump($destino_nombre);
	//die();
	
	$mysqli->close();
}
?>
  
	<style>
		#alerta {
			font-size: 24px;
			text-align: right;
		}
	</style>
  
  <script type="text/javascript">
	$(document).ready(function(){
                         
		//comprobamos si se pulsa una tecla
		$("#NumeroExpAnt").focusout(function(e){
				
			var consulta = $("#periodo").val() + pad($("#NumeroExpAnt").val(),4);
			if ($("#NumeroExpAnt").val() > 0) {
				 //hace la búsqueda
				$("#alerta").delay(1000).queue(function(n) {      
																			 
					$("#alerta").html('<i class="fa fa-spinner"></i>');
																	 
					$.ajax({
						type: "POST",
						url: "chk-na.php",
						data: "num_ant="+consulta,
						dataType: "json",
						error: function(){
								alert("Error en petición Ajax...");
						},
						success: function(data){
							// alert(data.codigo);
							$("#alerta").html(data.mensaje);
							if (data.codigo == 0) {
								$("#NumeroExpAnt").val('');
								$("#myModal").modal();
								
								//
								
							} else {
								$("#NumeroExp").val(pad($("#NumeroExpAnt").val(),4));
								$("#NuevoNumero").html('<h4>' + pad($("#NumeroExpAnt").val(),4) + '</h4>');
							}
							n();
						}
					});
																			 
				});
			} else {
				$("#alerta").html('');
			}
															
		});
														
	});
	
	function pad (str, max) {
  	str = str.toString();
  	return str.length < max ? pad("0" + str, max) : str;
	}
	
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Error en Número de Expediente Anterior...</h4>
      </div>
      <div class="modal-body">
        <p>El número de Expediente y Año ingresados <strong>ya está registrado y no puede duplicarse.</strong><br />Por favor ingrese un número que no se encuentre registrado o utilice la numeración automática dejando esta casilla vacia...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  
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
    <h1>Nuevo Alcance de Expediente</h1>
  </section>

  <!-- Main content -->
  <section class="content">
	
		<div class="row">
			<div class="col-md-9">
				
				<div class="box box-info">
						<div class="box-header with-border">
								<h3 class="box-title pull-left">Nuevo Alcance: <?php echo substr($orden,0,4) . ' | ' . substr($orden,4); ?></h3>
								<span class="text-muted pull-right"><small></small></span>
						</div>
					<div class="box-body">	
  	
    					<form method="post" id="nuevo-form" class="form-horizontal" role="form">
    
      
							<!-- Fecha Ingreso -->
							<div class="form-group">
							
								<label for="ingreso" class="col-md-3 control-label">Fecha:</label>
								
								<div class="col-md-9">
									<div class="input-group date form_linkin" data-date="" data-link-field="fecha" >
											<input class="form-control" type="text" value="" required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
											<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<input type="hidden" id="fecha" name="fecha" value="" />
								</div>
								
							</div>
				

				
							<!-- Alcance y Cuerpo -->
							<div class="form-group">
							
								 <label class="col-md-3 control-label" for="alcance">Alcance:</label>
								
								<div class="col-md-3">
									<div class="input-group">
											<input type="number" class="form-control" name="alcance" id="alcance" value="<?php echo $alcance;?>" readonly >
									</div>
								</div>
								
								<label class="col-md-3 control-label" for="cuerpo">Cuerpo:</label>
								
								 <div class="col-md-3">
									<div class="input-group">
											<input type="number" class="form-control" name="cuerpo" id="cuerpo" placeholder="Numero" >
									</div>
								</div>
								
							</div>
							
							
							<!-- Tema -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="solicitante">Solicitante:</label>
								
								<div class="col-md-9">
									<div>
										<select required class="form-control" name="solicitante" id="solicitante">
											<option value="" >Seleccione Solicitante...</option>
											<?php /*
											while ($temas = $tbl_temas->fetch_assoc()) {
												echo '<option value=' . $temas['Id'] . '>' . $temas['Nombre'] . '</option>';
											}*/
											while ($temas = $tbl_temas->fetch_assoc()) {
                				echo '<option value=' . $temas['Id'] . ($temas['Id'] == $exp['Solicitante'] ? ' selected ' : '') . '>' . $temas['Nombre'] . '</option>';												
											}
											?>
										</select>
									</div>
								</div>
								
							</div>
							
							<!-- Tema -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="motivo">Caratula:</label>
								
								<div class="col-md-9">
									<textarea class="form-control" rows="3" name="motivo" id="motivo" ><?php echo $exp['Caratula'];?></textarea>
								</div>
							</div>
							
							<!-- Destino -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="n_destino">Ubicaci&oacute;n:</label>
								
								<div class="col-md-9">
                                    <input type="text" class="form-control" name="n_destino" id="n_destino" value="<?php echo $destino_nombre;?>" disabled>
								</div>
								
							</div>
							
							<!-- Notas -->
							<div class="form-group">
							
								<label class="col-md-3 control-label" for="notas">Notas:</label>
								
								<div class="col-md-9">
									<textarea class="form-control" rows="3" name="notas" id="notas"><?php echo $exp['Notas'];?></textarea>
								</div>
							</div>
							
							<!-- Archivo -->
							<div class="form-group">
							
								 <label class="col-md-3 control-label" for="archivo">Archivo:</label>
								
								<div class="col-md-9">
									<input type="text" class="form-control" name="archivo" id="archivo" value="<?php echo $exp['Archivo'];?>" >
								</div>
								
							</div>			
							
							
							<div class="col-md-12">
								<input type="hidden" name="tarea" value="0" />
								<button type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>								
								<button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><span class="glyphicon glyphicon-save"></span> Agregar Alcance</button>
                                <input type="hidden" name="destino" value="<?php echo $destino;?>" />
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
    
  <link href="<?php echo $iniUrl;?>css/malo/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo $iniUrl;?>js/malo/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script type="text/javascript" src="<?php echo $iniUrl;?>js/malo/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

  <script type="text/javascript">

  $(".form_linkin").datetimepicker({
      language:  'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0,
      format: "dd/mm/yyyy",
      linkField: "fecha",
      linkFormat: "yyyy-mm-dd" // linkFormat: "yyyy-mm-dd hh:ii"
  });

  $(".form_periodo").datetimepicker({
      language:  'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 4,
      minView: 4,
      forceParse: 0,
      format: "yyyy",
  });
	
	function upperCaseF(a){
    setTimeout(function(){ a.value = a.value.toUpperCase(); }, 1);
	}
  </script>

<?php include($iniUrl . 'footer.php');
ob_end_flush();
?>