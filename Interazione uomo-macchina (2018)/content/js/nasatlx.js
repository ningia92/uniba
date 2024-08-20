$(document).ready(function() {
	//inizializzazione di tutti gli slider della pagina.
	createSlider('#mentalDemandSlider');
	createSlider('#physicalDemandSlider');
	createSlider('#temporalDemandSlider');
	createSlider('#performanceSlider');
	createSlider('#effortSlider');
	createSlider('#frustrationSlider');

	//gestione evento dell'invio del form con le risposte.
	$('#nasatlxForm').submit(function(event) {
		event.preventDefault();

		//lettura dei valori di tutte le risposte.
		var formData = {
			'mentalDemand' : $('#mentalDemandSlider').slider("option", "value"),
			'physicalDemand' : $('#physicalDemandSlider').slider("option", "value"),
			'temporalDemand' : $('#temporalDemandSlider').slider("option", "value"),
			'performance' : $('#performanceSlider').slider("option", "value"),
			'effort' : $('#effortSlider').slider("option", "value"),
			'frustration' : $('#frustrationSlider').slider("option", "value")
		};

		//chiamata ajax per l'invio delle risposte al server.
		$.ajax({
			url: $('#nasatlxForm').attr("action"),
			type: 'POST',
			dataType: 'json',
			data: formData,
			beforeSend: function() {
				$('#btnSubmit').attr("disabled");
			}
		})
		.done(function(responseData) {
			$('#btnSubmit').hide();
			$('#message').addClass('alert alert-success').html("Questionario salvato con successo!").show();
	/*		if(responseData.success)		
				$('#message').addClass('alert alert-success').html("Questionario salvato con successo!").show();
			else
				$('#message').addClass('alert alert-danger').html("Errore salvataggio questionario: " + responseData.errorMessage).show();*/
		})
		.fail(function() {
			$('#btnSubmit').hide();

			$('#message').addClass('alert alert-danger').html("Errore invio questionario.").show();
		});
	});
});

function createSlider(sliderID) {
	//inizializzazione di uno slider utilizzando jqueryui.
	$(sliderID).slider({
		value: 50,
		min: 0,
		max: 100,
		step: 5
	}).slider("pips", {
		labels: {
			'first': "Poco",
			'last': "Molto" }
		});
}
