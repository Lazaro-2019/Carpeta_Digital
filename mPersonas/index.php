<?php 
include('../conexion/conexion.php');

include('../sesiones/verificar_sesion.php');

include('../funcionesPHP/filtroUsuario.php');

$tUsuario=$_SESSION["user_tipo"];
userA($tUsuario);
	// Variables de configuración
	$titulo="Catálogo de Personas";
	$opcionMenu="A";
	$fecha=date("Y-m-d"); 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Personas</title>

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
</head>

<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header><!-- /header -->	
	<div class="container-fluid" >
		<div class="row" id="cuerpo" style="display:none">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2 vertical" >
				<?php 
					include('menuv.php');
				?>
			</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont">
					<div class="titulo borde sombra">
							<h3><?php echo $titulo; ?></h3>
					</div>	
					<div class="contenido borde sombra">
						<div class="container-fluid">
							<section id="alta" style="display: none">
								<form id="frmAlta">
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="nombre">Nombre de la Persona:</label>
												<input type="text" id="nombre" class="form-control " autofocus="" required="" placeholder="Escribe el Nombre de la Persona">
											</div>
										</div>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="paterno">Apellido Paterno:</label>
												<input type="text" id="paterno" class="form-control " required="" placeholder="Escribe el Apellido Paterno">
											</div>
										</div>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="materno">Apellido Materno:</label>
												<input type="text" id="materno" class="form-control " required="" placeholder="Escribe el Apellido Materno">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="form-group">
												<label for="direccion">Dirección:</label>
												<input type="text" id="direccion" class="form-control " required="" placeholder="Escribe la Dirección Completa">
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="sexo">Sexo:</label>
												<select  id="sexo" class="select2 form-control " style="width: 100%">
													<option value="0">Seleccione ...</option>
													<option value="M">Masculino</option>
													<option value="F">Femenino</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="Telefono">Teléfono:</label>
												<input type="text" id="telefono" class="form-control " required="" placeholder="Escribe el Teléfono">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<div class="form-group">
												<label for="fecha_nac">Fecha de Nacimiento:</label>
												<input type="date" id="fecha_nac" class="form-control " required="" placeholder="yyyy-mm-dd" value="<?php echo $fecha;?>">
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="form-group">
												<label for="correo">Correo Electrónico:</label>
												<input type="text" id="correo" class="form-control " required="" placeholder="Escribe el Correo Electrónico">
											</div>
										</div>
										<!-- <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
											<div class="form-group">
												<label for="tipo">Tipo de persona:</label>
												<select  id="tipo" class="select2 form-control " style="width: 100%">
													<option value="estudiante">Estudiante</option>
													<option value="trabajador">Trabajador</option>
												</select>
											</div>
										</div> -->
										<hr class="linea">
									</div>
									<div class="row">
										<div class="col-lg-12">
											<button type="button" id="btnLista" class="btn btn-login  btn-flat  pull-left">Lista de Personas</button>
											<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Guardar Información">										
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

<!-- Modal -->
	<div id="modalEditar" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<!-- Modal content-->
				<form id="frmActuliza">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Editar Datos de la Persona</h4>
						</div>
						<div class="modal-body">
							<input type="hidden" id="idE">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="nombreE">Nombre de la Persona:</label>
										<input type="text" id="nombreE" class="form-control " autofocus="" required="" placeholder="Escribe el Nombre de la Persona">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="paternoE">Apellido Paterno:</label>
										<input type="text" id="paternoE" class="form-control " required="" placeholder="Escribe el Apellido Paterno">
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="maternoE">Apellido Materno:</label>
										<input type="text" id="maternoE" class="form-control " required="" placeholder="Escribe el Apellido Materno">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="direccionE">Dirección:</label>
										<input type="text" id="direccionE" class="form-control " required="" placeholder="Escribe la Dirección Completa">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="sexoE">Sexo:</label>
										<select  id="sexoE" class="select2 form-control " style="width: 100%">
											<option value="M">Masculino</option>
											<option value="F">Femenino</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="telefonoE">Teléfono:</label>
										<input type="text" id="telefonoE" class="form-control " required="" placeholder="Escribe el Teléfono">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="fecha_nacE">Fecha de Nacimiento:</label>
										<input type="date" id="fecha_nacE" class="form-control " required="" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="correoE">Correo Electrónico:</label>
										<input type="text" id="correoE" class="form-control " required="" placeholder="Escribe el Correo Electrónico">
									</div>
								</div>
								<!-- <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
									<div class="form-group">
										<label for="tipoE">Tipo de persona:</label>
										<select  id="tipoE" class="select2 form-control " style="width: 100%">
											<option value="estudiante">Estudiante</option>
											<option value="trabajador">Trabajador</option>
										</select>
									</div>
								</div> -->
								<hr class="linea">
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
			$("#cuerpo").fadeIn("slow");
		};	
	</script>
</body>
</html>