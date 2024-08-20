<?php
    require_once 'lib/config.php';
    if(! isUserLoggedIn()) {
        header("Location: " .ACCOUNT_DIR."landing-page.php");
    } else {
        header("Location: " .ACCOUNT_DIR."login.php");
    }
?>