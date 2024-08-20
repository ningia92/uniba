<?php
$er = "";
//connessione al database
$conn = mysql_pconnect('localhost', 'root', '');
$Db = mysql_select_db('smartmuseum', $conn);	//seleziono la tabella di riferimento

//Inserimento in tabella
	//prende tutti i campi di un form e li inserisce in variabili
	$NumPassaporto = $_POST['NumPassaporto'];
	$Titolo = $_POST['Titolo'];
	$Autore = $_POST['Autore'];
	$Periodo = $_POST['Periodo'];
	$Categoria = $_POST['Categoria'];
	$Locazione = $_POST['Locazione'];
	$Cultura = $_POST['Cultura'];
	$Dominio = $_POST['Dominio'];
	$Materiali = $_POST['Materiali'];
	$Tecniche = $_POST['Tecniche'];
	$Condizioni = $_POST['Condizioni'];
	$Valore = $_POST['Valore'];
	$Originale = $_POST['Originale'];
	$Origini = $_POST['Origini'];
	$NomeProprietario = $_POST['NomeProprietario'];
	$IDProprietario = $_POST['IDProprietario'];
	$Descrizione = $_POST['Descrizione'];
	//$FileA = $_POST["FileAudio"];
	$FileV = $_POST['FileVideo'];
	$FileF = $_POST['FileFoto'];

	$query_supporto = sprintf("SELECT NumPassaporto FROM reperto WHERE '%u' = reperto.NumPassaporto",mysql_real_escape_string($NumPassaporto));
	
	//controllo che non sia già presente in tabella
	if(mysql_num_rows( mysql_query($query_supporto) ) != 0 )
	{
		$string = "<script type='text/javascript'>alert('Passaporto già presente');</script>";
		echo $string;
		header('Refresh:0; URL=loginform.php');
	}

	//query per l'inserimento
	mysql_real_escape_string
	
	$query = sprintf("insert into reperto values (
		'%u', '%s', '%s', '%s', '%s', '%s',
		'%s', '%s', '%s', '%s', '%s', '%s',
		'%s', '%s', '%s', '%u', '%s')",
		mysql_real_escape_string($NumPassaporto),mysql_real_escape_string($Titolo),mysql_real_escape_string($Autore),mysql_real_escape_string($Periodo),mysql_real_escape_string($Categoria),
		mysql_real_escape_string($Locazione),mysql_real_escape_string($Cultura),mysql_real_escape_string($Dominio),mysql_real_escape_string($Materiali),mysql_real_escape_string($Tecniche),
		mysql_real_escape_string($Condizioni),mysql_real_escape_string($Valore),mysql_real_escape_string($Originale),mysql_real_escape_string($Origini),mysql_real_escape_string($NomeProprietario),
		mysql_real_escape_string($IDProprietario),mysql_real_escape_string($Descrizione));

	$res = mysql_query($query);	//inserimento nel db

	if(isset($FileV)) {	//se è stato caricato un video eseguo la query
				$query_di_aiuto = sprintf("INSERT INTO multimedia VALUES ('', '%u', '%s')",mysql_real_escape_string($NumPassaporto),mysql_real_escape_string($FileV));
				$ins_file = mysql_query($query_di_aiuto);
	}
	if(isset($FileF)) {	//se è stata caricata una foto eseguo la query
				$query_di_aiuto2 = sprintf("INSERT INTO multimedia VALUES ('', '%u', '%s')",mysql_real_escape_string($NumPassaporto),mysql_real_escape_string($FileF));
				$ins_file = mysql_query($query_di_aiuto2);
	}

mysql_close($conn);	//Disconnessione dal database
header('Location: reperti.php')
?>
