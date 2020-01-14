<?php 
	include('../conexion/conexion.php');
	include('../sesiones/verificar_sesion.php');
		

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Carpeta Digital</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">

	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">


	<link rel="stylesheet" href="../plugins/animate/animate.css">
</head>
<body>
	<!-- /header -->
		<header>
			<?php 
				include('../layout/encabezado.php');
			?>
		</header>
	<!-- /header -->

	<div class="container-fluid" >
		<div class="row" id="cuerpo" style="display:none">
				<?php 
					include('../layout/menuv.php');
				?>
			<div class="<?php echo $col ?> cont">
				<div class="titulo borde sombra">
					<h3 class="titular">Panel Inicial</h3>
				</div>
				<div class="contenido borde sombra " style="padding-right:18px;">
					<ul class="nav nav-tabs nav-justified animated zoomIn">
						<li class="active colornav"><a data-toggle="tab" href="#menu1">Categorías</a></li>
						<li class="colornav"><a data-toggle="tab" href="#menu2">Años</a></li>
					</ul>
					<div class="tab-content">
						<div id="menu1" class="tab-pane fade in active">
							<br>
							<section id="caja_categoria"></section>
							<section id="sub_caja_anio" hidden></section>
							<section id="preguntas" hidden></section>
							<section id="sub_evidencias_1" hidden></section>
						</div>
						<div id="menu2" class="tab-pane fade">
							<br>
							<section id="caja_anio"></section>
							<section id="sub_caja_categoria" hidden></section>
							<section id="preguntas2" hidden></section>
							<section id="sub_evidencias_2" hidden></section>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
	
	<footer class="fondo">
		<?php 
			include('../layout/pie.php');
		 ?>			
	</footer>



		<div id="modalVBtesina" class="modal fade modal-<?php echo "$sColorCaja";  ?>" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->

				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="nArchivo">Archivo</h4>
				</div>
				<div class="modal-body">
			
					<div class="row">

						<div class="container-fluid">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-10">
									<label id="desc" class="descripcion animated flipInX">
									</label>								
								</div>
								<div class="col-lg-2">
									<label id="anio_desc" class="descripcion" ></label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div id="visualizador" style="height:700px;" class="animated zoomInUp"></div>
								</div>
							</div>
						</div>
						</div>

          		</div><!-- /.row -->

      		</div>
      <div class="modal-footer">
      </div>


    </div>
  </div>
</div>
	<!-- Modal -->

	



	<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>
	<!-- bootstrap -->
	<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>
	<script src="../plugins/PDFObject-master/pdfobject.min.js"></script>

	<script src="../js/menu.js"></script>
	<script src="../js/precarga.js"></script>
	<script src="../js/salir.js"></script>
	<script src="../js/cambiarcontra.js"></script>
	<script src="funciones.js"></script>
	<script src="../js/editardatos.js"></script>
	
	<script>
		llenar_caja_categoria();
		llenar_caja_anio();
		
		window.onload = function() {
			$("#cuerpo").fadeIn("slow");
			
		};	


	</script>
</body>
</html>