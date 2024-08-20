<?php
require_once("../../lib/config.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>404 - Page Not Found | <?php echo $websiteName; ?> </title>
<?php require_once("../inc/head_inc.php"); ?>

</head>
<body>
    <div class="modal-ish">
        <div class="modal-header">
            <center><img src="<?php echo IMG_DIR;?>logo.png"></center>

        </div>
        <div class="modal-body">
            <center>
                <h1>404 Error</h1>
                <br>
                <p class="lead">The requested page could not be found and might not exist</p>
            </center>
        </div>
    </div>
</body>
</html>
