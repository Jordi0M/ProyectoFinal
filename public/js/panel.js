//variable global para poder parar el set interval
var Loop=[];
var tracks = [];
var Tempo;
//añade a la array global los datos de cada track
function datosTracks(){

    ////////Local Storage (guardar la informacion)
    if(typeof(Storage) !== "undefined") {
        if (localStorage.local_tracks) {
            //console.log(JSON.parse(localStorage.local_tracks));
            //console.log(datos_JSON);
            introducirLocalStorage();
        } 
        else {
            crearTracks(datos_JSON);
        }
    } else {
            document.getElementById("#slide_general").innerHTML = "Sorry, your browser does not support web storage...";
    }

    
    
}

function introducirLocalStorage(){
    //para borrar el localstorage:
    //localStorage.clear();
    tracks = JSON.parse(localStorage.local_tracks);

    //crearemos el panel
    crearPanel();
}

function crearTracks(datos_JSON){
    tracks = [];
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
    localStorage.local_tracks = JSON.stringify(tracks);

    //crearemos el panel
    crearPanel();
}

$( document ).ready(function() {

 /// Validacion del Tempo
    var number = document.getElementById('input-metro');

    //al cambiar el numero por las flechas del imput number
    $('#input-metro').change(function(){
        Tempo=$(this).val();
        console.log(Tempo);
    })
    //al teclear
    number.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106) //numerico1
          || (e.keyCode > 47 && e.keyCode < 58) //numerico2
          || (e.keyCode > 36 && e.keyCode < 41) //flechas
          || e.keyCode == 8 || e.keyCode == 46)) { //supr y backspace
            return false;
        }
        if ($(this).val() == "") {
            alert("mal")
        }
        number.onkeyup = function(z){
            if ($(this).val() == "") {
                return;
            }
            Tempo=$(this).val();
            console.log(Tempo);
        }
    }

    //onclicks

    //$( ".myslider" ).on( "click",  clickCasilla );
    $( "#limpiar" ).on( "click",  limpiarCasillas );
    $( "#stop" ).on( "click",  pararSonido);
    $( "#play" ).on( "click",  pasarDatosAPlaySonido );
    $("#form_descargar_json").on( "click", descargarJSON );
    $('#input_file_subir_json').on('change', leerArchivo);

    
});


function crearPanel(){

    var tabla = $("<table id=tabla_panel class=tabla_panel>");

    $("#slide_general").append(tabla);

    for (const key in tracks) {
        
        var nombre_mostrar = tracks[key]["nombre"];

        var agregar_td_nombres = $("<td>").text(nombre_mostrar).css("margin-top","10px");
        
        var tr_pista = $("<tr>");
        
        $(tr_pista).append(agregar_td_nombres);
        $(tabla).append(tr_pista);
        
        crearCasillas(key, tr_pista);
        crearSlide(key, tr_pista);
    }
    //asignaremos el onclick despues de crear las teclas
    $( ".Tecla" ).on( "click",  clickCasilla );
    lineasDelReproductor();
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

    localStorage.local_tracks = JSON.stringify(tracks);
    
}

function Sonido (nombre_cancion, porcentaje_volumen){
    var ruta_audios = "/storage/";
    nombre_cancion = nombre_cancion.replace('public/', '');
    //como se guarda en la base de datos al inicio "public/", lo eliminaremos
    var audio = new Audio(ruta_audios+nombre_cancion);
    var porcentaje_volumen_exacto = porcentaje_volumen/100;
    audio.volume = porcentaje_volumen_exacto;
    audio.play();
}

function limpiarCasillas (){
    $( ".Tecla" ).css("background-color","#686868");
    for (const key in tracks) {
        tracks[key]["casillas"] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    }
    localStorage.local_tracks = JSON.stringify(tracks);
}


function crearCasillas(key, tr_pista){
    //var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
    var Teclas=$("<td>").attr("class","Teclas").attr("numero_fila",key);
    $(tr_pista).append(Teclas)

    for (var i=0; i<=15; i++) {
        if (tracks[key]["casillas"][i] == 0) {
            var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'#686868'};
        }
        else{
            var CssCasilla={"border":'solid #545454 3px',"width":'40px',"height":'40px',"border-radius":'5px',"background-color":'cyan'};
        }
        var Tecla=$('<div>').attr("class","Tecla").attr("pista",key).attr("casilla_por_filas",i).css(CssCasilla);      
        $(Teclas).append(Tecla);
    }
}

