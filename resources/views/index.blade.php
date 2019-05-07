@include('layouts.app') {{--Esto es el nav del login--}}

@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
            
        </div>
        <div class="col-sm-8" id="Botonera">
            <button id="play">
                <i class="material-icons" style="float:left">play_arrow</i>
            </button>
            <button id="stop">
                <i class="material-icons" style="float:right">stop</i>
            </button>
            &nbsp;
            <button id="limpiar">
                <i class="material-icons" style="float:left">clear</i>
            </button>
            &nbsp;
            <button id="subir_json">
                <i class="material-icons" style="float:right">folder</i>
            </button>
            <button id="descargar_json">
                <i class="material-icons" style="float:left">save</i>
            </button>
            &nbsp;
            @auth
                @include('modals/modal_nuevo_sonido')
                <button id="subir_sonido">
                    <i class="material-icons" style="float:right" data-toggle="modal" data-target="#modal_nuevo_sonido">music_note</i>
                </button>
            @endauth

            @guest
                <button id="subir_sonido" onclick="alert('Registrate o logueate para poder subir una cancion')">
                    <i class="material-icons" style="float:right">music_note</i>
                </button>
            @endguest
            
        </div>
    </div>
    <div class="row click_panel" style="background-color:gray">
        
    	<div class="col-sm-1" id="nombre_audios">
    	
    		
    	</div>
    	<div class="col-sm-9 center_panel" >
  

  
    	</div> 
		<div class="col-sm-2 slide_general">
			
		</div>

    </div>
    <script>
        //Este script añade en el div con id "nombre_audios", los audios que encuentre en la base de datos
        //los cuales tambien los busca en la carpeta storage que estara en public
        document.addEventListener('DOMContentLoaded', function(){
                var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
                var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

                function crearPanel(){
                    for (const key in datos_JSON) {
                        var nombre_audio = datos_JSON[key]["nombre_link"];
                        var nombre_mostrar = datos_JSON[key]["nombre_mostrar"];
                        nombre_audio = nombre_audio.replace('public/', '');
                        //como se guarda en la base de datos al inicio "public/", lo eliminaremos

                        var agregar_span = $("<span>").attr("nombre",nombre_audio).attr("pista",key).text(nombre_mostrar).css("margin-top","10px");
                        $("#nombre_audios").append("<br>");
                        $("#nombre_audios").append(agregar_span);
                        crearCasillas(nombre_audio, key);
                    
                    }
                }

                crearPanel();

                function pasarCasillas(){
                    Recibir({!!$NumeroPistas!!});
                }
                $( "#play" ).on( "click",  pasarCasillas );
				
		});
    </script>
@endsection