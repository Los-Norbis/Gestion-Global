<?php
ob_start();
$iniUrl = '../';
$TrId =$_GET['TrId'];
$Nombre = $_GET['Nombre'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	$numero = $_POST['m_numero'];
	$fecha = $mysqli->real_escape_string(trim($_POST['m_fecha']));	
	$kgcarga = $_POST['m_kgcarga'];
	$kgdescarga = $_POST['m_kgdescarga'];
	$kgdevolucion = $_POST['m_kgdevolucion'];
	$tarifa = $_POST['m_tarifa'];
	$bonificacion = $_POST['m_bonificacion'];

	if (isset($_POST['m_tipoid'])) {
		$crg = explode('|', $_POST['m_tipoid']);
		$tipocarga = intval($crg[0]);
		$desccarga = trim($crg[1]) . ' ';
	} else {
		$tipocarga = 0;
		$desccarga = '';
	}
	
	$origen = $_POST['origen'];
	$iva = (isset($_POST['iva21']) ? 1 : 0);
	
	$importe = $_POST['m_importe'];
	

	// die($name . ' ' . $email . ' ' . $new_password);
	
	$query = $mysqli->prepare("INSERT INTO cartas(Numero, Fecha, Tr_Id, KgCarga, KgDescarga, KgDevolucion, Tarifa, Bonificacion, TipoCarga, Origen, Iva) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$query->bind_param('isiiiidiiii', $numero, $fecha, $TrId, $kgcarga, $kgdescarga, $kgdevolucion, $tarifa, $bonificacion, $tipocarga, $origen, $iva);

	if($query->execute()) {
			$ncpid = $query->insert_id;
			$tipo = 0;
			$nota = '# ' . $numero . ' | Tarifa: $' . number_format($tarifa, 2, ',', '.') . ' | Carga: ' . $desccarga . $kgcarga . ' kgs | Descarga: ' . $kgdescarga . ' kgs ' . ($bonificacion > 0 ? '| Bonif.: ' . $bonificacion . '% ' : '') . '| IVA: ' . ($iva == 1 ? 'Si' : 'No');
			$query->close();
			// Insert en CC
			$query = $mysqli->prepare("INSERT INTO trans_cc (Fecha, Tipo, CP_Id, Tr_Id, Importe, Aux, Nota) VALUES (?,?,?,?,?,?,?)");
			$query->bind_param('siiidis', $fecha, $tipo, $ncpid, $TrId, $importe, $tipo, $nota);
			if($query->execute()) {
					$query->close();
					header('Location: ' . $iniUrl . 'transportes/cc.php?Id=' . $TrId . '&Nombre=' . $Nombre);
			} else {
					$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar Movimiento en Cuenta Corriente...</div>';
			}
	}	else {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar la Carta de Porte...</div>';
	}
	
	$mysqli->close();

} else {

	$sql = "SELECT ALL Id, Nombre, Precio FROM cargas";
	if (!$recset = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Cargas.</h2>";
			exit;
	}

}

?>

<link href="<?php echo $iniUrl; ?>css/malo/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>plugins/iCheck/all.css">
  <script src="<?php echo $iniUrl; ?>plugins/iCheck/icheck.min.js"></script>
	
<script src="<?php echo $iniUrl; ?>js/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/sweetalert.css">	
  
<style>
label {font-weight: 400;}

.cpsep {border-bottom: dotted 1px white; line-height: 2;}

.marca {background-color: #6C3; padding: 4px 8px; border-radius: 4px;}
</style>

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
    <h1>Nueva Carta de Porte</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-12">
    
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title pull-left"><?php echo $Nombre;?></h3>
            <span class="text-muted pull-right"><small>Pulse <strong>Calcular</strong> cuando necesite refrescar los totales...</small></span>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form" lang="es-ES">
							 <?php
              if(isset( $msg )){
                  echo $msg;
              }
              ?>
              
              <div class="row">
								<div class="col-sm-6 col-md-4">
                  <!-- Numero de Carta -->
                  <div class="form-group">
                    <label># Carta de Porte</label>
                    <div class="input-group">
                    
                      <span class="input-group-addon">
                        <i class="fa fa-hashtag" style="width: 16px;"></i>
                      </span>
                      <input tabindex="1" type="number" class="form-control" placeholder="N&uacute;mero" name="m_numero" required  autofocus/>
                    </div>
                  </div>
                </div>
                
                <div class="col-sm-6 col-md-4">                  
                  <!-- Fecha -->
                  <div class="form-group">
                    <label>Fecha</label>
                    <div class="input-group date fecha_link" data-date="" data-link-field="fecha">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar" style="width: 16px;"></i>
                        </span>
                        <input tabindex="2" class="form-control" type="text" value="" placeholder="Fecha" required  pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d">
                    </div>
                    <input type="hidden" id="m_fecha" name="m_fecha" value="" />
                  </div>
                </div>
                  
                <div class="col-sm-6 col-md-4">
                  <!-- Tarifa -->
                  <div class="form-group">
                    <label>Tarifa por Tonelada</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-usd" style="width: 16px;"></i>
                      </span>
                      <input tabindex="3" type="number" step="any" min="1" class="form-control" placeholder="Tarifa x Tn" name="m_tarifa" required />
                    </div>
                  </div>
              	</div>
              
								<div class="col-sm-6 col-md-4">
                  <!-- Kg Carga -->
                  <div class="form-group">
                    <label>Kg. Cargados</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-arrow-up" style="width: 16px;"></i>
                      </span>
                      <input tabindex="4" type="number" class="form-control" placeholder="Kg Cargados" name="m_kgcarga" required min="1" />
                    </div>
                  </div>
                </div>

						    <div class="col-sm-6 col-md-4">
                  <!-- Kg Descarga -->
                  <div class="form-group">
                    <label>Kg. Descargados</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-arrow-down" style="width: 16px;"></i>
                      </span>
                      <input tabindex="5" type="number" class="form-control" placeholder="Kg Descargados" name="m_kgdescarga" required min="1"  />
                    </div>
                  </div>
                </div>

								<div class="col-sm-6 col-md-4">
                  <!-- Kg Devueltos -->
                  <div class="form-group">
                    <label>Kg. Devueltos</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-arrow-left" style="width: 16px;"></i>
                      </span>
                      <input tabindex="6" type="number" class="form-control" placeholder="Kg Devueltos" name="m_kgdevolucion"  />
                    </div>
                  </div>
                </div>

								<div class="col-sm-6 col-md-4">
                  <!-- Bonificacion -->
                  <div class="form-group">
                    <label>Bonificaci&oacute;n</label>  
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-percent" style="width: 16px;"></i>
                      </span>
                      <input tabindex="7" type="number" class="form-control" placeholder="Bonificaci&oacute;n" name="m_bonificacion" min="0" max="100" />
                    </div>
                  </div>
                </div>

								<div class="col-sm-6 col-md-4">
                  <!-- Tipo de Carga -->
                  <div class="form-group">
                    <label>Tipo de Carga</label>  
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-leaf" style="width: 16px;"></i>
                      </span>
                      <select tabindex="8" required class="form-control" name="m_tipocarga" id="m_tipocarga">
                        <option value="">Tipo de Carga</option>
                        <?php
                        while ($cargas = $recset->fetch_assoc()) {
                          echo '<option value=' . $cargas['Precio'] . '>' . $cargas['Id'] . ' | ' . $cargas['Nombre'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
								
								<input type="hidden" id="m_tipoid" name="m_tipoid" value="0" />
                
                <div class="col-sm-12 col-md-4">
                  <!-- Origen -->
                  <div class="form-group">
                    <label>Origen del Viaje</label>
                    <div class="input-group" style="margin: 5px 0 0; text-align: center; width: 100%;">
                      <label style="margin-right: 24px;">
                          <input tabindex="9" type="radio" name="origen" value="100" class="square-blue" checked /> Campo
                      </label>
                      <label>
                          <input tabindex="10" type="radio" name="origen" value="80" class="square-blue" > Traspile
                      </label>
                    </div>
                  </div>
                </div>            
              </div>
							
							<input type="hidden" id="m_importe" name="m_importe" value="0" />
              
              <div class="row">
              	<div class="col-sm-12">
                	<div class="callout callout-info">
                  	<h4>Detalle</h4>
                    
                    <div class="cpsep">
                    	<span id="subtotal_desc">Esperando Datos...</span><span id="subtotal" class="pull-right">0,00</span>
                    </div>
                    
                    <div style="display: none;" id="bono">
                      <div class="cpsep">
                        <span id="bono_desc"></span><span id="bono_val" class="pull-right"></span>
                      </div>
                      <div class="cpsep" style="color: yellow;">
                        <span id="">Subtotal con Descuento:</span><span id="bono_sub" class="pull-right"></span>
                      </div>
                    </div>
                    
                    <div class="cpsep">
                    	<input tabindex="9" type="checkbox" id="iva21" name="iva21" class="flat-yellow" >
                  		<label for="iva21" style="margin:0 0 0 10px;">I.V.A. 21%</label>
                      <span id="iva_val" class="pull-right">0,00</span>
                    </div>
                    
                    <div class="cpsep" style="color: yellow; display: none;" id="iva">
                      <span id="">Subtotal con I.V.A.:</span><span id="iva_sub" class="pull-right"></span>
                    </div>
                    
                    <div class="cpsep" style="display: none;" id="faltante">
                      <span id="faltante_desc"></span><span id="faltante_val" class="pull-right"></span>
                    </div>          
                    
                  </div>
                </div>
                
                <div class="col-sm-12">
                	<div class="callout callout-success">
                  	<span id="">Total:</span><span id="total_val" class="pull-right">0,00</span>
                  </div>
                </div>
              </div>
              
              <div class="row">
              	<div class="col-sm-12">              
                <div class="form-group">
                  <button type="button" class="btn btn-default" onclick="location.href='<?php echo $iniUrl; ?>transportes/cc.php?Id=<?php echo $TrId;?>&Nombre=<?php echo $Nombre;?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                  <button type="button" class="btn btn-info" onclick="CalcularFlete();"><i class="fa fa-refresh"></i> &nbsp; Calcular</button>
                  <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Agregar Carta de Porte</button> 
                </div>
                </div>
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

<!-- Modal -->
<div class="modal fade" id="Aviso1" tabindex="-1" role="dialog" aria-labelledby="Aviso1Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Aviso1Label"><i class="fa fa-info-circle"></i>&nbsp; Ingreso de Datos</h4>
      </div>
      <div class="modal-body">
        <p>Existe una diferencia entre los kilos cargados y los kilos descargados que se han ingresado. Para calcular la costo del descuento es necesario que indique el <strong>Tipo de Carga</strong> y el <strong>Origen</strong> del viaje...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

var Rotulos = new Array('','');
var subtotal = carga = descarga = devuelto = tarifa = bono = total = iva = 0;
var origen = 100;

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
	
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-yellow, input[type="radio"].flat-yellow').iCheck({
      checkboxClass: 'icheckbox_flat-yellow',
      radioClass: 'iradio_flat'
    });
		
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].square-blue, input[type="radio"].square-blue').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });
		
		
		
		// Calculos al Ingresar Tarifa Tn
		$("input[name=m_tarifa]").change(function(){
      tarifa = Number($('input[name=m_tarifa]').val());
			CalcularFlete();
    });
		
		// Calculos al Ingresar Kg Descargados
		$("input[name=m_kgdescarga]").change(function(){
			descarga = Number($('input[name=m_kgdescarga]').val());
			CalcularFlete();
    });
		
		// Calculos al Ingresar Kg Cargados
		$("input[name=m_kgcarga]").change(function(){
			carga = Number($('input[name=m_kgcarga]').val());
			CalcularFlete();
    });
		
		// Calculos al Ingresar Kg Cargados
		$("input[name=m_kgdevolucion]").change(function(){
			devuelto = Number($('input[name=m_kgdevolucion]').val());
			CalcularFlete();
    });		
		
		// Calculos al Ingresar Bono
		$("input[name=m_bonificacion]").change(function(){
			bono = Number($('input[name=m_bonificacion]').val());
			CalcularFlete();
    });

		// Actualizar ID de Carga
		$('#m_tipocarga').change(function(){
			var seltp = $('#m_tipocarga option:selected').text();
			// var divtp = seltp.split('|');
			$('#m_tipoid').val(seltp);
			CalcularFlete();
    });		


		$('#iva21').on('ifChanged', function(event){
			CalcularFlete();
    });
	
		$('input[name=origen]').on('ifClicked', function(event){
			origen = $(this).val();
			CalcularFlete();
    });

});

