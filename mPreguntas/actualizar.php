<?php
//se manda llamar la conexion
include("../conexion/conexion.php");
include('../sesiones/verificar_sesion.php');

//RECIBE VARIABLES AJAX
$pregunta		= $_POST["preguntaE"];
$id_categoria	= $_POST["categoriaE"];
$ide			= $_POST["ide"];

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

mysql_query("SET NAMES utf8");
$insertar = mysql_query("UPDATE preguntas SET  
											pregunta='$pregunta',
											id_categoria='$id_categoria',
											fecha_registro='$fecha',
											hora_registro='$hora' 								
										WHERE id_pregunta='$ide'
									",$conexion)or die(mysql_error());

?>