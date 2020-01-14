<?php
include('../sesiones/verificar_sesion.php');
$id_archivo=trim($_POST["id_archivo"]).'.pdf';
if (is_array($_FILES) && count($_FILES) > 0) 
{
    if ($_FILES["file"]["type"] == "application/pdf") 
    {
        if (move_uploaded_file($_FILES["file"]["tmp_name"],"../docs/".$id_archivo)) 
        {
            //more code here...
            echo "../docs/".$id_archivo;
        } 
        else 
        {
            echo 0;
        }
    } 
    else 
    {
        echo 0;
    }
} 
else 
{
    echo 0;
}