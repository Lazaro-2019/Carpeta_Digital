<?php 
	// Conexion a la base de datos
	include('../conexion/conexion.php');
	include('../sesiones/verificar_sesion.php');

	include('../funcionesPHP/filtroUsuario.php');
	$tUsuario=$_SESSION["user_tipo"];
	userE($tUsuario);
	// Codificacion de lenguaje
	mysql_query("SET NAMES utf8");
	$idUsuario=$_SESSION["idUsuario"];
	$categoria=$_SESSION["idCategoria"];
	$tUsuario=$_SESSION["user_tipo"];

	if ($tUsuario=='Administrador') {
		// Consulta a la base de datos
		$consulta=mysql_query("SELECT 
									id_pregunta,
									pregunta,
									(SELECT id_categoria FROM categorias WHERE categorias.id_categoria=preguntas.id_categoria) AS id_catego,
									(SELECT nombre_categoria FROM categorias WHERE preguntas.id_categoria=categorias.id_categoria) AS categoria,
									fecha_registro,
									hora_registro,
									activo
									FROM preguntas",$conexion) or die (mysql_error());
	}
	else {
		$consulta=mysql_query("SELECT DISTINCT
									id_pregunta,
									pregunta,
									(SELECT id_categoria FROM categorias WHERE categorias.id_categoria=preguntas.id_categoria) AS id_catego,
									(SELECT nombre_categoria FROM categorias WHERE preguntas.id_categoria=categorias.id_categoria) AS categoria,
									preguntas.fecha_registro,
									preguntas.hora_registro,
									preguntas.activo
									FROM preguntas
									INNER JOIN usuarios ON usuarios.idCategoria=preguntas.id_categoria
									AND usuarios.idCategoria='$categoria' ",$conexion) or die (mysql_error());
	}


// $row=mysql_fetch_row($consulta)
 ?>
			<div class="table-responsive">
				<table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

					<thead align="center">
						<tr class="info" >
						<th>#</th>
						<th>Pregunta</th>
						<th>Categoría</th>
						<th>Fecha de Registro</th>
						<th>Hora de Registro</th>
						<th>Editar</th>
						<th>Estatus</th>
						</tr>
					</thead>

					<tbody align="center">
						<?php 
							$n=1;
							while ($row=mysql_fetch_row($consulta)) 
							{
								$id_pregunta          = $row[0];
								$pregunta			  = $row[1];
								$id_catego			  = $row[2];
								$categoria            = $row[3];
								$fecha_registro 	  = $row[4];
								$hora_registro        = $row[5];
								$activo         	  = $row[6]; 
								
								$checado           = ($activo == 1)?'checked' : '';		
								$desabilitar       = ($activo == 0)?'disabled': '';
								$claseDesabilita   = ($activo == 0)?'desabilita':'';
						?>
								<tr>
									<td >
										<p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo "$n"; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tPregunta".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo $pregunta; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tCategoria".$n; ?>" class="<?php echo $claseDesabilita; ?>">
											<?php echo $categoria; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tFecha".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
											<?php echo $fecha_registro; ?>
										</p>
									</td>
									<td>
										<p id="<?php echo "tHora".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
											<?php echo $hora_registro; ?>
										</p>
									</td>	
									<td>
										<button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
										onclick="abrirModalEditar(
																'<?php echo $id_pregunta ?>',
																'<?php echo $id_catego ?>',
																'<?php echo $pregunta ?>'
																);">
										<i class="far fa-edit"></i>
										</button>
									</td>
									<td>
										<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $id_pregunta; ?>);">
									</td>
								</tr>
						<?php
							$n++;
							}
						?>
					</tbody>
					<tfoot align="center">
						<tr class="info" >
							<th>#</th>
							<th class="text-center">Pregunta</th>
							<th>Categoría</th>
							<th>Fecha de Registro</th>
							<th>Hora de Registro</th>
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
                              text: 'Nueva Pregunta',
                              action: function (  ) {
							  ver_alta();
							  llenar_categoria();
							  llenar_categoriaE();
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