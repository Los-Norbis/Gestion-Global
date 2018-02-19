<?php
ob_start();
$iniUrl = '../';
$Id =$_GET['Id'];
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
  } else {
		$cbtb = 0;
	}

  $query = $mysqli->prepare("UPDATE trans_cc SET Fecha = ?, Tipo = ?, Importe = ?, Aux = ?, Nota = ? WHERE Id = ?");
	$query->bind_param('sidisi', $m_fecha, $m_tipo, $m_importe, $cbtb, $m_nota, $Id);

	if($query->execute()) {
			header('Location: cc.php?Id=' . $_POST['TrId'] . '&Nombre=' . $Nombre);
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error...</div>';
	}
	$query->close();
			
	$mysqli->close();

} else {
	$Id = $_GET['Id'];
	$sql = "SELECT * FROM trans_cc WHERE Id = " . $Id;
	if (!$resultado = $mysqli->query($sql)) {
			// ¡Oh, no! La consulta falló. 
			echo '<h2>Error... Movimiento no encontrado (Id: ' . $Id . '</h2>';
			exit;
	} else {
			$fila = $resultado->fetch_assoc();
	}	
}
$Tipos = Array('Combustible','Adelanto Efectivo', 'Cheque', 'Orden de Compra', 'Pago');
?>

<link href="<?php echo $iniUrl; ?>css/malo/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

<link href="<?php echo $iniUrl; ?>plugins/iCheck/all.css" rel="stylesheet">
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
    <h1>Modificar Movimiento <small>Cuenta Corriente</small></h1>
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
                  <?php
									foreach($Tipos as $key => $value):
										$ind = $key + 1;
										echo '<option value="' . $ind . '"'  . ($ind == $fila['Tipo'] ? ' selected ' : '') . '>' . $value . '</option>';
									endforeach;
				  			?>
                </select>
   
              </div>

			  			<div class="form-group" id="cbtb" <?php if ($fila['Tipo'] <> 1) { echo 'style="display:none;"'; } ?>>
                <div class="input-group" style="margin: 5px 0 0; text-align: center; width: 100%;">
                  <label style="margin-right: 24px;">
                      <input type="radio" name="combustible" value="1" class="square-blue" <?php echo ($fila['Aux'] < 2 ? 'checked' : ''); ?> /> Gasoil
                  </label>
                  <label>
                      <input type="radio" name="combustible" value="2" class="square-blue" <?php echo ($fila['Aux'] == 2 ? 'checked' : ''); ?> /> Nafta
                  </label>
                </div>
              </div>

              <div class="input-group date fecha_link" data-date="" data-link-field="fecha" style="margin: 10px 0 20px;">
              		<span class="input-group-addon">
                  	<i class="fa fa-calendar" style="width: 16px;"></i>
                  </span>
                  <input tabindex="1" class="form-control" type="text" value="<?php echo date("d/m/Y", strtotime($fila['Fecha'])); ?>" required  pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
              </div>
              <input type="hidden" id="m_fecha" name="m_fecha" value="<?php echo $fila['Fecha']; ?>" />
              
              
              <div class="input-group" style="margin: 10px 0 20px;">
                <span class="input-group-addon">
                  <i class="fa fa-usd" style="width: 16px;" id="num_icon"></i>
                </span>
                <input tabindex="3" type="text" class="form-control" placeholder="Importe" name="m_importe"  value="<?php echo $fila['Importe']; ?>" required />
              </div>

							<div class="input-group" style="margin: 10px 0 20px;">
                  <span class="input-group-addon">
                      <i class="fa fa-file-text-o" style="width: 16px;"></i>
                  </span>
                  <textarea class="form-control custom-control" rows="3" name="m_nota" placeholder="Observaciones" style="resize:none"><?php echo $fila['Nota']; ?></textarea>
              </div>
              
              <input type="hidden" id="TrId" name="TrId" value="<?php echo $fila['Tr_Id']; ?>" />
              
              <div class="form-group">
              	<button tabindex="5" type="button" class="btn btn-default pull-left" onclick="location.href='cc.php?Id=<?php echo $fila['Tr_Id']; ?>&Nombre=<?php echo $Nombre;?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                <button tabindex="4" type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-refresh"></i> &nbsp; Modificar Movimiento</button> 
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
		tipo = $(this).val();
		if (tipo == 1) {
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