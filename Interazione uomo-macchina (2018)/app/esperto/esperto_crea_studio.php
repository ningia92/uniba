<?php require_once("../../lib/config.php"); /* * Uncomment the "else" clause below if e.g. userpie is not at the root of your site. */ 
if (!isUserLoggedInEsp()) { header("Location: ".ACCOUNT_DIR."login.php"); } ?>

<!DOCTYPE html>
<html lang="it">

<head>

    <?php require_once("../inc/head_inc.php") ?>

    <link href="<?php echo CSS_DIR;?>utassistant-error.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR;?>utassistant_general.css" rel="stylesheet">

    <script src="<?php echo JS_DIR;?>crea_studio.js"></script>
    <script src="<?php echo JS_DIR;?>move_pills.js"></script>

</head>

<body onload="hideOther()">
    <?php require_once("../inc/navbars/navbar_esperto.php"); ?>
    <div class="container">
        <form class="form-horizontal" id="form" name="form" action="<?php echo ESPERTO_DIR?>crea_studio_code.php" method="post">
            <?php require_once("./ecs_tab.php") ?>
            <div class="tab-content">
                <?php require_once("./ecs_studio.php") ?>
                <?php require_once("./ecs_task.php") ?>
                <?php require_once("./ecs_partecipanti.php") ?>
            </div>
            <input id="count-task" type="hidden" name="count-task" value="1">
        </form>        
    </div>
    <script type="text/javascript">
        $('#email').keypress(function(event){
            if(event.keyCode === 13){
                checkAndAdd();
            }
        });
    </script>
</body>

</html>