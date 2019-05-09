//variable global para poder parar el set interval
var Loop=[];
var tracks = [];

//añade a la array global los datos de cada track
function datosTracks(){
    for (const key in datos_JSON) {
        var track = {
            nombre : datos_JSON[key]["nombre_mostrar"],
            volumen : 70,
            audio : datos_JSON[key]["nombre_link"],
            casillas : [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        };   
        
        //array de objetos
        tracks.push(track);

        //objeto de objetos
        //tracks["track"+key] = track;     
    }
    //crearemos el panel
    crearPanel();
}

$( document ).ready(function() {
    $( ".Tecla" ).on( "click",  clickCasilla );
    $( "#limpiar" ).on( "click",  limpiarCasillas );
    $( "#stop" ).on( "click",  pararSonido );
    $( "#play" ).on( "click",  pasarDatosAPlaySonido );
    
});


function crearPanel(){

    var tabla = $("<table id=tabla_panel class=tabla_panel>");

    $("#slide_general").append(tabla);

    for (const key in tracks) {
        
        var nombre_audio = tracks[key]["audio"];
        var nombre_mostrar = tracks[key]["nombre"];
        nombre_audio = nombre_audio.replace('public/', '');
        //como se guarda en la base de datos al inicio "public/", lo eliminaremos

        var agregar_td_nombres = $("<td>").text(nombre_mostrar).css("margin-top","10px");
        
        var tr_pista = $("<tr>");
        
        $(tr_pista).append(agregar_td_nombres);
        $(tabla).append(tr_pista);
        
        crearCasillas(key, tr_pista);
        crearSlide(key, tr_pista);
 
    }
}

function clickCasilla(){

    var casilla_pulsada = $(this).attr("pista");
    var casilla_por_filas = $(this).attr("casilla_por_filas");

    //al hacer click, se cambiara el modelo(array de objetos), el cual indica que esta iluminada la casilla
    var casilla_iluminada = tracks[casilla_pulsada]["casillas"][casilla_por_filas];

    //console.log(tracks[casilla_pulsada]["casillas"]);

    if (casilla_iluminada == 1){
        $( this ).css("background-color","#686868");
        tracks[casilla_pulsada]["casillas"][casilla_por_filas] = 0;
                
    }else{
        $( this ).css("background-color","cyan");
        tracks[casilla_pulsada]["casillas"][casilla_por_filas] = 1;
        
        var num_pista = $(this).attr("pista");
        var nombre_cancion = tracks[num_pista]["audio"];

        var porcentaje_volumen = tracks[num_pista]["volumen"];
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
    $( ".Tecla" ).css("background-color","#686868");
}


function crearCasillas(key, tr_pista){
    var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
    var Teclas=$("<td>").attr("class","Teclas").attr("numero_fila",key);
    $(tr_pista).append(Teclas)

    for (var i=0; i<=15; i++) {
        var Tecla=$('<div>').attr("class","Tecla").attr("pista",key).attr("casilla_por_filas",i).css(CssCasilla);      
        $(Teclas).append(Tecla);
    }
}

function crearSlide(key, tr_pista){
    var DivSlide=$('<div>').attr("class","rangeslider");
    var inputSlide=$('<input>').attr({"type":"range","min":"0","max":"100","value":"70","class":"myslider"});
    var SpanNumVolumen=$('<span>').attr("class","num_volumen");
    $(tr_pista).append(DivSlide);
    $(DivSlide).append(inputSlide);
    $(DivSlide).append(SpanNumVolumen);
    var rangeslider = $(".myslider")[key];
    var output = $(".num_volumen")[key];
    output.innerHTML = rangeslider.value;     
    rangeslider.oninput = function() { 
    output.innerHTML = this.value; 
    } 
}

function pasarDatosAPlaySonido(){
    var numero_de_tracks = tracks.length;
    var ArrPistas=[];
    
    for (var i =0; i <=numero_de_tracks; i++) {        
        ArrPistas.push($("[pista="+i+"]"));
    }

    for (var i = 0; i <= 15; i++) {
        
        for (var z = 0; z <= numero_de_tracks-1; z++) {
            //console.log(ArrPistas[z][i]);
            if ($(ArrPistas[z][i]).hasClass('hover')){
                playSonido(ArrPistas[z][i]);
                //Sonido($(ArrPistas[z][i]).attr("nombre"), 100);
            }
        }
    }
}

function playSonido(pista){
    console.log(pista);
    var num_pista = $(pista).attr("pista");
    var porcentaje_volumen = tracks[num_pista]["volumen"];
    var nombre = tracks[num_pista]["audio"];
    Loop = setInterval(function(){
        Sonido(nombre,porcentaje_volumen);
    },2000)
}

function pararSonido(){
    for (var i =0; i <= Loop; i++) {
        clearInterval(i);
    }
}

