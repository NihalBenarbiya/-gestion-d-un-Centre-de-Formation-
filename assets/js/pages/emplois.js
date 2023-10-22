const api_url = "api/emploi/";
const defaultObject = {
    ID_EMPLOIE : "",
    ID_FORMATION: "",
};
let modal;
let formateur = {};

/**/
updateForm = function (_formateur){
    formateur = _formateur;
    $('#form_control_ID_EMPLOIE').val(_formateur.ID_EMPLOIE);
    $('#form_control_ID_FORMATION').val(_formateur.ID_FORMATION);
}
// getFormateur = function(id){
//     $.get(api_url+"one.php", {id:id}, function(response) {
//         updateForm(response);
//     });
// }
getEmplois = function(){
    $.get(api_url+"all.php", function(response) {
        response.forEach(row=>{
            $('#form_control_ID_EMPLOIE')
                .append("<option value="+row.ID_EMPLOIE+">"+row.JOUR+" de " + row.HEURE_DEBUT + ":00 à "+row.HEURE_FIN+":00 </option>")
        });


        /**/
        const jours = ['lundi','mardi','mercredi','jeudi','vendredi','samedi'];

        jours.forEach(function(jour){
            let tr = $('#ae_'+jour);
            tr.html(tr.children(1).get(0));
            const rows = response.filter(function (jour2) {
                return jour2.JOUR.toLowerCase() === jour;
            })

            const _8hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "8");
            if(_8hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_8hIndex].FORMATIONS.forEach(function (formation) {
                    const date_debut = new Date(formation.DATE_DEBUT);
                    const date_fin = new Date(formation.DATE_FIN);
                    const today = new Date();
                    let classname = 'badge-primary';
                    if(today > date_fin){
                        classname = 'badge-danger';
                    }else {
                        if(today >= date_debut) {
                            classname = 'badge-success';
                        }
                    }

                    html = html+'<span class="badge '+classname+'">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }


            const _10hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "10");
            if(_10hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_10hIndex].FORMATIONS.forEach(function (formation) {
                    const date_debut = new Date(formation.DATE_DEBUT);
                    const date_fin = new Date(formation.DATE_FIN);
                    const today = new Date();
                    let classname = 'badge-primary';
                    if(today > date_fin){
                        classname = 'badge-danger';
                    }else {
                        if(today >= date_debut) {
                            classname = 'badge-success';
                        }
                    }

                    html = html+'<span class="badge '+classname+'">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

            const _14hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "14");
            if(_14hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_14hIndex].FORMATIONS.forEach(function (formation) {
                    const date_debut = new Date(formation.DATE_DEBUT);
                    const date_fin = new Date(formation.DATE_FIN);
                    const today = new Date();
                    let classname = 'badge-primary';
                    if(today > date_fin){
                        classname = 'badge-danger';
                    }else {
                        if(today >= date_debut) {
                            classname = 'badge-success';
                        }
                    }

                    html = html+'<span class="badge '+classname+'">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

            const _16hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "16");
            if(_16hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_16hIndex].FORMATIONS.forEach(function (formation) {
                    const date_debut = new Date(formation.DATE_DEBUT);
                    const date_fin = new Date(formation.DATE_FIN);
                    const today = new Date();
                    let classname = 'badge-primary';
                    if(today > date_fin){
                        classname = 'badge-danger';
                    }else {
                        if(today >= date_debut) {
                            classname = 'badge-success';
                        }
                    }

                    html = html+'<span class="badge '+classname+'">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

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
save = function(){
    let url = api_url+(formateur.ID_FORMATEUR ? "update.php" : "create.php");
    $.post(url, {data: formateur}, function(response) {
        if(response === true)
        {
            getEmplois();
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
                getEmplois();
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
    getEmplois();
    getFormations();
    updateForm(defaultObject);
})