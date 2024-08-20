<?php

include_once("../../../lib/config.php");


if(checkPostValues() && checkSession()) {
	$sessionValues = array();
	$questValues = array();

	//caricamento dell'array contenente i dati relativi allo studio e all'utente memorizzati nella sessione di navigazione.
	$sessionValues[] = intval($_SESSION['idstudio']);
	$sessionValues[] = intval($_SESSION['idtask']);
	$sessionValues[] = intval($_SESSION['id_user']);

	//caricamento dell'array contenente le risposte al questionario date dall'utente e inviate.
	$questValues[] = $_POST['mentalDemand'];
	$questValues[] = $_POST['physicalDemand'];
	$questValues[] = $_POST['temporalDemand'];
	$questValues[] = $_POST['performance'];
	$questValues[] = $_POST['effort'];
	$questValues[] = $_POST['frustration'];

	//calcolo della media delle risposte date al questionario e memorizzazione nell'array.
	$questValues[] = array_sum($questValues) / count($questValues);

	//unione dei due array in modo da potere passare un singolo array al metodo preparedQuery per inserire i dati nel database.
	$mergedArrays = array_merge($sessionValues, $questValues);

//	$mysqli = new MysqliDB();

	//esecuzione della query e inserimento del valore di successo ottenuto (true o false) nell'array della risposta.
//	$responseData = $mysqli->preparedQuery("INSERT INTO q_nasatlx VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $mergedArrays);
	$responseData = $db->sql_query("INSERT INTO q_nasatlx VALUES ('$mergedArrays[0]', '$mergedArrays[1]', '$mergedArrays[2]', '$mergedArrays[3]', '$mergedArrays[4]', '$mergedArrays[5]', '$mergedArrays[6]', '$mergedArrays[7]', '$mergedArrays[8]', '$mergedArrays[9]')");
	//stringa che memorizza l'eventuale messaggio di errore. inizializzata a stringa vuota.


	//in caso di errori, viene letto il codice di errore e inserito il messaggio di errore nella risposta alla chiamata ajax.
	if(!$responseData) {
		echo 'Errore inserimento dati!';
	}
	else
	{

	//invio della risposta codificata in formato json.
	header('Content-Type: application/json');
	echo json_encode($responseData);
//	echo 'Questionario salvato correttamente!';
	
	}
} else {
	echo "Richiesta non effettuata correttamente.";
}

function checkPostValues() {
	
	//controllo dei valori inviati alla pagina.
	return isset($_POST['mentalDemand']) && isset($_POST['physicalDemand']) && isset($_POST['temporalDemand'])
			&& isset($_POST['performance']) && isset($_POST['effort']) && isset($_POST['frustration']);
}

function checkSession() {
	
	//controllo dei valori della sessione.
	return isset($_SESSION['idstudio']) && isset($_SESSION['idtask']) && isset($_SESSION['id_user']);
}
