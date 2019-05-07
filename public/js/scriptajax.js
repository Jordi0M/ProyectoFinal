/*
//olvidado
$( document ).ready(function() {
    $('#form_modal_nuevo_sonido').submit(function(e){
        e.preventDefault();

        var ruta = window.location.origin+$("#form_modal_nuevo_sonido").attr("action");
        var nuevo_nombre_del_sonido = $("#form_modal_nuevo_sonido input[name=nuevo_nombre_del_sonido]").val();
        var sonido = $("#form_modal_nuevo_sonido input[name=sonido]");
        var token = $("#form_modal_nuevo_sonido input[name=_token]").val();
        var form = $('#form_modal_nuevo_sonido');
        
        $.ajax({
            url: ruta,
            headers:{'X-CSRF-TOKEN':token},
            data: new FormData(form[0]),
            //data: form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'json',
            success: function(data){
                $('#modal_nuevo_sonido').modal('hide');
                //$(".click_panel").html(data);
                console.log(data);
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.errors);
              }
        })
    });
});
*/