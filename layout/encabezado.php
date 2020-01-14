<?php 

include("../conexion/conexion.php");
include('../sesiones/verificar_sesion.php');
$tUsuario=$_SESSION["user_tipo"];

$user_idUser=$_SESSION["idUsuario"];
$user_usuario=$_SESSION["nCompleto"];
$user_contra=$_SESSION["contra"];	

$mnu=($tUsuario=='Visualizador')?"hidden":" ";
	// Codificacion de lenguaje
mysql_query("SET NAMES utf8");
	// Consulta a la base de datos
	$consulta5=mysql_query("SELECT
								personas.id_persona,
                                personas.nombre,
                                personas.ap_paterno,
                                personas.ap_materno,
                                personas.direccion,
                                personas.sexo,
                                personas.telefono,
                                personas.fecha_nacimiento,
                                personas.correo								
							FROM
								personas INNER JOIN usuarios ON personas.id_persona=usuarios.id_persona
                                AND usuarios.id_usuario='$user_idUser'
                                ",$conexion) or die (mysql_error());
                $n=1;
                while ($row=mysql_fetch_row($consulta5)) 
                {
                    $personas_idPersona   = $row[0];
                    $personas_nombre      = $row[1];
                    $personas_paterno     = $row[2];
                    $personas_materno     = $row[3];
                    $personas_direccion   = $row[4];
                    $personas_sexo        = $row[5];
                    $personas_telefono    = $row[6];
                    $personas_fecha_nac   = $row[7];
                    $personas_correo      = $row[8];

					// $sexo=($sexo=='M')?'<i class="fas fa-male fa-lg"></i>':'<i class="fas fa-female fa-lg"></i>';
				}
				
?>
	<section class="contenedor iconos fondo">
		<ul class="nav-pills pull-right menu-bar">
			<li class="list-unstyled ">
				<a href="#" class="color  borde" id="menuV" <?php echo $mnu ?> >
					<i class="fas fa-bars"></i>
				</a>
			</li>
			<li class="list-unstyled modulo">
				<a href="#" class="color borde" onclick="abrirModalEditarDatos(
																				'<?php echo $personas_idPersona?>',
																				'<?php echo $personas_nombre ?>',
																				'<?php echo $personas_paterno ?>',
																				'<?php echo $personas_materno ?>',
																				'<?php echo $personas_direccion ?>',
																				'<?php echo $personas_sexo ?>',
																				'<?php echo $personas_telefono ?>',
																				'<?php echo $personas_fecha_nac ?>',
																				'<?php echo $personas_correo ?>'
																				
																			);">
					<i class="far fa-user-circle"></i>
				</a>
			</li>
			<li class="list-unstyled modulo">
				<a href="#" class="color borde" onclick="abrirModalContra(
																		'<?php echo $user_idUser ?>'
																		);">
					<i class="fas fa-unlock-alt" ></i>
				</a>
			</li>
			<li class="list-unstyled modulo">
				<a href="#" onclick="salir();" class="color borde">
					<i class="fas fa-sign-out-alt"></i>
				</a>
			</li>
			<h2 class="fondo aparece der">
				<?php
					echo $user_usuario;
				?>
			</h2>
		</ul>
		<h2 class="fondo aparece  izq">
			<?php
				echo $user_usuario;
			?>
		</h2>
		<h2 class="fondo aparece  empresa">Dirección de la Subdelegación Montemorelos</h2>
	</section>


<!-- Modal -->
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
<!-- Modal -->



<!-- Modal Editar Datos de Usuario -->
<div id="modalEditarDatosUsuario" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<!-- Modal content-->
				<form id="frmActulizaDatosUsuario">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Editar Datos de Usuario</h4>
						</div>
						<div class="modal-body">
							<input type="hidden" id="idU">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
									<div class="form-group">
										<label for="nombreU">Nombre de Usuario:</label>
										<input type="text" id="nombreU" class="form-control " autofocus="" required="" placeholder="Escribe el nombre">
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
									<div class="form-group">
										<label for="paternoU">Apellido Paterno:</label>
										<input type="text" id="paternoU" class="form-control " required="" placeholder="Escribe el apellido">
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
									<div class="form-group">
										<label for="maternoU">Apellido Materno:</label>
										<input type="text" id="maternoU" class="form-control " required="" placeholder="Escribe el apellido">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="direccionU">Dirección:</label>
										<input type="text" id="direccionU" class="form-control " required="" placeholder="Escribe la dirección completo">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="">Sexo:</label>
										<select  id="sexoU" class="select2 form-control" style="width: 100%">
											<option value="M">Masculino</option>
											<option value="F">Femenino</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="telefonoU">Teléfono:</label>
										<input type="text" id="telefonoU" class="form-control " required="" placeholder="Escribe el telefono">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="fecha_nacU">Fecha de Nacimiento:</label>
										<input type="date" id="fecha_nacU" class="form-control " required="" placeholder="yyyy-mm-dd">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="correoU">Correo:</label>
										<input type="text" id="correoU" class="form-control " required="" placeholder="email">
									</div>
								</div>

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