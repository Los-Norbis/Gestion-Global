<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
include($iniUrl . 'dtload.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<<<<<<< HEAD
      <h1>Stock <small>Inicio</small></h1>
=======
      <h1>Articulos<small>Inicio</small></h1>
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Control & Edici&oacute;n</h3>
            </div>
<<<<<<< HEAD
            <!-- /.box-header -->
            <div class="box-body">

              <table cellpadding="0" cellspacing="0" id="trans" class="table nowrap table-striped table-bordered table-hover report" width="100%">
                  <thead>
                  <tr>
                      <th data-priority="1">Marca</th>
                      <th>Id</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <th data-priority="1">FESCOM</th>
                      <th>0001</th>
                  </tr>
                </tbody>
=======
            <!-- /.box-header --->
            <div class="box-body">

              <table cellpadding="0" cellspacing="0" id="articulos" class="table nowrap table-striped table-bordered table-hover report" width="100%">
                  <thead>
                  <tr>
                      <th>Id</th>
                      <th data-priority="1">Descripcion</th>
											<th>Stock</th>
                      <th>Precio</th>
                      <th>Unidad</th>
                      <th>Categoria</th>
                      <th>Marca</th>
                      <th class="none"></th>
                      <th class="none"></th>

                  </tr>
                  </thead>
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3

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
<<<<<<< HEAD

  <!-- Modal -->
  <div class="modal fade" id="marcaNuevaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Administrador de Marcas</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

                    <div class="input-group" style="margin: 10px 0 20px;">
                      <span class="input-group-addon">
                        <i class="fa fa-trademark" style="width: 16px;"></i>
                      </span>
          	          <input type="text" class="form-control" placeholder="Marca" name="m_nom" required  autofocus/>
                    </div>

                    <div class="form-group">
                    	<button type="button" class="btn btn-default pull-left" onclick="location.href='index.php'"><i class="fa fa-arrow-left"></i> &nbsp; Volver</button>
                      <button type="submit" class="btn btn-primary pull-right" name="btn-signup" id="btn-signup"><i class="fa fa-download"></i> &nbsp; Agregar Marca</button>
                    </div>

                  </form>

                </div>
        			</div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

=======
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
  <!-- /.content-wrapper -->

              <script type="text/javascript">
                $(document).ready(function () {

<<<<<<< HEAD
                    var funciones = <?php echo $_SESSION['levelSession']; ?>;
                    var tabla = $('#trans').DataTable({
=======
                    let formato = {style: "decimal"};
                    // Número de dígitos fraccionarios
                    formato.minimumFractionDigits = 2;
                    var funciones = <?php echo $_SESSION['levelSession']; ?>;
                    var tabla = $('#articulos').DataTable({
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3

                          responsive: true,
													select: {style: 'single'},
                          "lengthMenu": [ 10, 15, 20, 50, 100 ],
                          "pageLength": 10,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
<<<<<<< HEAD
                              "url": 'dt_marcas.php',
=======
                              "url": 'dt_stock.php',
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
                              "type": "POST"
                          },

                          "columns": [
<<<<<<< HEAD
                              { "data": "Nombre", 'width': '40%' },
															{ "data": "Tipo", 'width': '10%' },
                              { "data": "Cuit", 'width': '15%' },
                              { "data": "Telefono", 'width': '15%' },
							  							{ "data": "Email", 'width': '10%' },
                              { "data": "Id", 'width': '10%', className: 'text-right' }
=======
                              { "data": "Id", "visible" : false},
															{ "data": "Descripcion", 'width': '25%' },
                              { "data": "Stock", 'width': '3%', 'className' : 'text-right',
                                render : function ( data, type, row ) {
                                    if (data == '') {
                                      return '<span class="bajostock">' + data + '</span>';
                                    } else {
                                      return '<span class="stock-default">' + data + '</span>';

                                    }
                                },
                                "searchable": false
                              },
                              { "data": "PrecioCosto", 'width': '5%', 'className' : 'text-right',
                                render : function ( data, type, row ) {
                                    if (row.PrecioVenta > 0) {
                                      var precio = parseFloat(row.PrecioVenta);
                                      return '<span class="precioventa">$ ' + precio.toLocaleString('es', formato) + '</span>';
                                    } else {
                                      var precio = parseFloat(data);
                                      return '<span class="stock-default">$ ' + precio.toLocaleString('es', formato) + '</span>';
                                    }
                                },
                                "searchable": false
                              },
                              { "data": "Unidad", 'width': '5%' },
							  							{ "data": "Categoria", 'width': '10%' },
                              { "data": "Marca", 'width': '10%' },
                              { "data": "StockMin", "visible" : false},
                              { "data": "PrecioVenta", "visible" : false}
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3

                          ],
													"columnDefs": [

<<<<<<< HEAD
															{
																	"render": function ( data, type, row ) {
																		if (data == 0) {
																			return '<i class="fa fa-user" aria-hidden="true" style="color: #00a9aa;"></i>';
																		} else {
																			return '<i class="fa fa-book" aria-hidden="true" style="color: #232338;"></i>';
																		}
																	},
																	"searchable": false,
																	"targets": 1
															}
=======
                              {

															}

>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
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
                              "sLast":     "�ltimo",
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
													//"<'row'<'col-xs-12 col-md-6'B><'col-md-3 col-xs-12'l><'col-md-3 col-xs-12 pull-right'f>>" +
													// "<'row'<'col-xs-12 col-md-6'B><'col-md-3 col-sm-6'l><'col-md-3 col-sm-6 pull-right'f>>" +
													//"<'row'<'col-sm-12'tr>>" +
													//"<'row'<'col-md-5'i><'col-md-7'p>>",
													"<'row'<'col-xs-12 col-md-9'B><'col-md-3 col-sm-6 pull-right'f>>" +
													"<'row'<'col-sm-12'tr>>" +
													"<'row'<'col-md-5'l><'col-md-7'p>>" +
													"<'row'<'col-md-12'i>>",
												buttons: [
													{ text: 'Nuevo',
															action: function ( e, dt, node, config ) {
<<<<<<< HEAD
																	$("#marcaNuevaModal").modal();
=======
																	window.location.href = "nuevo.php";
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
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
<<<<<<< HEAD
													{ text: 'Eliminar'}
													//{ text: 'Cuenta Corriente'}
													//{ text: 'Liquidar'}
=======
                          { text: 'Eliminar'},
													//{ text: 'Cuenta Corriente'}
													//{ text: 'Liquidar'}
                          { text: 'Cuenta Corriente'}
                          //{ text: 'Cuenta Corriente'}
                          //{ text: 'Liquidar'}
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
												]



                      });

											// Declaracion al inicio...
											// Modificar Disable
<<<<<<< HEAD
											tabla.buttons( [1,2] ).disable();
=======
											tabla.buttons( [1,2,3] ).disable();
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3

                      //tabla.buttons().container().appendTo( '#expedientes_wrapper .col-sm-6:eq(0)' );
                      $('#rocket').click(function(){
                          tabla.search( '' ).draw();
                      });


                      $( "#buscar" ).focusin(function() {
                          tabla.columns(3).search( '' );
                          tabla.columns(4).search( '' );
                          $('#select-destino').prop('selectedIndex',0);
                          $('#select-tema').prop('selectedIndex',0);
                          //alert($('#select-destino').val());
                      });

                      tabla.button(0).enable(
                        funciones < 3 ? true : false
                      );

											// Seleccionar para Modificar
<<<<<<< HEAD
											$('#trans').on( 'select.dt', function () {
													var trans_nombre = tabla.cell('.selected', 0).data();
													var trans_id = tabla.cell('.selected', 5).data();

													tabla.button(1).action( function( e, dt, button, config ) {
															window.location.href = "editar.php?Id=" + trans_id;
													} );

													tabla.button(2).action( function( e, dt, button, config ) {
															window.location.href = "eliminar.php?Id=" + trans_id + "&Nombre=" + trans_nombre;
													} );

													tabla.buttons([1,2]).enable();
											} );

											$('#trans').on( 'deselect.dt', function () {
													var trans_id = 0;
													tabla.buttons([1,2]).disable();
=======
											$('#articulos').on( 'select.dt', function () {
													var cliente_nombre = tabla.cell('.selected', 0).data();
													var cliente_id = tabla.cell('.selected', 6).data();

													tabla.button(1).action( function( e, dt, button, config ) {
															window.location.href = "editar.php?Id=" + cliente_id;
													} );

													tabla.button(2).action( function( e, dt, button, config ) {
															window.location.href = "eliminar.php?Id=" + cliente_id + "&Nombre=" + cliente_nombre;
													} );
                          tabla.button(3).action( function( e, dt, button, config ) {
															window.location.href = "cc.php?Id=" + cliente_id + "&Nombre=" + cliente_nombre;
													} );

													tabla.buttons([1,2,3]).enable();
											} );

											$('#articulos').on( 'deselect.dt', function () {
													var cliente_id = 0;
													tabla.buttons([1,2,3]).disable();
>>>>>>> 953e0f39abd1666c758e8ae6624bcd09f8761ee3
											} );


                  });
              </script>


<?php
include($iniUrl . 'footer.php');
?>
