<?php


  require_once("../../lib/config.php");

  //Prevent the user visiting the logged in page if he/she is already logged in
  if(isUserLoggedInEsp()) { header("Location: ".ESPERTO_DIR."esperto_home.php"); die(); }    //verifica se l'utente è un valutatore
    else if(isUserLoggedInPart()) { header("Location:" .PARTECIPANTE_DIR."partecipante_home.php"); die(); }   //verifica se l'utente è un partecipante
  if(isUserLoggedIn()) { header("Location: ".ACCOUNT_DIR."index.php"); die(); }      //verifica l'utente altrimenti effettua logout all'interno della funz

?>


<?php
  /*
    Below is a very simple example of how to process a new user.
     Some simple validation (ideally more is needed).

    The first goal is to check for empty / null data, to reduce workload here we let the user class perform it's own internal checks, just in case they are missed.
  */

//Forms posted
if(!empty($_POST))
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
        $user = new User($username,$password,$email,"1");//l'utente si registra solo come esperto

        //Checking this flag tells us whether there were any errors such as possible data duplication occured
        if(!$user->status)
        {
          if($user->username_taken)
            $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
          if($user->email_taken)
            $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
        }
        else
        { 
          //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
          if(!$user->userPieAddUser())
          {
            
            if($user->mail_failure)
              $errors[] = lang("MAIL_ERROR");
            if($user->sql_failure)
              $errors[] = lang("SQL_ERROR");
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
        <div class="modal-dialog">
            <div class="modal-header">
            <h1>Registrazione</h1>
            </div>
                <div class="modal-body">
                    <div id="success">
                       <p><?php if (isset($message)) echo $message; ?></p>
                    </div>
                        <div id="regbox">
                            <form class="form-horizontal" name="newUser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"/>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" />
                                </div>
                                <div class="form-group">
                                    <label for="passwordc">Reinserisci password</label>
                                    <input type="password" class="form-control" name="passwordc" id="passwordc" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" />
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-primary btn-lg" name="new" id="newfeedform" value="Crea account" />
                                </div>
                            </form>
                        </div>
                </div>
        </div>
        <div class="clear"></div>
        <p style="margin-top:30px; text-align:center;">
            <a href="<?php echo BASE_DIR; ?>index.php">Home</a>
        </p>
    </body>
</html>
