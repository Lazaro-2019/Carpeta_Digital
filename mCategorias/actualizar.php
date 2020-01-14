<?php
    //se manda llamar la conexion
    include("../conexion/conexion.php");
    include('../sesiones/verificar_sesion.php');
    
    $nombrecategoria=$_POST["categoria"];
    $icono=$_POST["icono"];
    $ide=$_POST["id"];

    $fecha=date("Y-m-d");
    $hora=date("H:i:s");

    mysql_query("SET NAMES utf8");
    $insertar=mysql_query("UPDATE categorias SET
                                                nombre_categoria='$nombrecategoria',
                                                ico_categoria='$icono',
                                                fecha_registro='$fecha',
                                                hora_registro='$hora',
                                                id_registro='1'
                                            WHERE id_categoria='$ide'",$conexion)or die(mysql_error());
?>