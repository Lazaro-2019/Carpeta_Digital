<?php   
    include("../conexion/conexion.php");
    include('../sesiones/verificar_sesion.php');

    $valor=$_POST["valor"];
    $id=$_POST["id"];

    $fecha=date("Y-m-d");
    $hora = date("H:m:s");

    $valor=($valor==0)?0:1;

    mysql_query("SET NAMES utf8");
    $insertar=mysql_query("UPDATE categorias SET
                                                activo='$valor',
                                                fecha_registro='$fecha',
                                                hora_registro='$hora',
                                                id_registro='1'
                                            WHERE id_categoria='$id'",$conexion)or die(mysql_error());
?>
                                
