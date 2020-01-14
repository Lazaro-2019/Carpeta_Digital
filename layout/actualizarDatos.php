<?php
//se manda llamar la conexion
include("../conexion/conexion.php");

$idPersona  = $_POST["idPersona"];
$nombre     = $_POST["nombre"];
$appaterno  = $_POST["appaterno"];
$apmaterno  = $_POST["apmaterno"];
$direccion  = $_POST["direccion"];
$sexo       = $_POST["sexo"];
$telefono   = $_POST["telefono"];
$fecha_nac  = $_POST["fecha_nac"];
$correo     = $_POST["correo"];


mysql_query("SET NAMES utf8");
$insertar = mysql_query("UPDATE personas SET
											nombre              ='$nombre',
                                            ap_paterno          ='$appaterno',
                                            ap_materno          ='$apmaterno',
                                            sexo                ='$sexo',
                                            direccion           ='$direccion',
                                            telefono            ='$telefono',
                                            fecha_nacimiento    ='$fecha_nac',
                                            correo              ='$correo'

										WHERE id_persona='$idPersona'
										",$conexion)or die(mysql_error());
