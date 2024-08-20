<?php
	//connessione al database
	$conn = mysql_pconnect("localhost", "root", "");//connessione al server MySQL
	$Db = mysql_select_db("smartmuseum", $conn); //seleziono il db

	//Inserimento in tabella
	//prende tutti i campi di un form e li inserisce in variabili
	$ID = $_POST["ID"];


	$ParzRes = mysql_query("SELECT * from dipendente where '$ID' = IDdip");
	$trovato = mysql_num_rows($ParzRes);
	if($trovato == 0) {
		$html =  '<script type='text/javascript'>alert('Dipendente non trovato');</script>';
		echo $html;
		header("Refresh:0; URL=inputdipdel.php");
	}
	else{
		$res = mysql_fetch_row($ParzRes);
		$update = "DELETE FROM dipendente WHERE IDDip = '$ID'";
		$res = mysql_query($update);
		if(!$res)
			die ("Errore nella query" .mysql_error() );
			header("Refresh:0; URL=dipendenti.php");
		}

	if($query)
	{
		$html2 = "<script> alert('Eliminazione avvenuta con successo')</script>";
		echo $html2;
		header("Refresh:0; URL=dipendenti.php");
	}
	mysql_close($conn);
?>
