<?php

    require_once("../../lib/config.php");

    //Prevent the user visiting the logged in page if he/she is already logged in
    //verifica se l'utente è un valutatore
    if(isUserLoggedInEsp()) {
        header("Location: ".ESPERTO_DIR."esperto_home.php");
        die();
    } else if(isUserLoggedInPart()) { //verifica se l'utente è un partecipante
        header("Location: ".PARTECIPANTE_DIR."partecipante_home.php");
        die();
    }
    if(isUserLoggedIn()) { //verifica l'utente altrimenti effettua logout all'interno della funz
        header("Location: ".ACCOUNT_DIR."index.php");
        die();
    }
?>


<?php
/*
  Below is a very simple example of how to process a new user.
   Some simple validation (ideally more is needed).

  The first goal is to check for empty / null data, to reduce workload here we let the user class perform it's own internal checks, just in case they are missed.
*/

//Forms posted
if(! empty($_POST))
{
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);

    //Perform some validation
    //Feel free to edit / change as required

    if(minMaxRange(5,25,$username))
    {
        $errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
    }
    if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
    {
        $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
    }
    else if($password != $confirm_pass)
    {
        $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }
    if(!isValidemail($email))
    {
        $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }

    //End data validation
    if(count($errors) == 0)
    {
        //Construct a user object
        $user = new UserPart($username,$password,$email,"2");

        //Checking this flag tells us whether there were any errors such as possible data duplication occured
        if($user->status === false)
        {
            if ($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
            if ($user->email_taken)     $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
        }
        else
        {
            //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
            if(!$user->userPieAddUser())
            {
                if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
                if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
            }
        }
    }
    if(count($errors) == 0)
    {
        if($emailActivation)
        {
            $message = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
        } else {
            $message = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE1");
        }
    }
    else
    {
        $message = '<span style="color: red;">'.implode(", ", $errors).'</span>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrazione | <?php echo $websiteName; ?> </title>
    <?php require_once("../inc/head_inc.php"); ?>
</head>
<body>
    <?php require_once("../inc/navbars/navbar_default.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="modal-header">
                        <h1>Registrazione</h1>
                    </div>
                </div>
                <div class="row">
                    <p class="col-md-12" style="margin-top: 10px"><?php if (isset($message)) echo $message; ?></p>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal" name="newUser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" />
                        </div>
                        <div class="form-group">
                            <label for="password_repeat">Reinserisci password:</label>
                            <input type="password" class="form-control" name="passwordc" id="password_repeat" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary pull-right" name="new" id="newfeedform" value="Registrazione" />
                        </div>
                    </form>
                </div>
                <div class="row">
                    <p style="text-align: center">
                        <!--<a href="<?php echo $websiteUrl; ?>">Home Page</a>--> <!-- PERCORSO ASSOLUTO -->
                        <a href="<?php echo BASE_DIR; ?>">Home Page</a> <!-- PERCORSO RELATIVO -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
