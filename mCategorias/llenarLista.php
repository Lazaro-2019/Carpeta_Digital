<?php
    //conexion a la base de datos

    include('../conexion/conexion.php');

    include('../sesiones/verificar_sesion.php');
    include('../funcionesPHP/filtroArchivo.php');
    
    $tUsuario=$_SESSION["user_tipo"];
    userE($tUsuario);


    //Codificacion del lenguaje
    mysql_query("SET NAMES utf8");

    //Consulta a la base de datos
    $consulta=mysql_query("SELECT
                                    id_categoria,
                                    nombre_categoria,
                                    ico_categoria,
                                    fecha_registro,
                                    hora_registro,
                                    activo
                                    FROM
                                    categorias",$conexion)or die (mysql_error());
?>

    <div class="table-responsive">
        <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">
            <thead align="center">
                <tr class="info">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Icono</th>
                    <th>Fecha de Registro</th>
                    <th>Hora de Registro</th>
                    <th>Editar</th>
                    <th>Estatus</th>
                </tr>
            </thead>

            <tbody align="center">
                <?php
                    $n=1;
                    while($row=mysql_fetch_row($consulta))
                    {
                        $idcategoria=$row[0];
                        $nombrecatego=$row[1];
                        $icono=$row[2];
                        $fecha=$row[3];
                        $hora=$row[4];
                        $activo=$row[5];

                        $checado=($activo ==1)?'checked' : '';
                        $desabilitar=($activo==0)?'disabled' : '';
                        $claseDesabilita=($activo==0)?'desabilita' : '';
                ?>
                        <tr>
                            <td>
                                <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita;?>">
                                <?php echo "$n"; ?>
                                </p>
                            </td>
                            <td>
                                <p id="<?php echo "tCatego".$n;?>" class="<?php echo $claseDesabilita; ?>">
                                    <?php echo $nombrecatego; ?>
                                </p>
                            </td>
                            <td>
                                <p id="<?php echo "tIcono".$n;?>" class="<?php echo $claseDesabilita; ?>">
                                <i class="<?php echo $icono; ?>"></i>
                                </p>
                            </td>
                            <td>
                                <p id="<?php echo "tFecha".$n; ?>" class="<?php echo $claseDesabilita; ?>">
                                    <?php echo $fecha; ?>
                                </p>
                            </td>
                            <td>
                                <p id="<?php echo "tHora".$n; ?>" class="<?php echo $claseDesabilita;?> ">
                                    <?php echo $hora; ?>
                                </p>
                            </td>
                            <td>
                                <button id="<?php echo "boton".$n;?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm"
                                onclick="abrirModalEditar(
                                                        '<?php echo $idcategoria ?>',
                                                        '<?php echo $nombrecatego ?>',
                                                        '<?php echo $icono ?>'
                                                        );">
                                <i class="far fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <input data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado";?> id="<?php echo "interruptor".$n;?>" data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idcategoria;?>);">
                            </td>
                        </tr>
                <?php
                    $n++;
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class="info">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Icono</th>
                    <th>Fecha de Registro</th>
                    <th>Hora de Registro</th>
                    <th>Editar</th>
                    <th>Estatus</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function()
        {
            $('#example1').DataTable
            ({
                "language":
                {
                    // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    "url": "../plugins/datatables/langauge/Spanish.json"
                },
                "order":[[ 0, "asc"]],
                "paging": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "searching": true,
                stateSave:false,
                dom:'Bfrtip',
                
                lengthMenu:
                [
                    [10, 25, 50, -1],
                    ['10 Registros', '25 Registros', '50 Registros', 'Todos'],
                ],
                
                columnDefs:
                [{
                    //targets:0,
                    //visible:false
                }],

                buttons:
                [
                    {
                        extend:'pageLength',
                        text:'Registros',
                        className:'btn btn-default'
                    },

                    {
                        text:'Nueva Categoría',
                        action:function( )
                        {
                            ver_alta();
                        },
                        counter: 1
                    },

                    
                ]
            });
        });
    </script>
<script>
        $(".interruptor").bootstrapToggle('destroy');
        $(".interruptor").bootstrapToggle();
    </script>


    