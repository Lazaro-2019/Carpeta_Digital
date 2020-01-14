<?php 
	include("../conexion/conexion.php");
	// include('../sesiones/verificar_sesion.php');

	mysql_query("SET NAMES utf8");
	$consulta = mysql_query("SELECT
							id_categoria,
							nombre_categoria from categorias WHERE activo=1",$conexion)or die(mysql_error());
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
	$("#categoriaUser").select2();
</script>