function CalcularFlete() { // Usa Variables GLOBALES

	if (descarga > 0) {
		Rotulos[0] = Number(descarga/1000).format(2, 3, '.', ',') + ' Toneladas';
	} else {
		Rotulos[0] = 'Ingrese Descarga';
	}
	
	if (tarifa > 0) {
		Rotulos[1] = '$ ' + Number(tarifa).format(2, 3, '.', ',') + ' x Tn.';
	} else {
		Rotulos[1] = 'Ingrese Tarifa';
	}
	
	if (descarga > 0 && tarifa > 0) {
		// Modifica el Subtotal!
		subtotal = (descarga / 1000) * tarifa;
		total = subtotal;
		$('#subtotal').html('$ ' + Number(subtotal).format(2, 3, '.', ','));
	} else {
		subtotal = total = 0;
		$('#subtotal').html('$ 0,00');
	}
	
	$('#subtotal_desc').html(Rotulos[0] + ' | ' + Rotulos[1]);
	
	// Bonificacion
	if (bono > 0) {
		$('#bono_desc').html('Bonificaci&oacute;n ' + bono + '%');
		descuento = (subtotal/100) * bono;
		total = subtotal - descuento;
		
		$('#bono_val').html('<i class="fa fa-minus-circle"></i> $ ' + Number(descuento).format(2, 3, '.', ','));
		$('#bono_sub').html('$ ' + Number(subtotal - descuento).format(2, 3, '.', ','));
		$('#bono').show();
		
	} else {
		descuento = 0;
		$('#bono').hide();
	}
	
	// IVA
	if($('#iva21').prop('checked')) {
		iva = total * .21;
		total = total + iva;
		$('#iva_sub').html('$ ' + Number(total).format(2, 3, '.', ','));
		$('#iva').show();
	} else {
		iva = 0;
		$('#iva').hide();
	}
	$('#iva_val').html( (iva > 0 ? '<i class="fa fa-plus-circle"></i> ' : '') + '$ ' + Number(iva).format(2, 3, '.', ','));
	
	// Diferencia de Peso
	if (descarga > 0 && carga > 0) {
		// Determina kg de diferencia
		dif = carga - descarga;
		// Resta kg devueltos
		if (devuelto > 0) {
			dif = dif - devuelto;
		}
		
		if (dif > 0) {
			// comprobar si ha pasado el limite
			cargatn = Number($("#m_tipocarga").val());
			if (cargatn == 0 || origen == 0) {
					swal({
						title: "Aviso",
						text: "<p>Existe una diferencia entre los kilos cargados y los kilos descargados que se han ingresado.<br />Para calcular el valor del descuento es necesario que indique el <strong>Tipo de Carga</strong> y el <strong>Origen</strong> del viaje...</p>",
						/*timer: 8000,*/
						type: "warning",
						html: true,
						confirmButtonText: "Cerrar",
						showConfirmButton: true
					});
			} else {
				if (dif >= origen) {
					faltante = (cargatn/1000) * dif;
					total = total - faltante;
					$('#faltante_desc').html('Diferencia: ' + dif + ' Kg. a ' + Number(cargatn/1000).format(2, 3, '.', ',') + ' por Kg.');
				  	$('#faltante_val').html('<i class="fa fa-minus-circle"></i> $ ' + Number(faltante).format(2, 3, '.', ','));
				  	$('#faltante').show();
				} else {
					$('#faltante').hide();
				}
			}
		}
			
	}
	
	// Total Verde...
	$('#total_val').html('$ ' + Number(total).format(2, 3, '.', ','));
	$('#m_importe').val(Number(total).format(2, '.'));
	
	return true;
}

Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

</script>    

<?php
include('footer.php');
ob_end_flush();
?>