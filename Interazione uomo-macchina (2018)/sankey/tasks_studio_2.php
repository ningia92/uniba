<?php// Start the session//session_start();require_once("../lib/config.php");include_once("sankey_db.php");/** Uncomment the "else" clause below if e.g. userpie is not at the root of your site.*/if (!isUserLoggedInEsp()) {    header('Location: login.php');}unset($_SESSION['ob']); //distruggo la variabile di sessione con l'obiettivo del task per visualizzazione Sankeyunset($_SESSION['ist']); //distruggo la variabile di sessione con la descrizione del task per visualizzazione Sankeyunset($_SESSION['pagine']); //distruggo la variabile di sessione flag per visualizzare l'icona "pagine" nella navbar?><?php//se non esiste una variabile di sessione sull'id task la prelevo dal form con POST e imposto una variabile di sessioneif (!isset($_SESSION['task_id'])){    $_SESSION['task_id'] = $_POST['task_id'];//Recupero Identificativo del task su cui lavorare    $id_task = $_SESSION['task_id'];    //echo "idtask: ".$id_task; //stampa di prova}//altrimenti imposto la variabile $id_task con il valore della variabile di sessione già presoelse {    $id_task = $_SESSION['task_id'];    // echo "idtask: ".$id_task; //stampa di prova}$url = (isset($_POST['url_']) ? $_POST['url_'] : null); //Recupero url del task//echo " idstudio: ".$_SESSION['idstudio']; //stampa di prova dell'id studio?><?php require '.././smt2/config.php'; ?><?php include INC_DIR.'header.php'; ?><!DOCTYPE HTML><html><meta name="viewport" content="width=device-width, initial-scale=2.0"><head>    <meta charset="UTF-8">	<link rel="stylesheet" type="text/css" href="../content/css/switch.css">	    <title>Pagine Tasks Sankey Diagram UTAssistant</title>    <!-- stile per il pulsante indietro -->    <style>        .h5 {color:black; position: relative; right:-15px; top: -95px;            float: left;}        div.google-visualization-tooltip { width: 500px; margin-left: 10px; background: rgba(035, 026, 036, 0.8); }    </style>    <!-- SCRIPT PER IL SANKEY DIAGRAM -->    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    <script type="text/javascript">        var paddingValue = 10000; //dimensione standard dei label        google.charts.load("current", {packages:["sankey"]});        google.charts.setOnLoadCallback(drawChart);        function changePadding() {            var stringa = document.getElementById("valoreLabel").title;            if (stringa === "10000") {                var title = document.getElementById("contenutoPopUp").title;                document.getElementById("valoreLabel").title = 5;                if(title === "Stai visualizzando i Nomi delle Pagine"){                    paddingValue = 10000;                    nameSankey();                }                else {                    paddingValue = 10000;                    drawChart();                }            }            else {                var title = document.getElementById("contenutoPopUp").title;                document.getElementById("valoreLabel").title = 10000;                if(title === "Stai visualizzando i Nomi delle Pagine"){                    paddingValue = 5;                    nameSankey();                }                else {                    paddingValue = 5;                    drawChart();                }            }        }        function drawChart() {            var data = new google.visualization.DataTable();            data.addColumn('string', 'from');            data.addColumn('string', 'to');            data.addColumn('number', 'Utenti che sono passati da qui');            data.addColumn({type:'string', role:'style'});            // data.addColumn({type: 'string', role: 'tooltip'});            <?php            $servername = "localhost";            $dbname = "utassistantdb";            // Create connection            $conn = new mysqli('localhost', 'root', '', 'utassistantdb');            // Check connection            if (!$conn)            {                die('Impossibile connettersi: ' . mysqli_error($mysqli));            }            $sql = "SELECT a.url_partenza, a.url_raggiunto								FROM ass_url_intermedi as a INNER JOIN users as u ON a.id_user = u.user_id								WHERE a.id_task = '$id_task' AND u.group_id = 1";            $result = $conn->query($sql);            $sql2 = "SELECT a.url_partenza, a.url_raggiunto, u.group_id, count(*) as occurrences								FROM ass_url_intermedi as a INNER JOIN users as u ON a.id_user = u.user_id								WHERE a.id_task = '$id_task' GROUP BY a.url_partenza, a.url_raggiunto ORDER BY u.group_id";            $result2 = $conn->query($sql2);            if ($result2->num_rows > 1)            {            while($row2 = $result2->fetch_assoc())            {            if($row2["group_id"] == 1)            {            ?>				var st = "#00ff00";            data.addRows([                [ '<?php echo $row2["url_partenza"] ?>', '<?php echo $row2["url_raggiunto"] ?>', <?php echo $row2["occurrences"] ?>, st]            ]);            <?php 		}            if($row2["group_id"] == 2)            {            ?>				data.addRows([                [ '<?php echo $row2["url_partenza"] ?>', '<?php echo $row2["url_raggiunto"] ?>', <?php echo $row2["occurrences"] ?>, 'gray']            ]);            <?php			}            }            } else { ?>            showNoSankey(); //PARTE LA MODAL DI ERRORE            <?php }            ?>            var colors = [];            for(var i = 0; i < <?php echo $result->num_rows+1 ?>; i++)            {                colors.push("#00cc00");            }            for(var j = 0; j < <?php echo (($result2->num_rows*2)-($result->num_rows)) ?>; j++)            {                colors.push("black");            }            // Set chart options            var options = {                height: 340,                position: 'relative',                sankey:	{ 	iterations: 1000,                    node: {	colors: colors,                        width: 15,                        label: {fontSize: 15},                        labelPadding: paddingValue,                        nodePadding: 30                    }                },                focusTarget: 'category',                tooltip: {                    isHtml:true,                    textStyle: { color: 'white', fontSize: 13, bold: true },                    //trigger: 'selection' // mostra il tooltip al click del mouse (opzione non disponibile per il sankey)                }            };            // Instantiate and draw our chart, passing in some options.            var chart = new google.visualization.Sankey(document.getElementById('sankey_multiple'));            chart.draw(data, options);        }        function setContenutoPopUp() {            var stringa = document.getElementById("contenutoPopUp").title;            if (stringa === "Stai visualizzando i Nomi delle Pagine") {                document.getElementById("contenutoPopUp").title = "Stai visualizzando i Link delle Pagine";                drawChart();            }            else {                document.getElementById("contenutoPopUp").title = "Stai visualizzando i Nomi delle Pagine";                nameSankey();            }        }        function showNoSankey() {            $('#modalNoSankey').modal('show');        }        function goBack() {            window.history.back();        }        function showModalSankey() {            $('#modalHelpSankey').modal('show');        }    </script>    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    <script type="text/javascript">        //Sankey che mostra i nomi delle pagine web, invece che gli url        function nameSankey() {        /*        come sopra, va modificata la query che prende gli url in modo da prendere i nomi        inseriti da Fabio nel db, senza fare altre modifiche        */        var data = new google.visualization.DataTable();        data.addColumn('string', 'from');        data.addColumn('string', 'to');        data.addColumn('number', 'Utenti che sono passati da qui');        data.addColumn({type:'string', role:'style'});        <?php        $servername = "localhost";        $dbname = "utassistantdb";        // Create connection        $conn = new mysqli('localhost', 'root', '', 'utassistantdb');        // Check connection        if (!$conn)        {            die('Impossibile connettersi: ' . mysqli_error($mysqli));        }        $sql = "SELECT a.url_partenza, a.url_raggiunto                                    FROM ass_url_intermedi as a INNER JOIN users as u ON a.id_user = u.user_id                                    WHERE a.id_task = '$id_task' AND u.group_id = 1";        $result = $conn->query($sql);        $sql2 = "SELECT a.nome_pagina_partenza, a.nome_pagina_raggiunta, u.group_id, count(*) as occurrences                 FROM ass_url_intermedi as a                  INNER JOIN users as u                 ON a.id_user = u.user_id                 WHERE a.id_task = '$id_task'                  GROUP BY a.nome_pagina_partenza, a.nome_pagina_raggiunta                  ORDER BY u.group_id";        $result2 = $conn->query($sql2);        if ($result2->num_rows > 0)        {            while($row2 = $result2->fetch_assoc())            {                if($row2["group_id"] == 1) {                    ?>                    var st = "#00ff00";                    data.addRows([                    [ '<?php echo $row2["nome_pagina_partenza"] ?>', '<?php echo $row2["nome_pagina_raggiunta"] ?>', <?php echo $row2["occurrences"] ?>, st]                    ]);                    <?php                }   //end if                if($row2["group_id"] == 2) {                    ?>                    data.addRows([                    [ '<?php echo $row2["nome_pagina_partenza"] ?>', '<?php echo $row2["nome_pagina_raggiunta"] ?>', <?php echo $row2["occurrences"] ?>, 'gray']                    ]);                    <?php                }            }        }        else { ?>            showNoSankey(); //PARTE LA MODAL DI ERRORE        <?php }        ?>        var colors = [];        for(var i = 0; i < <?php echo $result->num_rows+1 ?>; i++)        {        colors.push('#00cc00');        }        for(var j = 0; j < <?php echo (($result2->num_rows*2)-($result->num_rows)) ?>; j++)        {        colors.push("black");        }        // Set chart options        var options = {        height: 340,        position: 'relative',        sankey:	{ 	iterations: 1000,        node: {	colors: colors,        width: 15,            label: {fontSize: 15},        labelPadding: paddingValue,        nodePadding: 30        }        },        focusTarget: 'category',        tooltip: {        isHtml: true,        textStyle: { color: 'white', fontSize: 13, bold: true },        //trigger: 'selection' // mostra il tooltip al click del mouse (opzione non disponibile per il sankey)        }        };        // Instantiate and draw our chart, passing in some options.        var chart = new google.visualization.Sankey(document.getElementById('sankey_multiple'));        chart.draw(data, options);        }    </script>    </head><body><?php require_once("../app/inc/navbars/navbar_esperto.php"); ?><h1 align="center" style='font-size:300%'>Sankey Diagram</h1><?php$ob_studio = ob_studio($_SESSION['idstudio']);//chiamo funzione che effettua query per recuperare nome caso di studio$r = mysql_fetch_array($ob_studio);//recupero obiettivo e descrizione del task in questione$Dati2 = rec_ob($id_task);$r2 = mysql_fetch_array($Dati2);?><!--mostro a video il titolo dello studio più il task corrente--><h4 align="center" style='font-size:200%; clear: both;'><?php echo $r['obiettivo']; echo " Task: "; echo  $r2['obiettivo'] ?></h4><div style="width: 99%;" class="row">    <div class="col-lg-3">        <span class="h5"><span class="glyphicon glyphicon-arrow-left"></span><a style="color:black;  text-decoration:none" href="tasks_studio.php">Indietro</a></span>    </div></div> <!-- col-lg-3 --><div style="clear: both;"class="container-fluid">    <div style="float:right; width: 70%;">        <br />        <div style="float:center;" class="panel panel-default" align="left">            <div class="panel-body">                <a href="#" onclick="showModalSankey()">                    <img src="help.png" style="max-width:3%;height:auto;">  AIUTO                </a>                <!-- SANKEY DIAGRAM -->                <div id="sankey_multiple" class="panel-body">                </div>            </div>        </div>    </div>    <!--STATISTICHE-->    <br />    <div style="float:left; width: 29%; " class="panel panel-default">        <div class="panel-body">            <h4 style="font-size:2vw"> Statistiche</h4>            <?php //interrogo il db per avere i dati da inserire nelle statistiche            //conto i totali            $sql = "SELECT COUNT(esito) AS conta FROM ass_user_task WHERE id_task = '$id_task'";            $result = $conn->query($sql);            $tot = $result->fetch_assoc();            //echo $tot['conta'];            //conto gli esiti positivi            $sql = "SELECT COUNT(esito) AS conta FROM ass_user_task WHERE id_task = '$id_task' AND esito = 1";            $result = $conn->query($sql);            $pos = $result->fetch_assoc();            //echo $pos['conta'];            //tempo medio            $sql = "SELECT AVG(tempo_impiegato) AS media FROM `ass_user_task` WHERE `id_task` = '$id_task'";            $result = $conn->query($sql);            $med = $result->fetch_assoc();            $medSeconds = number_format($med[media], 2);            $neg = $tot['conta']-$pos['conta'];            $perc_successo = ($pos['conta']/$tot['conta'])*100; // percentuale di successo            $perc_successo = number_format($perc_successo, 2);  //riduco le cifre dopo la virgola            $perc_insuccesso = 100 - $perc_successo;            $perc_insuccesso = number_format($perc_insuccesso, 2);  //riduco le cifre dopo la virgola            // conto il percorso ideale            $sql = "SELECT COUNT(*) AS conteggio					FROM ass_url_intermedi as a INNER JOIN users as u ON a.id_user = u.user_id					WHERE a.id_task = '$id_task' AND u.group_id = 1";            $result = $conn->query($sql);            $count_percorso = $result->fetch_assoc();            //conto quanti sono passati per il percorso ideale            $sql = "SELECT * FROM					(SELECT a.id_task, a.id_user, a.url_partenza, a.url_raggiunto 					FROM ( SELECT a.id_task, a.id_user, a.url_partenza, a.url_raggiunto, u.group_id FROM ass_url_intermedi as a 					INNER JOIN users as u ON a.id_user = u.user_id WHERE a.id_task = '$id_task' AND u.group_id = 2 ) AS a 					INNER JOIN (SELECT * FROM `ass_user_task`WHERE id_task='$id_task') AS b ON a.id_user = b.id_user WHERE b.esito = 1) AS prima 					INNER JOIN (SELECT a.url_partenza, a.url_raggiunto								FROM ass_url_intermedi as a INNER JOIN users as u ON a.id_user = u.user_id								WHERE a.id_task = '$id_task' AND u.group_id = 1) AS ideale ON prima.url_partenza = ideale.url_partenza AND prima.url_raggiunto = ideale.url_raggiunto                                ORDER BY prima.id_user ";            $result = $conn->query($sql);            $flag=0;            $count = 0;            $utenti = 0;            $percentuale_ideale = 0;            if ($result->num_rows > 0)            {                while($row = $result->fetch_assoc())                {                    if($flag == 0)                    {                        $temp = $row['id_user'];                        $flag = 1;                    }                    if($row['id_user'] == $temp)                    {                        $count++;                    }                    else                    {                        if($count == $count_percorso['conteggio'])                        {                            $utenti++;                            echo "utenti dentro: $utenti";                        }                        $count = 1;                        $temp = $row[id_user];                    }                }                if($count == $count_percorso['conteggio'])                {                    $utenti++;                    echo "utenti fuori: $utenti";                }                echo "utenti finale: $utenti";                $percentuale_ideale = $utenti/$tot['conta'] * 100;                $percentuale_ideale = number_format($percentuale_ideale, 2);            }            ?><ul>                <li>                    <?php                    echo "<h6 style='font-size:1.1vw'> Utenti che hanno eseguito il task: $tot[conta]</h6>"; ?></li>                <li>                    <?php                    echo "<h6 style='font-size:1.1vw'> Utenti che hanno superato il task: $pos[conta] ($perc_successo%)</h6>"; ?></li>                <li>                    <?php                    echo "<h6 style='font-size:1.1vw'> Utenti che hanno seguito il percorso ideale: $utenti ($percentuale_ideale%)</h6>"; ?></li>                <li>                    <?php                    echo "<h6 style='font-size:1.1vw'> Utenti che hanno fallito: $neg ($perc_insuccesso%)</h6>"; ?></li>                <li>                    <?php                    echo "<h6 style='font-size:1.1vw'> Tempo medio: $medSeconds s</h6>"; ?></li>            </ul>        </div>    </div>		<!-- Checkbox di modifica del sankey -->	<div style="float:left; width:29%;" class="panel panel-default">		<div class="panel-body">			<h4 style="font-size:2vw">Filtri</h4>			<h5> Visualizza pagine con </h5>			<div class="onoffswitch" id="contenutoPopUp" title="Stai visualizzando i Link delle Pagine" >				<input type="checkbox"  name="webNames" class="onoffswitch-checkbox" id="myonoffswitch2" checked onclick="setContenutoPopUp()">				<label class="onoffswitch-label" for="myonoffswitch2">					<span class="onoffswitch-inner2"></span>					<span class="onoffswitch-switch"></span>				</label>			</div>            <h5> Visualizza Etichette Nodi </h5>            <div class="onoffswitch" id="valoreLabel" title="5" >                <input type="checkbox"  name="webNames" class="onoffswitch-checkbox" id="myonoffswitch" onclick="changePadding()">                <label class="onoffswitch-label" for="myonoffswitch">                    <span class="onoffswitch-inner"></span>                    <span class="onoffswitch-switch"></span>                </label>            </div>		</div>	</div></div><!-- Modal messaggio di errore in caso di sankey vuoto --><div id="modalNoSankey" class="modal fade" role="dialog">    <div class="modal-dialog">        <div class="modal-content">            <div class="modal-header">                <h4 class="modal-title">Nessun Diagramma Sankey Visualizzabile</h4>            </div>            <div class="modal-body">                <span>                    Non sono stati trovati risultati per la sua richiesta, probabilmente nessun utente ha ancora effettuato                    questo task.<br>                    In caso di di problemi contatti il webmaster per maggiori informazioni                </span>            </div>            <div class="modal-footer">                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="goBack()">chiudi</button>            </div>        </div>    </div></div><!-- Modal di aiuto alla lettura del Sankey --><div id="modalHelpSankey" class="modal fade" role="dialog">    <div class="modal-dialog">        <div class="modal-content">            <div class="modal-header">                <h4 class="modal-title">Come interpretare il Sankey diagram</h4>            </div>            <div class="modal-body">                <span>                    Il <strong>Diagramma di Sankey</strong> è pensato per permettere di comprendere in che modo gli utenti si sono spostati all'interno del sito web                    preso in esame durante lo svolgimento del task assegnati.                    Ogni <strong>Nodo</strong> (di forma rettangolare, in verde o in nero) rappresenta una pagina web,                    e ogni <strong>Flusso</strong> rappresenta il passaggio di uno o                    più utenti che hanno esplorato le pagine del sito web. L'ampiezza del                    flusso che collega due nodi è determinata dal numero di utenti che effettuano                    quel percorso. Il <strong><span style="color:#00ff00;">Flusso Verde</span></strong> e i relativi <strong><span style="color:green;">Nodi</span></strong> rappresentano il percoso ideale,                    mentre i flussi in grigio rappresentano gli altri percorsi. Infine                    le informazioni relative alle pagine web di partenza, di arrivo, e al numero di utenti, sono visualizzabili                    facendo passare il mouse sul relativo flusso.<br>                    <b>NB</b>: nel numero di utenti del percorso ideale è <u>sempre</u> compreso l'esperto.                </span>            </div>            <div class="modal-footer">                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="goBack()">chiudi</button>            </div>        </div>    </div></div></div></body></html>