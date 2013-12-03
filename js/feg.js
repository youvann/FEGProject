$(document).ready(OnReady);

function OnReady(){
    // Cache le formulaire 2
    // $("#inscription").hide();
    // Formulaire 1 : Listes déroulantes
    $("#form_liste").submit(OnSubmitList);
}   

function OnSubmitList(data){
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: OnSuccessForm1
    });
    return false;
} // OnSubmitList ()

function OnSuccessForm1(data){
    var result = $("#result_form1");
    result.hide();      
    if(data.reponse === "ok"){
        result.html('<br/> Formations bien sélectionnées : ' + data.liste1 + ' et ' + data.liste2);
        result.fadeIn('slow');
        
        // setTimeout(function() {
        //     $("#formation").hide();
        //     $("#inscription").fadeIn('slow');
        // }, 1500);

    }else{
        result.html('<br/> Erreur : Veuillez resaisir les données');
        result.fadeIn('slow');
    }    
    
}   // OnSuccessForm ()

