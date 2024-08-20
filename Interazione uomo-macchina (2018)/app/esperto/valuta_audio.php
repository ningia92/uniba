<?php

require_once("../../lib/config.php");

 if (!isUserLoggedInEsp()) {
      header('Location: login.php');
  }

    //Identificativo dello studio da valutare
    $id_studio = $_POST['idstudio'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Valutazione Studio<?php echo $websiteName; ?> </title>
    <?php require_once("../inc/head_inc.php"); ?>
</head>
<body>
    <?php require_once("../inc/navbars/navbar_default.php"); ?>
    <h1> Implementazione a carico dei gruppi 4.(audio)</h1>


</body>
</html>