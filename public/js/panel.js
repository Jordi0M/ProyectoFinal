$( document ).ready(function() {
    $( ".hvr-glow" ).on( "click",  clickCasilla );
    $( "#limpiar" ).on( "click",  limpiarCasillas );
});

function clickCasilla(){

    if ($(this).hasClass('hover')){
        $( this ).removeClass( "hover" );
        $( this ).css("background-color","");
        
        
    }else{
        $( this ).addClass( "hover" );
        $( this ).css("background-color","cyan");
        
        var nombre_cancion = $(this).attr("nombre");
        Sonido(nombre_cancion);
    }
    
}

function Sonido (nombre_cancion){
    var ruta_audios = "/storage/";
    var audio = new Audio(ruta_audios+nombre_cancion);
    audio.play();
}

function limpiarCasillas (){
    $( ".hover" ).css("background-color","");
    $( ".hover" ).removeClass( "hover" );
}


function crearCasillas(){
    var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
    var Teclas=$("<div>").attr("class","Teclas");
    $(".center_panel").append(Teclas);
    for (var i=0; i<=15; i++) {
        var Tecla=$('<div>').attr("class","Tecla").css(CssCasilla);      
        $(".Teclas").append(Tecla);
       }
    var DivSlide=$('<div>').attr("class","rangeslider");
    var inputSlide=$('input').attr({"type":"range","min":"0","max":"100","value":"10","class":"myslider","id":"sliderRange"});
    var SpanDemo=$('<span>').attr("id","demo");
    $(".rangeslider").append(inputSlide);
    $(".rangeslider").append(SpanDemo);
    $(".Teclas").append(".rangeslider");
    var rangeslider = document.getElementById("sliderRange"); 
    var output = document.getElementById("demo"); 
        output.innerHTML = rangeslider.value;     
    rangeslider.oninput = function() { 
      output.innerHTML = this.value; 
    } 
}







