$(document).ready(function() {
    /*****************
     ** Formulaires **
     *****************/

    // Formulaire formation 
    $("#formCandidatFormation").submit(function() {
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function(data) {
                var result = $("#result_form1");
                result.hide();
                if (data.reponse === "ok") {
                    result.html('<br/> Formations bien sélectionnées : ' + data.liste1 + ' et ' + data.liste2);
                } else {
                    result.html('<br/> Erreur : Veuillez resaisir les données');
                }
                result.fadeIn('slow');
            }
        });
        return false;
    });

    // Ajout d'une étoile rouge pour tous les champs obligatoires
    $(".required").each(function(){
        var span = $("<span />");
        span.attr("class", "obligatory").text(" *");
        span.appendTo($(this).prev());
        // Etoile rouge
        span.css("color", "red");
    });

    // Ajout/Suppression d'une textbox
    var error  = $("#error");
    var add    = $("#add");
    var remove = $("#remove");

    // Cache le message d'erreur par défaut
    error.hide();

    function numOrder (){
        // Compte le nombre de input compris dans balise #textbox
        var cpt = $('#textbox-group > input').length;
        return parseInt(cpt + 1);
    }

    // Récupère le dernier input
    var lastInput = $("#textbox-group").last();

    add.click(function() {
        if (numOrder() <= 10){
            var label = $("<label />");
            label.attr("for", "tb" + numOrder())
                 .attr("for", "tb" + numOrder())
                 .html("Choix "    + numOrder())
                 .hide().appendTo(lastInput).fadeIn("normal");

            var input = $("<input />");
            input.attr("type", "text")
                 .attr("class", "form-control")
                 .attr("id", "tb" + numOrder())
                 .attr("name", "tb[]")
                .hide().appendTo(lastInput).fadeIn("normal");
        }else{
            error.html("<br>Vous ne pouvez pas insérez plus de 10 champs.").fadeIn("normal");
            setTimeout(function(){
                error.fadeOut("slow");
            }, 5000);
        }
    });

    remove.click(function(){
        if(numOrder() > 3){
            $('#textbox-group input:last').fadeOut("normal", function(){
                $(this).remove();
            });
            $('#textbox-group label:last').fadeOut("normal", function(){
                $(this).remove();
            });

        }else{
            error.html("<br>Vous ne pouvez pas avoir moins de deux champs.").fadeIn("normal");
            setTimeout(function(){
                error.fadeOut("slow");
            }, 5000);
        }
    });

    var myLanguageFR = {
        errorTitle : 'Form submission failed!',
        requiredFields : 'Ce champ est obligatoire.',
        badTime : 'You have not given a correct time',
        badEmail : 'Veuillez fournir une adresse électronique valide.',
        badTelephone : 'You have not given a correct phone number',
        badSecurityAnswer : 'You have not given a correct answer to the security question',
        badDate : 'You have not given a correct date',
        lengthBadStart : 'You must give an answer between ',
        lengthBadEnd : ' characters',
        lengthTooLongStart : 'You have given an answer longer than ',
        lengthTooShortStart : 'You have given an answer shorter than ',
        notConfirmed : 'Values could not be confirmed',
        badDomain : 'Incorrect domain value',
        badUrl : 'The answer you gave was not a correct URL',
        badCustomVal : 'You gave an incorrect answer',
        badInt : 'The answer you gave was not a correct number',
        badSecurityNumber : 'Your social security number was incorrect',
        badUKVatAnswer : 'Incorrect UK VAT Number',
        badStrength : 'The password isn\'t strong enough',
        badNumberOfSelectedOptionsStart : 'You have to choose at least ',
        badNumberOfSelectedOptionsEnd : ' answers',
        badAlphaNumeric : 'Veuillez écrire seulement des caractères alphanumerique ',
        badAlphaNumericExtra: ' et ',
        wrongFileSize : 'The file you are trying to upload is too large',
        wrongFileType : 'The file you are trying to upload is of wrong type',
        groupCheckedRangeStart : 'Please choose between ',
        groupCheckedTooFewStart : 'Please choose at least ',
        groupCheckedTooManyStart : 'Please choose a maximum of ',
        groupCheckedEnd : ' item(s)'
    };

    $.validate({
        form : "#formInfoPerso, #formPostBac, #formCandidatFormation",
        language : myLanguageFR
        // borderColorOnError : '#FF0000'
        // addValidClassOnAll : true    
    });



    /*/ Explorateur de fichiers
    $('#explorateur').fileTree({
        // root : ne pas oublier de mettre slash à la fin du chemin !
        root: '/Applications/MAMP/htdocs/FEGProject/',
        script : './js/jqueryFileTree/connectors/jqueryFileTree.php'
    }, function(file) { 
        // alert(file);
        window.open(file.replace("Applications/MAMP/htdocs/", ""));
    });*/
});
