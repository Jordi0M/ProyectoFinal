@extends('layouts.master')

@section('contenido')
    <div class="row" style="background-color:gray">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
        </div>
        <div style="text-align:center; background-color:yellow; padding-left:1%" class="col-sm-8">
            <button>
                <i class="material-icons hvr-glow" style="float:left">play_arrow</i>
            </button>
            <button>
                <i class="material-icons hvr-glow" style="float:right">stop</i>
            </button>
            &nbsp;
            <button>
                <i id="limpiar" class="material-icons" style="float:left">clear</i>
            </button>
            &nbsp;
            <button>
                <i class="material-icons hvr-glow" style="float:right">folder</i>
            </button>
            <button>
                <i class="material-icons hvr-glow" style="float:left">save</i>
            </button>
            &nbsp;
            <button>
                <i class="material-icons hvr-glow" style="float:right">music_note</i>
            </button>
        </div>
    </div>
    <div class="row click_panel" style="background-color:gray">
        
    	<div class="col-sm-1" id="nombre_audios">
    		<span class="hvr-glow" nombre="Mar.mp3">Crash</span> <br>
    		<span class="hvr-glow" nombre="fuego.mp3">Tom</span> <br>
    		<span class="hvr-glow" nombre="Intro.mp3">Snare</span> <br>
    		<span class="hvr-glow" nombre="Iglesia.mp3">Kick</span>

    		
    	</div>
    	<div class="center_panel" >
  

  
    		<div class="rangeslider"> 
  <input type="range" min="1" max="100" value="10"
                  class="myslider" id="sliderRange"> 
  <p>Value: <span id="demo"></span></p> 
</div> 
  
<script> 
var rangeslider = document.getElementById("sliderRange"); 
var output = document.getElementById("demo"); 
output.innerHTML = rangeslider.value; 
  
rangeslider.oninput = function() { 
  output.innerHTML = this.value; 
} 
</script> 
    	</div> 
    </div>
    <script>
        //Este script añade en el div con id "nombre_audios", los audios que encuentre en la base de datos
        //los cuales tambien los busca en la carpeta storage que estara en public
        document.addEventListener('DOMContentLoaded', function(){
                var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};

                for (const key in datos_JSON) {
                    var nombre_audio = datos_JSON[key]["nombre"];
                    var agregar_span = $("<span>").attr("class","hvr-glow").attr("nombre",nombre_audio).text(nombre_audio);
                    $("#nombre_audios").append("<br>");
                    $("#nombre_audios").append(agregar_span);

                }
				
		});
		crearCasillas();
    </script>
@endsection