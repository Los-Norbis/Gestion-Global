<?php
ob_start();
$iniUrl = '../';
$CpId =$_GET['CpId'];
$TrId =$_GET['TrId'];
$Nombre = $_GET['Nombre'];
include($iniUrl . 'header.php');

if(isset($_POST['btn-signup'])) {
	
	$error = false;
	
	if (isset($_POST['m_movids']) and !empty($_POST['m_movids'])) { // Finalizo Movimientos Seleccionados
		$ids = explode(" ", $_POST['m_movids']);
		foreach ($ids as $id_act) {
			$query = $mysqli->prepare("UPDATE trans_cc SET Fin = 1 WHERE Id = ?" );
			$query->bind_param('i', $id_act);
			if($query->execute()) {
					$query->close();
			} else {
				$error = true;
			}
		}
	}
	
	if (isset($_POST['m_cpids']) and !empty($_POST['m_cpids'])) { // Finalizo Cartas en ambas tablas
		$ids = explode(" ", $_POST['m_cpids']);
		foreach ($ids as $id_act) {
			$query = $mysqli->prepare("UPDATE trans_cc SET Fin = 1 WHERE CP_Id = ? AND Tipo = 0" );
			$query->bind_param('i', $id_act);
			if($query->execute()) {
					$query->close();
					
					$query = $mysqli->prepare("UPDATE cartas SET Fin = 1 WHERE Id = ?"); // Finalizo Carta
					$query->bind_param('i', $id_act);
					if($query->execute()) {
							$query->close();
					} else {
							$error = true;
					}					
					
			} else {
				$error = true;
			}
		}
	}
	
	/*
	$query = $mysqli->prepare("UPDATE trans_cc SET Fin = 1 WHERE Tipo = 0 AND CP_Id = ?"); // Finalizo Carta en CC
	$query->bind_param('i', $CpId);
	if($query->execute()) {
			$query->close();
	} else {
			$error = true;
	}	*/
	
	$m_importe = $_POST['m_importe']; // Guardo el Pago
	$m_dta = $_POST['m_datadc'];
	$m_tipo = 5;
	$m_fin = 1;
	$m_fecha = date('Y-m-d');
	$m_nota = 'Cartas de Porte' . ( !empty($m_dta) ? ' | ' . $m_dta : ''); 
	$query = $mysqli->prepare("INSERT INTO trans_cc(Fecha, Tipo, Tr_Id, Importe, Nota, Fin) VALUES (?,?,?,?,?,?)");
	$query->bind_param('siidsi', $m_fecha, $m_tipo, $TrId, $m_importe, $m_nota, $m_fin);
	if($query->execute()) {
			$query->close();
	} else {
			$error = true;
	}
	
	$mysqli->close();
	
	if ($error) {
			$msg = '<div class="alert alert-danger"><i class="fa fa-ban"></i> &nbsp; Ha ocurrido un error al salvar...</div>';
	} else {
		$retlink = 'index.php';
		header('Location: ' . $retlink);
	}

} else {
	// ------------------------------------------------
	// Traer Cartas del Transporte Actual
	// ------------------------------------------------
	$sql = "SELECT * FROM cartas WHERE Tr_Id = " . $TrId;
	if (!$cartarec = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Cartas.</h2>";
			exit;
	}	else {
		$carta = $cartarec->fetch_assoc();
	}
	
	// Liquidacion de la Carta
	$sql = "SELECT Fecha, Cp_Id, Importe, Nota FROM trans_cc WHERE Tr_Id = " . $TrId . " AND Tipo = 0 AND Fin = 0";
	if (!$movcp = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Importe CC.</h2>";
			exit;
	}	else {
		$totalcp = $movcp->num_rows;
	}
	
	// Opciones Globales
	$sql = "SELECT * FROM opciones WHERE Id = 1";
	if (!$recset = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Opciones.</h2>";
			exit;
	}	else {
		$config = $recset->fetch_assoc();
	}	
	
	// Movimientos que se pueden afectar a Carta Actual
	$sql = "SELECT * FROM trans_cc WHERE Tr_Id = " . $TrId . " AND Tipo BETWEEN 1 AND 4 AND Fin = 0";;
	if (!$movcc = $mysqli->query($sql)) {
			echo "<h2>Error en la Consulta SQL | Cuenta Corriente.</h2>";
			exit;
	}
	$filascp = $movcc->num_rows;
	
	$Tipos = Array('Carta de Porte','Combustible','Adelanto Efectivo', 'Cheque', 'Orden de Compra', 'Pago');

}



