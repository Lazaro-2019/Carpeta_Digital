<?php 
	// Conexion a la base de datos
	include('../conexion/conexion.php');

	include('../sesiones/verificar_sesion.php');
	$idUsuario=$_SESSION["idUsuario"];

	include('../funcionesPHP/filtroUsuario.php');
	$tUsuario=$_SESSION["user_tipo"];
	userE($tUsuario);
	
	
	// Codificacion de lenguaje
	mysql_query("SET NAMES utf8");

	if ($tUsuario=='Administrador') {
		$consulta=mysql_query("SELECT 
								id_archivo,
								nombre_archivo,
								descripcion_archivo,
								archivos.id_categoria,
								archivos.fecha_registro,
								archivos.hora_registro,
								archivos.anio,
								archivos.activo,
								archivos.id_pregunta,
								categorias.nombre_categoria,
								preguntas.pregunta
							FROM archivos INNER JOIN categorias ON categorias.id_categoria=archivos.id_categoria
							INNER JOIN preguntas ON preguntas.id_pregunta=archivos.id_pregunta
							ORDER BY nombre_archivo DESC",$conexion) or die (mysql_error());
	}
	else {
			// Consulta a la base de datos
	$consulta=mysql_query("SELECT
								id_archivo,
								nombre_archivo,
								descripcion_archivo,
								archivos.id_categoria,
								archivos.fecha_registro,
								archivos.hora_registro,
								archivos.anio,
								archivos.activo,
								archivos.id_pregunta,
								categorias.nombre_categoria,
								preguntas.pregunta
							FROM
								archivos
							INNER JOIN categorias ON categorias.id_categoria = archivos.id_categoria
							INNER JOIN preguntas ON preguntas.id_pregunta = archivos.id_pregunta
							INNER JOIN usuarios ON usuarios.id_usuario = '$idUsuario' 
							AND usuarios.idCategoria=archivos.id_categoria
							ORDER BY nombre_archivo DESC
							",$conexion) or die (mysql_error());
	}


	// $row=mysql_fetch_row($consulta)
 ?>
	    <div class="table-responsive">
	        <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">
	            <thead align="center">
	              <tr class="info" >
	                <th>#</th>
	                <th>Nombre</th>
	                <th>Descripción</th>
					<th>Categoría</th>
					<th>Pregunta</th>
					<th>Año</th>
	                <th>Ver</th>
	                <th>Subir</th>
					<th>Editar</th>
	                <th>Status</th>
	              </tr>
	            </thead>
	            <tbody align="center">
		            <?php 
			            $n=1;
			            while ($row=mysql_fetch_row($consulta)) 
			            {
							$id_archivo				= $row[0];
							$nombre_archivo			= $row[1];
							$descripcion_archivo	= $row[2];
							$id_categoria			= $row[3];
							$fecha_registro         = $row[4];
							$hora_registro			= $row[5];
							$anio					= $row[6]; 
							$activo					= $row[7];
							$pregunta				= $row[8];
							$nombre_catego			= $row[9];
							$preguntaN				= $row[10];

							$checado           = ($activo == 1)?'checked'   : '';		
							$desabilitar       = ($activo == 0)?'disabled'  : '';
							$claseDesabilita   = ($activo == 0)?'desabilita': '';
							
							$archivo ='../docs/'.$id_archivo.'.pdf';
							if (file_exists($archivo))
							{
								$Icono="<i class='fas fa-check-circle fa-lg'></i>";
								$doc=$archivo;
						 	}
							else
							{
								$Icono="<i class='fas fa-times-circle fa-lg'></i>";
							}
					?>
			            <tr>
			                <td>
			                  <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  	<?php echo "$n"; ?>
			                  </p>
			                </td>
			                <td>
								<p id="<?php echo "tNombre".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  		<?php echo $nombre_archivo; ?>
			                	</p>
			                </td>
			                <td>
								<p id="<?php echo "tDescripcion".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  		<?php echo $descripcion_archivo; ?>
			                	</p>
			                </td>
							<td>
								<p id="<?php echo "tCatego".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  		<?php echo $nombre_catego; ?>
			                	</p>
							</td>
							<td>
								<p id="<?php echo "tPregunta".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  		<?php echo $preguntaN; ?>
			                	</p>
			                </td>
							<td>
								<p id="<?php echo "tAnio".$n; ?>" class="<?php echo $claseDesabilita; ?>">
			                  		<?php echo $anio; ?>
			                	</p>
			                </td>
 							<td>
								<a class="sb btn btn-login btn-sm" id="<?php echo "tIcono".$n;?>" <?php echo $claseDesabilita ?> href="javascript:abrilModalVBtesina('<?php echo $id_archivo; ?>','<?php echo $descripcion_archivo;?>','<?php echo $nombre_archivo;?>')" title="<?php echo $id_archivo ?>" >
									<?php echo $Icono ?>		
								</a>
			                </td>
							<td>
								<button class="btn btn-login btn-sm"  id="<?php echo "tSubir".$n;?>" <?php echo $desabilitar ?> onclick="abrirModalSubir('<?php echo $id_archivo ?> ')">
									<i class="fas fa-upload"></i>
								</button>
			                </td>
							<td>
								<button id="<?php echo "boton".$n;?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm"
								onclick="abrirModalEditar(
														'<?php echo $id_archivo ?>',

														'<?php echo $id_categoria ?>',

														'<?php echo $nombre_archivo ?>',

														'<?php echo $descripcion_archivo ?>',
														
														'<?php echo $pregunta ?>',

														'<?php echo $anio ?>'
														);">
								<i class="far fa-edit"></i>
								</button>
							</td>
							<td>
								<input data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado";?> id="<?php echo "interruptor".$n;?>" data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $id_archivo;?>);">
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
	                <th>Descripción</th>
					<th>Categoría</th>
					<th>Pregunta</th>
					<th>Año</th>
	                <th>Ver</th>
	                <th>Subir</th>
					<th>Editar</th>
	                <th>Status</th>
	              </tr>
	            </tfoot>
	        </table>
	    </div>
			
	<script type="text/javascript">
		$(document).ready(
			function() 
			{
				$('#example1').DataTable
				({
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
					lengthMenu: 
					[
						[ 10, 25, 50, -1 ],
						[ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
					],
					columnDefs: 
					[{
						// targets: 0,
						// visible: false
					}],
					buttons: 
					[
						{
							extend: 'pageLength',
							text: 'Registros',
							className: 'btn btn-default'
						},
						{
							text:'Nuevo Archivo',
							action:function( )
							{
								ver_alta();
								llenar_categoria();
								llenar_pregunta();
								limpiarAlta();
							},
							counter: 1
						},
					]
				});
			});
	</script>
	<script>
		$(".interruptor").bootstrapToggle('destroy');
		$(".interruptor").bootstrapToggle();
	</script>

<script>
	$("#archivo").fileinput
	({
		theme: 'fas',
		language: 'es',
		showUpload: true,
		showCaption: true,
		showCancel: false,
		showRemove: true,
		browseClass: "btn btn-login",
		fileType: "pdf, docx, xlsx, pptx",
		allowedFileExtensions: ['pdf','docx','xlsx','pptx'],
		overwriteInitial: false,
		maxFileSize: 1000000000,
		maxFilesNum: 10
	});
</script>
