<?php

    require_once("../../lib/config.php");

    if (!isUserLoggedInEsp()) {
        header('Location: login.php');
    }

    if (isset($_GET['idstudio'])) {
        $id_studio = $_GET['idstudio'];
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Esperto Home<?php echo $websiteName; ?> 
        </title>
        <?php require_once("../inc/head_inc.php"); ?>
        <link href="../../content/css/utassistant-error.css" rel="stylesheet">
        <link href="../../content/css/utassistant_general.css" rel="stylesheet">
        <script src="../../content/js/invita_partecipanti.js"></script>
    </head>
<body>
    <?php require_once("../inc/navbars/navbar_invita_partecipanti.php") ?>
    <div class="container">
        <form class="form-horizontal" id="form" name="form" action="" method="post">
            <input type="hidden" id="idstudio" name="idstudio" value="<?php echo $id_studio ?>">
            <div id="partecipanti" class="">
                <h2>Invita i partecipanti</h2>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>Partecipanti Registrati</strong>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-condensed table-striped">
                                        <thead id="attributes">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Invita</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tuples">
                                        <?php
                                            $i = 0;
                                            $result = $loggedInUser->retrieve_uninvited_user($id_studio);
                                            while($row = $db->sql_fetchrow($result)):
                                                $i++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="h5">
                                                        <?php echo $row['username'] ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="h5">
                                                        <?php echo $row['email'] ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="h5">
                                                        <button type="button"
                                                                class="btn btn-default"
                                                                id="button<?php echo $i ?>"
                                                                onclick="invite('<?php echo $i ?>')">invita</button>
                                                        <input type="hidden"
                                                               name="row<?php echo $i ?>"
                                                               value="<?php echo $row['email']?>">
                                                        <input type="hidden"
                                                               id="row<?php echo $i ?>-bit"
                                                               name="row<?php echo $i ?>-bit"
                                                               value="0">
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" id="count_registered" name="count_registered" value="<?php echo $i ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="br_space">
                            <br>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>Partecipanti Non Registrati</strong>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <strong>Email</strong>
                                    </div>
                                    <div class="col-xs-4 col-xs-offset-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="email" oninput="deleteErrorStatus()">
                                    </div>
                                    <div class="col-xs-1">
                                        <button id="sendmail" type="button" class="btn btn-default btn-md fixbutton" onclick="checkAndAdd()">invita</button>
                                    </div>
                                </div>
                                <div class="br_space">
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <strong>Elenco </strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <textarea class="form-control" rows="5" id="invited" name="invited" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="btn btn-primary floatbutton fixbutton" name="invitapart" id="invitapart" onclick="checkAndSend()">
                                <span class="glyphicon glyphicon-send">
                                </span>
                            <strong class="h4"> Invita </strong>
                        </button>
                    </div>
                </div>
            </div>       
        </form>
    </div>

    <div id="Carica" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">Invito partecipanti in corso...</h4>
                </div>
                <div class="modal-body">
                    <span id="num_mail"></span>
                    <div class="progress progress-striped active" style="width:500px" >
                        <div id="bar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            <span id="bar2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="nessun_partecipante" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">Selezionare o inserire almeno un partecipante</h4>
                </div>
                <div class="modal-body">
                    <span> Selezionare dalla lista almeno un partecipante o utilizzare la funzione di invio partecipazioni tramite e-mail per invitarne nuovi </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>