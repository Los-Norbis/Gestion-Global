<?php
if (empty($_GET)) {
	// No ha sido llamado desde la Datatable...
	header('Location: index.php');
}
$iniUrl = '../';
include($iniUrl . 'header.php');
include($iniUrl . 'dtload.php');

$Id = $_GET['Id'];
$Nombre = $_GET['Nombre'];
$Volver = $_GET['Call'];

if ($result = $mysqli->query("SELECT Id, Tipo FROM trans_cc WHERE Tr_Id = " . $Id)) {
    /* determinar el número de filas del resultado */
    $row_cnt = $result->num_rows;
    $result->close();
}

$sql = "SELECT Gasoil, Nafta FROM opciones WHERE Id = 1";
if (!$opciones = $mysqli->query($sql)) {
	echo "<h2>Error en la Consulta SQL | Opciones.</h2>";
	exit;
}
$opciones = $opciones->fetch_assoc();
	
$result = $mysqli->query("SELECT * FROM trans_cc WHERE Tr_Id = " . $Id . " AND Fin = 0");
$saldo = 0;
while ($fila = $result->fetch_assoc()) {
		$p_importe = $fila['Importe'];
			
		if ($fila['Tipo'] == 1) {
			$p_importe = ($fila['Aux'] == 1 ? $p_importe * $opciones['Gasoil'] : $p_importe * $opciones['Nafta']);
		}
		
		if ($fila['Tipo'] == 0) {
			$saldo += $p_importe;
		} else {
			$saldo -= $p_importe;
		}
}

$mysqli->close();
//echo '<h1>' . $row_cnt . '</h1>';
//die();
?>

