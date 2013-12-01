$(document).ready(OnReady);

function OnReady(){
    // Formulaire 1 : Listes déroulantes
    $("form").submit(OnSubmit);
}   

function OnSubmit(data){
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: OnSuccessForm1
    });
    return false;
} // OnSubmit ()

function OnSuccessForm1(data){
    var result = $("#result_form1");
    result.hide();      
    if(data.reponse === "ok"){
        result.html('<br/> Formations bien sélectionnées : ' + data.liste1 + ' et ' + data.liste2);

    }else{
        result.html('<br/> Erreur : Veuillez resaisir les données');
    }
    result.fadeIn('slow');
    
}   // OnSuccessForm ()

