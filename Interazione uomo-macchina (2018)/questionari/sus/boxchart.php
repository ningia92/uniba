<?php
require_once("../../lib/config.php");
include_once("lib/Sus_func.php");


$numpart = $_SESSION ['numpartecipanti'];
$tot = 1;
while ( $tot <= $numpart ) {
	$suspartecipanti [$tot] = $_SESSION ['partecipanteSUS' . $tot];
	$sususabilitypartecipanti [$tot] = $_SESSION ['partecipanteusability' . $tot];
	$suslearnabilitypartecipanti [$tot] = $_SESSION ['partecipantelearnability' . $tot];
	$tot ++;
}

$id_studio = $_SESSION["idstudio"];

?>


<script type="text/javascript">
  //  google.charts.load('current', {'packages':['corechart']});
  //  google.charts.setOnLoadCallback(drawBoxPlot);

	var susscorepart=<?php echo '["' . implode('", "', $suspartecipanti) . '"]' ?>;
	var susscoreusabilitypart=<?php echo '["' . implode('", "', $sususabilitypartecipanti) . '"]' ?>;
	var susscorelearnabilitypart=<?php echo '["' . implode('", "', $suslearnabilitypartecipanti) . '"]' ?>;

	var part = <?php echo $numpart?>;

	if(part>=7){
	//	window.alert("Impossibile Rappresentare un grafico di questo tipo numero dei partecipanti < di 7");
	//}
	//else{
	var flag = 1;
	}

	function drawSUSBoxPlot() {
	var array = [];
	var temp = [];
	temp.push("Punteggio SUS");
	var count = 0;
		while(count<part){
		temp.push(parseInt(susscorepart[count]));
		count++;
		}
	array.push(temp);

	temp = [];
	temp.push("SUS - Usabilità");
	var count = 0;
	while(count<part){
		temp.push(parseInt(susscoreusabilitypart[count]));
		count++;
		}
	array.push(temp);

	temp = [];
	temp.push("SUS - Apprendibilità");
	var count = 0;
	while(count<part){
		temp.push(parseInt(susscorelearnabilitypart[count]));
		count++;
		}
	array.push(temp);

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'x');
      data.addColumn('number', 'series0');
      data.addColumn('number', 'series1');
      data.addColumn('number', 'series2');
      data.addColumn('number', 'series3');
      data.addColumn('number', 'series4');
      data.addColumn('number', 'series5');
      data.addColumn('number', 'series6');

      data.addColumn({id:'max', type:'number', role:'interval'});
      data.addColumn({id:'min', type:'number', role:'interval'});
      data.addColumn({id:'firstQuartile', type:'number', role:'interval'});
      data.addColumn({id:'median', type:'number', role:'interval'});
      data.addColumn({id:'thirdQuartile', type:'number', role:'interval'});

      data.addRows(getBoxPlotValues(array));

      /**
       * Takes an array of input data and returns an
       * array of the input data with the box plot
       * interval data appended to each row.
       */
      function getBoxPlotValues(array) {

        for (var i = 0; i < array.length; i++) {

          var arr = array[i].slice(1).sort(function (a, b) {
            return a - b;
          });

          var max = arr[arr.length - 1];
          var min = arr[0];
          var median = getMedian(arr);

          // First Quartile is the median from lowest to overall median.
          var firstQuartile = getMedian(arr.slice(0, 4));

          // Third Quartile is the median from the overall median to the highest.
          var thirdQuartile = getMedian(arr.slice(3));

          array[i][8] = max;
          array[i][9] = min
          array[i][10] = firstQuartile;
          array[i][11] = median;
          array[i][12] = thirdQuartile;
        }
        return array;
      }

      /*
       * Takes an array and returns
       * the median value.
       */
      function getMedian(array) {
        var length = array.length;

        /* If the array is an even length the
         * median is the average of the two
         * middle-most values. Otherwise the
         * median is the middle-most value.
         */
        if (length % 2 === 0) {
          var midUpper = length / 2;
          var midLower = midUpper - 1;

          return (array[midUpper] + array[midLower]) / 2;
        } else {
          return array[Math.floor(length / 2)];
        }
      }

      var options = {
          title:'Box Plot',
          height: 500,
          legend: {position: 'none'},
          hAxis: {
            gridlines: {color: '#fff'}
          },
          lineWidth: 0,
          series: [{'color': '#D6332D'}],
          intervals: {
            barWidth: 1,
            boxWidth: 1,
            lineWidth: 2,
            style: 'boxes'
          },
          interval: {
            max: {
              style: 'bars',
              fillOpacity: 1,
              color: '#555'
            },
            min: {
              style: 'bars',
              fillOpacity: 1,
              color: '#757'
            }
          }
      };

if(flag == 1)
{
      var chart = new google.visualization.LineChart(document.getElementById('box_plot'));
    	chart.draw(data, options);
}
    }
 </script>

    <?php
            $ob_studio = obiettivo_studio($id_studio); //chiamo funzione che effettua query per recuperare nome caso di studio
            $r = $db->sql_fetchrow($ob_studio);
    ?>
<?php if ($numpart >= 7) : ?>
    <div class="container-fluid">
    <div class="row">
	<div class="col-sm-2 col-xs-1">

	</div>

	<div class="col-sm-8 col-xs-10">
    <h2>Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2> <!--mostro a video il titolo dello studio corrente-->
	<div id="box_plot" style="width: 900px; height: 500px;"></div>
	</div>
<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>

<?php else : ?>
<h4>Impossibile Rappresentare un grafico di questo tipo numero dei partecipanti minore di 7 </h4>
<?php endif; ?>