<style>
.text-cut { text-overflow: ellipsis; overflow: hidden; max-width: 500px}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Cuenta Corriente <small>Transportes</small></h1>
    </section>

    <!-- Main content -->
		<?php
		if($row_cnt === 0) {
		?>
			<section class="content">	
				<div class="col-md-12">
					<div class="callout callout-danger">
						<i class="fa fa-remove"></i> &nbsp; <strong>No hay Movimientos en la Cuenta Corriente de <?php echo $Nombre; ?>...</strong>
            
					</div>
          <button type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
          <button type="button" class="btn btn-primary" onclick="location.href='cc_nuevo.php?TrId=<?php echo $Id; ?>&Nombre=<?php echo $Nombre; ?>'"><i class="fa fa-plus"></i> &nbsp; Nuevo Movimiento</button>
					<button type="button" class="btn btn-primary" onclick="location.href='<?php echo $iniUrl; ?>cartas/nuevo.php?TrId=<?php echo $Id; ?>&Nombre=<?php echo $Nombre; ?>'"><i class="fa fa-plus"></i> &nbsp; Nueva Carta de Porte</button>
				</div>
			</section>
		<?php
		} else {
				if ($Volver == 0) {
					$retlink = $iniUrl . 'cartas/index.php';
				} else if ($Volver == 1) {
					$retlink = 'index.php';
				}			
		?>
    
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $Nombre; ?></h3>
							<button type="button" class="btn btn-primary btn-sm pull-right" onclick="location.href='<?php echo $retlink; ?>'"><i class="fa fa-arrow-left"></i> &nbsp; Volver a <?php echo ($Volver == 0 ? 'Cartas de Porte' : 'Transportes'); ?></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table cellpadding="0" cellspacing="0" id="cuenta" class="table nowrap table-striped table-bordered table-hover report" width="100%">
                  <thead>
                  <tr>
                      <th data-priority="1">Fecha</th>
                      <th data-priority="2">Tipo</th>
											<th >Nota</th>
                      <th data-priority="3">Importe</th>
                      <th></th>
                      <th></th>
											<th></th>
                  </tr>
                  </thead>
                  
                  <tfoot>
                  <tr>
                      <th data-priority="1"></th>
                      <th></th>
                      <th class="text-right">Saldo</th>
                      <th><?php echo number_format($saldo, 2, ',', '.'); ?></th>
                      <th></th>
											<th></th>
											<th></th>
                  </tr>
                  </tfoot>
                  
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    <?php
		}
		?>
  </div>
  <!-- /.content-wrapper -->
  
              <script type="text/javascript">
                $(document).ready(function () {
                  
                    var funciones = <?php echo $_SESSION['levelSession']; ?>;
										var Param = new Array('<?php echo $Id; ?>', '<?php echo $Nombre; ?>');
										var Tipos = new Array('', 'Combustible', 'Adelanto Efectivo', 'Cheque', 'Orden de Compra', 'Pago');
                    var tabla = $('#cuenta').DataTable({
                                                
                          responsive: true,
													select: {style: 'single'},
                          "lengthMenu": [ 10, 15, 20, 50, 100 ],
                          "pageLength": 10,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                              "url": 'dt_trans_cc.php?Id=' + Param[0],
                              "type": "POST"
                          },
                          
                          "columns": [
                              { "data": "Fecha", 'width': '15%', className: 'text-right',
																render: function ( data, type, row ) {
																if ( type === 'display' ) {
																		var dateSplit = data.split('-');
																		return dateSplit[2] +'/'+ dateSplit[1] +'/'+ dateSplit[0];
																	}
																	return data;
																}
															},
                              { "data": "Tipo", 'width': '30%'/*,
																render: function ( data, type, row ) {
																if ( type === 'display' ) {
																		return Tipos[data];
																	}
																	return data;
																}*/
															},
															{ "data": "Nota", 'width': '30%', className: 'text-cut', 'orderable': false },
                              { "data": "Importe", 'width': '15%', className: 'text-right', 'orderable': false },/*
															{ "data": "Tr_Id", 'width': '8%', className: 'text-right' },*/
                              
															
															{ "data": "Id", className: 'text-right', 'visible': false },
															{ "data": "CP_Id", className: 'text-right', 'visible': false },
															{ "data": "Fin", className: 'text-center', 'orderable': false,
																"render": function ( data, type, row ) {
																	if (data === '0') {
																		return '<i class="fa fa-clock-o" style="color: orange;"></i>';
																	} else if (data === '1') {
																		return '<i class="fa fa-check-circle" style="color: limegreen;"></i>';
																	}
																}
															}															
                              
                          ],
                          "order": [[ 0, "desc" ]],
                           
                          "language": { 
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ Registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "<strong>Registros</strong> | _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty":      "Sin resultados...",
                            "sInfoFiltered":   "",
                            "sInfoPostFix":    "",
                            "sSearch":         "",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                              "sFirst":    "Primero",
                              "sLast":     "Último",
                              "sNext":     "Siguiente",
                              "sPrevious": "Anterior"
                            },
                            "oAria": {
                              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
														select: {
																rows: {
																		_: 'Ha seleccionado %d Registros',
																		0: '<span class="text-info">Seleccione una fila para activar funciones...</span>',
																		1: '<span class="text-success">Registro seleccionado.</span>'
																}
														}
												}, // Fin de Lenguaje
												dom: 
													"<'row'<'col-xs-12 col-md-9'B><'col-md-3 col-sm-6 pull-right'f>>" +
													"<'row'<'col-sm-12'tr>>" +
													"<'row'<'col-md-5'l><'col-md-7'p>>" +
													"<'row'<'col-md-12'i>>",
												buttons: [
													{ text: 'Nueva Carta de Porte',
															action: function ( e, dt, node, config ) {
																	window.location.href = "<?php echo $iniUrl; ?>cartas/nuevo.php?TrId="+Param[0]+"&Nombre="+Param[1];
															}
													},
																	
													{ text: 'Nuevo Movimiento',
															action: function ( e, dt, node, config ) {
																	window.location.href = "cc_nuevo.php?TrId="+Param[0]+"&Nombre="+Param[1];
															}
													},
													{ text: 'Modificar'},
													{ text: 'Eliminar'},
													{ text: 'Informes',
															action: function ( e, dt, node, config ) {
																	window.location.href = "info.php?TrId="+Param[0]+"&Nombre="+Param[1];
															}
													}
													
													//'excelHtml5',
													/*
													{ extend: 'pdfHtml5', text: 'PDF', pageSize: 'A4', orientation: 'landscape', title: 'Expedientes',
															exportOptions: {
																columns: [ 1, 2, 3, 5, 6, 7 ]
															}
													}, 
													{ extend: 'print', text: 'Imprimir', title: 'Cuenta Corriente: '+Param[1], className: 'hidden-xs'}*/
												]
												
                          
                          
                      });
                    	
											// Declaracion al inicio...
											// Modificar Disable
											tabla.buttons( [2,3] ).disable();
                    
                      //tabla.buttons().container().appendTo( '#expedientes_wrapper .col-sm-6:eq(0)' );
                      $('#rocket').click(function(){
                          tabla.columns(3).search( '' );
                          tabla.columns(4).search( '' );
                          tabla.search( '' ).draw();
                      });
                      
                      
                      $( "#buscar" ).focusin(function() {
                          tabla.columns(3).search( '' );
                          tabla.columns(4).search( '' );
                          $('#select-destino').prop('selectedIndex',0);
                          $('#select-tema').prop('selectedIndex',0);
                          //alert($('#select-destino').val());
                      });
                      
                      tabla.buttons([0,1]).enable(
                        funciones < 3 ? true : false
                      );
											
											// Seleccionar para Modificar
											$('#cuenta').on( 'select.dt', function () {
													var id = tabla.cell('.selected', 4).data();
													var tipo = tabla.cell('.selected', 1).data();
													tabla.button(2).action( function( e, dt, button, config ) {
														if (tipo == 'Carta de Porte') { // Carta de Porte
															var cpid = tabla.cell('.selected', 5).data();
															window.location.href =  "<?php echo $iniUrl; ?>cartas/editar.php?TrId="+Param[0]+"&Nombre="+Param[1]+"&CpId="+cpid + "&Call=1";
														} else { // Otros
															window.location.href = "cc_editar.php?Id=" + id + "&Nombre=" + Param[1];
														}
													} );
													
													if (tipo != 'Carta de Porte') {
															tabla.button(3).action( function( e, dt, button, config ) {
																	window.location.href = "cc_eliminar.php?Id=" + id + "&Nombre=" + Param[1];
															} );
															tabla.button(3).enable();
													}
													tabla.button(2).enable();
											} );
											
											$('#cuenta').on( 'deselect.dt', function () {
													var trans_id = 0;
													tabla.buttons([2,3]).disable();
											} );
        
          
                  });
              </script>

  
<?php
include($iniUrl . 'footer.php');
?>
