<?php
    include('../conexion/conexion.php');
    include('../sesiones/verificar_sesion.php');
    include('../funcionesPHP/filtroUsuario.php');
    $tUsuario=$_SESSION["user_tipo"];
    userE($tUsuario);

    $titulo="Catálogo de Categorías";
    $opcionMenu="A";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <title>Categorias</title>


</head>
<body>
    <header>
        <?php
            include('../layout/encabezado.php');
        ?>
    </header>
    <div class="container-fluid">
        <div class="row" id="cuerpo" style="display:none">
            <div class="col-xs-0 col-sm-3 col-md-2 col-lg-2 vertical">
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
                        <section id="alta" style="display:none">
                            <form id="frmAlta">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="categoria">Categoría:</label>
                                            <input type="text" id="categoria" class="form-control" required="" placeholder="Escriba el Nombre de la Categoría">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="icono">Icono:</label>
                                            
                                            <input type="text" id="icono" class="form-control" required="" placeholder="Escriba el Icono de la Categoría">
                                            <input type="hidden" id="idE" name="idE">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btnLista" class="btn btn-login btn-flat pull-left">Lista de Categorías</button>
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

<!-- Modal -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
                <form id="frmActualiza">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Editar Datos de Categoría</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
                                    <div class="form-group">
                                        <label for="categoriaE">Categoría:</label>
                                        <input type="text" id="categoriaE" class="form-control" style="width: 100%" placeholder="Escriba el Nombre de la Categoría">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <label for="iconoE">Icono:</label>
                                        <input type="text" id="iconoE" class="form-control" required="" placeholder="Escriba el Icono de Categoría">
                                    </div>
                                </div>
                                <hr class="linea">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    <button type="button" id="btnCerrar" class="btn btn-login btn-flat pull-left" data-dismiss="modal">
                                        Cerrar
                                    </button>
                                    <input type="submit" class="btn btn-login btn-flat pull-right" value="Actualizar Informacion">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <!-- Modal content-->
        </div>
    </div>
<!-- Modal-->




    <!--Enlace a los archivos JS-->

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