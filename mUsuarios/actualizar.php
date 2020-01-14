<?php
	//se manda llamar la conexion
	include("../conexion/conexion.php");
	// include('../sesiones/verificar_sesion.php');
	
	// $contraMD5=md5($contra);
	$ide     = $_POST["ide"];
	$tipo	= $_POST["tipoE"];
	$idCategoria =$_POST["areaE"];


	// $contra  = trim($contra);

	$fecha   = date("Y-m-d"); 
	$hora    = date ("H:i:s");

	mysql_query("SET NAMES utf8");
	$insertar = mysql_query("UPDATE usuarios SET
												usuario='$usuario',
												id_registro='1',
												fecha_registro='$fecha',
												hora_registro='$hora',
												tipo_usuario='$tipo',
												idCategoria='$idCategoria'
											WHERE id_usuario='$ide'
												",$conexion)or die(mysql_error());
?>