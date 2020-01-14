function abrirModalContra(id_usuario){
    $("#frmActuliza2")[0].reset();

    $("#idE2").val(id_usuario);
  

    $("#modalEditar2").modal("show");
     $('#modalEditar2').on('shown.bs.modal', function () {
         $("#contraE2").focus();
     });   
}

function mostrarContra()
{
    var btnMostrar=$('#btnMostrar').val();
    // console.log(btnMostrar);
    preCarga(300,2);
    if(btnMostrar=='oculto')
    {
        $("#contraE2").attr("type","text");
        $("#vContraE2").attr("type","text");
        $("#btnMostrar").attr("value","visto");
        $("#icoMostrar").removeClass("far fa-eye fa-lg");
        $("#icoMostrar").addClass("far fa-eye-slash fa-lg");
    }
    else
    {
        $("#contraE2").attr("type","password");
        $("#vContraE2").attr("type","password");
        $("#btnMostrar").attr("value","oculto");
        $("#icoMostrar").removeClass("far fa-eye-slash fa-lg");
        $("#icoMostrar").addClass("far fa-eye fa-lg");       
    }
}

$("#frmActuliza2").submit(function(e)
{
    $("#contraE2").focus();
    var contra  = $("#contraE2").val();
    var vContra  = $("#vContraE2").val();
       
    // validacion para que las contraseñas coincidan
       if(contra != vContra)
       {
           alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
           alertify.alert()
           .setting
           ({
               'title':'Información',
               'label':'Salir',
               'message': 'Las contraseñas deben de ser iguales.' ,
               'onok': function(){ alertify.message('Gracias !');}
           }).show();

           $("#contraE2").val('');
           $("#vContraE2").val('');
           $("#contraE2").focus();
           return false;       
       }
    var ide = $("#idE2").val();
        $.ajax({
            url:"../inicio/actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'contra':contra,
                    'ide':ide
                 },
            success:function(respuesta){
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza2")[0].reset();
            $("#modalEditar2").modal("hide");
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});