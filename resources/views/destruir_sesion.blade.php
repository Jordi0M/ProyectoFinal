<script>

    localStorage.clear();
    window.location = "/";

    ////////////LOGOUT, se guarda las iniciales.
    ///no sirve en esta blade, porque esta es para el login (lo de arriba);
    /*
    console.log(JSON.parse(localStorage.local_tracks));
    var tracks_iniciales = [];
    for (let index = 0; index < 6; index++) {
        console.log(tracks_iniciales);
        tracks_iniciales.push(JSON.parse(localStorage.local_tracks)[index]);
    }
    console.log(tracks_iniciales);
    */
</script>