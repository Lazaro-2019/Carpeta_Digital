<?php 
	include("../conexion/conexion.php");
	include('../sesiones/verificar_sesion.php');

	//se recibe el id de ajax
	$categoria=$_POST["id_categoria"];

	mysql_query("SET NAMES utf8");
	$consulta = mysql_query("SELECT
									id_pregunta,
									pregunta
								from preguntas INNER JOIN categorias 
								ON preguntas.id_categoria = categorias.id_categoria  
								WHERE preguntas.activo=1 
								AND preguntas.id_categoria= '$categoria'
								",$conexion)or die(mysql_error());
?>
	<option value="0">Seleccione...</option>
<?php 
	while ($row=mysql_fetch_row($consulta))
	{
		?>	
			<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
		<?php 
	}
?> 
<script>
	$("#preguntaE").select2();
</script>