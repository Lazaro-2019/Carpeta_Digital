<div class="row">
    <?php
        include('../conexion/conexion.php');
        include('../sesiones/verificar_sesion.php');	
    
        mysql_query("SET NAMES utf8");
        $consulta2=mysql_query("SELECT DISTINCT
                                            anio
                                        FROM
                                            archivos
                                        WHERE archivos.activo=1
                                        ORDER BY anio DESC",$conexion)or die (mysql_error());
        $n=1;
        while($row2=mysql_fetch_row($consulta2))
        {
            $anio=$row2[0];
    ?>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
            <div class="caja animated zoomIn">
                <p class="anio">
                    <?php echo $anio; ?>
                </p>
                <a href="#"  onclick="llenar_caja_categoria_sub(<?php echo $anio;?>)">
                    Ingresar
                </a>
            </div>
        </div>
    <?php
        }
    ?>
</div>