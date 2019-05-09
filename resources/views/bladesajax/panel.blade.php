<script>
    
    var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
    var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

    //crearPanel(datos_JSON);

    datosTracks();
    //crearPanel2(tracks);

    $( ".Tecla" ).on( "click",  clickCasilla );
                
</script>