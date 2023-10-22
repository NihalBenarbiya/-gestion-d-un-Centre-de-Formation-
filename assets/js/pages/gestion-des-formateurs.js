const api_url = "api/formateur/";
const defaultObject = {
    NOM : "",
    PRENOM: "",
    CIN: "",
    EMAIL: "",
    TEL: "",
    ADRESSE: "",
};
let modal;
let formateur = {};

/**/
updateForm = function (_formateur){
    formateur = _formateur;
    $('#form_control_NOM').val(_formateur.NOM);
    $('#form_control_PRENOM').val(_formateur.PRENOM);
    $('#form_control_CIN').val(_formateur.CIN);
    $('#form_control_EMAIL').val(_formateur.EMAIL);
    $('#form_control_TEL').val(_formateur.TEL);
    $('#form_control_ADRESSE').val(_formateur.ADRESSE);
}
getFormateur = function(id){
    $.get(api_url+"one.php", {id:id}, function(response) {
        updateForm(response);
    });
}
getFormateurs = function(){
    $.get(api_url+"all.php", function(response) {
        $('#ae_tbody').html('');
        response.forEach(function(row){

            $('#ae_tbody')
                .append(
                    '<tr>' +
                    '<td>'+row.NOM+'</td>' +
                    '<td>'+row.PRENOM+'</td>' +
                    '<td>'+row.CIN+'</td>' +
                    '<td>'+row.EMAIL+'</td>' +
                    '<td>'+row.TEL+'</td>' +
                    '<td>'+row.ADRESSE+'</td>' +

                    '<td class="text-right">' +
                    '<a class="btn btn-sm btn-icon-only text-success" href="#" onclick="openModal('+row.ID_FORMATEUR+')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '<a class="btn btn-sm btn-icon-only text-danger" href="#" onclick="remove('+row.ID_FORMATEUR+')">' +
                    '<i class="fas fa-trash"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>'
                );

        });
    });
}
save = function(){
    let url = api_url+(formateur.ID_FORMATEUR ? "update.php" : "create.php");
    $.post(url, {data: formateur}, function(response) {
        if(response === true)
        {
            getFormateurs();
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
                getFormateurs();
            });
    }


}
openModal = function (id) {
    if(id !== undefined){//modification
        getFormateur(id);
        modal.modal("show");
    }else {
        modal.modal("show");
    }
}
closeModal = function () {
    modal.modal("hide");
}

handleChange = function(event, property, value){
    formateur[property] = value ? value: event.value;
}


/**/
$(document).ready(()=>{
    modal = $('#ae_modal');
    modal
        .on('show.bs.modal',function(){
            updateForm(defaultObject);
        });
    /**/
    getFormateurs();
    getFormateurs();
    updateForm(defaultObject);
})