<?php
// Start the session
// session_start();
require_once ("../lib/config.php");
include_once ("lib/clickmap_db.php");

/*
 * Uncomment the "else" clause below if e.g. userpie is not at the root of your site.
 */
if (! isUserLoggedInEsp()) {
    header("Location: ".ACCOUNT_DIR." login.php");
}
unset($_SESSION['ob']); // distruggo la variabile di sessione con l'obiettivo del task per visualizzazione Heatmap
unset($_SESSION['ist']); // distruggo la variabile di sessione con la descrizione del task per visualizzazione Heatmap
unset($_SESSION['pagine']); // distruggo la variabile di sessione flag per visualizzare l'icona "pagine" nella navbar
?>

<?php
// se non esiste una variabile di sessione sull'id task la prelevo dal form con POST e imposto una variabile di sessione
if (! isset($_SESSION['task_id'])) {
    $_SESSION['task_id'] = $_POST['task_id']; // Recupero Identificativo del task su cui lavorare
    $id_task = $_SESSION['task_id'];
    // echo "idtask: ".$id_task; //stampa di prova
}  // altrimenti imposto la variabile $id_task con il valore della variabile di sessione già preso
else {
    $id_task = $_SESSION['task_id'];
    // echo "idtask: ".$id_task; //stampa di prova
}

$url = (isset($_POST['url_']) ? $_POST['url_'] : null); // Recupero url del task
                                                        // echo " idstudio: ".$_SESSION['idstudio']; //stampa di prova dell'id studio

?>

<?php require '.././smt2/config.php'; ?>
<?php include INC_DIR.'header.php'; ?>
<?php

$ob_studio = ob_studio($_SESSION['idstudio']); // chiamo funzione che effettua query per recuperare nome caso di studio
$r = $db->sql_fetchrow($ob_studio);

