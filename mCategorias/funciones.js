function llenar_lista() 
{
    //console.log("Se ha llenado lista");
    //preCarga(1000,4);
    $.ajax
    ({
        url:"llenarLista.php",
        type:"POST",
        dataType:"html",
        data:{},
        success:function(respuesta)
        {
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status)
        {
            alert("No se muestra");
        }
    });
}

function limpiarAlta() {
    $("#categoria").val('');
    $("#icono").val('');
}


function ver_alta() {
    //preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#categoria").focus();
    limpiarAlta();
}
function ver_lista() {
    $("#alta").slideUp('low');
    $('#lista').slideDown('low');
    limpiarAlta();
}

$('#btnLista').on('click',function(){
    llenar_lista();
    ver_lista();
    limpiarAlta();
});





$("#frmAlta").submit(function(e){
    var categoria=$("#categoria").val();
    var icono=$("#icono").val();

    $.ajax
    ({
        url:"guardar.php",
        type:"POST",
        dataType:"html",
        data:
        {
            'categoria':categoria,
            'icono':icono
        },
        success:function(respuesta)
        {
            alertify.set('notifier','position','bottom-right');
            alertify.success('Se ha guardado el registro');
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



function abrirModalEditar(id,nombrecatego,icono) {
    $("#frmActualiza")[0].reset();

    $("#idE").val(id);
    $("#categoriaE").val(nombrecatego);
    $("#iconoE").val(icono);
    $("#modalEditar").modal("show");

    $('modalEditar').on('shown.bs.modal', function(){
        $('#categoriaE').focus();
    });
}

$("#frmActualiza").submit(function(e)
{
    var categoria=$("#categoriaE").val();
    var icono=$("#iconoE").val();
    var ide=$("#idE").val();

    $.ajax
    ({
        url:"actualizar.php",
        type:"POST",
        dataType:"html",
        data:{
            'categoria':categoria,
            'icono':icono,
            'id':ide
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

function status (consecutivo,id)
{
    var nomToggle = "#interruptor"+consecutivo;
    var numero="#tConsecutivo"+consecutivo;
    var nombre="#tCatego"+consecutivo;
    var icono="#tIcono"+consecutivo;
    var fecha="#tFecha"+consecutivo;
    var hora="#tHora"+consecutivo;
    var boton="#boton"+consecutivo;

    if ($(nomToggle).is(':checked')) 
    {
        console.log("activado")
        var valor=1;
        alertify.success('Registro habilitado');
        $(numero).removeClass("desabilita");
        $(nombre).removeClass("desabilita");
        $(icono).removeClass("desabilita");
        $(fecha).removeClass("desabilita");
        $(hora).removeClass("desabilita");
        $(boton).removeAttr("disabled");

    }
    else
    {
        console.log("desactivado");
        var valor=0;
        alertify.error('Registro deshabilitado');
        $(numero).addClass("desabilita");
        $(nombre).addClass("desabilita");
        $(icono).addClass("desabilita");
        $(fecha).addClass("desabilita");
        $(hora).addClass("desabilita");
        $(boton).attr("disabled","disabled");
    }
    //console.log(consecutivo+' / '+id);
    $.ajax({
        url:"status.php",
        type:"POST",
        dataType:"html",
        data:{
            'valor':valor,
            'id':id
        },
        success:function(respuesta){
            alertify.set('notifier','position', 'bottom-right');
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });

}

function imprimir(){

    var titular = "Lista de categorias";
    var mensaje = "¿Deseas generar un archivo con PDF con la lista de categorias activas";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdfListaCategorias.php?";

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