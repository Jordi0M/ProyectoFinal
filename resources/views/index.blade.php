@include('layouts.app') {{--Esto es el nav del login--}}

@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
            
        </div>
        <div class="col-sm-8" id="Botonera">
            <label class="Botons btn btn-secondary" id="play" title="Click para Play">
                <i class="material-icons" style="float:left">play_arrow</i>
            </label>
            <label class="Botons btn btn-secondary" id="stop" title="Click para Stop">
                <i class="material-icons" style="float:right">stop</i>
            </label>
            &nbsp;
            <label class="Botons btn btn-secondary" id="limpiar" title="Click para limpiar las casillas">
                <i class="material-icons" style="float:left">clear</i>
            </label>
            &nbsp;
            <label for="input_file_subir_json" class="Botons btn btn-secondary" id="subir_json" title="Click para subir el archivo generado">
                <i class="material-icons" style="float:right">folder</i>
            </label>
            <input type="file" id="input_file_subir_json" />
            <a id="form_descargar_json">
            <label class="Botons btn btn-secondary" id="descargar_json" title="Click para generar un archivo">
                <i class="material-icons" style="float:left">save</i>
            </label>
            </a>
            &nbsp;
            @auth
                @include('modals/modal_nuevo_sonido')
                <label class="Botons btn btn-secondary" id="subir_sonido" title="Click para subir una cancion">
                    <i class="material-icons" style="float:right" data-toggle="modal" data-target="#modal_nuevo_sonido">music_note</i>
                </label>
            @endauth

            @guest
                <label class="Botons btn btn-secondary" id="subir_sonido" title="Click para subir una cancion" onclick="alert('Registrate o logueate para poder subir una cancion')">
                    <i class="material-icons" style="float:right">music_note</i>
                </label>
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
        <div class="slide_general" id="slide_general2">
			
		</div>

    </div>
    <script>

        var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
  
        datosTracks("#slide_general");
    
    </script>
@endsection