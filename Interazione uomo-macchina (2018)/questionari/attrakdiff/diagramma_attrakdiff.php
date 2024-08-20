<?php
    require_once ("../../lib/config.php");
    include_once("../../questionari/lib/utils.php");

    $id_studio = $_SESSION['idstudio'];
    $i = 0;
    $medie = array();
    // Recupero le risposte dei questionari dal db
    $Dati = select_qATTAKDIFF($id_studio);
    while ($q_attrakdiff = $db->sql_fetchrow($Dati)) {
        for ($j = 0; $j <= 27; $j ++) {
            $r = $j + 1;
            $risposte[$i][$j] = $q_attrakdiff["r$r"];
        }
        $i ++;
    }
    $numero_questionari = $i;
    if ($numero_questionari > 0) {
        for ($i = 0; $i <= 27; $i ++) {
            $somma = 0;
            for ($j = 0; $j < $numero_questionari; $j ++) {
                $somma = $somma + $risposte[$j][$i];
                $medie[$i] = $somma / $numero_questionari;
            }
            $medie[$i] = $somma / $numero_questionari;
        }

        $PQ = (($medie[0] + $medie[4] + $medie[7] + $medie[9] + $medie[11] + $medie[19] + $medie[27]) / 7) - 4;
        $HQI = (($medie[1] + $medie[5] + $medie[10] + $medie[12] + $medie[13] + $medie[14] + $medie[15]) / 7) - 4;
        $HQS = (($medie[3] + $medie[17] + $medie[21] + $medie[22] + $medie[23] + $medie[24] + $medie[26]) / 7) - 4;
        $ATT = (($medie[2] + $medie[6] + $medie[8] + $medie[16] + $medie[18] + $medie[20] + $medie[25]) / 7) - 4;

        $MHQ = ($HQI + $HQS) / 2;

        $PQ_array = array(
            $medie[0],
            $medie[4],
            $medie[7],
            $medie[9],
            $medie[11],
            $medie[19],
            $medie[27]
        );
        $HQ_array = array(
            $medie[1],
            $medie[5],
            $medie[10],
            $medie[12],
            $medie[13],
            $medie[14],
            $medie[15],
            $medie[3],
            $medie[17],
            $medie[21],
            $medie[22],
            $medie[23],
            $medie[24],
            $medie[26]
        );
        // CALCOLO L'INTERVALLO DI CONFIDENZA 95%
        $dev_std = stddev($PQ_array);
        $ic_PQ = ($dev_std / sqrt(count($PQ_array))) * 1.96;
        $ic_HQ = ($dev_std / sqrt(count($HQ_array))) * 1.96;

    $posX = 162 + intval((242 / 6) * $PQ);
    $posY = 128 - intval((242 / 6) * $MHQ);
    $sizeX = intval($ic_PQ * (242 / 3));
    $sizeY = intval($ic_HQ * (242 / 3));
?>


<script type="text/javascript">
  //    google.charts.load('current', {'packages':['corechart']});
  //    google.charts.setOnLoadCallback(drawChart);
	 // google.charts.setOnLoadCallback(drawChart1);

      function drawATTRAKDIFFChart() {
	 hAxis: { ticks: [5,10,15,20] }
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Values'],
          ['PQ',  <?php echo $PQ; ?>],
          ['HQ-I',  <?php echo $HQI; ?>],
          ['HQ-S',  <?php echo $HQS; ?>],
		  ['ATT',  <?php echo $ATT; ?>]
        ]);

		 var options = {

            vAxis: {minValue: 0},

            vAxis: {
				ticks: [-3,-2,-1,0,1,2,3],

            },
            pointSize: 8,
            colors: ['#f45d1c', '#475825'],
            chartArea: {
                left: 40,
                top: 40,
                width: 600,
                height: 250
            },
            legend: {position: 'top', textStyle: {fontSize: 14}, alignment: 'center'},
            backgroundColor: '#f7f6f4',
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      function drawATTRAKDIFFChart1() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Values',{ role: 'style' }],
          ['human - technical',  <?php echo $medie[0]-4?>,'color: #54fb00'],
		  ['simple - complicated',  '<?php echo $medie[4]-4?>','color: #54fb00'],
		  ['practical - impractical',  '<?php echo $medie[7]-4?>','color: #54fb00'],
		  ['cumbersome - straightforward',  '<?php echo $medie[9]-4?>','color: #54fb00'],
		  ['predictable - unpredictable',  '<?php echo $medie[11]-4?>','color: #54fb00'],
		  ['confusing - clearly structured',  '<?php echo $medie[19]-4?>','color: #54fb00'],
		  ['unruly - manageable',  '<?php echo $medie[27]-4?>','color: #54fb00'],

          ['isolating - connective',  '<?php echo $medie[1]-4?>','color: #50caf9'],
		  ['professional - unprofessional',  '<?php echo $medie[5]-4?>','color: #50caf9'],
		  ['stylish - tacky',  '<?php echo $medie[10]-4?>','color: #50caf9'],
		  ['cheap - premium',  '<?php echo $medie[12]-4?>','color: #50caf9'],
          ['alienanting - integrating',  '<?php echo $medie[13]-4?>','color: #50caf9'],
          ['brings me closer - separates me',  '<?php echo $medie[14]-4?>','color: #50caf9'],
		  ['unpresentable - presentable',  '<?php echo $medie[15]-4?>','color: #50caf9'],

		  ['inventive - conventional',  '<?php echo $medie[3]-4?>','color: #a580df'],
          ['unimaginative - creative',  '<?php echo $medie[17]-4?>','color: #a580df'],
		  ['bold - cautious',  '<?php echo $medie[21]-4?>','color: #a580df'],
          ['innovative - conservative',  '<?php echo $medie[22]-4?>','color: #a580df'],
          ['dull - captivating',  '<?php echo $medie[23]-4?>','color: #a580df'],
		  ['undemanding - challenging',  '<?php echo $medie[24]-4?>','color: #a580df'],
		  ['novel - ordinary',  '<?php echo $medie[26]-4?>','color: #a580df'],

		  ['pleasant - unpleasant',  '<?php echo $medie[2]-4?>','color: #f2f405'],
		  ['ugly - attractive',  '<?php echo $medie[6]-4?>','color: #f2f405'],
          ['likeable - disagreeable',  '<?php echo $medie[8]-4?>','color: #f2f405'],
          ['rejecting - inviting',  '<?php echo $medie[16]-4?>','color: #f2f405'],
		  ['good - bad',  '<?php echo $medie[18]-4?>','color: #f2f405'],
          ['repelling - appealing',  '<?php echo $medie[20]-4?>','color: #f2f405'],
          ['motivating - discouraging',  '<?php echo $medie[25]-4?>','color: #f2f405']
        ]);



		 var options = {


            hAxis: {minValue: 0},

            hAxis: {
				ticks: [-3,-2,-1,0,1,2,3]

            },
			orientation: 'vertical',
vAxis: {
		//textStyle:{color: \'red\'},
        slantedText: true,
        slantedTextAngle: 90 // here you can even use 180
    } ,
            pointSize: 8,
            chartArea: {
                left: 400,
                top: 40,
				right: 10,
                width: 700,
                height: 1000,
				bottom: 25
            },
            legend: {position: 'top', textStyle: {fontSize: 14}, alignment:'center'},
            backgroundColor: '#f7f6f4',
        };
        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart1'));



        chart1.draw(data, options);
      }
    </script>
    <style type="text/css">

