<?php
$iniUrl = '';
include('header.php');
include('dtload.php');

$level = $_SESSION['levelSession'];
if ($level < 3) {
	// Contar Cartas sin Liquidar
	if ($result = $mysqli->query("SELECT * FROM me_expedientes")) {
			//$exp_cnt = $result->num_rows;
			$result->close();
	}

	// Contar Transportes
	if ($result = $mysqli->query("SELECT Id FROM fc_clientes")) {
			$cli_cnt = $result->num_rows;
			$result->close();
	}

	$mysqli->close();
}
?>

<!--
<link href='plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='plugins/fullcalendar/moment.min.js'></script>
<script src='plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='plugins/fullcalendar/es.js'></script>
-->

<style>
	#videocontent {
		border-radius: 4px;
		margin: 12px 0;
		display: none;
		background-color: #fff;
	    border: 1px solid #ccc;
	}

	#datacontent {
		margin: 12px 0;
		text-align: center;
		display: none;
		background-color: #666;
	}
	#registrar {
		margin-top: 16px;
	}
</style>
  <script type="text/javascript" src="qr/js/qrcodelib.js"></script>
  <script type="text/javascript" src="qr/js/webcodecamjquery.js"></script>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>Inicio <small>Escritorio de Trabajo</small></h1>
  </section>

  <!-- Main content -->
  <section class="content">


    <div class="row">
		<?php
		if ($level < 3) {
		?>
				<div class="col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
            	<h3><?php echo $cli_cnt; ?></h3>
              <h4>Art&iacute;culos<br />&nbsp;</h4>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="#" class="small-box-footer">Ir a Art&iacute;culos <i class="fa fa-chevron-circle-right"></i></a>
          </div>
				</div>
				<div class="col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h3><?php echo $cli_cnt; ?></h3>
              <h4>Clientes<br />&nbsp;</h4>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="clientes" class="small-box-footer">Ir a Clientes <i class="fa fa-chevron-circle-right"></i></a>
          </div>
        </div>
		<?php } ?>

		<!--
		<div class="col-lg-4 col-xs-6">
			<div style="margin: 0 auto; width: 360px; ">
				<div>
					<button id="showcam" type="button" class="btn btn-primary btn-block"><i class="fa fa-play"></i>&nbsp; Activar C&aacute;mara</button>
				</div>

				<div id="videocontent">
					<canvas id="video" ></canvas>
				</div>

				<div class="alert alert-danger" id="datacontent"></div>

			</div>
		</div> -->

    </div>
    <!-- /.row -->

  </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->



<script>

	$(document).ready(function() {

		var arg = {
			resultFunction: function(result) {
				var expdt = result.code;

				var exp_str = expdt.substring(0,4) + ' | ' + expdt.substring(4);
					//alert(exp_str);

				var dataexp = '<h4>Expediente: ' + exp_str + '</h4>';
				$('#datacontent').html(dataexp).show();

				var parametros = { "orden" : expdt, "usuario" : <?php echo $_SESSION['userSession'];?> };

				$.ajax({
					data:  parametros,
					url:   'expedientes/chk-exp.php',
					type:  'post',
					dataType: "json",
					beforeSend: function () {
						datahtml = "<p>Procesando, espere por favor...</p>";
						$("#datacontent").html(dataexp + datahtml);
					},
					success:  function (data) {
						datahtml = data.mensaje;
						if (data.codigo == 1) {
							$("#datacontent").removeClass('alert-danger').addClass('alert-info');
							datahtml += '<a href="expedientes/registrar.php?Orden=' + expdt + '" id="registrar" class="btn btn-success btn-block"><i class="fa fa-check"></i>&nbsp; Registrar Expediente</a>';
						}
						$("#datacontent").html(dataexp + datahtml);
					}
				});
					//decoder.stop().play();
			}
		};

		var decoder = $("#video").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;

		sc = 0;
		ft = true;

		$("#showcam").click(function(){
			if (sc == 0) {
				 //$("#video").css("display", "");
				 //if (ft) {
					//	$("#video").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery.play();
				 //} else {
				 decoder.play();
				 //}
				 $("#videocontent").fadeIn(700);
				 $("#showcam").html('<i class="fa fa-stop"></i>&nbsp; Desactivar C&aacute;mara');
				 sc = 1;
				 ft = false;
			} else {
				 $("#videocontent").fadeOut(500);
				 $("#datacontent").fadeOut(500);
				 $("#showcam").html('<i class="fa fa-play"></i>&nbsp; Activar C&aacute;mara');
				 decoder.stop();
				 sc = 0;
			}
		});
		/*
		 $('#calendar').fullCalendar({
			 header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			editable: true,
			navLinks: true, // can click day/week names to navigate views
			eventLimit: true // allow "more" link when too many events
     }); */

	});

</script>

<?php
include('footer.php');
?>
