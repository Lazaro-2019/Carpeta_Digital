function llenar_caja_categoria()
{
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $("#sub_caja_anio").hide();
    $("#preguntas").hide();
    $("#sub_evidencias_1").hide();
    $.ajax
    ({
        url:"caja_categoria.php",
        type:"POST",
        dateType:"html",
        data:{},
        success:function(respuesta)
        {
            $("#caja_categoria").html(respuesta);
            $("#caja_categoria").slideDown("slow");
        },
        error:function(xhr,status)
        {
            alert("no se muestra");
        }
    }); 
}

function llenar_caja_anio()
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   $("#sub_caja_categoria").hide();
   $("#preguntas2").hide();
   $("#sub_evidencias_2").hide();
   $.ajax
   ({
       url:"caja_anio.php",
       type:"POST",
       dateType:"html",
       data:{},
       success:function(respuesta)
       {
           $("#caja_anio").html(respuesta);
           $("#caja_anio").fadeIn("slow");
       },
       error:function(xhr,status)
       {
           alert("no se muestra");
       }
   }); 
}

function llenar_caja_anio_sub(idCategoria)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   $("#caja_categoria").hide();
   $("#preguntas").hide();
   console.log(idCategoria);
   $.ajax
   ({
       url:"sub_caja_anio.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'idCategoria':idCategoria
        },
       success:function(respuesta)
       {
           $("#sub_caja_anio").html(respuesta);
           $("#sub_caja_anio").fadeIn("slow");
       },
       error:function(xhr,status){
           alert("no se muestra");
       }
   }); 
}

function llenar_caja_categoria_sub(anio)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   $("#caja_anio").hide();
   $("#preguntas2").hide();
   console.log(anio);
   $.ajax
   ({
       url:"sub_caja_categoria.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'anio':anio
        },
       success:function(respuesta)
       {
           $("#sub_caja_categoria").html(respuesta);
           $("#sub_caja_categoria").fadeIn("slow");
       },
       error:function(xhr,status){
           alert("no se muestra");
       }
   }); 
}

function llenar_preguntas_subcaja_1(idCategoria,anio)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   console.log(anio);
   console.log(idCategoria);
   $("#sub_caja_anio").hide();
   $("#caja_categoria").hide();
   $("#sub_evidencias_1").hide();
   $.ajax
   ({
       url:"sub_caja_preguntas_1.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'idCategoria':idCategoria,
           'anio':anio   
        },
       success:function(respuesta)
       {
           $("#preguntas").html(respuesta);
           $("#preguntas").show();
       },
       error:function(xhr,status)
       {
           alert("no se muestra");
       }
   }); 
}

function llenar_evidencias_sub_1(idCategoria,idPregunta,anio)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   console.log(anio);
   console.log(idCategoria);
   console.log(idPregunta);
   
   $("#sub_caja_categoria").hide();
   $("#preguntas").hide();
   $.ajax
   ({
       url:"llenar_evidencias_sub_1.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'idCategoria':idCategoria,
           'idPregunta':idPregunta,
           'anio':anio
        },
       success:function(respuesta)
       {
           $("#sub_evidencias_1").html(respuesta);
           $("#sub_evidencias_1").show();   
       },
       error:function(xhr,status)
       {
           alert("no se muestra");
       }
   }); 
}

function llenar_preguntas_subcaja_2(idCategoria,anio)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   console.log(anio);
   console.log(idCategoria);
   $("#caja_anio").hide();
   $("#sub_caja_categoria").hide();
   $("#sub_evidencias_2").hide();
   
   $.ajax
   ({
       url:"sub_caja_preguntas_2.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'idCategoria':idCategoria,
           'anio':anio
        },
       success:function(respuesta)
       {
           $("#preguntas2").html(respuesta);
           $("#preguntas2").show();   
       },
       error:function(xhr,status)
       {
           alert("no se muestra");
       }
   }); 
}

function llenar_evidencias_sub_2(idCategoria,idPregunta,anio)
{
    // console.log("Se ha llenado lista");
   // preCarga(1000,4);
   console.log(anio);
   console.log(idCategoria);
   console.log(idPregunta);
   $("#caja_anio").hide();
   $("#sub_caja_categoria").hide();
   $("#preguntas2").hide();
   $.ajax
   ({
       url:"llenar_evidencias_sub_2.php",
       type:"POST",
       dateType:"html",
       data : 
        {
           'idCategoria':idCategoria,
           'idPregunta':idPregunta,
           'anio':anio
        },
       success:function(respuesta)
       {
           $("#sub_evidencias_2").html(respuesta);
           $("#sub_evidencias_2").show();   
       },
       error:function(xhr,status)
       {
           alert("no se muestra");
       }
   }); 
}

function abrirModalDesc(desc){
    $("#desc").text(desc);
    $("#modalInfo").modal("show");
}

function abrilModalVBtesina(idArchivo,desc,nombre,anio){
    $("#desc").text("Descripción : " + desc);
    $("#anio_desc").text("Año : " + anio);
    $("#nArchivo").text(nombre);
    var archivo=idArchivo;
    console.log(archivo);
    PDFObject.embed("../docs/"+archivo+".pdf", "#visualizador");
    
    $("#modalVBtesina").modal("show");
  }

