<?php
    require_once ("../../lib/config.php");

    // Prevent the user visiting the logged in page if he/she is already logged in
    // verifica se l'utente è un valutatore
    if (isUserLoggedInEsp()) {
        header("Location: " .ESPERTO_DIR."esperto_home.php");
        die();
    } else if (isUserLoggedInPart()) { // verifica se l'utente è un partecipante
        header("Location: ".PARTECIPANTE_DIR."partecipante_home.php");
        die();
    } else if (isUserLoggedIn()) { // verifica l'utente altrimenti effettua logout all'interno della funz
        header("Location: ".BASE_DIR."index.php");
        die();
    }
    
    // Forms posted
    if (! empty($_POST)) {

        $errors = array();
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $remember_choice = 0;

        // Perform some validation
        // Feel free to edit / change as required
        if ($username == "") {
            $errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
        }
        if ($password == "") {
            $errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
        }

        // End data validation
        if (count($errors) == 0) {
            // A security note here, never tell the user which credential was incorrect
            if (! usernameExists($username)) {
                $errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
            } else {
                $userdetails = fetchUserDetails($username);

                // See if the user's account is activation
                if ($userdetails["active"] == 0) {
                    $errors[] = lang("ACCOUNT_INACTIVE");
                } else {
                    // Hash the password and use the salt from the database to compare the password.
                    $entered_pass = generateHash($password, $userdetails["password"]);

                    if ($entered_pass != $userdetails["password"]) {
                        // Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
                        $errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
                    } else {
                        // passwords match! we're good to go'

                        // Construct a new logged in user object
                        // Transfer some db data to the session object
                        $loggedInUser = new loggedInUser();
                        $loggedInUser->email = $userdetails["email"];
                        $loggedInUser->user_id = $userdetails["user_id"];
                        $loggedInUser->hash_pw = $userdetails["password"];
                        $loggedInUser->display_username = $userdetails["username"];
                        $loggedInUser->clean_username = $userdetails["username_clean"];
                        $loggedInUser->remember_me = $remember_choice;
                        $loggedInUser->remember_me_sessid = generateHash(uniqid(rand(), true));

                        // Update last sign in
                        $loggedInUser->updatelast_sign_in();


                        $_SESSION["userPieUser"] = $loggedInUser;

                        // Redirect to user account page
                        header("Location: ../../index.php");
                        die();
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | <?php echo $websiteName; ?></title>
    <?php require_once("../inc/head_inc.php"); ?>
</head>
<body>
    <?php require_once("../inc/navbars/navbar_default.php"); ?>
    <div class="br_spaces">
        <br>
    </div>
    <div class="modal-dialog">
        <div class="modal-header">
            <h2>
                <strong>Accedi</strong>
            </h2>
        </div>
        <div class="modal-body">
            <?php
                if (! empty($_POST)) {
                    ?>
                    <?php
                    if (count($errors) > 0) {
                        ?>
                        <div id="errors">
                            <?php errorBlock($errors); ?>
                        </div>
                        <?php
                    }
                }
            ?>
            <?php
                if (isset($_GET['status']) and $_GET['status'] == "success") {
                    echo "<p>Account creato correttamente. Addesso puoi accedere.</p>";
                } else {
                    $_GET['stauts'] = "";
                }
            ?>

            <form class="form-horizontal" name="newUser" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label>Username:</label> <input autocomplete="on" type="text" class="form-control" name="username" placeholder="Inserisci username" />
                </div>

                <div class="form-group">
                    <label>Password:</label> <input type="password" class="form-control" name="password" placeholder="Inserisci password" />
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="new" id="newfeedform" value="Accedi" />
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
    <p style="margin-top: 30px; text-align: center;">
        <!--<a href="<?php echo $websiteUrl; ?>">Home Page / </a>-->
        <!-- PERCORSO ASSOLUTO -->
        <a href="<?php echo BASE_DIR; ?>">Home Page / </a>
        <!-- PERCORSO RELATIVO -->
        <a href="forgot-password.php">Password dimenticata?</a>
    </p>
</body>
</html>
