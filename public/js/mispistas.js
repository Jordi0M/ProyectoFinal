function tracks_mis_pistas(){
    tracks = []
    for (const key in datos_JSON) {
        var track = {
            nombre : datos_JSON[key]["nombre_mostrar"],
            volumen : 70,
            audio : datos_JSON[key]["nombre_link"],
            casillas : [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        };   
        tracks.push(track); 
    }
}

function mostrarListaAudios(){
    
    tracks_mis_pistas();

    var tbody_tabla_mis_pistas = $("#tbody_tabla_mis_pistas");

    for (const key in tracks) {
        
        var nuevo_tr = $("<tr>");
        var nuevo_th = $("<th scope=row>");
        var td_nombre_audio = $("<td>").text(tracks[key]["nombre"]);
        var td_botones = $("<td>");
        var boton_eliminar = $("<button class='btn btn-danger eliminar' style='margin-left: 5%' title='click para editar el nombre'>").attr("numero_audio",key);
        var boton_editar = $("<button class='btn btn-warning editar' title='click para eliminar el audio'>").attr("numero_audio",key);
        var icono_boton_editar = $("<i>").attr("class","material-icons").attr("style","float:right").text("create");
        var icono_boton_eliminar = $("<i>").attr("class","material-icons").attr("style","float:right").text("delete");
        

        $(boton_editar).append(icono_boton_editar);
        $(td_botones).append(boton_editar);

        $(boton_eliminar).append(icono_boton_eliminar);
        $(td_botones).append(boton_eliminar);

        $(nuevo_tr).append(nuevo_th).append(td_nombre_audio).append(td_botones);
        $(tbody_tabla_mis_pistas).append(nuevo_tr);
    }

    $( document ).ready(function() {
        $( ".eliminar" ).on( "click",  eliminarAudio );
    });    
    
}

function eliminarAudio(){
    var form_eliminar = $("#form_eliminar");
    var numero_audio = $(this).attr("numero_audio");
    var ruta_eliminar = $("#form_eliminar").attr("action");
    var nombre_audio_link = tracks[numero_audio]["audio"].replace('public/', '');
    //nombre_audio_link = tracks[numero_audio]["audio"].replace('.wav', '');

    $("#form_eliminar").attr("action",ruta_eliminar+nombre_audio_link);

    $(form_eliminar).submit();
}

