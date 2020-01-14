<?php
    //se manda llamar la conexion
    include("../conexion/conexion.php");
    include('../sesiones/verificar_sesion.php');
    
    $nombrecategoriaE   =$_POST["categoriaE"];
    $nombreE            =$_POST["nombreE"];
    $descripcionE       =$_POST["descripcionE"];
    $preguntaE          =$_POST["preguntaE"];
    $idE                =$_POST["idE"];
    $anio               =$_POST["anio"];

    $fecha=date("Y-m-d");
    $hora=date("H:i:s");

    mysql_query("SET NAMES utf8");
    $insertar=mysql_query("UPDATE archivos SET
                                            nombre_archivo='$nombreE',
                                            descripcion_archivo='$descripcionE',
                                            id_categoria='$nombrecategoriaE',
                                            id_pregunta='$preguntaE',
                                            fecha_registro='$fecha',
                                            hora_registro='$hora',
                                            anio=$anio
                                        WHERE id_archivo='$idE'",$conexion)or die(mysql_error());
?>