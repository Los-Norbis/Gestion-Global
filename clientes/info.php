<?php
if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: index.php');
}
$iniUrl = '../';
$TrId =$_GET['TrId'];
$Nombre = $_GET['Nombre'];
$Volver = $_GET['Call'];
include($iniUrl . 'header.php');

?>

<style>
label {font-weight: normal;}
</style>

<link href="<?php echo $iniUrl; ?>css/malo/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>plugins/iCheck/all.css">
  <script src="<?php echo $iniUrl; ?>plugins/iCheck/icheck.min.js"></script>
	
	<script src="<?php echo $iniUrl; ?>js/sweetalert.min.js"></script>
	<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/sweetalert.css">	


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
	
	// Obtener Fechas de Pendientes para Listado 2
	$sql = 'SELECT Fecha FROM trans_cc WHERE Tr_Id = ' . $TrId . ' AND Fin = 0 ORDER BY Fecha';
	
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		$result->data_seek(0);
		$row = $result->fetch_assoc();
		$dfecha = $row['Fecha'];
		$result->data_seek($result->num_rows - 1);
		$row = $result->fetch_assoc();
		$hfecha = $row['Fecha'];
		$_rng_2 = true;		
	} else {
		$_rng_2 = false;
	}
	?>
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Informes <small><?php echo $Nombre;?></small></h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
		<div class="row">
			<div class="col-md-6 col-xs-12">
			
				<div class="box box-danger">
						<div class="box-header with-border">
							<h4 class="box-title">Cartas de Porte Pendientes | Subtotales</h4>
						</div>
						<div class="box-body">
							<div class="alert alert-success">
							Utilice este informe para ver la suma de los subtotales de todas las Cartas de Porte pendientes...
							</div>
							<form method="post" id="cpp-form" action="info_uno.php" target="_blank">
	
								<input type="hidden" name="Id" value="<?php echo $TrId;?>" />
								<input type="hidden" name="Nombre" value="<?php echo $Nombre;?>" />
								
								<div class="form-group">
									<button tabindex="4" type="submit" class="btn btn-primary pull-right" ><i class="fa fa-eye"></i> &nbsp; Ver Informe</button> 
								</div> 
							
							</form>
				
						</div>
				</div>
			</div>

	    <div class="col-md-6 col-xs-12">
      	<div class="box box-info">
          <div class="box-header with-border">
          	<h4 class="box-title">Movimientos Pendientes por Per&iacute;odo</h4>
          </div>
          <div class="box-body">
						<?php if ($_rng_2) { ?>
        		<form method="post" id="mpp-form" action="info_dos.php" target="_blank">
              
              <div class="form-group" id="tipos" >
									<div class="row" style="margin-bottom: 12px;">
										<div class="col-md-6">
											<label>
													<input type="checkbox" name="tipo[]" value="0" class="square-blue ValCheck" checked /> Cartas de Porte
											</label>
										</div>
										<div class="col-md-6">
											<label>
												<input type="checkbox" name="tipo[]" value="1" class="square-blue ValCheck" > Combustible
											</label>
										</div>
									</div>
									<div class="row" style="margin-bottom: 12px;">
										<div class="col-md-6">
											<label>
													<input type="checkbox" name="tipo[]" value="2" class="square-blue ValCheck" /> Adelanto Efectivo
											</label>
										</div>
										<div class="col-md-6">
											<label>
												<input type="checkbox" name="tipo[]" value="3" class="square-blue ValCheck" > Cheque
											</label>
										</div>
									</div>
									<div class="row" style="margin-bottom: 12px;">
										<div class="col-md-6">
											<label>
													<input type="checkbox" name="tipo[]" value="4" class="square-blue ValCheck" /> Orden de Compra
											</label>
										</div>
										<div class="col-md-6">
											<label>
												<input type="checkbox" name="tipo[]" value="5" class="square-blue ValCheck" > Pago
											</label>
										</div>
									</div>
									
              </div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="input-group date dfecha_link" data-date="" data-link-field="dfecha" style="margin: 10px 0 20px;">
											<span class="input-group-addon">
												<i class="fa fa-calendar" style="width: 16px;"></i>
											</span>
											<input tabindex="1" class="form-control" type="text" value="<?php echo date('d/m/Y', strtotime($dfecha)); ?>" placeholder="Desde Fecha..." required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
									</div>
									<input type="hidden" id="m_dfecha" name="m_dfecha" value="<?php echo $dfecha; ?>" />
								</div>

								<div class="col-md-6">
									<div class="input-group date hfecha_link" data-date="" data-link-field="hfecha" style="margin: 10px 0 20px;">
											<span class="input-group-addon">
												<i class="fa fa-calendar" style="width: 16px;"></i>
											</span>
											<input tabindex="1" class="form-control" type="text" value="<?php echo date('d/m/Y', strtotime($hfecha)); ?>" placeholder="Hasta Fecha..." required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
									</div>
									<input type="hidden" id="m_hfecha" name="m_hfecha" value="<?php echo $hfecha; ?>" />
								</div>
							</div>
							
							<input type="hidden" name="Id" value="<?php echo $TrId;?>" />
							<input type="hidden" name="Nombre" value="<?php echo $Nombre;?>" />
              
              <div class="form-group">
                <button tabindex="4" type="submit" class="btn btn-primary pull-right" id="checkBtn"><i class="fa fa-eye"></i> &nbsp; Ver Informe</button> 
              </div> 
            
            </form>
 						<?php } else { ?>
							<div class="alert alert-info">
							No se encontraron Movimientos Pendientes...
							</div>
						<?php } ?>					 
          </div>
  	  </div>
    </div>
  	</div>
	  <div class="row">
			<div class="col-md-12">
       	<button tabindex="5" type="button" class="btn btn-default pull-left" onclick="location.href='cc.php?Id=<?php echo $TrId;?>&Nombre=<?php echo $Nombre;?>&Call=1'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
			</div>
		</div>
	</section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

