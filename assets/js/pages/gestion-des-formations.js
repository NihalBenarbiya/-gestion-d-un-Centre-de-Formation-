const api_url = "api/formation/";
const defaultObject = {
    NOM : "",
    DATE_DEBUT: "",
    DATE_FIN: "",
    PRIX: 0,
    ID_FORMATEUR: "",
};
let modal;
let formation = {};

/**/
updateForm = function (_formation){
    formation = _formation;
    $('#form_control_NOM').val(_formation.NOM);
    $('#form_control_DATE_DEBUT').val(_formation.DATE_DEBUT);
    $('#form_control_DATE_FIN').val(_formation.DATE_FIN);
    $('#form_control_PRIX').val(_formation.PRIX);
    $('#form_control_ID_FORMATEUR').val(_formation.ID_FORMATEUR);
}
getFormation = function(id){
    $.get(api_url+"one.php", {id:id}, function(response) {
        updateForm(response);
    });
}
getFormations = function(){
    $.get(api_url+"all.php", function(response) {
        $('#ae_tbody').html('');
        response.forEach(function(row){
            const date_debut = new Date(row.DATE_DEBUT);
            const date_fin = new Date(row.DATE_FIN);
            const today = new Date();
            let classname = 'badge-primary';
            let status = 'A venir';
            if(today > date_fin){
                classname = 'badge-danger';
                status = 'Terminé';
            }else {
                if(today >= date_debut) {
                    classname = 'badge-success';
                    status = 'En cours';
                }
            }

            $('#ae_tbody')
                .append(
                    '<tr>' +
                    '<td>'+row.NOM+'</td>' +
                    '<td >'+date_debut.toLocaleDateString()+'</td>' +
                    '<td>'+date_fin.toLocaleDateString()+'</td>' +
                    '<td>' +
                    '<span class="badge badge-secondary">'+row.FORMATEUR.PRENOM+' '+row.FORMATEUR.NOM+'</span>' +
                    '</td>' +
                    '<td>' +
                    '<span class="badge '+classname+'">'+status+'</span>' +
                    '</td>' +
                    '<td>'+row.PRIX+' DH</td>' +
                    '<td class="text-right">' +
                    '<a class="btn btn-sm btn-icon-only text-success" href="#" onclick="openModal('+row.ID_FORMATION+')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '<a class="btn btn-sm btn-icon-only text-danger" href="#" onclick="remove('+row.ID_FORMATION+')">' +
                    '<i class="fas fa-trash"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>'
                );

        });
        console.log(data);
    });
}
save = function(){
    let url = api_url+(formation.ID_FORMATION ? "update.php" : "create.php");
    $.post(url, {data: formation}, function(response) {
        if(response === true)
        {
            getFormations();
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
                getFormations();
            });
    }


}
openModal = function (id) {
    if(id !== undefined){//modification
        getFormation(id);
        modal.modal("show");
    }else {
        modal.modal("show");
    }
}
closeModal = function () {
    modal.modal("hide");
}

handleChange = function(event, property, value){
    formation[property] = value ? value: event.value;
}

getFormateurs = function(){
    $.get("api/formateur/all.php", function(response) {
        response.forEach(_formateur=>{
            $('#form_control_ID_FORMATEUR')
                .append("<option value="+_formateur.ID_FORMATEUR+">"+_formateur.NOM+" "+_formateur.PRENOM+"</option>");
        });
    });
}

/**/
$(document).ready(()=>{
    modal = $('#ae_modal');
    modal
        .on('show.bs.modal',function(){
            updateForm(defaultObject);
        });
    /**/
    getFormations();
    getFormateurs();
    updateForm(defaultObject);
})