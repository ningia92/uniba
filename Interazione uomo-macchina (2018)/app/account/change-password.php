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
    $password = $_POST["password"];
    $password_new = $_POST["passwordc"];
    $password_confirm = $_POST["passwordcheck"];

    //Perform some validation
    //Feel free to edit / change as required

    if(trim($password) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
    }
    else if(trim($password_new) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_NEW_PASSWORD");
    }
    else if(minMaxRange(8,50,$password_new))
    {
      $errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
    }
    else if($password_new != $password_confirm)
    {
      $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }

    //End data validation
    if(count($errors) == 0)
    {
      //Confirm the hash's match before updating a users password
      $entered_pass = generateHash($password,$loggedInUser->hash_pw);

      //Also prevent updating if someone attempts to update with the same password
      $entered_pass_new = generateHash($password_new,$loggedInUser->hash_pw);

      if($entered_pass != $loggedInUser->hash_pw)
      {
        //No match
        $errors[] = lang("ACCOUNT_PASSWORD_INVALID");
      }
      else if($entered_pass_new == $loggedInUser->hash_pw)
      {
        //Don't update, this fool is trying to update with the same password ÃÂ¬ÃÂ¬
        $errors[] = lang("NOTHING_TO_UPDATE");
      }
      else
      {
        //This function will create the new hash and update the hash_pw property.
        $loggedInUser->updatePassword($password_new);
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Aggiorna Password | <?php echo $websiteName; ?> </title>
<?php require_once("../inc/head_inc.php");  ?>

</head>
<body>
<?php require_once("../inc/navbars/navbar_esperto.php"); ?>

<div class = "container" id="content">


    <?php //individuo che tipo di utente è loggato (esperto o partecipante)
    $group_id="";
    if ($loggedInUser->isGroupMember(1)) { $group_id="esperto";}
        else $group_id="partecipante";
    ?>
                 <div class="row">
                     <div class="col-xs-12">
                       <div class="h5 text-right">
                           <?php echo $group_id?>: <?php echo $loggedInUser->display_username; ?>
                       </div>
                    </div>
                </div>
    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading"><strong>CAMBIA PASSWORD</strong></div>
        <div class="panel-body">
        <?php
            if(!empty($_POST))
            {
        if(count($errors) > 0)
        {
            ?>
            <div id="errors">
            <?php errorBlock($errors); ?>
            </div>
            <?php } else { ?>
            <div id="success">
               <p><?php echo lang("ACCOUNT_DETAILS_UPDATED"); ?></p>
            </div>
        <?php } }?>



           <form name="changePass" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">

               <div class="form-group">
                   <label for="password" class="control-label col-md-2">Password</label>
                   <div class="col-md-4">
                       <input class="form-control" type="password" id="password" name="password" />
                   </div>
               </div>
               <div class="form-group">
                   <label class="control-label col-md-2" for="passwordc">Nuova Password</label>
                   <div class="col-md-4">
                       <input class="form-control" type="password" id="passwordc" name="passwordc" />
                   </div>
               </div>
               <div class="form-group">
                   <label class="control-label col-md-2" for="passwordcheck">Conferma Password</label>
                   <div class="col-md-4">
                       <input class="form-control" type="password" id="passwordcheck" name="passwordcheck" />
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-md-offset-2 col-md-4">
                       <input type="submit" class="btn btn-primary" name="new" id="newfeedform" value="Update" />
                   </div>
               </div>
       </div>
       </div>

    </form>


            <div class="clear"></div>

  <p style="margin-top:30px; text-align:center;"><a href="<?php echo BASE_DIR; ?>">Home Page</a></p>
</div>
</body>
</html>