?>

<link href="<?php echo $iniUrl; ?>css/malo/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $iniUrl; ?>js/malo/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

<script src="<?php echo $iniUrl; ?>js/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo $iniUrl; ?>css/sweetalert.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $iniUrl; ?>css/check.css">
  
<style>
label {font-weight: 400;}

.cpsep {border-bottom: dotted 1px white; padding: 8px 0;}

.marca {background-color: #6C3; padding: 4px 8px; border-radius: 4px;}

input[type=checkbox]:checked + label { color: yellow; }
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
    <h1>Liquidar Cartas de Porte</h1>
  </section>

  <!-- Main content -->
  <section class="content">
    
  <div class="row">
    <div class="col-md-12">
    
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title pull-left"><?php echo $Nombre;?></h3>
            <span class="text-muted pull-right"><small>Seleccione las Cartas a liquidar y los Movimientos a <strong>descontar</strong> del Total...</small></span>
          </div>
          <div class="box-body">
        		<form method="post" id="login-form" lang="es-ES">
							 <?php
              if(isset( $msg )){
                  echo $msg;
              }
              ?>
							
							<script type="text/javascript">
								var Cartas = [];
								var Movimientos = [];
							</script>

              <!-- Cartas de Porte -->
							<div class="row">
								<div class="col-sm-12">

									<div class="callout callout-warning">
									<?php
									if ($totalcp > 0) {
											$idx = 0;
											while ($fila = $movcp->fetch_assoc()) {
												$Desc = explode('|', $fila['Nota']);
												$ValAct = $fila['Importe'];
												?>
												<div class="row cpsep">
													<div class="col-sm-8" style="text-overflow: ellipsis;">
													<div class="checkbox checkbox-primary">
														<input type="checkbox" id="cpval<?php echo $idx;?>" name="cpvalor[]" class="styled"/>
														<label for="cpval<?php echo $idx;?>">
															
														</label>
														<span><?php echo date('d/m/Y', strtotime($fila['Fecha'])) . '  |  ' . $Desc[0];?></span>
														
													</div>
													</div>
													<div class="col-sm-4" style="text-align:right">$ <?php echo number_format($ValAct,2,',','.');?></div>
												</div>
												<script type="text/javascript">
													Cartas.push([<?php echo $ValAct;?>, <?php echo $fila['Cp_Id'];?>]);
												</script>
											<?php
												++$idx;
											}
									} else {
											echo '<p>No hay Cartas para Liquidar...</p>';
									}
									?>									
									</div>	
                </div>
              </div>
							
							<?php
									if ($totalcp == 0) {
										die();
									}
              ?>
							
							<!-- Movimientos -->
              <div class="row">
								<div class="col-sm-12">

									<div class="callout callout-info">
									<?php
									if ($filascp > 0) {
											$idx = 0;
											while ($fila = $movcc->fetch_assoc()) {
												$Desc = '';
												if ($fila['Tipo'] == 1) {
														$ValAct = $fila['Importe'] * ($fila['Aux'] == 1 ? $config['Gasoil'] : $config['Nafta']);
														$Desc = ' (' . number_format($fila['Importe'],0) . ' lts ' . ($fila['Aux'] == 1 ? 'Gasoil' : 'Nafta') . ')';
												} else {
														$ValAct = $fila['Importe'];
												}
												?>
												<div class="row cpsep">
													<div class="col-sm-8" style="text-overflow: ellipsis;">
													<div class="checkbox checkbox-primary">
														<input type="checkbox" id="impt<?php echo $idx;?>" name="importe[]" class="styled"/>
														<label for="impt<?php echo $idx;?>">
															
														</label>
														<span><?php echo date('d/m/Y', strtotime($fila['Fecha'])) . '  |  ' . $Tipos[$fila['Tipo']] . $Desc;?></span>
														
													</div>
													</div>
													<div class="col-sm-4" style="text-align:right">$ <?php echo number_format($ValAct,2,',','.');?></div>
												</div>
												<script type="text/javascript">
													Movimientos.push([<?php echo $ValAct;?>, <?php echo $fila['Id'];?>]);
												</script>
											<?php
												++$idx;
											}
									} else {
											echo '<p>No hay Movimientos para Descontar...</p>';
									}
									?>									
									</div>	
                </div>
              </div>
							
							<div class="row">
                <div class="col-sm-12">
                	<div class="callout callout-success">
                  	<span id="total_desc">Total a Pagar</span><span id="total_val" class="pull-right">$ 0,00</span>
                  </div>
                </div>
              </div>
							
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-file-text-o" style="width: 16px;"></i>
                      </span>
                      <input type="text" class="form-control" value="" placeholder="Ingrese aqui informaci&oacute;n adicional como # de comprobante..." name="m_datadc" maxlength="110"/>
                    </div>
                  </div>
                </div>
              </div>

				
							<input type="hidden" name="m_importe" id="m_importe" value="0" />
							<input type="hidden" name="m_movids" id="m_movids" value="" />
							<input type="hidden" name="m_cpids" id="m_cpids" value="" />
							
              
              <div class="row">
              	<div class="col-sm-12">              
                <div class="form-group">
									<?php
									$retlink = 'index.php';
									?>
                  <button type="button" class="btn btn-default" onclick="location.href='<?php echo $retlink; ?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                  <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Liquidar Cartas de Porte</button> 
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

<script type="text/javascript">

var cancelar = totalcp = 0;

$(document).ready(function(){
	
		$('input[name="cpvalor[]"]').change(function() {
			//alert($('input[name="importe[]"]').index(this) + '   ' + $(this).prop('checked'));
			var idx = $('input[name="cpvalor[]"]').index(this);
			var val_act = Cartas[$('input[name="cpvalor[]"]').index(this)] [0];
			var est_act = $(this).prop('checked');
			if (est_act) {
				totalcp = totalcp + val_act;
			} else {
				totalcp = totalcp - val_act;
			}
			CalcularCarta();
    });
		

		$('input[name="importe[]"]').change(function() {
			//alert($('input[name="importe[]"]').index(this) + '   ' + $(this).prop('checked'));
			var idx = $('input[name="importe[]"]').index(this);
			var val_act = Movimientos[$('input[name="importe[]"]').index(this)] [0];
			var est_act = $(this).prop('checked');
			if (est_act) {
				//$('input[name="importe[]"]').index(this).css("color", "black");
				if ((cancelar + val_act) > totalcp) {
					
					$(this).prop('checked', false);
					//swal("Oops...", "Something went wrong!", "error");
					swal({
						title: "Error",
						text: "El Importe seleccionado (<strong>$ " + Number(val_act).format(2, 3, '.', ',') + "</strong>)<br />no puede ser sumado a los $" + Number(cancelar).format(2, 3, '.', ',') + "<br /> porque excede el total de la Carta de Porte...",
						/*timer: 8000,*/
						type: "warning",
						html: true,
						confirmButtonText: "Cerrar",
						showConfirmButton: true
					});
				} else {
					cancelar = cancelar + val_act;
				}
			} else {
				cancelar = cancelar - val_act;
			}
			CalcularCarta();
    });
		

	/*	
	$('input[name="importe[]"]:checked').each(function() {
		var act_ids = '';
		
		alert($('input[name="importe[]"]').index(this));
	});	*/	
	
		/*
		var seltp = $('#m_tipocarga option:selected').text();
		$('#m_tipoid').val(seltp); */
													 
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
	
		CalcularCarta();

});

function CalcularCarta() { // Usa Variables GLOBALES

	var ids = '';
	$('input[name="importe[]"]:checked').each(function(){        
			var act_id = Movimientos[$('input[name="importe[]"]').index(this)][1] + ' ';
			ids += act_id;
	});
	ids = ids.trim();
	 
	
	var cpids = '';
	$('input[name="cpvalor[]"]:checked').each(function(){        
			var act_id = Cartas[$('input[name="cpvalor[]"]').index(this)][1] + ' ';
			cpids += act_id;
	});
	cpids = cpids.trim();
	
	var pagar = totalcp - cancelar;

	// Total Verde...
	$('#total_desc').html('Total a Pagar (Se descuentan $ ' + Number(cancelar).format(2, 3, '.', ',') + ')');
	$('#total_val').html('$ ' + Number(pagar).format(2, 3, '.', ','));
	$('#m_importe').val(Number(pagar).format(2, '.')); // cargar hidden
	$('#m_movids').val(ids);
	$('#m_cpids').val(cpids);
	
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