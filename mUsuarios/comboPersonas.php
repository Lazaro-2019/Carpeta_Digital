<?php
	include("../conexion/conexion.php");
	// include('../sesiones/verificar_sesion.php');

	mysql_query("SET NAMES utf8");

	$consulta = mysql_query("SELECT
										personas.id_persona,
										CONCAT(personas.ap_paterno,' ',personas.ap_materno,' ',personas.nombre) AS 	Persona
											FROM personas 
											
											WHERE personas.activo =1 	
											ORDER BY ap_materno ASC",$conexion)or die(mysql_error());
?>
    <option value="0">Seleccione...</option>

<?php
	while($row = mysql_fetch_row($consulta))
	{  
?>
	<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>

<?php
	}
?>

<script>
	$("#idPersona").select2();
</script>