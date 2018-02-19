<?php
ob_start();
$iniUrl = '../';
$TrId =$_GET['TrId'];
$Nombre = $_GET['Nombre'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
  $m_fecha = $mysqli->real_escape_string(trim($_POST['m_fecha']));
  $m_tipo = $_POST['m_tipo'];
  $m_importe = $_POST['m_importe'];
  $m_nota = $mysqli->real_escape_string(trim($_POST['m_nota']));
  $cbtb = 0;
  if ($m_tipo == 1) {
	  $cbtb = $_POST['combustible'];
  }
	
  $query = $mysqli->prepare("INSERT INTO trans_cc(Fecha, Tipo, Tr_Id, Importe, Aux, Nota) VALUES (?,?,?,?,?,?)");
	$query->bind_param('siidis', $m_fecha, $m_tipo, $TrId, $m_importe, $cbtb, $m_nota);

	if($query->execute()) {
		if ($m_tipo == 1) {
			$url_nombre = str_replace(" ", "%20", $Nombre);
			?>
			<script src="<?php echo $iniUrl; ?>js/sweetalert.min.js"></script>
			<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/sweetalert.css">
			<script type="text/javascript">
					swal({
						title: "Atencion",
						text: '<a class="btn btn-success btn-lg" href="orden.php?Cant=<?php echo $m_importe; ?>&Nombre=<?php echo $url_nombre; ?>&Tipo=<?php echo $cbtb; ?>&Fecha=<?php echo $m_fecha; ?>" target="_blank">Pulse AQUI para Imprimir la Orden</a>',
						/*timer: 8000,*/
						type: "warning",
						html: true,
						confirmButtonText: "Cerrar",
						showConfirmButton: true
					},
					function(isConfirm){
						if (isConfirm) {
							var url = 'cc.php?Id=<?php echo $TrId; ?>&Nombre=<?php echo $url_nombre; ?>';
							location.href=url;
						}
					});
			</script>
			
		<?php
		} else {
			header('Location: cc.php?Id=' . $TrId . '&Nombre=' . $Nombre);
		}
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
			
	$mysqli->close();

}
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
    <h1>Nuevo Movimiento <small>Cuenta Corriente</small></h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-6">
    
      <div class="box box-info">
          <div class="box-header with-border">
          	<span class="pull-left"><?php echo $Nombre;?></span>
            <span class="text-muted pull-right"><small>Todos los campos son obligatorios...</small></span>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form">
							 <?php
              if(isset( $msg )){
                  echo $msg;
              }
              ?>

              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                <i class="fa fa-th" style="width: 16px;"></i>
                </span>
                <select tabindex="2" required autofocus class="form-control" name="m_tipo" id="m_tipo">
                  <option value="">Seleccione Tipo</option>
                  <option value="1">Combustible</option>
                  <option value="2">Adelanto Efectivo</option>
                  <option value="3">Cheque</option>
                  <option value="4">Orden de Compra</option>
                  <option value="5">Pago</option>
                </select>
              </div>
              
              <div class="form-group" id="cbtb" style="display:none;">
                <div class="input-group" style="margin: 5px 0 0; text-align: center; width: 100%;">
                  <label style="margin-right: 24px;">
                      <input type="radio" name="combustible" value="1" class="square-blue" checked /> Gasoil
                  </label>
                  <label>
                      <input type="radio" name="combustible" value="2" class="square-blue" > Nafta
                  </label>
                </div>
              </div>

              <div class="input-group date fecha_link" data-date="" data-link-field="fecha" style="margin: 10px 0 20px;">
              		<span class="input-group-addon">
                  	<i class="fa fa-calendar" style="width: 16px;"></i>
                  </span>
                  <input tabindex="1" class="form-control" type="text" value="" placeholder="Fecha" required pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
              </div>
              <input type="hidden" id="m_fecha" name="m_fecha" value="" />
              
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-usd" style="width: 16px;" id="num_icon"></i>
                </span>
                <input tabindex="3" type="text" class="form-control" placeholder="Importe" name="m_importe" required />
              </div>
              
              <div class="input-group" style="margin: 10px 0 20px;">
                  <span class="input-group-addon">
                      <i class="fa fa-file-text-o" style="width: 16px;"></i>
                  </span>
                  <textarea class="form-control custom-control" rows="3" name="m_nota" placeholder="Observaciones" style="resize:none"></textarea>
              </div>              
              
              <div class="form-group">
              	<button tabindex="5" type="button" class="btn btn-default pull-left" onclick="location.href='cc.php?Id=<?php echo $TrId;?>&Nombre=<?php echo $Nombre;?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button tabindex="4" type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Agregar Movimiento</button> 
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

<script type="text/javascript">

tipo = 0;

$(document).ready(function(){
													 
  $(".fecha_link").datetimepicker({
		  language:  'es',
		  weekStart: 1,
		  todayBtn:  1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0,
		  format: "dd/mm/yyyy",
		  linkField: "m_fecha",
		  linkFormat: "yyyy-mm-dd" // linkFormat: "yyyy-mm-dd hh:ii"
  });
  
	// Calculos al Ingresar Tarifa Tn
	$('#m_tipo').change(function(){
		tipo = Number($(this).val());
		if (tipo === 1) {
	    $('#cbtb').show();
			$('input[name=m_importe]').attr('placeholder', 'Litros de Combustible');
			$('#num_icon').attr('class', 'fa fa-tint');
		} else {
			$('#cbtb').hide();
			$('input[name=m_importe]').attr('placeholder', 'Importe');
			$('#num_icon').attr('class', 'fa fa-usd');
		}
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
ob_end_flush();
?>