const api_url = "api/secretaire/";
const defaultObject = {
    NOM : "",
    PRENOM: "",
    EMAIL: "",
    TEL: "",
    ADRESSE: "",
    MDP: "",
};
let modal;
let secretaire = {};

/**/
updateForm = function (_secretaire){
    secretaire = _secretaire;
    $('#form_control_NOM').val(_secretaire.NOM);
    $('#form_control_PRENOM').val(_secretaire.PRENOM);
    $('#form_control_EMAIL').val(_secretaire.EMAIL);
    $('#form_control_TEL').val(_secretaire.TEL);
    $('#form_control_ADRESSE').val(_secretaire.ADRESSE);
    $('#form_control_MDP').val(_secretaire.MDP);
}
getSecretaire = function(id){
    $.get(api_url+"one.php", {id:id}, function(response) {
        updateForm(response);
    });
}
getSecretaires = function(){
    $.get(api_url+"all.php", function(response) {
        $('#ae_tbody').html('');
        response.forEach(function(row){
            $('#ae_tbody')
                .append(
                    '<tr>' +
                    '<td>'+row.NOM+'</td>' +
                    '<td>'+row.PRENOM+'</td>' +
                    '<td>'+row.EMAIL+'</td>' +
                    '<td>'+row.TEL+'</td>' +
                    '<td>'+row.ADRESSE+'</td>' +

                    '<td class="text-right">' +
                    '<a class="btn btn-sm btn-icon-only text-success" href="#" onclick="openModal('+row.ID_SECRETAIRE+')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '<a class="btn btn-sm btn-icon-only text-danger" href="#" onclick="remove('+row.ID_SECRETAIRE+')">' +
                    '<i class="fas fa-trash"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>'
                );

        });
    });
}
save = function(){
    let url = api_url+(secretaire.ID_SECRETAIRE ? "update.php" : "create.php");
    $.post(url, {data: secretaire}, function(response) {
        if(response === true)
        {
            getSecretaires();
            closeModal();
        }else {
            alert("Veuillez vérifier les champs")
        }
    }).fail(r=>{
        alert("Veuillez vérifier les champs")
    });
}
remove = function(id){

    const confirmed = confirm("Êtes-vous sûr?");
    if(confirmed){
        jQuery
            .get(api_url+"delete.php", { id: id }, function(response) {
                getSecretaires();
            });
    }


}
openModal = function (id) {
    if(id !== undefined){//modification
        getSecretaire(id);
        modal.modal("show");
    }else {
        modal.modal("show");
    }
}
closeModal = function () {
    modal.modal("hide");
}

handleChange = function(event, property, value){
    secretaire[property] = value ? value: event.value;
}



/**/
$(document).ready(()=>{
    modal = $('#ae_modal');
    modal
        .on('show.bs.modal',function(){
            updateForm(defaultObject);
        });
    /**/
    getSecretaires();
    updateForm(defaultObject);
})