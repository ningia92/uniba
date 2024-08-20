var questionariCompletati = {attrakdiff: 0, nps: 0, umux: 0, nasatlx: 0, sus: 0 };

function setQuestionariCompletati(nomeQuestionario, valore = 0)
{
	questionariCompletati[nomeQuestionario] = valore;
}


$(document).ready(function() {
	//caricamento della libreria charts js di google.
	console.log(questionariCompletati);
	google.charts.load('current', {packages: ['corechart','bar','gauge']});
	if(questionariCompletati.nasatlx)
		google.charts.setOnLoadCallback(nasatlxChartsReady);

	if(questionariCompletati.nps){
	google.charts.setOnLoadCallback(drawNPStipoutenteChart);
	google.charts.setOnLoadCallback(drawNPSutentiChart);
	google.charts.setOnLoadCallback(drawNPSscoreChart);
}

if(questionariCompletati.attrakdiff){
	google.charts.setOnLoadCallback(drawATTRAKDIFFChart);
	google.charts.setOnLoadCallback(drawATTRAKDIFFChart1);
}

if(questionariCompletati.sus){
	google.charts.setOnLoadCallback(drawSUSBoxPlot);
	google.charts.setOnLoadCallback(drawSUShistogramChart);
}

if(questionariCompletati.umux){
	google.charts.setOnLoadCallback(drawUMUXBoxPlot);
	google.charts.setOnLoadCallback(drawUMUXhistogramChart);
}
});

function nasatlxChartsReady() {
	//attivazione dei pulsanti per la visualizzazione dei grafici dopo aver caricato correttamente la libreria charts.
	$('.chartBtn').removeAttr('disabled');
}

function showChart(btn, tableID, chartDivID) {
	var chartDiv = $('#' + chartDivID);

	//visualizza o nasconde il grafico.
	if(chartDiv.is(':visible')) {
		chartDiv.fadeOut('fast');
		$(btn).html("<span class='glyphicon glyphicon-signal'></span> Mostra grafico <span class='glyphicon glyphicon-chevron-down'></span>");
	} else {
		chartDiv.fadeIn('fast');
		$(btn).html("<span class='glyphicon glyphicon-signal'></span> Chiudi grafico <span class='glyphicon glyphicon-chevron-up'></span>");
		drawChart(tableID, chartDivID);
	}
}

function drawChart(tableID, chartDivID) {
	var chartData = new google.visualization.DataTable();

	//colonne della tabella.
	var columns = [["Sforzo mentale"], ["Sforzo fisico"], ["Sforzo temporale"], ["Prestazioni"], ["Fatica"], ["Frustrazione"], ["Media"]];

	//aggiunta al grafico di una colonna che contiene gli username degli utenti.
	chartData.addColumn('string');

	//caricamento dei dati dei grafici utilizzando i dati gia' presenti nelle tabelle della pagina.
	$('#' + tableID + ' tr').each(function() {
		var rowCells = $(this).find('td');

		if(rowCells.length > 0) {
			//aggiunta del singolo utente al grafico.
			chartData.addColumn('number', $(rowCells[0]).text());

			//aggiunta delle risposte dell'utente al grafico.
			columns.forEach(function(row, index) {
				row.push(parseInt($(rowCells[index + 1]).text()));
			});
		}
	});

	//aggiunta delle colonne della tabella al grafico. Viene utilizzato il metodo addRows dal momento che nei grafici si scambiano le colonne con le righe delle tabelle originarie.
	chartData.addRows(columns);

	var chartOptions = {
		hAxis: {title: "Scala", minValue: 0, maxValue: 100},
		vAxis: {title: "Valore"},
		backgroundColor: 'transparent'
	};

	//costruzione e disegno del grafico.
	var chart = new google.visualization.ColumnChart($('#' + chartDivID)[0]);
	chart.draw(chartData, chartOptions);
}
