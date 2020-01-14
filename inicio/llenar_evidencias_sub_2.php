
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        <button class="btn btn-login btn-block animated zoomIn " onclick="llenar_preguntas_subcaja_2(
                                                                                                '<?php echo $idCategoria; ?>',
                                                                                                '<?php echo $anio; ?>')">
            <!-- <i class="fas fa-undo"></i> -->
            <i class="fas fa-angle-left " style="font-size:30px;"></i>
        </button>
    </div>
    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
        <button class="btn btn-login btn-block animated zoomIn" onclick="llenar_caja_anio();">
            <!-- <i class="fas fa-undo"></i> -->
            <p>Regresar a índice de años</p>
        </button>
    </div>
    
</div>
<div class="panel-group accordion accordion2 animated zoomIn" id="accor3" role="tablist">  
<?php
    include('../conexion/conexion.php');
    include('../sesiones/verificar_sesion.php');

    $idCategoria    =$_POST['idCategoria'];
    $pregunta2      =$_POST['idPregunta'];
    $anio2           =$_POST['anio'];
    
    mysql_query("SET NAMES utf8");
    $consulta5=mysql_query("SELECT DISTINCT
                                nombre_archivo,
                                anio
                                FROM
                                    archivos
                                WHERE
                                    id_categoria='$idCategoria' AND anio='$anio2' AND id_pregunta='$pregunta2'
                                    AND activo=1 
                                    ORDER BY nombre_archivo",$conexion)or die (mysql_error());
    

    for ($j=1; $row=mysql_fetch_row($consulta5) ; $j++) 
    { 
            $nombre_archivoSub=$row[0];
            $anioSub=$row[1];
?>
                          
            <div class="panel panel-color ">
                <div class="panel-heading " role="tab" id="<?php echo "head3".$j;?>">
                    <h4 class="panel-title ">
                        <a href="<?php echo "#coll3".$j;?>" data-toggle="collapse" data-parent="<?php echo "#accor3".$j;?>">
                            <?php echo $nombre_archivoSub; ?>
                        </a>				
                    </h4>
                </div>

                <div id="<?php echo "coll3".$j;?>" class="panel-collapse collapse ">
                    <div class="panel-body ">
                        <?php
                            $consulta3=mysql_query("SELECT 
                                                        id_archivo,
                                                        descripcion_archivo,
                                                        nombre_archivo,
                                                        anio
                                                        FROM
                                                            archivos
                                                        WHERE
                                                            id_categoria='$idCategoria' AND anio='$anio2' AND id_pregunta='$pregunta2'
                                                            AND activo=1
                                                            AND nombre_archivo='$nombre_archivoSub'  
                                                            ORDER BY nombre_archivo");
                            for ($n=1; $row=mysql_fetch_row($consulta3) ; $n++) 
                            { 
                                $id_archivo=$row[0];
                                $descripcion=$row[1];
                                $nombre=$row[2];
                                $anio=$row[3];

                                $archivo ='../docs/'.$id_archivo.'.pdf';
                                if (file_exists($archivo))
                                {
                                    $Icono="<i class='far fa-file-pdf fa-lg fa-2x'></i>";
                                    $doc=$archivo;
                                }
                                else{
                                    $Icono="<h5>No se ha subido ningun archivo</h5>";
                                }
                        ?>
                                <!-- <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="caja" id="<?php echo $n;?>">
                                            <p class="enlaceIcono"><?php echo $Icono; ?></p>
                                        <p>
                                            <br>
                                            <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $nombre;?>" href="javascript:abrilModalVBtesina('<?php echo $id_archivo; ?>','<?php echo $descripcion;?>','<?php echo $nombre;?>','<?php echo $anio;?>')">Mostrar</a>

                                        </p>
                                    </div>
                                </div> -->

                                <div class="col-lg-3 col-md-6">
                                    <div class="panel colorArchivo textoPanel2">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class=""><?php echo $Icono; ?></i>
                                                </div>
                                                <div class="col-xs-11 text-right textoPanel">
                                                    <!-- <div class="huge">26</div> -->
                                                    <div><?php echo $descripcion; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $nombre;?>" href="javascript:abrilModalVBtesina('<?php echo $id_archivo; ?>','<?php echo $descripcion;?>','<?php echo $nombre;?>','<?php echo $anio;?>')">
                                            <div class="panel-footer colorArchivo_base">
                                                <span class="pull-left">Mostrar</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                
            </div>
    
        
<?php
    }
    ?>

    </div>
<script>

			$('[data-toggle="tooltip"]').tooltip()
	
</script>