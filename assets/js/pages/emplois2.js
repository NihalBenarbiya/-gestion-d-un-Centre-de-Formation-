
getEmplois = function(){
    $.get("api/emploi/monEmploi.php", function(response) {
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
                    html = html+'<span class="badge badge-secondary">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }


            const _10hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "10");
            if(_10hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_10hIndex].FORMATIONS.forEach(function (formation) {
                    html = html+'<span class="badge badge-secondary" onclick="openModal('+formation.ID_FORMATION+')">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

            const _14hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "14");
            if(_14hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_14hIndex].FORMATIONS.forEach(function (formation) {
                    html = html+'<span class="badge badge-secondary">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

            const _16hIndex = rows.findIndex(j=>j.HEURE_DEBUT === "16");
            if(_16hIndex === -1){
                tr.append('<td></td>');
            }else {
                let html = "";
                rows[_16hIndex].FORMATIONS.forEach(function (formation) {
                    html = html+'<span class="badge badge-secondary">'+formation.NOM+'</span>';
                })
                tr.append('<td>'+html+'</td>');
            }

        });
    });
}


/**/
$(document).ready(()=>{
    getEmplois();
})