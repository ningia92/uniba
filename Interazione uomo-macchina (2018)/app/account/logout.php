<?php

  require_once("../../lib/config.php");

  //Log the user out
  if(isUserLoggedIn()) $loggedInUser->userLogOut();
  
  session_destroy();
  
  setcookie(session_name(),'',time() - 3600);
  
  $_SESSION = array();

  //if(!empty($websiteUrl))   //PERCORSO ASSOLUTO!
  if(!empty(BASE_DIR)) //PERCORSO RELATIVO
  {
    $add_http = "";

    if(strpos($websiteUrl,"http://") === false)
    {
      $add_http = "http://";
    }

   // header("Location: ".$add_http.$websiteUrl);  //$websiteUrl PERCORSO ASSOLUTO!
	 header("Location: ".$add_http.BASE_DIR); //PERCORSO RELATIVO
    die();
  }
  else
  {
    header("Location: http://".$_SERVER['HTTP_HOST']);
    die();
  }
?>


