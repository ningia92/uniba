<?php
    require_once("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");
    include_once("lib/Sus_func.php");

    // CALCOLO DEVIAZIONE STANDARD DEL SUS SCORE
    $dev_std = 0;
    $Upper_CI_Bound = 0;
    $Lower_CI_Bound = 0;
    $ic = 0;

    if ($numero_questionari > 1) {
        $dev_std = stddev($Sus_Score);

        // CALCOLO L'INTERVALLO DI CONFIDENZA 95%
        $ic = ($dev_std / sqrt(count($Sus_Score))) * 1.96;
        // Ora ricavo l'intervallo di fiducia:
        $Upper_CI_Bound = $Total_sus_score + ($ic / 2);
        $Lower_CI_Bound = $Total_sus_score - ($ic / 2);
    }
?>
<div class="container-fluid">
    <?php
        $ob_studio = obiettivo_studio($id_studio);
        $r = $db->sql_fetchrow($ob_studio);
    ?>
    <div class="row">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-8 col-xs-10">
            <h2 align="center">Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2>
            <h4>Tabella punteggio SUS</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Punteggio SUS:</th>
                        <th>Deviazione standard:</th>
                        <th>Intervallo di Confidenza 95%:</th>
                        <th>Intervallo di confidenza-limite superiore:</th>
                        <th>Intervallo di confidenza-limite superiore:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo number_format($Total_sus_score, 2); ?></td>
                        <td><?php echo number_format($dev_std, 2);?></td>
                        <td><?php echo number_format($ic, 2);?></td>
                        <td><?php echo number_format($Upper_CI_Bound, 2);?></td>
                        <td><?php echo number_format($Lower_CI_Bound, 2);?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-sm-2 col-xs-1"></div>
    </div>
</div>
