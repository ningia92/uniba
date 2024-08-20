<?php
    require_once("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");
    $id_studio = $_SESSION["idstudio"];

    $i = 0;
    $utenti = array();

    $Dati = select_qNPS($id_studio);
    while($q_nps = $db->sql_fetchrow($Dati)) {
        $risposte[$i] = $q_nps["r"];
        $utenti[$q_nps["username"]] = $q_nps["r"];
        $i++;
    }

    $numero_questionari = $i;
    if($numero_questionari>0) {
        //$_SESSION['numpartecipanti'] = $numero_questionari;
        $_SESSION['risposte'] = $utenti;
        $promotori=0;
        $detrattori=0;
        $neutri=0;
        for($j=0;$j<$numero_questionari;$j++) {
            if($risposte[$j] >8 && $risposte[$j] <11)
                $promotori++;
            else if($risposte[$j] >6 && $risposte[$j] <9)
                    $neutri++;
                else if($risposte[$j] >=0 && $risposte[$j] <7)
                        $detrattori++;
        }
        $promotori = $promotori / $numero_questionari;
        $neutri = $neutri / $numero_questionari;
        $detrattori = $detrattori / $numero_questionari;
        $valNPS = ($promotori - $detrattori) * 100;

        //VARIABILI DI SESSIONE PER NpsPie.php
        $_SESSION['detrattori']=$detrattori;
        $_SESSION['neutri']=$neutri;
        $_SESSION['promotori']=$promotori;
?>
<script type="text/javascript">
    function drawNPSscoreChart() {

        var data = new google.visualization.arrayToDataTable([
            ["Label", "Value"],
            ["NPScore", <?php echo intval( $valNPS ); ?>]
        ]);

        var options = {
            min:-100, max:100,
            width: 250, height: 250,
            redFrom: -100, redTo: -40,
            yellowFrom:-40, yellowTo: 10,
            greenFrom:10, greenTo:100,
            minorTicks: 10
        };

        var chart = new google.visualization.Gauge(document.getElementById("npscore_div"));

        chart.draw(data, options);
    }
</script>

<?php
    $ob_studio = obiettivo_studio($id_studio);
    $r = $db->sql_fetchrow($ob_studio);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-8 col-xs-10">
            <h2 align="center">Risultati del questionario NPS dello studio: <?php echo $r['obiettivo'] ?></h2>
            <h2>Tabella punteggio NPS</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Punteggio NPS:</th>
                        <td><?php echo number_format($valNPS, 0); ?></td>
                    </tr>
                    <tr>
                        <th>Detrattori(0-6):</th>
                        <td><?php echo number_format($detrattori*$numero_questionari, 0).' ('.number_format($detrattori*100, 1).'%)';?></td>
                    </tr>
                    <tr>
                        <th>Neutri(7-8):</th>
                         <td><?php echo number_format($neutri*$numero_questionari, 0).' ('.number_format($neutri*100, 1).'%)';?></td>
                    </tr>
                    <tr>
                        <th>Promotori(9-10):</th>
                        <td><?php echo number_format($promotori*$numero_questionari, 0).' ('.number_format($promotori*100, 1).'%)';?></td>
                    </tr>
                </thead>
             </table>
            <div id="npscore_div" style="vertical-align: middle; overflow: hidden; width: 250px; height: 250px; display: inline-block;"></div>
        </div>
        <div class="col-sm-2 col-xs-1"></div>
    </div>
</div>
<?php
    } else {
        echo '<h2>Nessun questionario compilato</h2>';
    }

    function select_qNPS($id_studio)
    {
        global $db;
        $Sql   = "Select * from q_nps inner join users on q_nps.id_utente = users.user_id where id_studio=$id_studio";
        $Dati  = $db->sql_query($Sql);
        return $Dati;
    }
?>
