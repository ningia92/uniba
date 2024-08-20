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

	<title>Employee management</title>

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

	<title>Employee management</title>

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

	<script src="../js/Controlli.js"></script>

	<style>

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
                        <a href="reperti.php">Reperti</a>
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

	<section id="">
	<div id="divform">';
	echo $html2;

		$conn = mysql_pconnect('localhost', 'root', '');
		$db = mysql_select_db('smartmuseum', $conn);

		$id = $_POST["ID"];
		$query_di_aiuto = sprintf("SELECT * from dipendente where '%s' = IDdip",mysql_real_escape_string($id));
		$ParzRes = mysql_query($query_di_aiuto);
		$trovato = mysql_num_rows($ParzRes);
		if($trovato == 0) { echo "<script type='text/javascript'>alert('Dipendente non trovato');</script>";
							header('Refresh:0; URL=inputdip.php');}

		$res = htmlspecialchars(mysql_fetch_row($ParzRes));

		mysql_close($conn);

		$html3= '

		<form method = "POST" name = "modulo">

			<input type="hidden" name="Nascosto" value="1">
			IDDipendente: '; echo htmlspecialchars($res[0]),'\n\n'; echo '
			<input type="text" name = "ID"  value = '; echo htmlspecialchars($res[0]); echo ' style="display:none";>
			<br><br>
			Nome <input type="text" name = "Nome" value = '; echo htmlspecialchars($res[1]); echo ' style= "color: #1D1D1D">
			Cognome <input type="text" name = "Cognome" value ='; echo htmlspecialchars($res[2]); echo ' style= "color: #1D1D1D">
			<br><br>
			Data di Nascita <input type="text" name = "DataNascita" value = '; echo htmlspecialchars($res[3]); echo ' style= "color: #1D1D1D">
			<br><br>
			Città <input type="text" name = "Citta" value = '; echo htmlspecialchars($res[4]); echo ' style= "color: #1D1D1D">
			Sesso <select name = "Sesso" value = '; echo htmlspecialchars($res[5]); echo ' style= "color: #1D1D1D">
					<option value="M" '; if ($res[5] == "M") echo "selected='selected'"; echo '> M </option>
					<option value="F" '; if ($res[5] == "F") echo "selected='selected'"; echo '> F </option>
			</select>


			<br><br>
			Codice Fiscale <input type="text" name = "CodiceFiscale" value = '; echo htmlspecialchars($res[6]); echo ' style= "color: #1D1D1D">
			<br><br>
			Email <input type="text" name = "Email" value = '; echo htmlspecialchars($res[7]); echo ' style= "color: #1D1D1D">
			Password <input type="password" name = "Password" value = '; echo htmlspecialchars($res[8]); echo ' style= "color: #1D1D1D">
			  Conferma <input type="password" name = "Conferma" value = '; echo htmlspecialchars($res[8]); echo' style= "color: #1D1D1D">
			<br><br>
			<input class="button alert" id="button" type="button" value="Invia" onClick="Modulo()">
		</form>
	</div>
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
