<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
include($iniUrl . 'dtload.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Cargas <small>Inicio</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Control & Edici&oacute;n</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table cellpadding="0" cellspacing="0" id="cargas" class="table nowrap table-striped table-bordered table-hover report" width="100%">
                  <thead>
                  <tr>
                      <th data-priority="1">Descripci&oacute;n</th>
                      <th>Valor (Tn)</th>
                      <th>Id</th>
                  </tr>
                  </thead>
                  
                  <tfoot>
                  <tr>
                      <th></th>
                      <th></th>
                      <th>Id</th>
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
  </div>
  <!-- /.content-wrapper -->
  
              <script type="text/javascript">
                $(document).ready(function () {
                  
                    var funciones = <?php echo $_SESSION['levelSession']; ?>;
                    var tabla = $('#cargas').DataTable({
                                                
                          responsive: true,
													select: {style: 'single'},
                          "lengthMenu": [ 10, 15, 20, 50, 100 ],
                          "pageLength": 10,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                              "url": 'dt_cargas.php',
                              "type": "POST"
                          },
                          
                          "columns": [
                              { "data": "Nombre", 'width': '50%' },
                              { "data": "Precio", 'width': '40%', className: 'text-right' },
                              { "data": "Id", 'width': '10%', className: 'text-right' }
                              
                          ],
                          "order": [[ 0, "asc" ]],
                           
                          "language": { 
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ Registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
                            "sInfo":           "<strong>Registros</strong> | _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty":      "Sin resultados...",
                            "sInfoFiltered":   "(filtrado)",
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
													"<'row'<'col-xs-12 col-md-6'B><'col-md-3 col-xs-12'l><'col-md-3 col-xs-12 pull-right'f>>" +
													"<'row'<'col-sm-12'tr>>" +
													"<'row'<'col-md-5'i><'col-md-7'p>>",												
												buttons: [
													{ text: 'Nuevo',
															action: function ( e, dt, node, config ) {
																	window.location.href = "nuevo.php";
															}
													},
													{ text: 'Modificar'},
													
													//'excelHtml5',
													/*
													{ extend: 'pdfHtml5', text: 'PDF', pageSize: 'A4', orientation: 'landscape', title: 'Expedientes',
															exportOptions: {
																columns: [ 1, 2, 3, 5, 6, 7 ]
															}
													}, */
													{ text: 'Eliminar'},
													{ extend: 'print', text: 'Imprimir', title: 'Expedientes', className: 'hidden-xs'}
													
													
												]
                          
                      });
                    	
											// Declaracion al inicio...
											// Modificar Disable
											tabla.buttons( [1,2] ).disable();
                    
                      //tabla.buttons().container().appendTo( '#expedientes_wrapper .col-sm-6:eq(0)' );
                      $('#rocket').click(function(){
                          tabla.search( '' ).draw();
                      });
                      
                      tabla.button(0).enable(
                        funciones > 1 ? true : false
                      );
											
											// Seleccionar para Modificar
											$('#cargas').on( 'select.dt', function () {
													var crg_nombre = tabla.cell('.selected', 0).data();
													var crg_id = tabla.cell('.selected', 2).data();
													tabla.button(1).action( function( e, dt, button, config ) {
															window.location.href = "editar.php?Id=" + crg_id + "&Nombre=" + crg_nombre;
													} );
													tabla.button(2).action( function( e, dt, button, config ) {
															window.location.href = "eliminar.php?Id=" + crg_id + "&Nombre=" + crg_nombre;
													} );
													tabla.buttons([1,2]).enable();
											} );
											
											$('#cargas').on( 'deselect.dt', function () {
													var trans_id = 0;
													tabla.buttons([1,2]).disable();
											} );
        
          
                  });
              </script>

  
<?php
include($iniUrl . 'footer.php');
?>
