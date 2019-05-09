<script>
    
    var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
    var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

    //crearPanel(datos_JSON);

    datosTracks(datos_JSON);
    //crearPanel2(tracks);

    function pasarCasillas(){
        Recibir({!!$NumeroPistas!!});
    }
    $( "#play" ).on( "click",  pasarCasillas );

    $( ".Tecla" ).on( "click",  clickCasilla );
                
</script>