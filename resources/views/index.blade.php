@include('layouts.app') {{--Esto es el nav del login--}}

@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
            
        </div>
        <div class="col-sm-8" id="Botonera">
            <button id="play" title="Click para Play">
                <i class="material-icons" style="float:left">play_arrow</i>
            </button>
            <button id="stop" title="Click para Stop">
                <i class="material-icons" style="float:right">stop</i>
            </button>
            &nbsp;
            <button id="limpiar" title="Click para limpiar las casillas">
                <i class="material-icons" style="float:left">clear</i>
            </button>
            &nbsp;
            <button id="subir_json" title="Click para subir el archivo generado">
                <i class="material-icons" style="float:right">folder</i>
            </button>
            <button id="descargar_json" title="Click para generar un archivo">
                <i class="material-icons" style="float:left">save</i>
            </button>
            &nbsp;
            @auth
                @include('modals/modal_nuevo_sonido')
                <button id="subir_sonido" title="Click para subir una cancion">
                    <i class="material-icons" style="float:right" data-toggle="modal" data-target="#modal_nuevo_sonido">music_note</i>
                </button>
            @endauth

            @guest
                <button id="subir_sonido" title="Click para subir una cancion" onclick="alert('Registrate o logueate para poder subir una cancion')">
                    <i class="material-icons" style="float:right">music_note</i>
                </button>
            @endguest
            
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
                /*
                ////////Local Storage (guardar la informacion)
                if(typeof(Storage) !== "undefined") {
                    if (localStorage.pantalla2) {
                        
                        console.log(localStorage.getItem('pantalla2'));
                        $("#slide_general").html(localStorage.pantalla2);
                    } 
                    else {
                        
                        localStorage.pantalla2 = $("#slide_general").html();
                    }
                } else {
                        document.getElementById("#slide_general").innerHTML = "Sorry, your browser does not support web storage...";
                }
                */

                function pasarCasillas(){
                    Recibir({!!$NumeroPistas!!});
                }
                $( "#play" ).on( "click",  pasarCasillas );
				
		});
    </script>
@endsection