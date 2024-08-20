<?php
    require_once("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");
    include_once("lib/Sus_func.php");
    $i = 0;
    $j = 0;
    $risposte_modificate = array();
    $Sus_Score = array();
    $Sus_Usability = array();
    $Learnability = array();
    $Total_sus_score = 0;
    $TotSusUsability = 0;

    $id_studio = $_SESSION["idstudio"];

    //Recupero le risposte dei questionari dal db
    $Dati = select_qSUS($id_studio);

    while($q_sus = $db->sql_fetchrow($Dati)) {
        for($j=0;$j<=9;$j++) {
            $r = $j+1;
            $risposte[$i][$j] = $q_sus["r$r"];
        }
        $i++;
    }

    $numero_questionari = $i;

    for($i = 0; $i < $numero_questionari; $i++) {
        $Somma_risposte = 0;
        for($k = 0; $k <= 9; $k++) {
            if(pari_dispari($k+1) == 0) {
                $risposte_modificate[$i][$k] = 5 - $risposte[$i][$k];
            } else {
                $risposte_modificate[$i][$k] = $risposte[$i][$k] - 1;
            }
            $Somma_risposte = $Somma_risposte + $risposte_modificate[$i][$k];
        }
        $Learnability[$i] = ($risposte_modificate[$i][3] + $risposte_modificate[$i][9]) * 12.5;
        $Sus_Usability[$i] = ($Somma_risposte - $risposte_modificate[$i][3] - $risposte_modificate[$i][9])* 3.125;
        $Sus_Score[$i] = $Somma_risposte * 2.5;
        $Mean[$i] = $Sus_Usability[$i] * 0.8 + $Learnability[$i] * 0.2;

        $Total_sus_score = $Total_sus_score + $Sus_Score[$i];
        $TotSusUsability = $TotSusUsability + $Sus_Usability[$i];
    }

    if ($numero_questionari == 0) {//non fa nulla
    }

    else {

    $Total_sus_score = $Total_sus_score / $numero_questionari;
    $TotSusUsability = $TotSusUsability /  $numero_questionari; }

    //CALCOLO DEVIAZIONE STANDARD DEL SUS SCORE
    $DevStdSusUsability = 0;
    $Upper_CI_Bound = 0;
    $Lower_CI_Bound = 0;
    $ic = 0;
    if($numero_questionari>1) {
        $DevStdSusUsability=stddev($Sus_Usability);

        //CALCOLO L'INTERVALLO DI CONFIDENZA 95%
        $ic = ($DevStdSusUsability / sqrt(count($Sus_Usability)))*1.96;
        //Ora ricavo l'intervallo di fiducia:
        $Upper_CI_Bound = $TotSusUsability+($ic/2);
        $Lower_CI_Bound = $TotSusUsability-($ic/2);
    }


?>

<div class="container-fluid">
   <?php
            $ob_studio = obiettivo_studio($id_studio); //chiamo funzione che effettua query per recuperare nome caso di studio
            $r = $db->sql_fetchrow($ob_studio);
    ?>

<div class="row">
	<div class="col-sm-2 col-xs-1">
	</div>

	<div class="col-sm-8 col-xs-10">
    <h2 align="center">Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2> <!--mostro a video il titolo dello studio corrente-->
<br/>
  <h4>Sus: Usabilita'</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>SUS _ Usabilità:</th>
        <th>Deviazione standard:</th>
        <th>Intervallo di Confidenza 95%:</th>
        <th>Intervallo di confidenza-limite superiore:</th>
        <th>Intervallo di confidenza-limite superiore:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo  number_format($TotSusUsability, 2); ?></td>
        <td><?php echo  number_format($DevStdSusUsability, 2); ?></td>
        <td><?php echo  number_format($ic, 2);?></td>
        <td><?php echo  number_format($Upper_CI_Bound, 2); ?></td>
        <td><?php echo  number_format($Lower_CI_Bound, 2); ?></td>
     </tr>

    </tbody>
  </table>
</div>

<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>
