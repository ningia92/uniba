<?php
session_start();
function isLoggedIn()
{
	if(isset($_SESSION['email']))
	{
		return true;
	} else
	{
		return false;
	}
}

if(isLoggedIn())
{
$user = $_SESSION['email'];

//connessione al server
$conn = mysql_pconnect('localhost', 'root', '');
//selezione del database
mysql_select_db('smartmuseum', $conn);

$query = sprintf("SELECT Email FROM dipendente WHERE Email = '%s' and isAdmin = '1'",mysql_real_escape_string($user));
$results = mysql_query($query);
$number = mysql_num_rows($results);

//Disconnessione dal database
mysql_close($conn);
}

if (!isLoggedIn() || !isset($number) || $number == 0)
{
	session_destroy();
	$html= '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel=\'shortcut icon\' type=\'image/x-icon\' href=\'../img/favicon.ico\' />

	<title>Reperti management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">

	<!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

	<!-- Theme CSS -->
    <link href="../css/creative.min.css" rel="stylesheet">

	<style>
		#repButton
		{
			margin: 10px;
		}

		#dipButton
		{
			margin: 10px;
		}

		#welcome
		{
			color: #F05F40;
		}

		#divback
		{
			text-align: center;
		}
	</style>
</head>

<body class="bg-dark">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="../index.html">Smart museum</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

	<section id="">
		<p align="center">You are not authorized to access the following page.</p>
		<div id="divback">
			<a href = "../index.html" id="backhome">Home</a>
		</div>

    </section>
</body>
</html> ';
echo $html;
}
 else
 {
	$html2= '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel=\'shortcut icon\' type=\'image/x-icon\' href=\'../img/favicon.ico\' />

	<title>Reperti management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">

	<!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

	<!-- Theme CSS -->
    <link href="../css/creative.min.css" rel="stylesheet">

	<style>
		#acceso
		{
			color: #F05F40;
		}

		#dipButton
		{
			margin: 10px;
		}

		#divform
		{
			margin-left: 10px;
		}

		#button
		{
			background-color: #F05F40;
		}
	</style>
</head>

<body class="bg-dark">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="../index.html">Smart museum</a>
            </div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li>
                        <a href="reperti.php" id="acceso">Reperti</a>
                    </li>
                    <li>
                        <a href="dipendenti.php">Employees</a>
                    </li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

	<section id="">';
		echo $html2;

		$conn = mysql_pconnect("localhost", "root", "");
		$db = mysql_select_db("smartmuseum", $conn);

		$pass = $_POST["NumPassaporto"];
		$ParzRes = mysql_query("SELECT * from reperto where '$pass' = NumPassaporto");
		$trovato = mysql_num_rows($ParzRes);
		if($trovato == 0) {
			$str= "<script type='text/javascript'>alert('Reperto non trovato!');</script>";
			echo $str;
			header('Refresh:0; URL=inputMod.php');
		}

		$res = mysql_fetch_row($ParzRes);

		mysql_close($conn);

		$html3= '

		<form id="divform" method = "POST" action = "modify.php">

    	<input type="text" name = "NumPassaporto" value = '; echo htmlspecialchars($res[0]); echo' style="display:none;">

			Titolo <input type="text" name = "Titolo" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[1]); echo'>
			Autore <input type="text" name = "Autore" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[2]); echo'>
			<br><br>
			Periodo <input type="text" name = "Periodo" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[3]); echo'>
			<br><br>
			Categoria <input type="text" name = "Categoria" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[4]); echo'>
			<br><br>
			Locazione <input type="text" name = "Locazione" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[5]); echo'>
			<br><br>
			Cultura <input type="text" name = "Cultura" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[6]); echo'>
			<br><br>
			Dominio <input type="text" name = "Dominio" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[7]); echo'>
			<br><br>
			Materiali <input type="text" name = "Materiali" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[8]); echo'>
			<br><br>
			Tecniche <input type="text" name = "Tecniche" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[9]); echo'>
			<br><br>
			Condizioni <input type="text" name = "Condizioni" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[10]); echo'>
			Valore <input type="float" name = "Valore" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[11]); echo'>
			<br><br>
			Originale <select name = "Originale" style= "color: #1D1D1D">
					<option value="Si" '; if ($res[12] == "1") echo "selected='selected'";echo'> Si </option>
					<option value="No" '; if ($res[12] == "0") echo "selected='selected'";echo'> No </option>
				</select>
			<br><br>
			Origini <input type="text" name = "Origini" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[13]); echo '>
			<br><br>
			NomeProprietario <input type="text" name = "NomeProprietario" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[14]); echo'>
			IDProprietario <input type="name" name = "IDProprietario" style= "color: #1D1D1D" required value = '; echo htmlspecialchars($res[15]); echo '>
			<br><br><br>
			Descrizione <textarea rows="5" cols="80" name="Descrizione" style= "color: #1D1D1D" value = '; echo htmlspecialchars($res[16]); echo '> </textarea>
			<br><br>
			<!--
			File Video <input type = "file" name = "FileVideo" value = '; echo htmlspecialchars(multi[0]); echo '>
			<br><br>
			File Foto <input type = "file" name = "FileFoto" value = '; echo htmlspecialchars(multi[1]); echo '>
			<br><br>
			-->
			<input id="button" class="button alert" type="submit" value="Invia">
		</form>
    </section>
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/creative.min.js"></script>
</body>
</html> ';
echo $html3;
 }
?>
