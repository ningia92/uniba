<?php
    require_once ("../../lib/config.php");

    if (! isUserLoggedInPart()) {
        header("Location: ".ACCOUNT_DIR."login.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Partecipante Home
            <?php echo $websiteName; ?>
        </title>

        <?php require_once("../inc/head_inc.php"); ?>

        <link href="<?php echo CSS_DIR;?>utassistant_general.css" rel="stylesheet">
        <script src="<?php echo JS_DIR;?>partecipa_studio.js"></script>
    </head>
    <body>
        <?php require_once("../inc/navbars/navbar_partecipante.php"); ?>
        <div class="container" id="contentStudiPartecipante">
            <div class="row">
                <div class="col-md-12">
                    <div class="h5 text-right">partecipante: <?php echo $loggedInUser->display_username; ?></div>
                </div>
            </div>
            <div class="row clreafix">
                <div class="col-md-12">
                    <h1>Benvenuto</h1>
                    <p class="character_fix">
                        La piattaforma UTAssistant permette la partecipazione a test
                        sull'utilizzo di pagine web. <br> Nell'elenco sottostante saranno
                        visualizzati gli  studi ai quali sarà possibile
                        partecipare.

                    </p>
                    <br><br>
                </div>
            </div>

            <h2>Studi Assegnati:</h2>
            <?php
                $result = $loggedInUser->recupera_studi_partecipante();
                $i = 0;
                while ($row = $db->sql_fetchrow($result)) :
                    $i ++;
            ?>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Studio
                                <?php echo " ".$i ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong> Titolo </strong>
                                </div>
                                <div class="col-md-4 col-md-offset-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-control-static" id="titolo_Studio">
                                        <?php echo $row['obiettivo']; ?>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Descrizione</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-control-static" id="descrizione_Studio">
                                        <?php echo $row['descrizione']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <button type="submit" class="btn btn-info"
                                        onclick="modalAvviaStudio(<?php echo $row['id_studio'];?>)">
                                        Avvia Studio
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            ?>
            <?php if ($i == 0) echo "<h5>Nessuno Studio Assegnato</h5>"; ?>
            <h2>Studi Completati:</h2>
            <?php
                $result = $loggedInUser->recupera_studi_flag_completato();
                $f = $i;
                while ($row = $db->sql_fetchrow($result)) :
                    $f ++;
            ?>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Studio <?php echo " ".$f ?></a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong> Titolo </strong>
                                </div>
                                <div class="col-md-4 col-md-offset-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-control-static" id="titolo_Studio">
                                        <?php echo $row['obiettivo']; ?>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Descrizione</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="form-control-static" id="descrizione_Studio">
                                        <?php echo $row['descrizione']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
                endwhile;
            ?>
            <?php if ($f == $i) echo "<h5>Nessuno Studio Completato</h5>"; ?>
        </div>

        <div id="modalAvviaStudio" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ">Informazioni Generali e avviso per la Privacy</h4>
                    </div>
                    <div class="modal-body">
                        <span>All'inizio di ogni task verrà visualizzata una descrizione
                        delle operazioni da effettuare.<br>Una volta eseguite le operazioni del task, cliccare sul
                        tasto &nbsp&nbsp<span class="glyphicon glyphicon-forward"></span><strong>Task
                            successivo</strong><br>  <br>Sarà possibile in qualsiasi momento
                        effettuare l'uscita dallo studio con &nbsp&nbsp<span
                        class="glyphicon glyphicon-log-out"></span><strong> Interrompi studio</strong>
                        </span>
                        <p></p>
                        <span>Durante l'esecuzione dello studio potrebbero essere
                            effettuate:<br>- Registrazione audio<br>- Registrazione video<br>-
                            Rilevamento attività mouse
                        </span>
                    </div>
                    <div class="modal-footer">
                        <form method="post"
                            action="<?php echo PARTECIPANTE_DIR; ?>partecipante_studio.php">
                            <div class="row">
                                <div class="col-xs-6">
                                    <button id="annulla" type="button" class="btn btn-danger"
                                        data-dismiss="modal">annulla</button>
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-success">continua</button>
                                </div>
                            </div>
                            <input id="id_studio" type="hidden" name="id_studio" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
