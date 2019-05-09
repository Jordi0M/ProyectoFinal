@include('layouts.app') {{--Esto es el nav del login--}}

@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
            
        </div>
        <div class="col-sm-8" id="Botonera">
            <button class="Botons" id="play" title="Click para Play">
                <i class="material-icons" style="float:left">play_arrow</i>
            </button>
            <button class="Botons" id="stop" title="Click para Stop">
                <i class="material-icons" style="float:right">stop</i>
            </button>
            &nbsp;
            <button class="Botons" id="limpiar" title="Click para limpiar las casillas">
                <i class="material-icons" style="float:left">clear</i>
            </button>
            &nbsp;
            <button class="Botons" id="subir_json" title="Click para subir el archivo generado">
                <i class="material-icons" style="float:right">folder</i>
            </button>
            <button class="Botons" id="descargar_json" title="Click para generar un archivo">
                <i class="material-icons" style="float:left">save</i>
            </button>
            &nbsp;
            @auth
                @include('modals/modal_nuevo_sonido')
                <button class="Botons" id="subir_sonido" title="Click para subir una cancion">
                    <i class="material-icons" style="float:right" data-toggle="modal" data-target="#modal_nuevo_sonido">music_note</i>
                </button>
            @endauth

            @guest
                <button class="Botons" id="subir_sonido" title="Click para subir una cancion" onclick="alert('Registrate o logueate para poder subir una cancion')">
                    <i class="material-icons" style="float:right">music_note</i>
                </button>
            @endguest
                    <i class="Tempo-name">Tempo</i>
                    <input class="input-tempo" id="input-metro" type="number" name="bpm" value="80" min="40" max="240">
                    <!--<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a>
                    <a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a>-->
                    <span>bpm</span> 
        </div>
    </div>

    <div class="row click_panel" style="background-color:gray">

		<div class="slide_general" id="slide_general">
			
		</div>

    </div>
    <script>
        //Este script añade en el div con id "nombre_audios", los audios que encuentre en la base de datos
        //los cuales tambien los busca en la carpeta storage que estara en public
        document.addEventListener('DOMContentLoaded', function(){
                var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
                var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

                crearPanel(datos_JSON);

                var tracks = [];

                for (const key in datos_JSON) {
                    var track = {
                        nombre : datos_JSON[key]["nombre_mostrar"],
                        volumen : 70,
                        audio : datos_JSON[key]["nombre_link"],
                        casillas : [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                    };   
                    //tracks.push(track);
                    tracks.push(track);
                   
                }
                console.log(tracks);

                function pasarCasillas(){
                    Recibir({!!$NumeroPistas!!});
                }
                $( "#play" ).on( "click",  pasarCasillas );
				
		});
    </script>
@endsection