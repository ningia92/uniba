<?php
    require_once ("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");

    $sqlquery = "SELECT * FROM q_umux";
    $result = $db->sql_query($sqlquery);
    $number = 0;
    $matrice = array();
    $i = 0;
    while ($q_umux = $db->sql_fetchrow($result)) {
        $matrice[] = [
            $q_umux["id_utente"],
            $q_umux["id_studio"],
            $q_umux["r1"],
            $q_umux["r2"]
        ];
        $number ++;
        $i ++;
    }

    if ($number < 1) {
        print "<center><p>Nessun questionario compilato.</p></center>";
    } else {

        /*
         * for($i=0;$i<$number;$i++)
         * {
         * $resrow = $db->sql_fetchrow($result);
         * for($j=0;$j<4;$j++)
         * {
         * $matrice[$i][$j] = $resrow[$j];
         * }
         * }
         */

        $y = array();
        $j = 0;

        for ($i = 0; $i < $number; $i ++) {
            // $resrow = $db->sql_fetchrow($result);

            if ($matrice[$i][1] == $_SESSION["idstudio"]) {
                $y[$j] = calcolaUmux($matrice[$i][2], $matrice[$i][3]);
                $j ++;
            }
        }
?>


<script type="text/javascript">
  //      google.charts.load("current", {
  //          packages: ['corechart']
  //      });
  //      google.charts.setOnLoadCallback(drawUMUXhistogramChart);



        function drawUMUXhistogramChart() {
            var umux = <?php echo '["' . implode('", "', $y) . '"]' ?>;
            var a = [
                ["User", "UmuxScore", {
                    role: "style"
                }],
                ["Utente1", <?php echo $y[0]?>, "color: #F62217"]
            ];

            var i = 1;
            while (i <= <?php echo $j-1?>) {
                var temp = [];

                temp.push("Utente" + (i + 1));
                temp.push(umux[i]);
                temp.push("color: #F62217");
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
                title: "Grafico a barre - punteggio Umux partecipanti",
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-8 col-xs-10">
            <div id="columnchart_values" style="width: auto; height: 300px;"></div>
        </div>
        <div class="col-sm-2 col-xs-1"></div>
    </div>
</div>

<?php } ?>