$(document).ready(function(){
	
    $('#checkBtn').click(function() {
			// Controlar si hay Tipos seleccionados...
      checked = $('input[name="tipo[]"]:checked').length; 
      if(!checked) {
				swal({
					title: "Error",
					text: "Debe seleccionar al menos <strong>un tipo de movimiento</strong><br />para el Informe...",
					/*timer: 8000,*/
					type: "warning",
					html: true,
					confirmButtonText: "Cerrar",
					showConfirmButton: true
				});
        return false;
      }
			
			// Controlar fechas validas
			var dfecha = $('#m_dfecha').val();
			var hfecha = $('#m_hfecha').val();
			if (hfecha < dfecha) {
				swal({
					title: "Error",
					text: "En el periodo seleccionado para el Informe<br />la <strong>fecha inicial</strong> <i>no puede ser mayor</i> a la <strong>fecha final</strong>...",
					/*timer: 8000,*/
					type: "warning",
					html: true,
					confirmButtonText: "Cerrar",
					showConfirmButton: true
				});
				return false;
			}

    });	
													 
  $(".dfecha_link").datetimepicker({
		  language:  'es',
		  weekStart: 1,
		  todayBtn:  1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0,
		  format: "dd/mm/yyyy",
		  linkField: "m_dfecha",
		  linkFormat: "yyyy-mm-dd"
  });
  
  $(".hfecha_link").datetimepicker({
		  language:  'es',
		  weekStart: 1,
		  todayBtn:  1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0,
		  format: "dd/mm/yyyy",
		  linkField: "m_hfecha",
		  linkFormat: "yyyy-mm-dd"
  });

});

//Flat red color scheme for iCheck
$('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
  checkboxClass: 'icheckbox_square-blue',
  radioClass: 'iradio_square-blue'
});
</script> 

<?php
include($iniUrl . 'footer.php');
?>