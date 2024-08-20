<?php

require_once '../../lib/config.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>UTAssistant | <?php echo $websiteName; ?> </title>
    <?php require_once("../inc/head_inc.php"); ?>
</head>

<body>
<?php require_once("../inc/navbars/navbar_default.php"); ?>
<div>
    <h1 style="text-align: center; margin: 80px 0;">UTAssistant</h1>
    <p class="text-center">
        <a class="btn btn-default" href="login.php">Accedi</a>
        <a class="btn btn-danger btn-large" href="<?php echo ESPERTO_DIR;?>register_esperto.php">
            Registrati come Esperto</a>
    </p>
    <div class="text-center" style="margin: 30px 0;">
        <a href="forgot-password.php">Password dimenticata?</a> |
        <a href="resend-activation.php">Reinvia mail di attivazione</a>
    </div>
    <div class="clear"></div>
</div>

<div class="row">
<img src="../../content/img/loghi_uta.jpg" alt="Responsive image" style="display: block; margin-left: auto; margin-right: auto;">
</div>

</body>
</html>


