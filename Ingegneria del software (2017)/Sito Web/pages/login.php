<?php
	session_start();

	//connessione al server
	$conn = mysql_pconnect('localhost', 'root', '');
	//selezione del database
	mysql_select_db('smartmuseum', $conn);

	// assegnazione dei valori inseriti nel login alle variabili
	$email = $_POST['email'];
	$password = $_POST['password'];

	$hash = hash('sha512', $password);

	// query per il controllo di email e password
	$query = sprintf("SELECT * FROM dipendente WHERE Email = '%s' and Password = '%s'",mysql_real_escape_string($email),mysql_real_escape_string($hash));
	$results = mysql_query($query);
	$number = mysql_num_rows($results);

	// query per il controllo accesso admin
	$query2 = sprintf("SELECT * FROM dipendente WHERE Email = '%s' and Password = '%s' and isAdmin = '1'",mysql_real_escape_string($email),mysql_real_escape_string($hash));
	$results2 = mysql_query($query2);
	$number2 = mysql_num_rows($results2);

	if($number2 > 0)
	{	$_SESSION['email'] = $email;
		header('Location: admin.php');
	} else if($number > 0)
	{
		$_SESSION['email'] = $email;
		header('Location: dipendente.php');
	} else
	{
		$string = "<script type='text/javascript'>alert('Incorrect login! Try again...');</script>";
		echo $string;
		header("Refresh:0; URL=loginform.php");
	}

	//Disconnessione dal database
	mysql_close($conn);
?>
