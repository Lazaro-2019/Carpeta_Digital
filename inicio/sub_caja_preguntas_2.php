
<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        <button class="btn btn-login btn-block animated zoomIn " onclick="llenar_caja_categoria_sub(
                                                                                                
                                                                                                '<?php echo $anio; ?>')
                                                                                                ">
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
<?php
    include('../conexion/conexion.php');
    include('../sesiones/verificar_sesion.php');

    $idCategoria    =$_POST['idCategoria'];
    $anio           =$_POST['anio'];

    mysql_query("SET NAMES utf8");
    $consulta4=mysql_query("SELECT DISTINCT
                       
                                        preguntas.id_pregunta,
                                        preguntas.pregunta,
                                        categorias.ico_categoria
                                        FROM
                                        preguntas
                                        INNER JOIN archivos ON archivos.id_pregunta = preguntas.id_pregunta 
                                        AND archivos.anio = '$anio' AND archivos.id_categoria = '$idCategoria' 
                                        AND preguntas.activo=1
                                        INNER JOIN categorias ON categorias.id_categoria=preguntas.id_categoria",$conexion)or die (mysql_error());
    

    for ($j=1; $row=mysql_fetch_row($consulta4) ; $j++) 
    { 
            $id_pregunta=$row[0];
            $pregunta=$row[1];
            $icono=$row[2];

?>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
            <div class="caja2 animated zoomIn">
                <!-- <p>
                    <i class="<?php echo $icono; ?>"></i>
                </p> -->
                <br>
                <br>
                <a href="#" class="caja2"  onclick="llenar_evidencias_sub_2(
                                                        '<?php echo $idCategoria; ?>',
                                                        '<?php echo $id_pregunta;?>',
                                                        '<?php echo $anio;?>')">
                <?php echo $pregunta; ?>
                </a>
            </div>
        </div>
<?php
    }
?>

<!-- <script>

			$('[data-toggle="tooltip"]').tooltip()
	
</script> -->