.content {

	vertical-align:middle;
	text-align:center;
}
}
    </style>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 content"></div>
			<div class="col-sm-8 content">
				<h2>Diagramma dei valori medi</h2>
				<div id="curve_chart" style="width: 650px; height: 350px"></div>
				<br>
				<h2>Description of word-pairs</h2>
				<table style="height: 247px;" width="445">
					<tbody>
						<tr>
							<td>
								<table style="height: 100%;" width="100%">
									<tbody>
										<tr style="height: 25%;">
											<td style="height: 25%;" width="25%" bgcolor="#54fb00"><img
												src="<?php echo IMG_DIR;?>PQ.png"></img></td>
										</tr>
										<tr style="height: 25%;">
											<td style="height: 25%;" width="25%" bgcolor="#50caf9"><img
												src="<?php echo IMG_DIR;?>HQI.png"></img></td>
										</tr>
										<tr style="height: 25%;">
											<td style="height: 25%;" width="25%" bgcolor="#a580df"><img
												src="<?php echo IMG_DIR;?>HQS.png"></img></td>
										</tr>
										<tr style="height: 25%;">
											<td style="height: 25%;" width="25%" bgcolor="#f2f405"><img
												src="<?php echo IMG_DIR;?>ATT.png"></img></td>
										</tr>
									</tbody>
								</table>
							</td>
							<td><div id="curve_chart1" style="width: 700px; height: 1000px"></div></td>
						</tr>
					</tbody>
				</table>
				<br>
				<h2>Result Diagram</h2>
				<img src="/utassistant/questionari/attrakdiff/lib/diagramma_risultato.php?posX=
					    <?php echo $posX.'&posY='.$posY.'&sizeX='.$sizeX.'&sizeY='.$sizeX;?>"
					alt="Errore caricamento diagramma" />
			</div>
			<div class="col-sm-2 content"></div>
		</div>
	</div>
<?php
    } else {
        echo '<h2>Nessun questionario compilato</h2>';
    }

    function select_qATTAKDIFF($id_studio)
    {
        global $db;
        $query = "SELECT r1,r2,r3,r4,r5,r6,r7,r8,r9,r10,r11,r12,r13,r14,r15,r16,r17,r18,r19,r20,r21,r22,r23,r24,r25,r26,r27,r28 
                  FROM q_attrakdiff
                  WHERE id_studio=$id_studio";
        return $db->sql_query($query);
    }
?>
