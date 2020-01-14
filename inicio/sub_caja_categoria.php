<div class="row">
    <div class="col-xs-12- col-sm-12 col-md-12 col-lg-12">
        <button class="btn btn-login btn-block animated zoomIn" onclick="llenar_caja_anio();">
            <!-- <i class="fas fa-undo"></i> -->
            <p>Regresar a índice de años</p>
        </button>
    </div>
</div>

<div class="row">
    <?php
        include('../conexion/conexion.php');
        include('../sesiones/verificar_sesion.php');	

        $anio=$_POST["anio"];

        mysql_query("SET NAMES utf8");
        $consulta3=mysql_query("SELECT DISTINCT
                                    categorias.id_categoria,
                                    categorias.nombre_categoria,
                                    categorias.ico_categoria
                                FROM
                                    categorias INNER JOIN archivos
                                on
                                    categorias.activo = 1 
                                AND archivos.anio='$anio' 
                                AND archivos.id_categoria=categorias.id_categoria
                                ORDER BY nombre_categoria
                                ",$conexion)or die (mysql_error());
        $n=1;
        while($row2=mysql_fetch_row($consulta3))
        {
            $idcategoria=$row2[0];
            $nombrecatego=$row2[1];
            $icono=$row2[2];
    ?>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
            <div class="caja animated zoomIn">   
                <p>
                    <i class="<?php echo $icono; ?>"></i>
                </p>
                <br>
                <a href="#"  onclick="llenar_preguntas_subcaja_2(
                                                            '<?php echo $idcategoria; ?>',
                                                            '<?php echo $anio;?>'
                                                            )">
                    <?php echo $nombrecatego; ?>
                </a>
            </div>
        </div>
    <?php
        }
    ?>
</div>