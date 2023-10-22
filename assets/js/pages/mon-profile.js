const api_url = "api/auth/";

/**/
updateProfile = function(){
    const infos = {
        NOM : $('#form_control_NOM').val(),
        PRENOM: $('#form_control_PRENOM').val(),
        EMAIL: $('#form_control_EMAIL').val(),
        TEL: $('#form_control_TEL').val(),
        ADRESSE: $('#form_control_ADRESSE').val(),
        MDP: $('#form_control_MDP').val()
    };
    $.post(api_url+"updateProfile.php", {data:infos}, function(response) {
        if(response)
        {
            alert("Bien Enregistrer")
        }
        else {
            alert("Veuillez vérifier les champs")
        }


    }).fail(function () {
        alert("Veuillez vérifier les champs")
    })

    ;
}

