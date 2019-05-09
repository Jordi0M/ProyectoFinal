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

                $( document ).ready(function(){

                    $("#descargar_json").click(function(){
                        genBlock()
                    })
                    
                    $("#subir_json").click(function(){
                        recorrerHijo("Teclas");
                    })		

                })

                function recorrerHijo(classPadre){
                
                    var padre = "."+classPadre;
                    
                    $(padre).children().each(function(indice, elemento){
                        //console.log(elemento);
                        if (elemento.className !== ""){
                            console.log("Mi padre es: "+classPadre+"  Soy el hijo: "+ elemento.className);
                            recorrerHijo(elemento.className);
                        }
                    });
                }
                function genBlock(cnt_block){
                    var elements = []
                    
                    recorrerHijo("Teclas");

                    $(".Teclas div").each(function(index){           
                        var objetoHijo = new Object();
                        objetoHijo.class = $(this).attr("class");
                        objetoHijo.style = $(this).attr("style");
                        objetoHijo.text = $("." + objetoHijo.class).html();
                        elements.push(objetoHijo);
                    }) 
                    console.log(elements)      
                    
                    //var obj = JSON.parse(elements);
                    //console.log(obj)
                    /*
                    for (var i = 0; i < rows.length; i++) {
                        obj['datos'].push({"nombre":rows[i].nombre,"acierto":rows[i].dato1,"fallo":rows[i].dato2});
                    };
                    */
                    var obj = JSON.stringify(elements);
                    console.log(obj)

                    var data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(elements));

                    var a = document.createElement('a');
                    a.href = 'data:' + data;
                    a.download = 'data.json';
                    a.innerHTML = 'download JSON';

                    var container = document.getElementById('slide_general');
                    container.appendChild(a);
                }

                function pasarCasillas(){
                    Recibir({!!$NumeroPistas!!});
                }
                $( "#play" ).on( "click",  pasarCasillas );
				
		});
    </script>
@endsection