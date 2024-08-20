<?php 
    
    if (!isUserLoggedInPart()) { 
        header( "Location: /utassistant/app/account/login.php");
    } 
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php require_once("../app/inc/head_inc.php") ?>
</head>
<body>
    <?php
        $id_utente = $loggedInUser->user_id;
        $id_studio = $_SESSION['idstudio'];

        if($_SESSION['flag_q_aa']==1) {
            require_once(INCLUDE_ATTRAKDIFF_DIR."attrakdiff.php");
        }
        if($_SESSION['flag_q_sus']==1) {
            require_once(INCLUDE_SUS_DIR."sus.php");
        }
        if($_SESSION['flag_q_nps']==1) {
            require_once(INCLUDE_NPS_DIR."nps.php");
        }
        if($_SESSION['flag_q_umux']==1) {
            require_once(INCLUDE_UMUX_DIR."umux.php");
        }
	?>
</body>
</html>