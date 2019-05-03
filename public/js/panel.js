$( document ).ready(function() {
    $( ".hvr-glow" ).on( "click",  clickCasilla );
    $( "#limpiar" ).on( "click",  limpiarCasillas );
});

function clickCasilla(){

    if ($(this).hasClass('hover')){
        $( this ).removeClass( "hover" );
        $( this ).css("background-color","#686868");
        
        
    }else{
        $( this ).addClass( "hover" );
        $( this ).css("background-color","cyan");
        
        var nombre_cancion = $(this).attr("nombre");
        var pista = $(this).attr("pista");
        var porcentaje_volumen = $("#demo"+pista).text();
        Sonido(nombre_cancion, porcentaje_volumen);
    }
    
}

function Sonido (nombre_cancion, porcentaje_volumen){
    var ruta_audios = "/storage/";
    var audio = new Audio(ruta_audios+nombre_cancion);
    var porcentaje_volumen_exacto = porcentaje_volumen/100;
    audio.volume = porcentaje_volumen_exacto;
    audio.play();
}

function limpiarCasillas (){
    $( ".hover" ).css("background-color","#686868");
    $( ".hover" ).removeClass( "hover" );
}


function crearCasillas(nombre_audio, key){
    var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
    var Teclas=$("<div>").attr("class","Teclas").attr("pista",key);
    $(".center_panel").append(Teclas);
    for (var i=0; i<=15; i++) {
        var Tecla=$('<div>').attr("class","Tecla hvr-glow").attr("nombre",nombre_audio).attr("pista",key).css(CssCasilla);      
        $(Teclas).append(Tecla);
       }
       crearSlide(key);
    
}

function crearSlide(key){
    var DivSlide=$('<div>').attr("class","rangeslider");
    var inputSlide=$('<input>').attr({"type":"range","min":"0","max":"100","value":"10","class":"myslider","id":"sliderRange"+key,"pista":key});
    var SpanDemo=$('<span>').attr("id","demo"+key).attr("pista",key);
    $(".slide_general").append(DivSlide);
    $(DivSlide).append(inputSlide);
    $(DivSlide).append(SpanDemo);
    var rangeslider = document.getElementById("sliderRange"+key); 
    var output = document.getElementById("demo"+key); 
    output.innerHTML = rangeslider.value;     
    rangeslider.oninput = function() { 
      output.innerHTML = this.value; 
    } 
}






