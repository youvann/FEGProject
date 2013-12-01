$(document).ready(function() {
	$("form").submit(function() {
		$.ajax({
			type: $(this).attr("method"),
			url: $(this).attr("action"),
			data: $(this).serialize(),
			success: function() {
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
});

