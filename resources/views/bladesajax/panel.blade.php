<script>
    
    var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
    var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

    crearPanel(datos_JSON);

    function pasarCasillas(){
        Recibir({!!$NumeroPistas!!});
    }
    $( "#play" ).on( "click",  pasarCasillas );

    $( ".hvr-glow" ).on( "click",  clickCasilla );
                
</script>