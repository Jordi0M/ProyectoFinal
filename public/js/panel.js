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