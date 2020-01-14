function entrando(){
    window.location='../inicio/index.php';
}

function cambioContra(){
    $("#cuerpo").hide();
    $("#cambiarContra").fadeIn('low');
    alertify.warning("Debes de cambiar tu contraseña , ya que es tu primer ingreso al sistema",3);
    $("#vContra1").val('');
    $("#vContra2").val('');
    $("#vContra1").focus();
}

function limpiarLogin() {
    document.getElementById('username').value="";
    document.getElementById('pass').value="";
    document.getElementById('username').focus();
    // $("#username").val('');
    // $("#pass").val('');
    // $("#username").focus();
}

$("#frmIngreso").submit(function(e){
    var usuario,contra;
    var usuario = $("#username").val();
    var contra  = $("#pass").val();
    document.getElementById('username').focus();
    var usuario=usuario.trim();
    console.log(usuario);
    console.log(contra);

    // contra=contra.trim();
    if(usuario=='' || contra==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Acceso denegado',
            'label':'Aceptar',
            'message': 'Debes de colocar nombre de usuario y contraseña' ,
            'onok': function(){ 
                alertify.message('Gracias !');
                limpiarLogin();
            }
        }).show();
        return false;    
    }else{
        $.ajax({
            url:"verificar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'usuario':usuario,
                    'contra':contra
                 },
            success:function(respuesta)
            {
                respuesta=parseInt(respuesta);
                console.log(respuesta);
                switch(respuesta)
                {
                    case 0 :
                        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
                        alertify.alert()
                        .setting
                        ({
                            'title':'Acceso denegado',
                            'label':'Aceptar',
                            'message': 'Nombre de usuario o contraseña incorrectos' ,
                            'onok': 
                            function()
                            { 
                                alertify.message('Gracias !');
                                limpiarLogin();
                            }
                        }).show();
                        
                    break;
                    case 1 :
                        var valorChk=$('#chkContra').val();
                        if(valorChk=='si')
                        {
                            cambioContra();
                            $("#usuario").val(usuario); 
                            document.getElementById('username').focus();                    
                        }
                        else
                        {
                            alertify.success('Ingresando....') ; 
                            preCarga(2000,2);
                            setInterval(entrando, 2000); 
                        }
                    break;
                    case 2 :
                        // $("#username").focus();
                        cambioContra();
                        $("#usuario").val(usuario);
                        
                    break;
                }
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
    } 
        e.preventDefault();
        return false;
});

function evaluarCheck(valor){
    if(valor=='no'){
        $('#chkContra').val('si');
    }else{
        $('#chkContra').val('no');
    }
}

function cancelar() {
    // console.log("Saliendo del sistema...")
    alertify
    .confirm("alert")
    .set({ transition: "zoom", message: "Transition effect: zoom" })
    .show();
    alertify
    .confirm(
        "Carpeta Digital",
        "¿ Deseas cancelar el cambio de contraseña?",
        function() 
        {
            $("#cuerpo").fadeIn();
            $("#cambiarContra").hide("low");
            $("#frmIngreso")[0].reset();
            $("#frmCambiar")[0].reset();
            document.getElementById('username').focus();
        },
        function() {
        alertify.error("Cancelar");
        }
    )
    .set("labels", { ok: "Si", cancel: "No" });
}

$("#frmCambiar").submit(function(e){
    $("#vContra1").focus();
    var usuario = $("#usuario").val();
    var contra  = $("#vContra1").val();
    var vContra  = $("#vContra2").val();

    if (contra !=vContra) 
    {
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Las contraseñas deben ser iguales' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#vContra1").val('');
        $("#vContra2").val('');
        $("#vContra1").focus();
        return false;       
    }
   
    //var ide= $("#usuario").val();
        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'usuario':usuario,
                    'contra':contra,
                    //'usuario':usuario
                    //'ide':ide
                    //'restaurar':1
                 },
            success:function(respuesta)
            {
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Se ha actualizado el registro' );
                $("#frmCambiar")[0].reset();
                entrando();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

