<?php
	//se manda llamar la conexion
	include("../conexion/conexion.php");
	include('../sesiones/verificar_sesion.php');

	//Recibe variables de AJAX
	$pregunta = $_POST["pregunta"];
	$id_categoria = $_POST["categoria"];

	$fecha=date("Y-m-d"); 
	$hora=date ("H:i:s");

	mysql_query("SET NAMES utf8");
	$insertar = mysql_query("INSERT INTO preguntas 
											(
											pregunta,
											id_categoria,
											fecha_registro,
											hora_registro,
											activo
											)
										VALUES
											(
											'$pregunta',
											'$id_categoria',
											'$fecha',
											'$hora',
											'1'
											)
										",$conexion)or die(mysql_error());
?>