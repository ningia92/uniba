<?php

  require_once("../../lib/config.php");

  //Prevent the user visiting the logged in page if he/she is not logged in
  if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
?>
<?php
  /*
    Below is a very simple example of how to process a login request.
    Some simple validation (ideally more is needed).
  */

//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $email = $_POST["email"];

    //Perform some validation
    //Feel free to edit / change as required

    if(trim($email) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
    }
    else if(!isValidEmail($email))
    {
      $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
    else if($email == $loggedInUser->email)
    {
        $errors[] = lang("NOTHING_TO_UPDATE");
    }
    else if(emailExists($email))
    {
      $errors[] = lang("ACCOUNT_EMAIL_TAKEN");
    }

    //End data validation
    if(count($errors) == 0)
    {
      $loggedInUser->updateEmail($email);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Aggiorna dettagli contatto | <?php echo $websiteName; ?> </title>
<?php require_once("../inc/head_inc.php"); ?>

</head>
<body>
<?php require_once("../inc/navbars/navbar_default.php"); ?>
<div id="content">

<div class="modal-ish">
  <div class="modal-body">


            <?php
                if(!empty($_POST))
                {
                    if(count($errors) > 0)
                    {
                ?>
                <div id="errors">
                <?php errorBlock($errors); ?>
                </div>
                <?php
                     } else { ?>
            <div id="success">

               <p><?php echo lang("ACCOUNT_DETAILS_UPDATED"); ?></p>

            </div>
            <?php } }?>


                <form name="changePass" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                <p>
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo $loggedInUser->email; ?>" />
                </p>
               </div>


  <div class="modal-footer">
<input type="submit" class="btn btn-primary" name="new" id="newfeedform" value="Update" />
  </div>

                </form>
      </div>


            <div class="clear"></div>

              <p style="margin-top:30px; text-align:center;"><a href="/">Home</a></p>
</div>
</body>
</html>

