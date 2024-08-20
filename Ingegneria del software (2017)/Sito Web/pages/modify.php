<?php
	//$er = "";
	$connect = mysql_pconnect('localhost', 'root', '');
	$db = mysql_select_db('smartmuseum', $connect);

	//modifica di una tupla in tabella
	//if(isset($POST('invio')) {
		//nel form ci saranno alcuni campi oscurati che non sono modificabili
		//per il resto si tratta di un semplice inserimento sovrascrivendo il vecchio, in modo da non
		//complicare l'algoritmo
	$pass = $_POST['NumPassaporto'];
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

	//$Video = $_POST["FileVideo"];
	//$Foto = $_POST["FileFoto"];

	//se il Passaporto non è corretto
	/*
	if(mysql_affected_row(mysql_query("SELECT * FROM reperto WHERE '$pass' = reperto.NumPassaporto")) == 0)	{
		die("Passaporto non corretto".mysql_error() );
	}
	*/

	//eseguo la query di aggiornamento del reperto
	//se sono arrivato qui significa che sicuramente il reperto è presente nel database
	//in quanto ho bloccato la modifica del Passaporto dal .php chiamante, dove effettuo di già un controllo
	//sul Passaporto;
	$update = sprintf("UPDATE reperto SET
		Titolo = '%s',
		Autore = '%s',
		Periodo = '%s',
		Categoria = '%s',
		Locazione = '%s',
		Cultura = '%s',
		Dominio = '%s',
		Materiali = '%s',
		Tecniche = '%s',
		Condizioni = '%s',
		Valore = '%s',
		Originale = '%s',
		Origini = '%s',
		NomeProprietario = '%s',
		IDProprietario = '%u',
		Descrizione = '%s'
		WHERE '%s' = NumPassaporto ",
		mysql_real_escape_string($Titolo),mysql_real_escape_string($Autore),mysql_real_escape_string($Periodo),mysql_real_escape_string($Categoria),
		mysql_real_escape_string($Locazione),mysql_real_escape_string($Cultura),mysql_real_escape_string($Dominio),mysql_real_escape_string($Materiali),
		mysql_real_escape_string($Tecniche),mysql_real_escape_string($Condizioni),mysql_real_escape_string($Valore),mysql_real_escape_string($Originale),
		mysql_real_escape_string($Origini),mysql_real_escape_string($NomeProprietario),mysql_real_escape_string($IDProprietario),mysql_real_escape_string($Descrizione),
		mysql_real_escape_string($pass));

	$res = mysql_query($update);

	if(!isset($res))
	{
		$prt= "<script type='text/javascript'>alert('Errore nella query');</script>";
		echo $prt;
		header("Refresh:0; URL=loginform.php");
	}else
	{
		$prt2= "<script type='text/javascript'>alert('Reperto modificato');</script>";
		echo $prt2;
		header("Refresh:0; URL=loginform.php");
	}

/*
	if($Video)
		$ins_file = mysql_query( "UPDATE multimedia SET File = '$Video' WHERE (SELECT * from multimedia WHERE IDFile = )" );
*/

	mysql_close($connect);
	header("Refresh:0; URL=dipendente.php");
?>