function crearSlide(key, tr_pista){
    var DivSlide=$('<div>').attr("class","rangeslider");
    var volumen_track = tracks[key]["volumen"];
    var inputSlide=$('<input>').attr({"type":"range","min":"0","max":"100","value":volumen_track,"class":"myslider"});
    /*
    , "pista_volumen":key
    */
    //posible atributo para cambiar el volumen al objeto
    var SpanNumVolumen=$('<span>').attr("class","num_volumen");
    $(tr_pista).append(DivSlide);
    $(DivSlide).append(inputSlide);
    $(DivSlide).append(SpanNumVolumen);
    var rangeslider = $(".myslider")[key];
    var output = $(".num_volumen")[key];
    output.innerHTML = rangeslider.value;     
    rangeslider.oninput = function() {
    output.innerHTML = this.value; 
    tracks[key]["volumen"] = parseInt(this.value);
    localStorage.local_tracks = JSON.stringify(tracks);
    } 
}

function lineasDelReproductor(){
    var tabla = $("#tabla_panel");
    var tr_lineas_divisorias = $("<tr>");
    var primer_td_invisible = $("<td>");
    var td_lineas = $("<td>").attr("class","lineas_reproductor");
    var CssCasilla={"width":'40px',"height":'40px', "text-align":"center"};
    //$(".linea_divisoria").eq(0).css("color","cyan");
    //$(".linea_divisoria:eq(0)").css("color","cyan");

    for (let index = 0; index < 16; index++) {
        var div_linea_divisoria = $("<div>").attr("class","linea_divisoria").text("'").css(CssCasilla);
        $(td_lineas).append(div_linea_divisoria);
    }

    $(tr_lineas_divisorias).append(primer_td_invisible);
    $(tr_lineas_divisorias).append(td_lineas);
    $(tabla).append(tr_lineas_divisorias);
}

function pasarDatosAPlaySonido(){
    var numero_de_tracks = tracks.length;

    if(Tempo>240 || Tempo< 40){
        alert(Tempo);
        return ;    
    }

    var arrayTiempo = [];
    var arrayTemporal = [];

    for (var i = 0; i <= 15; i++) {
        for (var z = 0; z < numero_de_tracks; z++) {
            casilla_iluminada = tracks[z]["casillas"][i];
            if (z != numero_de_tracks) {
                if (casilla_iluminada == 1){
                    //playSonido(tracks[z]);
                    arrayTemporal.push(tracks[z]);
                }
            }
        }
        arrayTiempo[i] = arrayTemporal;
        arrayTemporal = [];
    }

    var l = 0;
    Loop = setInterval(function(){
        $(".linea_divisoria").css("color","black");
        $(".linea_divisoria").eq(l).css("color","cyan");
        funcionPrueba(arrayTiempo[l]);
        
        l++;
        if (l >= 16) {
            l = 0;
        }
        
    },2000)
}

function funcionPrueba(arrayTiempo){
    for (const key in arrayTiempo) {
        playSonido(arrayTiempo[key]);
    }
}

function playSonido(track){
    console.log(track);
    var porcentaje_volumen = track["volumen"];
    var nombre = track["audio"];
    Sonido(nombre,porcentaje_volumen);
}

function pararSonido(){
    for (var i =0; i <= Loop; i++) {
        clearInterval(i);
    }
}

//Descargar JSON
function descargarJSON(){

    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(tracks));
    $("#form_descargar_json").attr("href",dataStr).attr("download", "pistas.json");
    //boton_descarga.click();
}

//Subir JSON
function leerArchivo(e) {
    var booleano;
    var archivo = e.target.files[0];
    if (!archivo) {
        return;
    }
    var lector = new FileReader();
    lector.onload = function(e) {
        var contenido = e.target.result;
        if (JSON.parse(contenido).length == JSON.parse(localStorage.local_tracks).length) {
            for (const key in JSON.parse(localStorage.local_tracks)) {
                //console.log(booleano);
                if (JSON.parse(contenido)[key]["audio"] === JSON.parse(localStorage.local_tracks)[key]["audio"]) {
                    booleano = true;
                }
                else{
                    booleano = false;
                }
            }
        }
        if (booleano) {
            localStorage.local_tracks = contenido;
            tracks = JSON.parse(localStorage.local_tracks);
            $("#slide_general").html("");
            datosTracks();
        }
        else{
            alert("Error, no has subido el mismo tipo de pistas");
        }
    };
    lector.readAsText(archivo);
    
}
  
function RecibirTempo(){
    var valTempo=$('#input-metro').val();
    var Tempo=60000/valTempo;
    $('')  
}


