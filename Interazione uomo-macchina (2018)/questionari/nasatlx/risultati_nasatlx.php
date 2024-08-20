<?php
    require_once ("../../lib/config.php");

    $idStudio = $_SESSION['idstudio'];

    // caricamento di tutte le risposte al questionario dello studio dal database in un array associativo.
    $res = $db->sql_query("SELECT idStudio, idTask, idUser, mentalDemand, physicalDemand, temporalDemand, performance, effort, frustration, mean, studio.obiettivo as obiettivoStudio, task.obiettivo as obiettivoTask, username 
                                  FROM q_nasatlx INNER JOIN studio ON idStudio = id_studio INNER JOIN task ON idTask = id_task INNER JOIN users ON idUser = user_id
                                  WHERE idStudio =" . $idStudio);
    $results = $db->sql_fetchrow($res);
    if (isset($results) && ! empty($results)) {
        // id del task corrente inizializzato con l'id del primo task dello studio.

        $currentTaskID = $results['idTask'];
        $i = 0;

        // array che contiene tutte le risposte date dagli utenti divise per task.
        $taskUsersRows[$i][] = $results;

        // caricamento delle risposte degli utenti per ogni task nell'array taskUsersRows.
        while($row = $db->sql_fetchrow($res)) {
            if ($row['idTask'] != $currentTaskID) {
                $currentTaskID = $row['idTask'];
                $i ++;
            }

            $taskUsersRows[$i][] = $row;
        }
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-8 col-xs-10">
            <h1 class="text-center">Risultati questionario NASA TLX</h1>

            <?php if(isset($taskUsersRows)) {

                ;?>
            <h3 class="text-center">Obiettivo studio: <?= $taskUsersRows[0][0]['obiettivoStudio']; ?> <small>(ID Studio: <?= $idStudio; ?>)</small>
            </h3>

            <?php foreach($taskUsersRows as $singleTask) { //lettura delle risposte ai singoli task. ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Obiettivo task: <?= $singleTask[0]['obiettivoTask']; ?> <small>(ID Task: <?= $singleTask[0]['idTask']; ?>)</small>
                    </h4>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="task<?= $singleTask[0]['idTask']; ?>tbl"
                            class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Sforzo mentale</th>
                                    <th>Sforzo fisico</th>
                                    <th>Sforzo temporale</th>
                                    <th>Prestazioni</th>
                                    <th>Fatica</th>
                                    <th>Frustrazione</th>
                                    <th>Media</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($singleTask as $singleUserRow) { //lettura della singola risposta di un singolo utente per il task corrente.?>
                                <tr>
                                    <td><?= $singleUserRow['username']; ?></td>
                                    <td><?= $singleUserRow['mentalDemand']; ?></td>
                                    <td><?= $singleUserRow['physicalDemand']; ?></td>
                                    <td><?= $singleUserRow['temporalDemand']; ?></td>
                                    <td><?= $singleUserRow['performance']; ?></td>
                                    <td><?= $singleUserRow['effort']; ?></td>
                                    <td><?= $singleUserRow['frustration']; ?></td>
                                    <td><?= $singleUserRow['mean']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <button class="chartBtn btn btn-default center-block"
                        onclick="showChart(this, 'task<?= $singleTask[0]['idTask']; ?>tbl', 'task<?= $singleTask[0]['idTask']; ?>chart');">
                        <span class="glyphicon glyphicon-signal"></span> Mostra grafico <span
                            class="glyphicon glyphicon-chevron-down"></span>
                    </button>

                    <div id="task<?= $singleTask[0]['idTask']; ?>chart" hidden></div>
                </div>
            </div>
            <?php } } else {?>
            <h3 class="text-center alert alert-warning">Non ci sono risultati
                disponibili.</h3>
            <?php } ?>
        </div>
        <div class="col-sm-2 col-xs-1"></div>
    </div>
</div>