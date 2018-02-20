<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
include($iniUrl . 'dtload.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<?php  
  $userlevel = $_SESSION['levelSession'];
	if ($userlevel == 3) {
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
      <h1>Usuarios <small>Inicio</small></h1>
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

              <table cellpadding="0" cellspacing="0" id="usuarios" class="table nowrap table-striped table-bordered table-hover report" width="100%">
                  <thead>
                  <tr>
					<th>Activo</th>
                      <th data-priority="1">Nombre</th>
                      <th>Area</th>
                      <th>Email</th>
					<th>Nivel</th>
                      <th>Id</th>
                  </tr>
                  </thead>
                  
                  <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
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
  </div>
  <!-- /.content-wrapper -->
  
              <script type="text/javascript">
                $(document).ready(function () {
                  
                    var funciones = <?php echo $_SESSION['levelSession']; ?>;
                    var tabla = $('#usuarios').DataTable({
                                                
                          responsive: true,
													select: {style: 'single'},
                          "lengthMenu": [ 10, 15, 20, 50, 100 ],
                          "pageLength": 10,
                          "processing": true,
                          "serverSide": true,
                          "ajax": {
                              "url": 'dt_usuarios.php',
                              "type": "POST"
                          },
                          
                          "columns": [
							  { "data": "user_validate", className: 'text-center', 'orderable': false,
								  "render": function ( data, type, row ) {
									  if (data === '0') {
										  return '<i class="fa fa-clock-o" style="color: orange;"></i>';
									  } else if (data === '1') {
										  return '<i class="fa fa-check-circle" style="color: limegreen;"></i>';
									  }
								  }
							  },
                              { "data": "user_name", 'width': '30%' },
							  { "data": "user_area", 'width': '30%' },
                              { "data": "user_email", 'width': '30%'},
							  { "data": "user_level",
								  "render": function ( data, type, row ) {
									  if (data === '1') {
										  return 'Super Usuario';
									  } else if (data === '2') {
										  return 'Administrador';
									  } else if (data === '3') {
										  return 'Normal';
									  }
								  }
							  },
                              { "data": "user_id", 'width': '10%', className: 'text-right' }
                              
                          ],
                          "order": [[ 1, "asc" ]],
                           
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
										window.location.href = "usr-nu.php?ml=" + (funciones + 1);
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
						{ text: 'Estado'},
						{ extend: 'print', text: 'Imprimir', title: 'Usuarios', className: 'hidden-xs'}
						
						
					]
                          
                      });
                    	
					  // Declaracion al inicio...
					  // Modificar Disable
					  tabla.buttons( [1,2,3] ).disable();
                    
                      //tabla.buttons().container().appendTo( '#expedientes_wrapper .col-sm-6:eq(0)' );
                      $('#rocket').click(function(){
                          tabla.search( '' ).draw();
                      });
                      
											
					  // Seleccionar para Modificar
					  $('#usuarios').on( 'select.dt', function () {
							  var usr_val = tabla.cell('.selected', 0).data();
							  var usr_nombre = tabla.cell('.selected', 1).data();
							  var usr_id = tabla.cell('.selected', 5).data();
							  
							  tabla.button(1).action( function( e, dt, button, config ) {
									  window.location.href = "usr-cc.php?Id=" + usr_id;
							  } );
							  tabla.button(2).action( function( e, dt, button, config ) {
									  window.location.href = "usr-bu.php?Id=" + usr_id + "&Nombre=" + usr_nombre;
							  } );
							  tabla.button(3).action( function( e, dt, button, config ) {
							  var parametros = {
									  "usuario" : usr_id,
									  "estado" : usr_val
							  };														
							  $.ajax({
									  data:  parametros,
									  url:   'usr-st.php',
									  type:  'post',
									  //beforeSend: function () {
									  //				$("#resultado").html("Procesando, espere por favor...");
									  //},
									  success:  function (response) {
											  tabla.cell('.selected', 0).data(response).draw();
									  }
							  });													
							  } );
							  tabla.buttons([1,2,3]).enable();
					  } );
					  
					  $('#usuarios').on( 'deselect.dt', function () {
							  var usr_id = 0;
							  tabla.buttons([1,2,3]).disable();
					  } );
        
          
                  });
              </script>

  
<?php
include($iniUrl . 'footer.php');
?>
