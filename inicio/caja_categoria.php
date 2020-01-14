<div class="row">
    <?php
        include('../conexion/conexion.php');
        include('../sesiones/verificar_sesion.php');	
    
        mysql_query("SET NAMES utf8");
        $consulta=mysql_query("SELECT
                                    categorias.id_categoria,
                                    nombre_categoria,
                                    ico_categoria,
                                    categorias.fecha_registro,
                                    categorias.hora_registro,
                                    categorias.activo
                                FROM
                                    archivos
                                    INNER JOIN categorias ON archivos.id_categoria=categorias.id_categoria
                                WHERE
                                    categorias.activo = 1
                                GROUP BY nombre_categoria
                                ORDER BY nombre_categoria",$conexion)or die (mysql_error());
        $n=1;
        while($row=mysql_fetch_row($consulta))
        {
            $idcategoria=$row[0];
            $nombrecatego=$row[1];
            $icono=$row[2];
            $fecha=$row[3];
            $hora=$row[4];
            $activo=$row[5];
    ?>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
            <div class="caja animated zoomIn">
                <p>
                    <i class="<?php echo $icono; ?>"></i>
                </p>
                <br>
                <a href="#"  onclick="llenar_caja_anio_sub(<?php echo $idcategoria; ?>)">
                    <?php echo $nombrecatego; ?>
                </a>
            </div>
        </div>
    <?php
        }
    ?>
</div>