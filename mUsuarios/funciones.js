function llenar_lista(){
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $.ajax({
        url:"llenarLista.php",
        type:"POST",
        dateType:"html",
        data:{},
        success:function(respuesta){
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    });	
}

function limpiar_alta() {
    $("#idPersona").val('');
    $("#usuario").val('');
    $("#contra").val('');
    $("#vContra").val('');
    $("#tipo").val(0);
    $("#tipo").select2();
    $("#categoriaUser").val(0);
    $("#categoriaUser").select2();
}

function ver_alta(){
    // preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#nombre").focus();
    limpiar_alta();
}

function ver_lista(){
    $("#alta").slideUp('low');
    $("#lista").slideDown('low');
    
}

$('#btnLista').on('click',function(){
    ver_lista();
    llenar_lista();
    limpiar_alta();
});



$("#frmAlta").submit(function(e){
  
    var idPersona = $("#idPersona").val();
    var usuario   = $("#usuario").val();
    var contra    = $("#contra").val();
    var vContra   = $("#vContra").val();
    var tipo      = $("#tipo").val();
    var area      = $("#categoriaUser").val();

    console.log(idPersona);
    console.log(usuario);
    console.log(contra);
    console.log(vContra);
    console.log(tipo);
    console.log(area);

    // validacion para no meter id de persona en 0
    if(idPersona==0){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar a una persona.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipo=="Encargado" && area==null) || (tipo=="Encargado" && area==0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar un area para el usuario encargado.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipo==null && area==null) || (tipo==0 && area==0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar que tipo de usuario es.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipo==null && area!=null) || (tipo==0 && area!=0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar que tipo de usuario es.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipo=='Administrador' && area!=0) ||  (tipo=='Visualizador' && area!=0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Este tipo de usuario no necesita ningun area deje la opcion por defecto.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#categoriaUser").val(0);
        $("#categoriaUser").select2();
        return false;       
    }
    // validacion para que el nombre de usuario sea minimo de 5 caracteres
    caracteres=$("#usuario").val().length;
    if(caracteres < 5){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'El usuario debe tener mas de 5 caracteres' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#usuario").focus();
        return false;       
    }

    // validacion para que las contraseñas coincidan
    if(contra != vContra){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Las contraseñas deben de ser iguales.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#contra").focus();
        return false;       
    }
  

        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idPersona':idPersona,
                    'usuario':usuario,
                    'contra':contra,
                    'tipo':tipo,
                    'area':area
                 },
            success:function(respuesta){
            
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Se ha guardado el registro' );
                $("#frmAlta")[0].reset();
                limpiar_alta();
                ver_lista();
                llenar_lista();
                llenar_persona();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idUsuario,idPersona,usuario,tipo,idCategoria){
   
    $("#frmActuliza")[0].reset();
    
    llenar_personaU(idPersona);
    // llenar_usuario(tipo);
     llenar_usuario(tipo);
     llenar_categoriaE(idCategoria)
    // $("#tipoE").val(tipo);
    $("#idE").val(idUsuario);
    $("#usuarioE").val(usuario);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#usuarioE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var usuario  = $("#usuarioE").val();
    var tipoE     = $("#tipoE").val();
    var areaE      = $("#categoriaUserE").val();
    var ide     = $("#idE").val();
       // validacion para que el nombre de usuario sea minimo de 5 caracteres
       caracteres=$("#usuarioE").val().length;
       if(caracteres < 5){
           alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
   
           alertify.alert()
           .setting({
               'title':'Información',
               'label':'Salir',
               'message': 'La cantidad de caracteres para el usario debe de ser mayor a 5' ,
               'onok': function(){ alertify.message('Gracias !');}
           }).show();
           $("#usuarioE").focus();
           return false;       
       }
       if((tipoE=="Encargado" && areaE==null) || (tipoE=="Encargado" && areaE==0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar un area para el usuario encargado.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipoE==null && areaE==null) || (tipoE==0 && areaE==0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar que tipo de usuario es.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipoE==null && areaE!=null) || (tipoE==0 && areaE!=0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar que tipo de usuario es.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if((tipoE=='Administrador' && areaE!=0) ||  (tipoE=='Visualizador' && areaE!=0)){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Este tipo de usuario no necesita ningun area deje la opcion por defecto.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#categoriaUserE").val(0);
        $("#categoriaUserE").select2();
        return false;       
    }
        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'usuario':usuario,
                    'ide':ide,
                    'tipoE':tipoE,
                    'areaE':areaE
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza")[0].reset();
            $("#modalEditar").modal("hide");
            llenar_lista();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});


function status(concecutivo,id){
    var nomToggle = "#interruptor"+concecutivo;
    var nomBoton  = "#boton"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;
    var nCompleto = "#tNcompleto"+concecutivo;
    var usuario   = "#tUsuario"+concecutivo;
    var registro  = "#tRegistro"+concecutivo;
    var nomBotonR  = "#botonR"+concecutivo;
   


    if($(nomToggle).is(':checked')){

            // console.log("activado");
            var valor=0;
            alertify.success('Registro habilitado' );
            $(nomBoton).removeAttr("disabled");
            $(nomBotonR).removeAttr("disabled");
            $(numero).removeClass("desabilita");
            $(nCompleto).removeClass("desabilita");
            $(usuario).removeClass("desabilita");
            $(registro).removeClass("desabilita");
        }
        else
        {
            // console.log("desactivado");
            var valor=1;
            alertify.error('Registro deshabilitado' );
            $(nomBoton).attr("disabled", "disabled");
            $(nomBotonR).attr("disabled", "disabled");
            $(numero).addClass("desabilita");
            $(nCompleto).addClass("desabilita");
            $(usuario).addClass("desabilita");
            $(registro).addClass("desabilita");
        }
    
    // console.log(concecutivo+' | '+id);
    $.ajax({
        url:"status.php",
        type:"POST",
        dateType:"html",
        data:{
                'valor':valor,
                'id':id
             },
        success:function(respuesta){
            
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}


function llenar_persona()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPersonas.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idPersona").empty();
            $("#idPersona").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function restaurarContra(idUser){
    // console.log(idUser);
    $.ajax({
        url:"restaurarContra.php",
        type:"POST",
        dateType:"html",
        data:{
                'idUser':idUser
             },
        success:function(respuesta){

            alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

            alertify.alert()
            .setting({
                'title':'Información',
                'label':'Salir',
                'message': 'La contraseña ha sido modificada' ,
                'onok': function(){ alertify.message('Gracias !');}
            }).show();

        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}

function mostrarContra1(){
    var btnMostrar=$('#btnMostrar1').val();
    // console.log(btnMostrar);
    preCarga(300,2);
    if(btnMostrar=='oculto'){
        $("#contraE").attr("type","text");
        $("#vContraE").attr("type","text");
        $("#btnMostrar1").attr("value","visto");
        $("#icoMostrar1").removeClass("far fa-eye fa-lg");
        $("#icoMostrar1").addClass("far fa-eye-slash fa-lg");
    }
    else{
        $("#contraE").attr("type","password");
        $("#vContraE").attr("type","password");
        $("#btnMostrar1").attr("value","oculto");
        $("#icoMostrar1").removeClass("far fa-eye-slash fa-lg");
        $("#icoMostrar1").addClass("far fa-eye fa-lg");       
    }
}

function llenar_personaU(idPersona)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPersonasU.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombreE").empty();
            $("#nombreE").html(respuesta);
            $("#nombreE").val(idPersona);
            $("#nombreE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}



function llenar_usuario(tipo)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboTipo.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        data:{
            
         },
        success : function(respuesta) {
            $("#tipoE").empty();
            $("#tipoE").html(respuesta);
            $("#tipoE").val(tipo);
            $("#tipoE").select2(); 

        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function imprimir(){

    var titular = "Lista de Usuarios";
    var mensaje = "¿Deseas generar un archivo con PDF con la lista de usuarios activos";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdfListaUsuarios.php?";

    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        titular, 
        mensaje, 
        function(){ 
            window.open(link,'_blank');
            }, 
        function(){ 
                alertify.error('Cancelar') ; 
                // console.log('cancelado')
              }
    ).set('labels',{ok:'Generar PDF',cancel:'Cancelar'}); 
  }

  function llenar_categoria()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboCategoriasUser.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#categoriaUser").empty();
            $("#categoriaUser").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function llenar_categoriaE(id_catego)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboCategoriasUserE.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#categoriaUserE").empty();
            $("#categoriaUserE").html(respuesta);  
            $("#categoriaUserE").val(id_catego);
            $(".select2").select2();

        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}