<div class="row">
    <div class="col-xs-12- col-sm-12 col-md-12 col-lg-12">
        <button class="btn btn-login btn-block animated zoomIn" onclick="llenar_caja_categoria();">
            <!-- <i class="fas fa-undo"></i> -->
            <p>Regresar a índice de categorías</p>
        </button>
    </div>
</div>

<div class="row">
    <?php
        include('../conexion/conexion.php');
        include('../sesiones/verificar_sesion.php');	

        $idCategoria=$_POST["idCategoria"];

        mysql_query("SET NAMES utf8");
        $consulta2=mysql_query("SELECT DISTINCT
                                            anio
                                        FROM
                                            archivos
                                        WHERE archivos.activo=1 AND  id_categoria=$idCategoria
                                        ORDER BY
                                        anio DESC
                                        ",$conexion)or die (mysql_error());
        $n=1;
        while($row2=mysql_fetch_row($consulta2))
        {
            $anio=$row2[0];
    ?>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <div class="caja animated zoomIn">
                    <p class="anio">
                        <?php echo $anio; ?>
                    </p>
                    <a href="#"  onclick="llenar_preguntas_subcaja_1(
                                                                '<?php echo $idCategoria; ?>',
                                                                '<?php echo $anio; ?>'
                                                                )">
                        Ingresar
                    </a>
                </div>
            </div>
    <?php
        }
    ?>
</div>