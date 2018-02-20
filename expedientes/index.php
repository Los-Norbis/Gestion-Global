<?php
$iniUrl = '../';
include($iniUrl . 'header.php');
include($iniUrl . 'dtload.php');

// Expedientes
$sql = "SELECT ALL Id, Nombre FROM fc_clientes";
if (!$tbl_temas = $mysqli->query($sql)) {
		// �Oh, no! La consulta fall�.
		echo "<h2>Error en la Consulta SQL | Solicitantes.</h2>";
		exit;
}

$sql = "SELECT ALL Id, Nombre FROM me_destino_exp";
if (!$tbl_destinos = $mysqli->query($sql)) {
		// �Oh, no! La consulta fall�.
		echo "<h2>Error en la Consulta SQL | Destino.</h2>";
		exit;
}
$level = $_SESSION['levelSession'];
//

?>

	<style>
		select {
			width: 100%;
		}
		option {
			width: 220px;
		}

	</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Expedientes <small>Inicio</small></h1>
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

              <table cellpadding="0" cellspacing="0" id="expedientes" class="table nowrap table-striped table-bordered table-hover report" width="100%">
        <thead>
        <tr>

            <th class="cell-center">Fecha</th>
            <th class="cell-center" data-priority="1">A&ntilde;o|N&deg;</th>
            <th class="cell-center">Alc.</th>
            <th class="cell-center">Cpo.</th>
			<th class="cell-center" data-priority="2">Caratula</th>
            <!-- <th class="cell-center select-filter" data-priority="2">Solicitante</th> -->
            <th>Solicitante</th>
            <th data-priority="4">Ubicacion</th>
            <th class="none">Notas:</th>
			<th class="none">Archivo:</th>
            <th class="none"></th>

        </tr>
        </thead>

        <tfoot>
        <tr>

            <th class="cell-center"></th>
            <th class="cell-center"></th>
            <th class="cell-center"></th>
            <th class="cell-center"></th>
			<th class="cell-center"></th>
            <th>
			<select name="tema" id="select-tema" >
                <option value="">Filtrar Solicitante</option>
                <?php
                while ($temas = $tbl_temas->fetch_assoc()) {
                  echo '<option value=' . $temas['Id'] . '>' . $temas['Nombre'] . '</option>';
                }
                ?>
            </select>
            </th>
            <th>
				<select name="destino" id="select-destino" >
                <option value="">Filtrar Ubicacion</option>
                <?php
                while ($destinos = $tbl_destinos->fetch_assoc()) {
                  echo '<option value=' . $destinos['Id'] . '>' . $destinos['Nombre'] . '</option>';
                }
                ?>
              	</select>
            </th>
            <th class="none">Notas</th>
			<th class="none">Archivo</th>
            <th class="none"></th>
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

				$.fn.DataTable.ext.pager.numbers_length = 6;
				var funciones = <?php echo $level; ?>;
	      		var tabla = $('#expedientes').DataTable({

				responsive: true,
				"select": true,
				"lengthMenu": [ 10, 15, 20, 50, 100 ],
				"pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": 'dss_inicio.php',
					"type": "POST"
                },

				"columns": [

            				{ "data": 'Ingreso', 'width': '8%', className: "cell-right",

							  render: function ( data, type, row ) {
							  if ( type === 'display' ) {
							  var dateSplit = data.split('-');
							  return dateSplit[2] +'/'+ dateSplit[1] +'/'+ dateSplit[0];
							  }
								  return data;
							  }
							},
							{ "data": "Orden",  className: "cell-right", 'width': '6%' },
							{ "data": "Alcance",  className: "cell-right", 'orderable': false, 'width': '3%' },
							{ "data": "Cuerpo",  className: "cell-right", 'orderable': false, 'width': '3%' },
							{ "data": "Caratula",  className: "col-300" },
							{ "data": "Solicitante",  className: "col-200" },
							{ "data": "Destino", 'width': '15%' },

							{ "data": "Notas" },
							{ "data": "Archivo" },
							{ "data": null }

        				],
				"columnDefs": [
						{
								"render": function ( data, type, row ) {
										return data.substr(0,4) + ' | ' + data.substr(4,4);
								},
								"targets": 1
						},
						{
								"render": function ( data, type, row ) {
										return data + '/' + row.Periodo_DE;
								},
								"targets": null
						},
						{
								render: function ( data, type, row ) {
								if ( type === 'display' ) {
										if (data == 0) {
											return '';
										}
									}
									return data;
								},
								"targets": [ 2, 3 ]
						},
						{
						"render": function ( data, type, row ) {
							var khtml = '';
							var cmlink = 'Id=' + row.Orden + '&Alcance=' + row.Alcance;

							if (funciones < 3) {

								var khtml = '<a href="editar.php?' + cmlink + '" class="btn btn-info pull-right">Modificar</a>';
								if (row.Alcance == 0) {
									khtml += '&nbsp;<a href="alcance.php?Id=' + row.Orden + '" class="btn btn-info pull-right hidden-xs" style="margin-right: 8px;" target="_blank">Nuevo Alcance</a>';
								}
								khtml += '<a href="trans.php?' + cmlink + '" class="btn btn-primary pull-right" style="margin-right: 8px;">Transferir</a>';
								khtml += '&nbsp;<a href="qr.php?' + cmlink + '" class="btn btn-primary pull-right hidden-xs" style="margin-right: 8px;" target="_blank">Generar QR</a>';
								khtml += '&nbsp;<a href="caratula.php?' + cmlink + '" class="btn btn-primary pull-right hidden-xs" style="margin-right: 8px;" target="_blank">Generar Car&aacute;tula</a>';
							}

							khtml += '&nbsp;<a href="movimientos.php?' + cmlink + '" class="btn btn-success pull-right" style="margin-right: 8px;">Ver Movimientos</a>';

							return khtml;
						},
						"searchable": false,
						"targets": -1
						},
						// { "visible": false,  "targets": [ 6 ] }
				],
								"order": [[ 1, "desc" ]],

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
					"<'row'<'col-xs-12 col-md-6'<'#titulo'i>><'col-md-3 col-sm-6'l><'col-md-3 col-sm-6 pull-right'f>>" +
					"<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-md-5'B><'col-md-7'p>>",

					 //"<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
					 //"<'row'<'col-sm-12'tr>>" +
					 //"<'row'<'col-sm-5'i><'col-sm-7'p>>",

				buttons: [
					{ text: 'Nuevo Expediente',
							action: function ( e, dt, node, config ) {
				window.location.href = "nuevo.php";
			}
					},
					//'excelHtml5',
					//{ extend: 'pdfHtml5', text: 'PDF', pageSize: 'A4', orientation: 'landscape', title: 'Expedientes',
						//	exportOptions: {
		//	columns: [ 1, 2, 3, 5, 6, 7 ]
			//}
					//},
					{ extend: 'print', text: 'Imprimir', title: 'Expedientes'}
				]

		});


		//tabla.buttons().container().appendTo( '#expedientes_wrapper .col-sm-6:eq(0)' );
		$('#rocket').click(function(){
				tabla.columns(6).search( '' );
				tabla.columns(7).search( '' );
				tabla.search( '' ).draw();
		});

		$('#select-tema').change(function() {
				tabla.columns(6).search( $(this).val() ).draw();
		});

		$('#select-destino').change(function() {
				tabla.columns(7).search( $(this).val() ).draw();
		});

		$( "#buscar" ).focusin(function() {
				tabla.columns(6).search( '' );
				tabla.columns(7).search( '' );
				$('#select-destino').prop('selectedIndex',0);
				$('#select-tema').prop('selectedIndex',0);
				//alert($('#select-destino').val());
		});

		tabla.buttons([0]).enable(
		funciones < 3 ? true : false
		);


});
</script>


<?php
include($iniUrl . 'footer.php');
?>