// recupero obiettivo e descrizione del task in questione
$Dati2 = rec_ob($id_task);
$r2 = $db->sql_fetchrow($Dati2);
// INSERISCO IN VARIABILI DI SESSIONE OBIETTIVO E DESCRIZIONE DEL TASK PER MOSTRARE IL TUTTO SULLA NAVBAR HEATMAP E SULLA PAGINA IN QUESTIONE
$_SESSION['ob'] = $r2['obiettivo'];
$_SESSION['ist'] = $r2['istruzioni'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Pagine Tasks Clickmap UTAssistant</title>
<!-- stile per il pulsante indietro -->
<style>
.h5 {
	color: black;
	position: relative;
	right: -19px;
	top: -95px;
}
</style>
<link rel="stylesheet" type="text/css" href="lib/prova_navbar.css">
</head>
<body>
      <?php require_once("../app/inc/navbars/navbar_esperto.php"); ?>
      <script>
      $(document).ready(function () {
    	  $('.tree-toggle').click(function () {	$(this).parent().children('ul.tree').toggle(200);
    	  });
    	  $(function(){
    	  $('.tree-toggle').parent().children('ul.tree').toggle(200);
    	  })
  	});
      </script>



	<!-- Riferimento per tornare indietro alla pagina dei tasks -->


	<div class="container">
		<div class="row">
			<div class="col-sm-3">

			</div>
			<div class="col-sm-9">
				<h1 align="center">Clickmap</h1>

				<!--mostro a video il titolo dello studio pi� il task corrente-->
				<h4 align="center"><?php echo $r['obiettivo']. " - ". $r2['obiettivo']; ?></h4>
			</div>

		</div>
		<div class="row">
			<div class="col-sm-3">
        <a href="tasks_studio.php"> <span class="h5"> <span
            class="glyphicon glyphicon-arrow-left"></span> <u>Indietro</u></span></a>
								<!-- MENU RAPIDO HEATMAP -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<b>Menù rapido</b>
					</div>
					<div class="panel-body">
<?php

$result = $loggedInUser->recupera_studi_esperto(); // recupero tutti i casi di studio dell'esperto
while ($campi = $db->sql_fetchrow($result)) {
    $campo[] = $campi;
}

foreach ($campo as $key => $row) // foreach sui casi di studio
{
    $studi = $row['obiettivo']; // prendo tutti gli obiettivi dei casi di studi uno alla volta

    if (strcmp($studi, $r['obiettivo']) == 0) { // se lo studio è quello corrente nella pagina lo evidenzio nel menù

        echo "<a href=\"javascript:menufunc('menu" . $key . "')\"><span style='background-color:#90EE90'><b><u>$studi</u></b></span></a><br><br>"; // stampo obiettivi nel menu
        echo "<div id='menu" . $key . "'  style=\"display: block;\">"; // esplodo il menù se corrisponde al caso di studio
    }

    else { // altrimenti non evidenzio il caso di studio nel menù

        echo "<a href=\"javascript:menufunc('menu" . $key . "')\"><b><u>$studi</u></b></a><br><br>"; // li stampo sul menu
        echo "<div id='menu" . $key . "'  style=\"display: none;\">";
    }

    // INSERIMENTO OBIETTIVI DEI TASKS DI UN CASO DI STUDIO
    $obiettivi_task = array(); // vettore che conterrà gli obiettivi in ordine dei vari tasks dei casi di studio
    $id_tasks = array(); // vettore che conterrà gli id tasks in ordine
    $result2 = ob_task($row['id_studio']); // chiamo funzione per recuperare gli obiettivi dei tasks di un caso di studio

    while ($campo2 = mysql_fetch_array($result2)) {
        $nome_obiettivo = explode("\n", $campo2['obiettivo']); // split sulle andate a capo per suddividere i vari obiettivi
        $obiettivi_task = array_merge($obiettivi_task, $nome_obiettivo); // inserisco i singoli obiettivi in un array

        $nome_task = explode("\n", $campo2['id_task']); // split sulle andate a capo per suddividere gli id task
        $id_tasks = array_merge($id_tasks, $nome_task); // inserisco i singoli id task in un array
    }

    $i = 0; // contatore per id task
    $key2 += count($campo); // serve per aprire e chiudere il menu ad albero nelle varie sottosezioni
    foreach ($obiettivi_task as $row2) // foreach sui tasks
{
        $id = $id_tasks[$i]; // prelevo l'id task corrispondente all'obiettivo del task che servirà come parametro della funzione rec_pagine
                             // echo $id; //test
        echo "- "; // test
                   // echo $key2; //test

        echo "<a href=\"javascript:menufunc('menu" . $key2 . "')\">$row2</a><br><br>";
        echo "<div id='menu" . $key2 . "'  style=\"display: none;\">";

        $key2 ++; // incremento la chiave per aprire e chiudere i sottomenu

        // INSERIMENTO PAGINE VISUALIZZATE PER TASK
        $pagine_task = array(); // vettore che conterrà le pagine visualizzate per task
        $result3 = rec_pagine($id); // chiamo funzione per recuperare le pagine visualizzate durante un task tramite il suo id in input

        while ($campo3 = mysql_fetch_array($result3)) {
            $nome_aux4 = explode("\n", $campo3['url']); // split sull'andata a capo per le pagine aperte durante il task
            $pagine_task = array_merge($pagine_task, $nome_aux4); // inserisco le pagine aperte durante il task in un vettore
        }

        foreach ($pagine_task as $row3) // foreach sulle pagine aperte durante il task
{
            /*
             * Il link della pagina nell'href porta alla visualizzazione dell'heatmap passando alla pagina tre variabili (idtask,url,obiettivo) che servono per la creazione dell'heatmap; queste variabili sono recuperate con $_REQUEST nella pagina heatmap_studio.php qualora non ci siano le variabili di sessione di idtask e url.
             */
            echo "&nbsp&nbsp&nbsp- "; // spazio
            echo "<a href='heatmap_studio.php?task=" . $id . "&url=" . $row3 . "&obiettivo=" . $row2 . "' target='_blank'><i>$row3</i></a><br><br>";
            echo "<div id='menu" . $key3 . "'  style=\"display: none;\">";

            ?>
        <?php
            echo "</div>"; // chiusura div per pagine
        }
        echo "</div>"; // chiusura div per tasks
        $i ++; // incremento id task per il task successivo
    }
    echo "</div>"; // chiusura div per casi di studio
}

?>

            <!-- SCRIPT PER IL FUNZIONAMENTO DEL MENU AD ALBERO -->
						<script>
            function startmenu(menuId){
               document.getElementById(menuId).style.display = "none";
            }


            function menufunc(menuId)
            {
                if(document.getElementById(menuId).style.display == "none")
                {
                    startmenu(menuId);
                    document.getElementById(menuId).style.display = "block";

                }
                else if(document.getElementById(menuId).style.display == "block")
                {
                    startmenu(menuId);
                    document.getElementById(menuId).style.display = "none";

                } else
                {
                    startmenu(menuId);
                }
            }
            </script>

					</div>
				</div>

			</div>

			<div class="col-sm-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<b>Pagine Visualizzate Task</b>
					</div>
					<div class="panel-body">
						<form action=clickmap_studio.php method="post" target="_blank">
							<!-- target="_blank" PER APRIRE NUOVA PAGINA -->

					<?php

    echo '<table class="table table-hover"><tr><th>URL</th><th>Visualizzazione</th></tr><tbody>';
    // Recupero le pagine visitate durante il task
    $Dati = rec_pagine($id_task);

    while ($row4 = $db->sql_fetchrow($Dati)) {

        // visualizzo in tabella le pagine visualizzate inviando al click i dati sull'url e task corrispondente
        echo '<tr><td>' . $row4["url"] . '
                                </td>
                                <td>
                                <button type="submit" class="btn btn-default btn-sm" name="url_" value="' . $row4["url"] . '" checked="checked"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Display</button>
                                </td>
                                <td>
                                <input id="taskid" type="hidden" name="task" value="' . $id_task . '"hidden></input>
                                </td>
                                </tr>';
    }

    ?>

		</form>
					</div>
				</div>
			</div>
			<!-- div col-lg-9 -->
		</div>
	</div>
	</div>

</body>
</html>
