<?php
require_once("../../lib/config.php");
 
if (isset($_REQUEST['idstudio'])) {
// $conn = new mysqli("localhost", "root", "", "utassistantdb");
 
$idstudio = $_POST['idstudio'];


	$sql = "SELECT DISTINCT id_task, obiettivo FROM `task` WHERE task.id_studio='". $idstudio."' ORDER BY task.id_task";
    $query_sql = "SELECT ass_user_task.*, task.obiettivo, task.istruzioni, task.url, task.urlfinale, task.durata_max FROM ass_user_task INNER JOIN task ON ass_user_task.id_task = task.id_task WHERE ass_user_task.id_studio='". $idstudio."' ORDER BY ass_user_task.id_user, ass_user_task.id_task";
    $result = $db->sql_query($query_sql);
	$result_task = $db->sql_query($sql);


if($result->num_rows != 0)
{	
//***Inserisco in un array i dati presi dal database ordinandoli per partecipante e per task***//
$partecipanti = array();
$tasks = array();
$data_task = array();
$data_esiti = array();


while(($row = $db->sql_fetchrow($result)))
{
	$tasks[$row['id_task']] = array("esito" => $row['esito'],"obiettivo" => $row['obiettivo'],"istruzioni" => $row['istruzioni'],"url" => $row['url'],"urlfinale" => $row['urlfinale'],"url_raggiunta" => $row['url_raggiunta'],"note" => $row['note'],"tempo_impiegato" => $row['tempo_impiegato'], "durata_max" => $row['durata_max']);
	$partecipanti[$row['id_user']] = $tasks;
}


//***Costruisco la tabella che conterrà i dati***//

echo "<div class=\"table-responsive\">";

echo<<<SPT
<script>
$(document).ready(function(){
SPT;

foreach($partecipanti as $partecipante => $temp)
{

	foreach($temp as $task => $t)
	{
		echo<<<SPT1
		$('#popover{$task}{$partecipante}').popover({title: "<b>Task {$task}</b><button type=\"button\" id=\"close\" class=\"close\" onclick=\"$('#popover{$task}{$partecipante}').popover('hide');\">&times;</button>", content: "<div><p><b>Obiettivo:</b> {$t['obiettivo']}</p><p style=\"word-wrap:break-word\"><b>Istruzioni: </b>{$t['istruzioni']}</p><p style=\"word-wrap:break-word\"><b>URL iniziale: </b>{$t['url']}</p>	<p style=\"word-wrap:break-word\"><b>URL finale: </b>{$t['urlfinale']}</p>	<p style=\"word-wrap:break-word\"><b>URL raggiunta: </b>{$t['url_raggiunta']}</p>	<p><b>Note: </b>{$t['note']}</p>	<p><b>Durata massima: </b>{$t['durata_max']} (min.)</p></div>	<p><b>Tempo impiegato: </b>{$t['tempo_impiegato']} (sec.)</p></div>",	html: true, placement: "auto left"});   
SPT1;
	}
}

echo<<<SPT2
});

</script>
SPT2;

echo "<table  class=\"table table-striped table-bordered\"><tr><td></td>";

$result_task->data_seek(0);
while($row = $db->sql_fetchrow($result_task))
{
	
	echo "<td align=\"center\">{$row['obiettivo']}</td>";
}
echo "<td><h5>Tasso di successo medio per partecipante</h5></td>";
echo "</tr>";

$riga = 0;
$colonna = 0;
foreach($partecipanti as $partecipante => $temp)
{
	echo "<tr><td>Partecipante {$partecipante}</td>";

	$somma_esiti_partecipante = 0;

	foreach($temp as $task => $t)
	{
		echo "<td><a id=\"popover{$task}{$partecipante}\" href=\"#\" data-toggle=\"popover\" >{$t['esito']}</a></td>";
		$somma_esiti_partecipante += intval($t['esito']);
		$esiti[$riga][$colonna] = intval($t['esito']);
		$colonna++;
	}
	$colonna = 0;
	$riga++;

	$media_partecipante = count($temp);
		
	if($media_partecipante != 0)
	$media_partecipante = round(($somma_esiti_partecipante/count($temp))*100,2);


	$array_media_partecipante[] = $media_partecipante;
	echo "<td>{$media_partecipante}%</td>";
	echo "</tr>";
	
}

echo "<tr><td>Tasso di successo medio per task</td>";

$row = 0;
$col = 0;

for ($col = 0; $col < count($esiti[0]); $col++)
{
	$media_task = 0;
			for ($row = 0; $row < count($esiti); $row++) 
				{
					$media_task += $esiti[$row][$col];	
				}
	
		$media_task = round((($media_task)/count($esiti))*100,2);
	
		$array_media_task[] = $media_task;
		echo "<td>{$media_task}%</td>";
}

echo "<td></td></tr>";
echo "</table>";

$media_complessiva = round((((array_sum($array_media_partecipante))/count($array_media_partecipante)) + ((array_sum($array_media_task))/count($array_media_task)))/2,2);
echo "Tasso di successo medio complessivo (task e partecipanti): {$media_complessiva}%";
echo "</div>";

}
else
	echo "Questo studio non è stato mai eseguito o non ci sono dati sufficienti!";
}
else
	echo "Errore caricamento pagina!"
?>

