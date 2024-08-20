<?php
require_once("../../lib/config.php");

if (!isUserLoggedInPart()) {
    header("Location: " .ACCOUNT_DIR."login.php");
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php require_once("../inc/head_inc.php"); ?>
</head>
<body>
    <?php

//	if($_SESSION['flag_q_nasatlx']==1 && $_SESSION['status'] == 'questionarioNasaTlx') {
//	require_once("../../questionari/nasatlx/nasatlx.php");
//	}

/*	if($_SESSION['flag_q_aa']==1) {
	require_once("../../questionari/attrakdiff/attrakdiff.php");
	}
	if($_SESSION['flag_q_sus']==1) {
	require_once("../../questionari/sus/sus.php");
	}
    if($_SESSION['flag_q_nps']==1) {
        require_once("../../questionari/nps/nps.php");
    }
	if($_SESSION['flag_q_umux']==1) {
	require_once("../../questionari/umux/umux.php");
	}*/


        switch ($_SESSION['status']) {
            case "aa":
                require_once("../../questionari/attrakdiff/attrakdiff.php");
                break ;
            case "sus":
                require_once("../../questionari/sus/sus.php");
                break ;
            case "nps":
                require_once("../../questionari/nps/nps.php");
                break ;
            case "umux":
                require_once("../../questionari/umux/umux.php");
                break ;
            case "nasatlx":
                require_once("../../questionari/nasatlx/nasatlx.php");
                break ;
        }
    ?>
</body>
</html>
