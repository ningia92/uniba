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

if (isLoggedIn())
{
	//connessione al server
	$conn = mysql_pconnect('localhost', 'root', '');
	//selezione del database
	mysql_select_db('smartmuseum', $conn);

	$value = $_SESSION['email'];
	
	$query = sprintf("SELECT * FROM dipendente WHERE Email = '%s' and isAdmin = '1'",mysql_real_escape_string($value));
	$results = mysql_query($query);
	$number = mysql_num_rows($results);

	//Disconnessione dal database
	mysql_close($conn);

	if($number > 0)
	{
		header('Location: admin.php');
	} else
	{
		header('Location: dipendente.php');
	}
} else
{
 $html = '
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     <meta name="description" content="">
     <meta name="keywords" content="smart museum">
     <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

     <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

     <title>Login</title>

     <link href="../css/metro.css" rel="stylesheet">
     <link href="../css/metro-icons.css" rel="stylesheet">
     <link href="../css/metro-responsive.css" rel="stylesheet">

     <script src="../js/jquery-2.1.3.min.js"></script>
     <script src="../js/metro.js"></script>

     <style>
         .login-form {
             width: 25rem;
             height: 18.75rem;
             position: fixed;
             top: 50%;
             margin-top: -9.375rem;
             left: 50%;
             margin-left: -12.5rem;
             background-color: #ffffff;
             opacity: 0;
             -webkit-transform: scale(.8);
             transform: scale(.8);
         }

 		#submit
 		{
 			background-color: #F05F40;
 			border-color: #F05F40;
 		}

 		#thin
 		{
 			background-color: #F05F40;
 		}

 		#divback
 		{
 			margin: 10px;
 			padding: 10px;
 		}

 		#backhome
 		{
 			color: #F05F40;
 			font-size: 20px;
 		}
 		#button
 		{
 			background-image: url("../img/button.jpg");
 			width: 10px;
 			height: 10px;
 		}
     </style>

     <script>
         $(function(){
             var form = $(".login-form");

             form.css({
                 opacity: 1,
                 "-webkit-transform": "scale(1)",
                 "transform": "scale(1)",
                 "-webkit-transition": ".5s",
                 "transition": ".5s"
             });
         });
     </script>
 </head>
 <body class="bg-dark">
 	<div id="divback">
 	<a href = "../index.html" id="backhome">Home</a>
 	</div>
     <div class="login-form padding20 block-shadow">
         <form action="login.php" method="POST">
             <h1 class="text-light">Login</h1>
             <hr class="thin"/ id= "thin">
             <br />
             <div class="input-control text full-size" data-role="input">
                 <label for="email">Email:</label>
 				<input type="text" name="email" id="email" required>
                 <button class="button helper-button clear" style="background-image: url(../img/button.png); background-repeat:no-repeat; background-position: center center"></button>
             </div>
             <br />
             <br />
             <div class="input-control password full-size" data-role="input">
                 <label for="password">Password:</label>
 				<input type="password" name="password" id="password" required>
                 <button class="button helper-button reveal" style="background-image: url(../img/button2.png); background-repeat:no-repeat; background-position: center center"></button>
             </div>
             <br />
             <br />
             <div class="form-actions">
                 <button type="submit" value="login" class="button primary" id = "submit">Submit</button>
             </div>
         </form>
     </div>
 </body>
 </html>';
	echo $html;
}
?>
