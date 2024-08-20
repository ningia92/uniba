<?php
	//connessione al database
	$conn = mysql_pconnect("localhost", "root", "");//connessione al server MySQL
	$Db = mysql_select_db("smartmuseum", $conn); //seleziono il db


	//controllo che l'indirizzo email non sia gia presente
	$ID = $_POST["ID"];
	$Email = $_POST["Email"];
	$query = mysql_query("SELECT * from dipendente WHERE '$ID' != IDDip AND '$Email' = Email");
	$trovato = mysql_num_rows($query);
	if($trovato == 0)
	{
		$CodiceFiscale = $_POST["CodiceFiscale"];
		$query = mysql_query("SELECT * from dipendente WHERE '$ID' != IDDip AND '$CodiceFiscale' = CodiceFiscale");
		$trovato = mysql_num_rows($query);
		if($trovato == 0)
		{
		//Inserimento in tabella
		//prende tutti i campi di un form e li inserisce in variabili
		$Nome = $_POST["Nome"];
		$Cognome = $_POST["Cognome"];
		$DataNascita = $_POST["DataNascita"];
		$Citta = $_POST["Citta"];
		$Sesso = $_POST["Sesso"];
		$Password = $_POST["Password"];

		//controllo se la password è cambiata, se si criptare
		$query = mysql_query("SELECT Password from dipendente WHERE '$ID' = IDDip");
		$res = mysql_fetch_row($query);
		if($res[0] != $Password) {$Hash= hash('sha512', $Password);}
		else { $Hash = $Password;}

		$update = "UPDATE dipendente SET
			Nome = '$Nome',
			Cognome = '$Cognome',
			DataNascita = '$DataNascita',
			Citta = '$Citta',
			Sesso = '$Sesso',
			CodiceFiscale = '$CodiceFiscale',
			Email = '$Email',
			Password = '$Hash'
			WHERE '$ID' = IDDip";

		$res = mysql_query($update);

		if($query)
		{
			$var= "<script type='text/javascript'>alert('Modifica avvenuta con successo');</script>";
			echo $var;
			header("Refresh:0; URL=admin.php");
		}
		if(!$res)
			echo "Errore nella query" .mysql_error() );
			header("Refresh:0; URL=modificaform.php");
		}
		else {
			$var2= "<script type='text/javascript'>alert('ATTENZIONE! Codice Fiscale già presente');</script>";
			echo $var2;
			header("Refresh:0; URL=inputdip.php");
		}
	}
	else  {
		$var3= "<script type='text/javascript'>alert('ATTENZIONE! Indirizzo Email già presente');</script>";
		echo $var3;
		header("Refresh:0; URL=inputdip.php");
	}
	mysql_close($conn);
?>
