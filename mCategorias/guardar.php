<?php
    //se manda llamar la conexion
    include("../conexion/conexion.php");
    include('../sesiones/verificar_sesion.php');

    $nomcategoria=$_POST["categoria"];
    $icono=$_POST["icono"];

    $fecha=date("Y-m-d");
    $hora=date("H:i:s");

    mysql_query("SET NAMES utf8");
    $insertar=mysql_query("INSERT INTO categorias
                                                (
                                                    nombre_categoria,
                                                    ico_categoria,
                                                    id_registro,
                                                    fecha_registro,
                                                    hora_registro,
                                                    activo
                                                )
                                                VALUES
                                                (
                                                    '$nomcategoria',
                                                    '$icono',
                                                    '1',
                                                    '$fecha',
                                                    '$hora',
                                                    '1'
                                                )",$conexion)or die(mysql_error());
?>