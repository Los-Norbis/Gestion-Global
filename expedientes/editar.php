<?php
ob_start();
$iniUrl = '../';
include($iniUrl . 'header.php');

$orden = $_GET['Id'];
$alcance = $_GET['Alcance'];

if (isset($_POST['btn-signup'])) {

	$ingreso = $mysqli->real_escape_string(trim($_POST['fecha']));
	$periodo = $_POST['periodo'];
	$numero = $_POST['NumeroExp'];
	$alcance = $_POST['alcance'];
	$cuerpo = $_POST['cuerpo'];
	$solicitante = $_POST['solicitante'];
	$caratula = $_POST['motivo'];
	//$ubicacion = $_POST['destino'];
	$archivo = $_POST['archivo'];
	$notas = $_POST['notas'];

	// Numero para buscar
	$orden_act = $_POST['orden_act'];


	$query = $mysqli->prepare("UPDATE me_expedientes SET Ingreso = ?, Orden = ?, Cuerpo = ?, Archivo = ?, Solicitante = ?, Caratula = ?, Notas = ? WHERE Orden = ? AND Alcance = ?");

	$orden = $periodo . $numero;
	$query->bind_param('ssisisssi', $ingreso, $orden, $cuerpo, $archivo, $solicitante, $caratula, $notas, $orden_act, $alcance);

	if($query->execute()) {
			$query->close();
			header('Location: index.php');
	} else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar Nuevo Expediente...</div>';
	}

	$mysqli->close();

} else {


	$sql = "SELECT ALL Id, Nombre FROM fc_clientes";
	if (!$tbl_temas = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló.
			echo "<h2>Error en la Consulta SQL | Solicitantes.</h2>";
			exit;
	}
	/*
	$sql = "SELECT ALL Id, Nombre FROM me_destino_exp";
	if (!$tbl_destinos = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló.
			echo "<h2>Error en la Consulta SQL | Destino.</h2>";
			exit;
	}*/

	$sql = "SELECT * FROM me_expedientes WHERE Orden = " . $orden . " AND Alcance = " . $alcance;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló.
			echo '<h2>Error... Expediente no encontrado (Orden: ' . $orden . '</h2>';
			exit;
	} else {
			$a_exp = $resultado->fetch_assoc();
			$periodo = substr($a_exp['Orden'], 0, 4);
			$numero  = substr($a_exp['Orden'], 4, 4);
	}

	$sql = "SELECT Nombre FROM me_destino_exp WHERE ID = " . $a_exp['Destino'];
	if ($t_query = $mysqli->query($sql)) {
			$fila = $t_query->fetch_row();
			$destino_nombre = $fila[0];
	} else {
			echo "<h2>Error en la Consulta SQL | Destinos.</h2>";
			exit;
	}

	$mysqli->close();
}
?>

<style>
	#alerta {
		font-size: 24px;
		text-align: right;
	}
