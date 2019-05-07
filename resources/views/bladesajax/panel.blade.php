holassSS

<script>
    console.log("tataturca");
    //Este script añade en el div con id "nombre_audios", los audios que encuentre en la base de datos
    //los cuales tambien los busca en la carpeta storage que estara en public
    document.addEventListener('DOMContentLoaded', function(){
            var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
            var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

            

            crearPanel(datos_JSON);

            function pasarCasillas(){
                Recibir({!!$NumeroPistas!!});
            }
            $( "#play" ).on( "click",  pasarCasillas );
            
    });
</script>