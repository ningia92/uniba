<?php
require_once("../../lib/config.php");


$numpart = $_SESSION['num_partecipanti'];

$tot = 1;
while ($tot <= $numpart) {
    $umuxpartecipanti[$tot] = $_SESSION['partecipanteUMUX' . $tot];
    $tot ++;
}

?>


<script type="text/javascript">
//    google.charts.load('current', {'packages':['corechart']});
//    google.charts.setOnLoadCallback(drawUMUXBoxPlot);

	var umuxscorepart=<?php echo '["' . implode('", "', $umuxpartecipanti) . '"]' ?>;


	var part = <?php echo $numpart?>;

	if(part>=7){
    var flag = 1;
//		window.alert("Impossibile Rappresentare un grafico di questo tipo numero dei partecipanti < di 7");
	}
	//else{

//	}

	function drawUMUXBoxPlot() {
	var array = [];
	var temp = [];
	temp.push("Punteggio UMUX");
	var count = 0;
		while(count<part){
		temp.push(parseInt(umuxscorepart[count]));
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
          title: ' Box Plot ',
          height: 500,
          legend: {position: 'none'},
          hAxis: {
            gridlines: {color: '#F62217'}
          },
          lineWidth: 0,
          series: [{'color': '#F62217'}],
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
              color: '#F62217'
            },
            min: {
              style: 'bars',
              fillOpacity: 1,
              color: '#F62217'
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

<?php if ($numpart >= 7) : ?>
<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 col-xs-1">
			</div>

			<div class="col-sm-8 col-xs-10">
				<div id="box_plot" style="width: 900px; height: 500px;"></div>
			</div>

			<div class="col-sm-2 col-xs-1">

			</div>
		</div>
	</div>
<?php else : ?>
<h4>Impossibile Rappresentare un grafico di questo tipo numero dei partecipanti minore di 7</h4>
<?php endif; ?>
