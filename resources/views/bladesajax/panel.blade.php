<script>
    
    var datos_JSON = {!! json_encode($ListaAudios->toArray(), JSON_HEX_TAG) !!};
    var NumeroPistas = {!! json_encode($NumeroPistas, JSON_HEX_TAG) !!};

    //crearPanel(datos_JSON);

    crearTracks(datos_JSON);
    //crearPanel2(tracks);
                
</script>