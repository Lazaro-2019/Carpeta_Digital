<?php 
	include("../conexion/conexion.php");
	include('../sesiones/verificar_sesion.php');
	$idUsuario=$_SESSION["idUsuario"];
	$categoria=$_SESSION["idCategoria"];
	$tUsuario=$_SESSION["user_tipo"];
	mysql_query("SET NAMES utf8");
	if ($tUsuario=='Administrador') {
		$consulta = mysql_query("SELECT
									id_categoria,
									nombre_categoria 
								FROM categorias
								WHERE activo=1",$conexion)or die(mysql_error());
	}
	else {
		$consulta = mysql_query("SELECT
									id_categoria,
									nombre_categoria 
								FROM categorias
								INNER JOIN usuarios ON usuarios.idCategoria=categorias.id_categoria
								AND usuarios.idCategoria='$categoria'
								WHERE categorias.activo=1",$conexion)or die(mysql_error());
	}
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
	$("#categoriaE").select2();
</script>