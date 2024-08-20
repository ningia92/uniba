<?php
require_once("../../lib/config.php");
include_once("../../questionari/lib/utils.php");

$id_studio = $_SESSION["idstudio"];

$i = 0;
$j = 0;
$risposte_modificate = array();
$Sus_Score = array();
$Sus_Usability = array();
$Learnability = array();
$Total_sus_score = 0;
$TotSusUsability = 0;
$TotSusLearnability = 0;

// Recupero le risposte dei questionari dal db
$Dati = select_qSUS($id_studio);
while ($q_sus = $db->sql_fetchrow($Dati)) {
    for ($j = 0; $j <= 9; $j ++) {
        $r = $j + 1;
        $risposte[$i][$j] = $q_sus["r$r"];
    }
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ nel vettore utenti inserisco gli id utenti che man mano fanno i questionari
  //  $utenti[$i] = $q_sus[10];
    $i ++;
}

$numero_questionari = $i;
$_SESSION['numpartecipanti'] = $numero_questionari;

for ($i = 0; $i < $numero_questionari; $i ++) {
    $Somma_risposte = 0;
    for ($k = 0; $k <= 9; $k ++) {
        if (pari_dispari($k + 1) == 0) {
            $risposte_modificate[$i][$k] = 5 - $risposte[$i][$k];
        } else {
            $risposte_modificate[$i][$k] = $risposte[$i][$k] - 1;
        }
        $Somma_risposte = $Somma_risposte + $risposte_modificate[$i][$k];
    }

    $Learnability[$i] = ($risposte_modificate[$i][3] + $risposte_modificate[$i][9]) * 12.5;
    $Sus_Usability[$i] = ($Somma_risposte - $risposte_modificate[$i][3] - $risposte_modificate[$i][9]) * 3.125;
    $Sus_Score[$i] = $Somma_risposte * 2.5;
    $Mean[$i] = $Sus_Usability[$i] * 0.8 + $Learnability[$i] * 0.2;

    $Total_sus_score = $Total_sus_score + $Sus_Score[$i];
    $TotSusLearnability = $TotSusLearnability + $Learnability[$i];
    $TotSusUsability = $TotSusUsability + $Sus_Usability[$i];
    $n = $i + 1;

    // VARIABILI DI SESSIONE PER boxchart.php
    $_SESSION['partecipanteSUS' . $n] = $Sus_Score[$i];
    $_SESSION['partecipanteusability' . $n] = $Sus_Usability[$i];
    $_SESSION['partecipantelearnability' . $n] = $Learnability[$i];
}



    $Total_sus_score = $Total_sus_score / $numero_questionari;
    // VARIABILE DI SESSIONE CHE SERVE IN chartscore
    $_SESSION['totScore'] = $Total_sus_score;


// CALCOLO DEVIAZIONE STANDARD DEL SUS SCORE
/*$dev_std = 0;
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
    echo $dev_std;
}*/

function pari_dispari($i)
{
    if ($i & 1) {
        return 1;
    } else {
        return 0;
    }
}

function select_qSUS($id_studio)
{
    global $db;
    // aggiungo nome utente alla query per tener traccia dell'utente per il questionario
    $Sql = "SELECT r1,r2,r3,r4,r5,r6,r7,r8,r9,r10,users.username FROM q_sus INNER JOIN users ON users.user_id = q_sus.id_utente WHERE id_studio=$id_studio";
    $Dati = $db->sql_query($Sql);
    return $Dati;
}

?>
