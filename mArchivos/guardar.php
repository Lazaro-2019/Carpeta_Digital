<?php
	//se manda llamar la conexion
	include("../conexion/conexion.php");
	include('../sesiones/verificar_sesion.php');

	//Recibe variables de AJAX
	$id_categoria	= $_POST["categoria"];
	$nombre			= $_POST["nombre"];
	$descripcion	= $_POST["descripcion"];
	$pregunta		= $_POST["pregunta"];
	$anio			= $_POST["anio"];

	$fecha=date("Y-m-d"); 
	$hora=date ("H:i:s");

	mysql_query("SET NAMES utf8");
	$insertar = mysql_query("INSERT INTO archivos 
												(
												nombre_archivo,
												descripcion_archivo,
												id_categoria,
												id_pregunta,
												fecha_registro,
												hora_registro,
												anio,
												activo
												)
											VALUES
												(
												'$nombre',
												'$descripcion',
												'$id_categoria',
												'$pregunta',
												'$fecha',
												'$hora',
												'$anio',
												'1'
												)
											",$conexion)or die(mysql_error());
?>