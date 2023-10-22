const api_url = "api/certificat/";
let formation = {
    ID_FORMATION : ""
};

getFormations = function(){
    $.get("api/formation/mesFormations.php", function(response) {
        response.forEach((row, index)=>{
            if(index === 1){
                formation.ID_FORMATION = row.ID_FORMATION;
            }
            const date_fin = new Date(row.DATE_FIN);
            const today = new Date();
            const disabled = today > date_fin ? "disabled": "";
            $('#form_control_ID_FORMATION')
                .append("<option "+disabled+" value="+row.ID_FORMATION+" class='"+(today > date_fin ? "text-warning":"text-success")+"'>"+row.NOM+"</option>")
        });
    });
}
save = function(){

    $.post(api_url+"create.php", {data: formation}, function(response) {
        if(response === true)
        {
            alert("Bien Envoyé")
        }else {
            alert("Veuillez vérifier les champs")
        }
    }).fail(r=>{
        alert("Veuillez vérifier les champs")
    });
}


handleChange = function(event, property, value){
    formation[property] = value ? value: event.value;
}


/**/
$(document).ready(()=>{
    getFormations();
})