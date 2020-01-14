<?php 
    include'../conexion/conexion.php'; 
    include'../funcionesPHP/fechaEspanol.php'; 
    include'../funcionesPHP/calcularEdad.php';

    // $Id=$_GET['id'];
    // $idDatos=$_GET['datos'];
            
    mysql_query("SET NAMES utf8");
    $consulta=mysql_query("SELECT
                            nombre_categoria,
                            ico_categoria,
                            fecha_registro,
                            hora_registro
                            FROM
                            categorias WHERE activo=1",$conexion) or die (mysql_error());
    
    //Descargamos el arreglo que arroja la consulta
    $n=1;
    // $row=mysql_fetch_row($consulta);

    $fecha=date("Y-m-d"); 
    $fechaEspanol=fechaCastellano($fecha);

 ?>

<!-- Inicio Estilo del reporte -->
<style type="text/css">

    table
    {
        width:  90%;
        margin:auto;
    }

    td.borde
    {
        text-align: center;
        border: solid 1px #D8D8D8;
        padding: 2px;
        text-align: center;
    }

    td.titular
    {
        text-align: center;
        border: solid 1px #34495e;
        background: #ecf0f1;
        color:#34495e;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 11px;
        font-size:12px;
    }

    p.parrafo
    {
        border: solid 1px #34495e;
        color:#34495e;
        font-size:12px;
        margin:5px;
        padding:0px 0px 5px 0px;  
    }

    td.encabezado
    {
        text-align: center;
        color:#34495e;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 11px;
        font-size:15px;
        border: solid 1px #D8D8D8;
    }

    td.fecha
    {
        text-align: right;
        border: solid 0px #34495e;
        background: #ffffff;
        color:#34495e;
        letter-spacing: 3px;
        padding: 18px;
    }

    img{
        width: 100%;
    }

</style>
<!-- Fin Estilo del reporte -->

<table border="0">
    <col style="width: 100%" class="col1">

    <tr>
        <td>
        <img src="../img/encabezado.jpg" alt="">
        </td>
    </tr>

</table>

<table border="0">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <!-- defino el ancho de la tabla -->
    <tr border="0">
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr >
        <td  colspan="10" class="encabezado">
            LISTA DE CATEGORIAS
        </td>
    </tr> 
    <tr >
        <td  colspan="1" class="titular">
            #
        </td>
        <td  colspan="3" class="titular">
            Nombre de la categoria
        </td>
        <td  colspan="2" class="titular">
            Icono
        </td>
        <td  colspan="3" class="titular">
            Fecha
        </td>
        <td  colspan="2" class="titular">
            Hora
        </td>
    </tr>

    <?php
        $n=1;
        while($row=mysql_fetch_row($consulta)){
            $nombre  = $row[0];
            $icono  = $row[1];
            $fecha = $row[2];
            $hora    = $row[3];
    ?>
        <tr >
            <td  colspan="1" class="borde">
                <p class="parrafo">
                    <?php echo $n; ?>
                </p>
            </td>
            <td  colspan="3" class="borde">
                <p class="parrafo">
                    <?php echo $nombre; ?>
                </p>
            </td>
            <td  colspan="2" class="borde">
                <p class="parrafo">
                    <?php echo $icono; ?>
                </p>
            </td>
            <td  colspan="3" class="borde">
                <p class="parrafo">
                    <?php echo $fecha; ?>
                </p>
            </td>
            <td  colspan="2" class="borde">
                <p class="parrafo">
                    <?php echo $hora; ?>
                </p>
            </td>
        </tr>
    <?php 
        $n++;
        }
    ?>
 

</table>

<table>
<col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <!-- defino el ancho de la tabla -->
    <tr border="0">
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr >
        <td  colspan="10" class="fecha">
            <strong><?php echo "$fechaEspanol"; ?></strong>
        </td>
    </tr> 
    <tr>
        <td  colspan="10" align="center">
            <hr>
        </td>
    </tr>
</table>