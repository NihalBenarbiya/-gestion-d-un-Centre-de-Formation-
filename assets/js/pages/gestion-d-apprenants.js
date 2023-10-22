const api_url = "api/apprenant/";
const defaultObject = {
    NOM : "",
    PRENOM: "",
    EMAIL: "",
    TEL: "",
    ADRESSE: "",
    MDP: "",
};
let modal;
let apprenant = {};

/**/
updateForm = function (_apprenant){
    apprenant = _apprenant;
    $('#form_control_NOM').val(_apprenant.NOM);
    $('#form_control_PRENOM').val(_apprenant.PRENOM);
    $('#form_control_EMAIL').val(_apprenant.EMAIL);
    $('#form_control_TEL').val(_apprenant.TEL);
    $('#form_control_ADRESSE').val(_apprenant.ADRESSE);
    $('#form_control_MDP').val(_apprenant.MDP);
}
getApprenant = function(id){
    $.get(api_url+"one.php", {id:id}, function(response) {
        updateForm(response);
    });
}
getApprenants = function(){
    $.get(api_url+"all.php", function(response) {
        $('#ae_tbody').html('');
        response.forEach(function(row){
            let formations = '';
            row.INSCRIRE.forEach(function (row2) {
                const today = new Date();
                const date_fin = new Date(row2.DATE_FIN);
                let classname = 'badge-success'
                if(today > date_fin){
                    classname = 'badge-danger';
                }
                formations = formations + '<span class="badge '+classname+'">'+row2.NOM+'</span>';
            })


            $('#ae_tbody')
                .append(
                    '<tr>' +
                    '<td>'+row.NOM+'</td>' +
                    '<td>'+row.PRENOM+'</td>' +
                    '<td>'+row.EMAIL+'</td>' +
                    '<td>'+row.TEL+'</td>' +
                    '<td>'+row.ADRESSE+'</td>' +
                    '<td>'+formations+'</td>' +

                    '<td class="text-right">' +
                    '<a class="btn btn-sm btn-icon-only text-success" href="#" onclick="openModal('+row.ID_APPRENANT+')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '<a class="btn btn-sm btn-icon-only text-danger" href="#" onclick="remove('+row.ID_APPRENANT+')">' +
                    '<i class="fas fa-trash"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>'
                );

        });
    });
}
save = function(){
    let url = api_url+(apprenant.ID_APPRENANT ? "update.php" : "create.php");
    $.post(url, {data: apprenant}, function(response) {
        if(response === true)
        {
            getApprenants();
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
                getApprenants();
            });
    }


}
openModal = function (id) {
    if(id !== undefined){//modification
        getApprenant(id);
        modal.modal("show");
    }else {
        modal.modal("show");
    }
}
closeModal = function () {
    modal.modal("hide");
}

handleChange = function(event, property, value){
    apprenant[property] = value ? value: event.value;
}



/**/
$(document).ready(()=>{
    modal = $('#ae_modal');
    modal
        .on('show.bs.modal',function(){
            updateForm(defaultObject);
        });
    /**/
    getApprenants();
    updateForm(defaultObject);
})