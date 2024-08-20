<?php
    require_once("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");
    include_once("lib/Sus_func.php");

    $Total_sus_score = $Total_sus_score / $numero_questionari;
    $TotSusLearnability = $TotSusLearnability / $numero_questionari;

    // CALCOLO DEVIAZIONE STANDARD DEL SUS SCORE
    $DevStdSusLearnability = 0;
    $Upper_CI_Bound = 0;
    $Lower_CI_Bound = 0;
    $ic = 0;
    if ($numero_questionari > 1) {
        $DevStdSusLearnability = stddev($Learnability);

        // CALCOLO L'INTERVALLO DI CONFIDENZA 95%
        $ic = ($DevStdSusLearnability / sqrt(count($Learnability))) * 1.96;
        // Ora ricavo l'intervallo di fiducia:
        $Upper_CI_Bound = $TotSusLearnability + ($ic / 2);
        $Lower_CI_Bound = $TotSusLearnability - ($ic / 2);
    }
?>

<div class="container-fluid">
<?php
    $ob_studio = obiettivo_studio($id_studio); // chiamo funzione che effettua query per recuperare nome caso di studio
    $r = $db->sql_fetchrow($ob_studio);
?>

<div class="row">
	<div class="col-sm-2 col-xs-1">
	</div>

	<div class="col-sm-8 col-xs-10">
    <h2 align="center">Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2>
		<!--mostro a video il titolo dello studio corrente-->
		<br />
		<h4>SUS - Apprendibilità</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>SUS - Apprendibilità:</th>
					<th>Deviazione standard:</th>
					<th>Intervallo di Confidenza 95%:</th>
					<th>Intervallo di confidenza-limite superiore:</th>
					<th>Intervallo di confidenza-limite superiore:</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo number_format($TotSusLearnability, 2); ?></td>
					<td><?php echo number_format($DevStdSusLearnability, 2); ?></td>
					<td><?php echo number_format($ic, 2);?></td>
					<td><?php echo number_format($Upper_CI_Bound, 2); ?></td>
					<td><?php echo number_format($Lower_CI_Bound, 2); ?></td>
				</tr>

			</tbody>
		</table>
	</div>

<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>
