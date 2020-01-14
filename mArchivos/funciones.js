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

function limpiarAlta(){
    $('#categoria').select2(0);
    $('#nombre').val('');
    $('#anio').val(0);
    $('#anio').select2();
    $('#descripcion').val('');
    $('#pregunta').val('');
   
}
function ver_alta() {
    limpiarAlta();
    //preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#categoria").focus();
}

function ver_lista() {
    limpiarAlta();
    $("#alta").slideUp('low');
    $('#lista').slideDown('low');
}

$('#btnLista').on('click',function(){
    limpiarAlta();
    ver_lista();
    llenar_lista();
});

function abrirModalSubir(id_archivo){
    console.log(id_archivo);
    $('#idE').val(id_archivo);
    $("#modalSubir").modal("show");
}

$(document).ready(function() {
    $(".upload").on('click', function() 
    {
        var formData = new FormData();
        var files = $('#archivo')[0].files[0];
        var id_archivo=$('#idE').val();

        formData.append('file',files);
        formData.append('id_archivo',id_archivo);
        console.log(id_archivo);
        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                    console.log(response);
                    $(".card-img-top").attr("src", response);
                    $('#archivo').fileinput('reset').trigger('custom-event');
                    alertify.success('El documento ha sido cargado con exito.');
                    $("#frmSubir")[0].reset();
                    $("#modalSubir").modal("hide");
                    llenar_lista();

                } else {
                    alertify.error('Formato de archivo incorrecto.');
                    console.log(response);
				}
            },
            error:function(xhr,status){
                alertify.error('Error en proceso');
            },
        });
		return false;
    });
});

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



function llenar_pregunta()
{
    var categoria = $("#categoria").val();
    // alert(idRepre);
    $.ajax({
        url : 'comboPreguntas.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
		data: 
		{
		'categoria': categoria
	    	},
        success : function(respuesta) {
            $("#pregunta").empty();
            $("#pregunta").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

$(document).ready(function(){
    $('#categoria').val(1);
    llenar_pregunta();

    $('#categoria').change(function(){
        llenar_pregunta();
    })
})

function abrirModalEditar(id_archivo,id_categoria,nombre_archivo,descripcion_archivo,pregunta,anio) {
    
    llenar_categoriaE(id_categoria);
	llenar_preguntaE(id_categoria,pregunta);
    
    $('#idE').val(id_archivo);
    $('#categoriaE').val(id_categoria);
    $('#nombreE').val(nombre_archivo);
    $('#descripcionE').val(descripcion_archivo);
    $('#anioE').val(anio);

    $("#modalEditar").modal("show");
}


function llenar_categoriaE(id_categoria)
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
            $("#categoriaE").val(id_categoria);
            $(".select2").select2();
                  
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}


function llenar_preguntaE(id_categoria,pregunta)
{

    $.ajax({
        url : 'comboPreguntasE.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
		data:{
            'id_categoria':id_categoria
        },
        success : function(respuesta) {
            $("#preguntaE").empty();
            $("#preguntaE").html(respuesta);  
            $("#preguntaE").val(pregunta);
            $(".select2").select2();     
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}



$("#frmAlta").submit(function(e){
    var categoria	=$("#categoria").val();
    var nombre		=$("#nombre").val();
    var descripcion	=$("#descripcion").val();
    var pregunta	=$("#pregunta").val();
    var anio        =$("#anio").val();
    
    //Validaciones

    if(pregunta==0){
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
    if(categoria==0){
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
    if(nombre==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes ingresar el nombre del archivo.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if(descripcion==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes escribir una descripcion del archivo.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
    if(anio==0 || anio==null){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes elegir un año.' ,
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
                'categoria': categoria,
                'nombre': nombre,
                'descripcion': descripcion,
                'pregunta': pregunta,
                'anio':anio
                    
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            ver_lista();
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
    var tConsecutivo       = "#tConsecutivo"+concecutivo;
    var nombre_archivo     = "#tNombre"+concecutivo;
    var tDescripcion       = "#tDescripcion"+concecutivo;
    var tCatego            = "#tCatego"+concecutivo;
    var tPregunta          = "#tPregunta"+concecutivo;
    var tAnio              = "#tAnio"+concecutivo;
    var tIcono             = "#tIcono"+concecutivo;
    var tSubir             = "#tSubir"+concecutivo;
   

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(tSubir).removeAttr("disabled");
        $(tIcono).removeAttr("desabilita");
        $(tConsecutivo).removeClass("desabilita");
        $(nombre_archivo).removeClass("desabilita");
        $(tDescripcion).removeClass("desabilita");
        $(tCatego).removeClass("desabilita");
        $(tAnio).removeClass("desabilita");
        $(tPregunta).removeClass("desabilita");

    }
    else
    {
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(tSubir).attr("disabled", "disabled");
        $(tIcono).attr("disabled", "disabled");
        $(tConsecutivo).addClass("desabilita");
        $(nombre_archivo).addClass("desabilita");
        $(tDescripcion).addClass("desabilita");
        $(tCatego).addClass("desabilita");
        $(tPregunta).addClass("desabilita");
        $(tAnio).addClass("desabilita");
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



$("#frmActualiza").submit(function(e)
{
    var categoriaE=$("#categoriaE").val();
    var nombreE=$("#nombreE").val();
    var descripcionE=$("#descripcionE").val();
    var preguntaE=$("#preguntaE").val();
    var anio=$("#anioE").val();
    var idE=$("#idE").val();

    $.ajax
    ({
        url:"actualizar.php",
        type:"POST",
        dataType:"html",
        data:{
            'categoriaE':categoriaE,
            'nombreE':nombreE,
            'descripcionE':descripcionE,
            'preguntaE':preguntaE,
            'idE':idE,
            'anio':anio
        },
        success:function(respuesta){
            alertify.set('notifier','position','bottom-right');
            alertify.success('Se ha actualizado el registro');
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

function abrilModalVBtesina(idArchivo,desc,nombre){
    $("#desc2").text("Descripción : " + desc);
    $("#nArchivo2").text(nombre);
    var archivo=idArchivo;

    console.log(archivo);
    PDFObject.embed("../docs/"+archivo+".pdf", "#visualizador2");
    
    $("#modalVBtesina2").modal("show");
  }

