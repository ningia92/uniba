<?php
require_once("../../lib/config.php");
include_once("lib/Sus_func.php");
$numpart = $_SESSION['numpartecipanti'];

$j = 1;
$suspartecipanti = array();
$tot = 1;
while ($tot <= $numpart) {
    $suspartecipanti[$tot] = $_SESSION['partecipanteSUS' . $tot];
    $tot ++;
}
$id_studio = $_SESSION["idstudio"];
?>

<script type="text/javascript">
    //        google.charts.load("current", {
    //            packages: ['corechart']
    //        });
    //        google.charts.setOnLoadCallback(drawChart);

            function drawSUShistogramChart() {
                var sus = <?php echo '["' . implode('", "', $suspartecipanti) . '"]' ?>;
                var a = [
                    ["User", "SusScore", {
                        role: "style"
                    }],
                    ["Utente1", <?php echo $suspartecipanti[1]?>, "color: #76A7FA"]
                ];

                var i = 1;
                while (i <= <?php echo $numpart-1?>) {
                    var temp = [];

                    temp.push("Utente" + (i + 1));
                    temp.push(sus[i]);
                    temp.push("color: #76A7FA");
                    a.push(temp);

                    i++;
                }


                var data = google.visualization.arrayToDataTable(a);



                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1, {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                var options = {
                    title: "Grafico a barre - punteggio SUS partecipanti",
                    width: 850,
                    height: 500,
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }

        </script>


        <?php
        $ob_studio = obiettivo_studio($id_studio); // chiamo funzione che effettua query per recuperare nome caso di studio
        $r = $db->sql_fetchrow($ob_studio);
        ?>
    <div class="container-fluid">
    <div class="row">
	<div class="col-sm-2 col-xs-1">
	</div>

	<div class="col-sm-8 col-xs-10">
    <h2 align="center">Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2>
	<!--mostro a video il titolo dello studio corrente-->
	<br />
	<div id="columnchart_values" style="width: auto; height: 300px;"></div>
</div>
<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>
