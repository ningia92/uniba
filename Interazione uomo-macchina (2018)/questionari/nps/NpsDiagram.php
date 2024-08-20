<?php require_once("../../lib/config.php");?>
<?php
    $risposte = $_SESSION['risposte'];
    $numero_questionari = count($risposte);//$_SESSION['numpartecipanti'];
    $detrattori = $_SESSION['detrattori'];
    $neutri = $_SESSION['neutri'];
    $promotori = $_SESSION['promotori'];
?>

<script type="text/javascript">
		//google.charts.load("current", {packages: ["corechart"]});
		//	google.charts.setOnLoadCallback(drawBasic);
			function drawNPStipoutenteChart() {
				var data = new google.visualization.DataTable();
				data.addColumn("string", "Tipo Utente");
				data.addColumn("number", "Valutazione");

				data.addRows([
				["Promotori",<?php echo $promotori*$numero_questionari;?>],
				["Neutri",<?php echo $neutri*$numero_questionari;?>],
				["Detrattori",<?php echo $detrattori*$numero_questionari;?>]
				]);

				var options = {
					title: "Valutazioni Utenti in Percentuale" ,
					pieSliceTextStyle: {color: "black"},
		        	slices: [{color: "green"}, {color: "yellow"}, {color: "red"}]
		        };

				var chart = new google.visualization.PieChart(document.getElementById("piechart"));
					chart.draw(data, options);
				}
		</script>
<script type="text/javascript">
			//google.charts.load("current", {packages: ["corechart", "bar"]});
		//	google.charts.setOnLoadCallback(drawBasic);

			function drawNPSutentiChart() {

				var data = new google.visualization.DataTable();
				data.addColumn("string", "Utenti");
				data.addColumn("number", "Valutazione");

				data.addRows([ <?php
//$counter = 0;

foreach ($risposte as $key => $value) {
	  echo "[\"" . ($key) . "\"," . $value . "],";
}


/*for ($counter = 0; $counter < count($risposte); $counter ++) {
    echo "[\"Utente " . ($counter + 1) . "\"," . $risposte[$counter] . "],";
}*/
?>

				]);

				var options = {

					title: "Valutazioni Fornite dagli Utenti",
			        chartArea: {width: "50%"},
			        isStacked: true,
			        hAxis: {
			          title: "Valutazione",
			          minValue: 0,
			          ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
			        },
			        vAxis: {
			          title: ""
			        }
			      };

				var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
  				chart.draw(data, options);
				}
		</script>

<div class="container-fluid">
<div class="row">
    <div class="col-sm-2 col-xs-1"></div>
    <div class="col-sm-8 col-xs-10">
        <div id="chart_div"></div>
        <div id="piechart"></div>
    </div>
    <div class="col-sm-2 col-xs-1"></div>
</div>
</div>
