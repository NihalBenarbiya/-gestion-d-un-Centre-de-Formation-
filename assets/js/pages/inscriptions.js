const api_url = "api/inscrire/";
const defaultObject = {
    ID_APPRENANT : "",
    ID_FORMATION: "",
    ETAT_DE_PAIEMENT: "0",
};
let currentObject = {};
let modal;
let mode = "create";
let inscription = {};

/**/
updateForm = function (_inscription){
    inscription = _inscription;
    console.log("aa",_inscription)
    $('#form_control_ID_APPRENANT').val(_inscription.ID_APPRENANT);
    $('#form_control_ID_FORMATION').val(_inscription.ID_FORMATION);
    $('#form_control_ETAT_DE_PAIEMENT').prop('checked',_inscription.ETAT_DE_PAIEMENT === "1");
}
getInscription = function(ID_FORMATION, ID_APPRENANT){
    $.get(api_url+"one.php", {ID_FORMATION:ID_FORMATION, ID_APPRENANT:ID_APPRENANT}, function(response) {
        updateForm(response);
        currentObject = {ID_FORMATION:ID_FORMATION, ID_APPRENANT:ID_APPRENANT};
    });
}
getInscriptions = function(){
    $.get(api_url+"all.php", function(response) {
        $('#ae_tbody').html('');
        response.forEach(function(row){
            let classname = 'badge-success';
            let etat = 'Payé';
            if(row.ETAT_DE_PAIEMENT === '0'){
                classname = 'badge-danger';
                etat = 'Non payé';
            }
            //
            const date_debut = new Date(row.FORMATION.DATE_DEBUT);
            const date_fin = new Date(row.FORMATION.DATE_FIN);
            const today = new Date();
            let classname2 = 'badge-primary';
            let status = 'A venir';
            if(today > date_fin){
                classname2 = 'badge-danger';
                status = 'Terminé';
            }else {
                if(today >= date_debut) {
                    classname2 = 'badge-success';
                    status = 'En cours';
                }
            }


            $('#ae_tbody')
                .append(
                    '<tr>' +
                    '<td>'+row.APPRENANT.NOM+' '+row.APPRENANT.PRENOM+'</td>' +
                    '<td>'+row.FORMATION.NOM+'</td>' +
                    '<td><span class="badge '+classname+'">'+etat+'</span></td>' +
                    '<td><span class="badge '+classname2+'">'+status+'</span></td>' +

                    '<td class="text-right">' +
                    '<a class="btn btn-sm btn-icon-only text-success" href="#" onclick="openModal('+row.ID_FORMATION+', '+row.ID_APPRENANT+')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '<a class="btn btn-sm btn-icon-only text-danger" href="#" onclick="remove('+row.ID_FORMATION+', '+row.ID_APPRENANT+')">' +
                    '<i class="fas fa-trash"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>'
                );

        });
    });
}
getFormations = function(){
    $.get("api/formation/all.php", function(response) {
        response.forEach(row=>{
            $('#form_control_ID_FORMATION')
                .append("<option value="+row.ID_FORMATION+">"+row.NOM+"</option>")
        });
    });
}
getApprenants = function(){
    $.get("api/apprenant/all.php", function(response) {
        response.forEach(row=>{
            $('#form_control_ID_APPRENANT')
                .append("<option value="+row.ID_APPRENANT+">"+row.NOM+" "+row.PRENOM+"</option>");
        });
    });
}
save = function(){
    let url = api_url+(mode === "update" ? "update.php" : "create.php");
    let postData = {data: inscription};
    if(mode === "update")
    {
        postData.ID_APPRENANT = currentObject.ID_APPRENANT;
        postData.ID_FORMATION = currentObject.ID_FORMATION;
    }
    console.log()
    $.post(url, postData, function(response) {
        if(response === true)
        {
            getInscriptions();
            closeModal();
        }else {
            alert("Les champs ne sont pas valides ou l'inscription existent déjà")
        }
    }).fail(r=>{
        alert("Les champs ne sont pas valides ou l'inscription existent déjà")
    });
}
remove = function(ID_FORMATION, ID_APPRENANT){

    const confirmed = confirm("Êtes-vous sûr?");
    if(confirmed){
        jQuery
            .get(api_url+"delete.php", {ID_FORMATION:ID_FORMATION, ID_APPRENANT:ID_APPRENANT}, function(response) {
                getInscriptions();
            });
    }
}
openModal = function (ID_FORMATION, ID_APPRENANT) {
    if(ID_FORMATION !== undefined && ID_APPRENANT !== undefined){//modification
        getInscription(ID_FORMATION, ID_APPRENANT);
        mode = "update";
        modal.modal("show");
    }else {
        mode = "create";
        modal.modal("show");
    }
}
closeModal = function () {
    modal.modal("hide");
}
handleChange = function(event, property, value){
    if(property === "ETAT_DE_PAIEMENT"){
        inscription[property] = event.checked ? "1":"0";
    }else {
        inscription[property] = value ? value: event.value;
    }

}



/**/
$(document).ready(()=>{
    modal = $('#ae_modal');
    modal
        .on('show.bs.modal',function(){
            updateForm(defaultObject);
        });
    /**/
    getInscriptions();
    getFormations();
    getApprenants();
})