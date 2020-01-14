<?php 
include('../conexion/conexion.php');

include('../sesiones/verificar_sesion.php');

include('../funcionesPHP/filtroUsuario.php');

$tUsuario=$_SESSION["user_tipo"];
userE($tUsuario);
// Variables de configuración
$titulo="Catálogo Archivos";
$opcionMenu="A";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Archivos</title>

	<!-- Meta para compatibilidad en dispositivos mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">

    <!-- fontawesome -->
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">

	<!-- DataTableButtons -->
     <link rel="stylesheet" href="../plugins/dataTableButtons/buttons.dataTables.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

    <!-- bootstrap-toggle-master -->
    <link href="../plugins/bootstrap-toggle-master/css/bootstrap-toggle.css" rel="stylesheet">
    <link href="../plugins/bootstrap-toggle-master/stylesheet.css" rel="stylesheet">
	
	<!-- select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.css">

	<!-- Estilos propios -->
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">

	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">

	<!-- fileinput -->
	<link href="../plugins/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

	<!-- smoothbox -->
	<link rel="stylesheet" href="../plugins/Smoothbox-master/css/smoothbox.css">

	<!-- Animate -->
	<link rel="stylesheet" href="../plugins/animate/animate.css">
</head>

<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header>
	<!-- /header -->	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2 vertical" id="menu" style="display:none">
				<?php 
					include('menuv.php');
				?>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont" id="titulo" style="display:none">
			   <div class="titulo borde sombra">
			        <h3><?php echo $titulo; ?></h3>
			   </div>	
			   <div class="contenido borde sombra">
				    <div class="container-fluid">
						<section id="alta" style="display:none">
							<form id="frmAlta">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<div class="form-group">
											<label for="categoria">Categoría:</label>
											<select  id="categoria" class="select2 form-control" style="width: 100%" >
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="form-group">
											<label for="icono">Nombre del Archivo:</label>
											<input type="text" id="nombre" class="form-control" required="" placeholder="Escriba el Nombre del Archivo">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
										<div class="form-group">
											<label for="anio">Año:</label>
											<select  id="anio" class="select2 form-control" style="width: 100%" >
												<option value="0">Seleccione...</option>
												<?php 
													$year=date("Y");
													$anio=$year-20;

													for ($i=$year; $i>=$anio ; $i--) 
													{
														echo "<option value=$i>$i</option>";
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											<label for="descripcion">Descripción del Archivo:</label>
											<input type="text" id="descripcion" class="form-control" required="" placeholder="Escriba la Descripción del Archivo">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											<label for="pregunta">Preguntas:</label>
											<select  id="pregunta" class="select2 form-control " style="width: 100%">
											</select>
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-lg-12">
										<button type="button" id="btnLista" class="btn btn-login btn-flat pull-left">Lista de Archivos</button>
										<input type="submit" class="btn btn-login btn-flat pull-right" value="Guardar Información">
									</div>
								</div>
							</form>
						</section>

						<section id="lista">
			
						</section>
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

<!-- Modal Subir-->
	<div id="modalSubir" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<!-- Modal content-->
				<form id="frmSubir">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Seleccione el Archvo a Subir</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<!-- <label for="image">Nueva imagen</label> -->
								<input type="file" class="form-control-file" name="archivo" id="archivo">
								<input type="hidden" class="form-control-file" name="idE" id="idE">
							</div>
						</div>
						<div class="modal-footer">
							<div class="row">
								<div class="col-lg-12">
									<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
									<input type="button" class="btn btn-login  btn-flat  pull-right upload" value="Subir Archivo">
								</div>
							</div>
						</div>
					</div>
				</form>
			<!-- Modal content-->
		</div>
	</div>
<!-- Modal Subir-->


<!-- Modal Editar-->
	<div id="modalEditar" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    <!-- Modal content-->
			<form id="frmActualiza">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Editar datos de Archivo</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" id="idE">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
								<div class="form-group">
									<label for="categoriaE">Categoria:</label>
									<select  id="categoriaE" class="select2 form-control" style="width: 100%" onchange="llenar_preguntaE(this.value);">
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
								<div class="form-group">
									<label for="icono">Nombre del Archivo:</label>
									<input type="text" id="nombreE" class="form-control" required="" placeholder="Escriba el Nombre del Archivo">
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
								<div class="form-group">
									<label for="anioE">Año</label>
									<select  id="anioE" class="select2 form-control" style="width: 100%" >
										<option value="0">Seleccione...</option>
										<?php 
											$year=date("Y");
											$anio=$year-20;

											for ($i=$year; $i>=$anio ; $i--) 
											{
												echo "<option VALUE=$i>$i</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="descripcion">Descripción del Archivo</label>
									<input type="text" id="descripcionE" class="form-control" required="" placeholder="Escriba la Descripción del Archivo">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
									<label for="pregunta">Preguntas:</label>
									<select  id="preguntaE" class="select2 form-control " style="width: 100%">
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
							<div class="row">
								<div class="col-lg-12">
									<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
									<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Actualizar Información">	
								</div>
							</div>
					</div>
				</div>
			</form>
			<!-- Modal content-->
		</div>
	</div>
<!-- Modal -->


	<!-- Modal Editar 2-->
	<div id="modalEditar2" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
	    	<!-- Modal content-->
				<form id="frmActuliza2">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Cambiar Contraseña</h4>
						</div>
						<div class="modal-body">
							<input type="hidden" id="idE2">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label for="contraE2">Contraseña:</label>
										<input type="password" id="contraE2" class="form-control " required="" placeholder="Escribe la contraseña">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label for="vContraE2">Verificar Contraseña:</label>
										<input type="password" id="vContraE2" class="form-control " required="" placeholder="Vuelve a esrcribir la contraseña">
									</div>
								</div>
								<hr class="linea">
							</div>
						</div>
						<div class="modal-footer">
							<div class="row">
								<div class="col-lg-12">
									<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
									<button type="button" id="btnMostrar" class="btn btn-login  btn-flat  pull-left" onclick="mostrarContra()" value="oculto">
									<i class="far fa-eye fa-lg" id="icoMostrar"></i>
									</button>
									<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Actualizar Información">	
								</div>
							</div>
						</div>
					</div>
				</form>
			<!-- Modal content-->
		</div>
	</div>
<!-- Modal Editar 2-->


<!-- Modal Ver Archivo-->
<div id="modalVBtesina2" class="modal fade modal-<?php echo "$sColorCaja";  ?>" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="nArchivo2">Archivo</h4>
				</div>
			<div class="modal-body">
				<div class="row">
					<div class="container-fluid">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12">
									<label id="desc2" class="descripcion animated flipInX">dddd</label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div id="visualizador2" style="height:700px;" class="animated zoomInUp"></div>
								</div>
							</div>
						</div>
					</div>

				</div><!-- /.row -->
			</div>
			<div class="modal-footer">
			</div>
			</div>
		<!-- Modal content-->
	</div>
</div>
<!-- Modal -->



	<!-- ENLACE A ARCHIVOS JS -->
	<!-- jquery -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>

	<!-- bootstrap-toggle-master -->
    <script src="../plugins/bootstrap-toggle-master/doc/script.js"></script>
    <script src="../plugins/bootstrap-toggle-master/js/bootstrap-toggle.js"></script>

 	 <!-- dataTableButtons -->
    <script type="text/javascript" src="../plugins/dataTableButtons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.flash.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/jszip.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/pdfmake.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/vfs_fonts.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.html5.min.js"></script>
    <script type="text/javascript" src="../plugins/dataTableButtons/buttons.print.min.js"></script>
	
	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>

	<!-- PDF OBJECT -->
	<script src="../plugins/PDFObject-master/pdfobject.min.js"></script>

    <!-- Funciones propias -->
    <script src="funciones.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/precarga.js"></script>
	<script src="../js/salir.js"></script>
	<script src="../js/cambiarcontra.js"></script>
	<script src="../js/editardatos.js"></script>

    <!-- LLAMADAS A FUNCIONES E INICIALIZACION DE COMPONENTES -->

    <!-- Llamar la funcion para llenar la lista -->
	<script type="text/javascript">
		llenar_lista();
		// llenar_pregunta();
		// llenar_categoriaE();
	
	</script>

    <!-- Inicializador de elemento -->
     <script>
      $(function () {
        $(".select2").select2();
        
      });
    </script> 

	<script>
		var letra ='<?php echo $opcionMenu; ?>';
		$(document).ready(function() { menuActivo(letra); });
	</script>

	<script type="text/javascript" src="../plugins/stacktable/stacktable.js"></script>
	<script>
		window.onload = function() {
			$("#listaInicial").fadeIn("slow");
			$("#menu").fadeIn("slow");
			$("#titulo").fadeIn("slow");
		};	
	</script> 

	

	<script src="../plugins/bootstrap-fileinput-master/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/fr.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/es.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/themes/fas/theme.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.js" type="text/javascript"></script>


</body>
</html>