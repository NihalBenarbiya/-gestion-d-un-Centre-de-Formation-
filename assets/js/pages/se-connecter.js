const api_url = "api/auth/";
let loginInfo = {
    EMAIL : "",
    MDP: "",
};
/**/
login = function(){
    $.post(api_url+"login.php", loginInfo, function(response) {
        // console.log(response);
        if(response === true){
            window.location.href = "index.php";
        }else {
            alert('Email ou le mot de passe incorrect');
        }
    }).fail(function () {
        alert('Email ou le mot de passe incorrect')
    })

    ;
}

handleChange = function(event, property, value){
    loginInfo[property] = value ? value: event.value;
}


