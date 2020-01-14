function abrirModalEditarDatos(idPersona,nombre,paterno,materno,direccion,sexo,telefono,fecha_nac,correo){
    console.log(idPersona);
    console.log(nombre);
    console.log(paterno);
    console.log(materno);
    console.log(direccion);
    console.log(sexo);
    console.log(telefono);
    console.log(fecha_nac);
    console.log(correo);
    // llenar_combo_modal(sexo);
    $("#idU").val(idPersona);
    $("#nombreU").val(nombre);
    $("#paternoU").val(paterno);
    $("#maternoU").val(materno);
    $("#direccionU").val(direccion);
    $('#sexoU').val(sexo);
    $("#telefonoU").val(telefono);
    $("#fecha_nacU").val(fecha_nac);
    $("#correoU").val(correo);
    
    
    $("#modalEditarDatosUsuario").modal("show");
}

$("#frmActulizaDatosUsuario").submit(function(e)
{

    var idPersona   = $("#idU").val();
    var nombre      = $("#nombreU").val();
    var appaterno   = $("#paternoU").val();
    var apmaterno   = $("#maternoU").val();
    var direccion   = $("#direccionU").val();
    var sexo        = $("#sexoU").val();
    var telefono    = $("#telefonoU").val();
    var fecha_nac   = $("#fecha_nacU").val();
    var correo      = $("#correoU").val();
    
    console.log(idPersona);
    console.log(nombre);
    console.log(appaterno);
    console.log(apmaterno);
    console.log(direccion);
    console.log(sexo);
    console.log(telefono);
    console.log(fecha_nac);
    console.log(correo);

        $.ajax({
            url:"../layout/actualizarDatos.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idPersona':idPersona,
                    'nombre':nombre,
                    'appaterno':appaterno,
                    'apmaterno':apmaterno,
                    'direccion':direccion,
                    'sexo':sexo,
                    'telefono':telefono,
                    'fecha_nac':fecha_nac,
                    'correo':correo
                 },
            success:function(respuesta){
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro');
            $("#frmActulizaDatosUsuario")[0].reset();
            $("#modalEditarDatosUsuario").modal("hide");
            window.location="../inicio/index.php";
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});


