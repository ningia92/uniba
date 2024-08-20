<?php

require_once("../../lib/config.php");
include_once("../../questionari/lib/utils.php");


$id_studio = $_SESSION["idstudio"];

$sqlquery = "SELECT * FROM q_umux WHERE id_studio = '$id_studio'";
$result = $db->sql_query($sqlquery);
$number = 0;
$tuple = array();


while ($q_umux = $db->sql_fetchrow($result)) {

    $tuple[$number] = array(
        "r1" => $q_umux['r1'],
        "r2" => $q_umux['r2']
    );
    $number ++;
}

if ($number < 1) {
    print "<center><p>Nessun questionario compilato.</p></center>";
} else {

//    $umuxScore = array();

    for ($i = 0; $i < $number; $i ++) {
        $umuxScore[] = calcolaUmux($tuple[$i]['r1'], $tuple[$i]['r2']);
    }

    $numero_questionari = $number;
    $_SESSION['num_partecipanti'] = $numero_questionari;

    $total_umux_score = 0;

    for($i = 0; $i < $numero_questionari; $i ++) {

        $total_umux_score = $total_umux_score + $umuxScore[$i];

        $n = $i + 1;
        // VARIABILI DI SESSIONE PER Umuxboxchart.php
        $_SESSION['partecipanteUMUX' . $n] = $umuxScore[$i];
    }

    $dev_std = 0;
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ evito il warning della divisione per zero in caso di nessun questionario svolto
    // if ($numero_questionari == 0) echo "<h2>Nessun questionario compilato</h2><br>";
    /*
     * if ($numero_questionari == 0) {
     * ?><script> window.alert("Nessun questionario compilato!");</script>
     *
     * }
     *
     * else {
     */
    $total_umux_score = $total_umux_score / $numero_questionari;

    // CALCOLO DEVIAZIONE STANDARD DEL UMUX SCORE

    for ($i = 0; $i < $numero_questionari; $i ++) {
        $dev_std = $dev_std + pow(($umuxScore[$i] - $total_umux_score), 2);
    }
    $dev_std = $dev_std / $numero_questionari;
    $dev_std = sqrt($dev_std);
    // }

    // CALCOLO L'INTERVALLO DI CONFIDENZA 95%
    $ic = ($dev_std / sqrt(count($umuxScore))) * 1.96;
    // Ora ricavo l'intervallo di fiducia:
    $Upper_CI_Bound = $total_umux_score + ($ic / 2);
    $Lower_CI_Bound = $total_umux_score - ($ic / 2);
}

function select_qUMUX($id_studio)
{
    global $db;
    // aggiungo nome utente alla query per tener traccia dell'utente per il questionario
    $Sql = "SELECT r1,r2,users.username FROM q_umux INNER JOIN users ON users.user_id = q_umux.id_utente WHERE id_studio=$id_studio";
    $Dati = $db->sql_query($Sql);
    return $Dati;
}

?>



<div class="container-fluid">
<div class="row">
	<div class="col-sm-2 col-xs-1">
	</div>


<div class="col-sm-8 col-xs-10">
		<a href="#" onclick=" $('#modalInfo_t_t_Umux').modal('show');"> <span
			class="glyphicon glyphicon-info-sign"><strong class="h4"> Info</strong></span>
		</a>
		<h2>Tabella punteggio UMUX-Lite</h2>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Punteggio UMUX-Lite:</th>
					<th>Deviazione standard:</th>
					<th>Intervallo di Confidenza 95%:</th>
					<th>Intervallo di confidenza-limite superiore:</th>
					<th>Intervallo di confidenza-limite inferiore:</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo number_format($total_umux_score, 2); ?></td>
					<td><?php echo number_format($dev_std, 2);?></td>
					<td><?php echo number_format($ic, 2);?></td>
					<td><?php echo number_format($Upper_CI_Bound, 2);?></td>
					<td><?php echo number_format($Lower_CI_Bound, 2);?></td>

				</tr>

			</tbody>
		</table>
		</div>
<div class="col-sm-2 col-xs-1">

</div>

</div></div>




	<!-- Modal descrizione tab_totUmuxScore-->
	<div id="modalInfo_t_t_Umux" class="modal fade" role="dialog">
		<div class="modal-dialog">


			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title ">Informazioni sul calcolo dei risultati:</h4>
				</div>
				<div class="modal-body">
					<span> <strong>Calcolo Punteggio UMUX-Lite:</strong><br> Ci sono
						due modi per calcolare i risultati di UMUX. Il primo è il calcolo
						dei valori della scala in modo assoluto, come segue: Totale
						assoluto (UMUX-LITE) = {[(Risp. Domanda 1-1)+( Risp. Domanda
						2-1)]* (100/12)}.<br> Il secondo processo di calcolo si basa
						sull’idea di bilanciare i punteggi di UMUX-LITE facendoli
						regredire verso i punteggi di un’altra scala di valutazione, il
						SUS, in modo da poterli comparare. <br>In questo sistema è stata
						adottata questa formula che si riferisce al totale standardizzato
						<br> (UMUX-LITE) = 0.65*{[( Risp. Domanda 1-1)+(Risp. Domanda
						2-1)]* (100/12)} + 22.9. <strong>Calcolo Deviazione standard: </strong><br>
						La deviazione standard, altro non è che la distribuzione dei
						nostri dati. La formula per calcolarla è: σ =
						radice[(Σ((X-μ)^2))/(N)].

					</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
				</div>
			</div>
		</div>
	</div>
