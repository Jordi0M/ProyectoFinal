@include('layouts.app') {{--Esto es el nav del login--}}

@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
        </div>
        <div class="col-sm-8" id="Botonera">
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

        </div>
    </div>

    <div class="row click_panel" style="background-color:gray">

        <div class="slide_general" id="slide_general">
			
        </div>

    </div>
    <script>

        var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
        
        console.log(datos_JSON);

        mostrarListaAudios()
    
    </script>
@endsection