<?php 
// Conexion a la base de datos
include('../conexion/conexion.php');
include('../sesiones/verificar_sesion.php');

include('../funcionesPHP/filtroUsuario.php');
$tUsuario=$_SESSION["user_tipo"];
userA($tUsuario);

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta7=mysql_query("SELECT
							usuarios.id_usuario,
							usuarios.id_persona,
							usuarios.usuario,
							usuarios.activo,
							(SELECT personas.nombre FROM personas WHERE personas.id_persona=usuarios.id_persona) AS nUsuario,
							(SELECT personas.ap_paterno FROM personas WHERE personas.id_persona=usuarios.id_persona) AS pUsuario,
							(SELECT personas.ap_materno FROM personas WHERE personas.id_persona=usuarios.id_persona) AS mUsuario,
							usuarios.fecha_registro,
							usuarios.contra,
							usuarios.tipo_usuario,
							usuarios.idCategoria,
							personas.activo
						FROM
							usuarios INNER JOIN personas ON personas.id_persona=usuarios.id_persona
							
							",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
			<div class="table-responsive">
				<table id="example1" class="table table-responsive table-condensed table-bordered table-striped">
					<thead align="center">
						<tr class="info" >
							<th>#</th>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Registro</th>
							<th>Restaurar</th>
							<th>Editar</th>
							<th>Estatus</th>
						</tr>
					</thead>

					<tbody align="center">
						<?php 
							$n=1;
							while ($row=mysql_fetch_row($consulta7)) 
							{
								$User8_idUsuario    = $row[0];
								$activo             = $row[3];
								$nomUsuarioCompleto = $row[5].' '.$row[6].' '.$row[4];
								$idPersona          = $row[1];
								$usuario            = $row[2];
								$registro           = $row[7];
								$contra             = $row[8];
								$tipo				= $row[9];
								$idCategoria		= $row[10];
								$personaActivo		= $row[11];

								$checado         = ($activo == 1)?'checked' : '';		
								$desabilitar     = ($activo == 0)?'disabled': '';
								$claseDesabilita = ($activo == 0)?'desabilita':'';
						?>
								<tr>
									<td >
										<p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo "$n"; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tNcompleto".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo $nomUsuarioCompleto; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tUsuario".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo $usuario; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tRegistro".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
											<?php echo $registro; ?>
										</p>
									</td>	
									<td>
										<button id="<?php echo "botonR".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
										onclick="restaurarContra(
																'<?php echo $User8_idUsuario; ?>'
																);">
										<i class="fas fa-sync-alt"></i>
										</button>
									</td>
									<td>
										<button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
										onclick="abrirModalEditar(
																'<?php echo $User8_idUsuario;  ?>',
																'<?php echo $idPersona; ?>',
																'<?php echo $usuario; ?>',
																'<?php echo $tipo; ?>',
																'<?php echo $idCategoria; ?>'
																);">
										<i class="far fa-edit"></i>
										</button>
									</td>
									<td>
										<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $User8_idUsuario; ?>);">
									</td>
								</tr>
						<?php
							$n++;
							}
						?>
					</tbody>
					<tfoot align="center">
						<tr class="info">
							<th>#</th>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Registro</th>
							<th>Restaurar</th>
							<th>Editar</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>
			
      <script type="text/javascript">
        $(document).ready(function() {
              $('#example1').DataTable( {
                 "language": {
                         // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                          "url": "../plugins/datatables/langauge/Spanish.json"
                      },
                 "order": [[ 0, "asc" ]],
                 "paging":   true,
                 "ordering": true,
                 "info":     true,
                 "responsive": true,
                 "searching": true,
                 stateSave: false,
                  dom: 'Bfrtip',
                  lengthMenu: [
                      [ 10, 25, 50, -1 ],
                      [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                  ],
                 columnDefs: [ {
                      // targets: 0,
                      // visible: false
                  }],
                  buttons: [
                            {
                                extend: 'pageLength',
                                text: 'Registros',
                                className: 'btn btn-default'
                            },

                         {
                              text: 'Nuevo Usuario',
                              action: function (  ) {
									ver_alta();
									llenar_persona();
                              },
                              counter: 1
                          },
                  ]
              } );
          } );

      </script>
      <script>
            $(".interruptor").bootstrapToggle('destroy');
            $(".interruptor").bootstrapToggle();
      </script>
    
    
