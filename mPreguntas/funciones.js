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

function limpiarAlta() {
    $("#pregunta").val('');
    $("#categoria").val(0);
    $("#categoria").select2();
}

function ver_alta(){
    // preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#pregunta").focus();
    limpiarAlta();
}

function ver_lista(){
    $("#alta").slideUp('low');
    $("#lista").slideDown('low');
    limpiarAlta();
}

$('#btnLista').on('click',function(){
    llenar_lista();
    ver_lista();
    limpiarAlta();
});

$("#frmAlta").submit(function(e){
    
    var pregunta = $("#pregunta").val();
    var categoria = $("#categoria").val();
    //Validaciones

    if(pregunta==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar una pregunta.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if(categoria==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar una categoria.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    
    // console.log(nombreCompleto);

        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'pregunta':pregunta,
                    'categoria':categoria,
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            ver_lista();
            llenar_lista();
            llenar_categoria();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(id_pregunta,id_catego,pregunta){
   
   $("#frmActualiza")[0].reset();

    llenar_categoriaE(id_catego);

    $("#idE").val(id_pregunta);
    $("#preguntaE").val(pregunta);
    $("#categoriaE").val(id_catego);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#preguntaE').focus();
     });   
}

$("#frmActualiza").submit(function(e){
  
    var preguntaE   = $("#preguntaE").val();
    var categoriaE  = $("#categoriaE").val();
    var ide         = $("#idE").val();
    
    //Validaciones


    if(preguntaE==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes escribir una pregunta.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#preguntaE").focus();
        return false;       
    }

    if(categoriaE==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar una categoria.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        $("#categoriaE").focus();
        return false;       
    }

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'preguntaE':preguntaE,
                    'categoriaE':categoriaE,
                    'ide':ide
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActualiza")[0].reset();
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
    var nomToggle          = "#interruptor"+concecutivo;
    var nomBoton           = "#boton"+concecutivo;
    var numero             = "#tConsecutivo"+concecutivo;
    var tPregunta         = "#tPregunta"+concecutivo;
    var tCategoria = "#tCategoria"+concecutivo;
    var fecha        = "#tFecha"+concecutivo;
    var hora        = "#tHora"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(tPregunta).removeClass("desabilita");
        $(tCategoria).removeClass("desabilita");
        $(fecha).removeClass("desabilita");
        $(hora).removeClass("desabilita");

    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(tPregunta).addClass("desabilita");
        $(tCategoria).addClass("desabilita");
        $(fecha).addClass("desabilita");
        $(hora).addClass("desabilita");

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
            // console.log(respuesta);
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}




function llenar_categoria()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboCategorias.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#categoria").empty();
            $("#categoria").html(respuesta);      
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
        url : 'comboCategoriasE.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#categoriaE").empty();
            $("#categoriaE").html(respuesta);  
            $("#categoriaE").val(id_catego);
            $(".select2").select2();

        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}