</style>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Error en el Número...</h4>
      </div>
      <div class="modal-body">
        <p>El número de Expediente y Año ingresados <strong>ya está registrado y no puede duplicarse.</strong><br />Por favor ingrese una combinación de número/año que no se encuentre registrada...</p>
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
    <h1>Modificar <?php echo (!empty($alcance) ? ' Alcance de ' : '');?>Expediente</h1>
  </section>

  <!-- Main content -->
  <section class="content">

		<div class="row">
			<div class="col-md-9">

				<div class="box box-info">
						<div class="box-header with-border">
								<h3 class="box-title pull-left">Modificar <?php echo (!empty($alcance) ? ' Alcance de ' : '');?>Expediente: <?php echo $a_exp['Orden'] . (!empty($alcance) ? ' | ' . $alcance : ''); ?></h3>
								<span class="text-muted pull-right"><small></small></span>
						</div>
					<div class="box-body">

    					<form method="post" id="nuevo-form" class="form-horizontal" role="form">


							<!-- Fecha Ingreso -->
							<div class="form-group">

								<label for="ingreso" class="col-md-3 control-label">Fecha:</label>

								<div class="col-md-9">
									<div class="input-group date form_linkin" data-date="" data-link-field="fecha" >
											<input class="form-control" type="text" value="<?php echo date("d/m/Y", strtotime($a_exp['Ingreso'])); ?>" required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
											<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<input type="hidden" id="fecha" name="fecha" value="<?php echo $a_exp['Ingreso']; ?>" />
								</div>

							</div>

							<div class="form-group">

							<!-- Año DE -->
								<label for="periodo" class="col-md-3 control-label">Año:</label>

								<div class="col-md-3">
									<div class="input-group date form_periodo" data-date="<?php echo $periodo; ?>" data-link-field="" >
										<input class="form-control" type="text" id="periodo" name="periodo" value="<?php echo $periodo; ?>" required pattern="(19|20)\d\d">
										<!--
										<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>-->
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
									<input type="hidden" id="periodoAnt" name="periodoAnt" value="<?php echo $periodo; ?>" />
								</div>


								<div class="col-md-2">
									<div id="NuevoNumero">
										<h4 ><?php echo $numero; ?></h4>
									</div>
									<input type="hidden" name="NumeroExp" id="NumeroExp" value="<?php echo $numero; ?>" />
								</div>
								<div class="col-md-1">
									<div id="alerta"></div>
								</div>
								<div class="col-md-3">
									<input type="number" class="form-control" name="NumeroExpAnt" id="NumeroExpAnt" placeholder="Numero anterior..." data-toggle="tooltip" title="Tenga en cuenta que el Año seleccionado sea el correcto antes de ingresar un Numero Anterior...">
								</div>

							</div>

							<!-- Alcance y Cuerpo -->
							<div class="form-group">

								 <label class="col-md-3 control-label" for="alcance">Alcance:</label>

								<div class="col-md-3">
									<div class="input-group">
											<input type="number" class="form-control" name="alcance" id="alcance" value="<?php echo $a_exp['Alcance']; ?>" readonly >
									</div>
								</div>

								<label class="col-md-3 control-label" for="cuerpo">Cuerpo:</label>

								 <div class="col-md-3">
									<div class="input-group">
											<input type="number" class="form-control" name="cuerpo" id="cuerpo" placeholder="Numero" value="<?php echo $a_exp['Cuerpo']; ?>">
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
											<?php
											while ($temas = $tbl_temas->fetch_assoc()) {
                				echo '<option value=' . $temas['Id'] . ($temas['Id'] == $a_exp['Solicitante'] ? ' selected ' : '') . '>' . $temas['Nombre'] . '</option>';
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
									<textarea class="form-control" rows="3" name="motivo" id="motivo"><?php echo $a_exp['Caratula']; ?></textarea>
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
									<textarea class="form-control" rows="3" name="notas" id="notas"><?php echo $a_exp['Notas']; ?></textarea>
								</div>
							</div>

							<!-- Archivo -->
							<div class="form-group">

								 <label class="col-md-3 control-label" for="archivo">Archivo:</label>

								<div class="col-md-9">
									<input type="text" class="form-control" name="archivo" id="archivo" placeholder="" value="<?php echo $a_exp['Archivo']; ?>" >
								</div>

							</div>


							<div class="col-md-12">
								<input type="hidden" name="tarea" value="0" />
								<button type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
								<button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i>  &nbsp; Modificar Expediente</button>
							</div>

							<input type="hidden" name="orden_act" id="orden_act" value="<?php echo $orden; ?>" />

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

$(".form_periodo").datetimepicker().on('changeDate', function(ev) {
	// alert($('#periodoAnt').val())
	Itati(0);
});

$('#NumeroExpAnt').change(function() {
	Itati(1);
});

function Itati(origen) {
	//alert($('#periodo').val());
	$("#alerta").html('');

	if (origen == 0) { // Viene del Date Year...
		var consulta = $("#periodo").val() + pad($("#NumeroExp").val(),4);
	} else {
		var consulta = $("#periodo").val() + pad($("#NumeroExpAnt").val(),4);
	}

	//alert(consulta)

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

				if (origen == 0) { // Restauro el ultimo periodo valido
					$('#periodo').val($("#periodoAnt").val());
					$('.form_periodo').datetimepicker('update');
				}
				$("#myModal").modal();
			} else {

				if (origen == 0) { // Guardo el ultimo periodo valido
					$('#periodoAnt').val($("#periodo").val());
				} else {
					$("#NumeroExp").val(pad($("#NumeroExpAnt").val(),4));
					$("#NuevoNumero").html('<h4>' + pad($("#NumeroExpAnt").val(),4) + '</h4>');
				}

			}
		}
	});

}

function pad (str, max) {
	str = str.toString();
	return str.length < max ? pad("0" + str, max) : str;
}

</script>

<?php include($iniUrl . 'footer.php');
ob_end_flush();
?>
