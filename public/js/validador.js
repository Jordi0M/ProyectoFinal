function validarNulos(IdForm){
    var control = true;
    $(IdForm + ' input').each(function(){
        if($(this).val() === ""){
            $(this).css('border','1px solid red');
            control = false;
        }else if($(this).children("option:selected").val() === ""){
			$(this).css('border','1px solid red');
            control = false;
		}else{
            $(this).css('border','');
        }
    })

    if(control){
        return true;
    }else{
        alert("Todos los campos son obligatorios.");
        return false;
    }
}