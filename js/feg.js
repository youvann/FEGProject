$(document).ready(function() {
	
	/*****************
	 ** Formulaires **
	 *****************/

	// Formulaire formation 
	$("#formFormation").submit(function() {
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

	// Formulaire informations personnelles
	$("#formInfoPerso").submit(function() {
		$(".required").each(function(){
			if ($(this).is(":invalid")) {
				$(this).parent().addClass("has-error");
			}
			if ($(this).is(":valid")) {
				$(this).parent().addClass("has-success");
			}
		});		
	});

	// Ajout d'une étoile rouge pour tous les champs obligatoires
	$(".required").each(function(){
		var span = $("<span />");
		span.attr("class", "obligatory").text(" *");
		span.appendTo($(this).prev());
		// Etoile rouge
		span.css("color", "red");
	});

	// Validations des formulaires
	$("#formInfoPerso").validate();
});
