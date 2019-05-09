//variable global para poder parar el set interval
var Loop=[];


$( document ).ready(function() {
    $( ".hvr-glow" ).on( "click",  clickCasilla );
    $( "#limpiar" ).on( "click",  limpiarCasillas );
    $( "#stop" ).on( "click",  pararSonido );
    
});


function crearPanel(datos_JSON){

    var tabla = $("<table id=tabla_panel class=tabla_panel>");

    $(".slide_general").append(tabla);

    for (const key in datos_JSON) {
        var nombre_audio = datos_JSON[key]["nombre_link"];
        var nombre_mostrar = datos_JSON[key]["nombre_mostrar"];
        nombre_audio = nombre_audio.replace('public/', '');
        //como se guarda en la base de datos al inicio "public/", lo eliminaremos

        var agregar_td_nombres = $("<td>").attr("class","nombres_pistas").attr("nombre",nombre_audio).attr("pista",key).text(nombre_mostrar).css("margin-top","10px");
        
        var tr_pista = $("<tr class>");
        $(tr_pista).append(agregar_td_nombres);
        $(tabla).append(tr_pista);
        
        crearCasillas(nombre_audio, key, tr_pista);
        crearSlide(key, tr_pista);
 
    }
}

function clickCasilla(){

    if ($(this).hasClass('hover')){
        $( this ).removeClass( "hover" );
        $( this ).css("background-color","#686868");
        
        
    }else{
        $( this ).addClass( "hover" );
        $( this ).css("background-color","cyan");
        
        var nombre_cancion = $(this).attr("nombre");
        var pista = $(this).attr("pista");
        var porcentaje_volumen = $("#sliderRange"+pista).val();
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


function crearCasillas(nombre_audio, key, tr_pista){
    var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
    var Teclas=$("<td>").attr("class","Teclas").attr("pista",key);
    $(tr_pista).append(Teclas)
    //$(".center_panel").append(Teclas);
    for (var i=0; i<=15; i++) {
        var Tecla=$('<div>').attr("class","Tecla hvr-glow").attr("nombre",nombre_audio).attr("pista",key).css(CssCasilla);      
        $(Teclas).append(Tecla);
    }
}

function crearSlide(key, tr_pista){
    var DivSlide=$('<div>').attr("class","rangeslider");
    var inputSlide=$('<input>').attr({"type":"range","min":"0","max":"100","value":"70","class":"myslider","id":"sliderRange"+key,"pista":key});
    var SpanDemo=$('<span>').attr("class","num_volumen").attr("id","demo"+key).attr("pista",key);
    $(tr_pista).append(DivSlide);
    $(DivSlide).append(inputSlide);
    $(DivSlide).append(SpanDemo);
    var rangeslider = document.getElementById("sliderRange"+key); 
    var output = document.getElementById("demo"+key); 
    output.innerHTML = rangeslider.value;     
    rangeslider.oninput = function() { 
    output.innerHTML = this.value; 
    } 
}

function Recibir(Num){
    var ArrPistas=[];
    var ArrCasilla=[];
    for (var i =0; i <=Num; i++) {        
        ArrPistas.push($("[pista="+i+"]"));
    }

    for (var i = 2; i <= 17; i++) {
        
        for (var z = 0; z <= Num-1; z++) {
            //console.log(ArrPistas[z][i]);
            if ($(ArrPistas[z][i]).hasClass('hover')){
                playSonido(ArrPistas[z][i]);
                //Sonido($(ArrPistas[z][i]).attr("nombre"), 100);
            }
        }
    }
}

function playSonido(pista){
    var porcentaje_volumen = $("#sliderRange"+$(pista).attr("pista")).val();
    Loop = setInterval(function(){
        Sonido($(pista).attr("nombre"),porcentaje_volumen);
    },2000)
}

function pararSonido(){
    for (var i =0; i <= Loop; i++) {
        clearInterval(i);
    }
}

