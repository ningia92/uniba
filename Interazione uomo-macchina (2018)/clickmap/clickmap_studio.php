<?php
// Start the session
//session_start();
 require_once("../lib/config.php");
  /*
  * Uncomment the "else" clause below if e.g. userpie is not at the root of your site.
  */
  if (!isUserLoggedInEsp()) {
      header("Location: ".ACCOUNT_DIR."login.php");
  }
$_SESSION['pagine']=1; //flag per visualizzare l'icona "pagine" nella navbar
?>

<?php

$id_task = $_REQUEST['task']; //Recupero Identificativo del task su cui lavorare


//se è settato questo valore vuol dire che l'heatmap è richiesto del menu rapido quindi distruggo la variabile di sessione sull'obiettivo task
//per prelevarla dalla $_REQUEST

//se non è richiesta l'heatmap da menu rapido imposto la variabile di sessione con l'obiettivo task dal form del menu classico Heatmap

$bgr = "";
$url = (isset($_POST['url_']) ? $_POST['url_'] : $_REQUEST['url']); //recupero url della pagina da visualizzare per Heatmap
//stampe di prova
//echo "idstudio: ".$_SESSION['idstudio']." ";
//echo "idtask: ".$_SESSION['task_id'];

$idstudio = $_SESSION['idstudio'];
$_SESSION['task_attuale'] = $id_task;
?>

<?php require '../smt2/config.php'; ?>
<?php include INC_DIR.'header.php'; ?>


<!DOCTYPE HTML>
<html>
	<head>
    <!-- SCRIPT BASE PER VISUALIZZAZIONE HEATMAP -->
    <script src="simpleheat.js"></script>
    <script src="data.js"></script>
    <title>Show Clickmap UTAssistant</title>
        <!--
         <style>
        .options { width : 250px ; height: 109px ; position: relative; top: -5px; right: -1080px; padding: 5px; background: rgba(255,255,255,0.6);
            border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; line-height: 1; }
    </style> -->
        <!-- css per rendere responsive il tutto -->
        <style>

            .iframe-container {
                    width: 100%;
                    height: 0;
                    padding-bottom: 56.25%; /* 16:9 */
                    position: relative;

                             }
            iframe   {

                    position: absolute;
                    overflow: hidden;
                    width: 100%;
                    left : 0;
                    top : 0;

                          }
             canvas   {

                    position: absolute;
                    overflow: visible;
                    width: 100%;
                    left: -7px;

                          }

            .options { width : 220px ; height: 40px ; position: relative; top: -15px; right: -187px; padding: 5px;
                        border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; line-height: 0.5;}



    </style>
	</head>
	<body>



					<?php

						$servername = DB_HOST;
						$username = DB_USER;
						$password = DB_PASSWORD;
						$dbname = DB_NAME;

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error) {
				    		die("Connection failed: " . $conn->connect_error);
						}

                        //MODIFICATO
                        //query che seleziona le coordinate x e y relative al task
						$sql = "SELECT smt2_records.coords_x, smt2_records.coords_y, smt2_records.clicks, smt2_records.vp_width, smt2_records.vp_height
                                FROM smt2_records
                                JOIN smt2_ass_task_users_records
                                ON smt2_records.id = smt2_ass_task_users_records.id_records

                                JOIN smt2_cache
                                ON smt2_cache.id = smt2_records.cache_id
                                WHERE smt2_ass_task_users_records.id_task =".$id_task."
                                AND smt2_cache.url='".$url."'";


						$result = $conn->query($sql);
				        $vettoreX = array(); //vettore che conterrà la concatenazione fra i vari task delle coordinate X
                        $vettoreY = array(); //vettore che conterrà la concatenazione fra i vari task delle coordinate Y
                        $vettoreC = array();

                            if ($result->num_rows > 0) {
                            //prelevo dimensione url sito del task
                            $riga = $result->fetch_assoc();
                            $width = $riga["vp_width"];
                            $height = $riga["vp_height"];

                            $cordX = explode(",",$riga["coords_x"]); //split sulla virgola della riga delle coordinate x
                            $cordY = explode(",",$riga["coords_y"]); //split sulla virgola della riga delle coordinate y
                            $cordC = explode(",",$riga["clicks"]); //split sulla virgola della riga dei clicks

                            $index = 0;
                                foreach ($cordC as $elem)   {
                                  if ($elem == 0)  {
                                    unset($cordX[$index]);
                                     unset($cordY[$index]);

                                    }
                                $index = $index+1;
                              }
                                    $vettoreX = array_merge($vettoreX,$cordX);//concatenazione
                                    $vettoreY = array_merge($vettoreY,$cordY);//concatenazione



				    		// output data of each row
                            while ($row = $result->fetch_assoc()){
                                  $cordX = explode(",",$row["coords_x"]); //split sulla virgola della riga delle coordinate x
                                  $cordY = explode(",",$row["coords_y"]); //split sulla virgola della riga delle coordinate y
                                  $cordC = explode(",",$row["clicks"]); //split sulla virgola della riga dei clicks
                                  $index = 0;
                                foreach ($cordC as $elem)   {
                                      if ($elem == 0)  {
                                          unset($cordX[$index]);
                                          unset($cordY[$index]);
                                          }
                                $index = $index+1;
                                    }
                                $vettoreX = array_merge($vettoreX,$cordX);//concatenazione
                                $vettoreY = array_merge($vettoreY,$cordY);//concatenazione
                                } //fine while
                        }

                    else { //se non trova coordinate corrispondeti al task stampa un alert
                        $message = "Non è stato rilevato heatmap per questo task";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                         }
                        //else echo("<h3>Non è stato rilevato l'heatmap per questo task</h3></br>");
                       //print_r($vettoreX);   //per verifica di concatenazione avvenuta correttamente
                       //echo count($vettoreX); //per verifica di concatenazione avvenuta correttamente

				?>
        <!-- div per contenere il settings dell'heatmap, spostato nella navbar -->
        <!-- <div class="options">
        <label>Raggio </label><input type="range" id="radius" value="25" min="10" max="50"  /><br />
        <label>Sfocatura </label><input type="range" id="blur" value="15" min="10" max="50" />
        </div> -->

        <!-- inserisco width e heigh sia del canvas che dell'iframe in base alle dimensioni della pagina rilevata per il task
        iframe e canvas inseriti nello stesso container -->
        <div class="iframe-container">

        <?php
      /*  $str = str_replace("?", "-", $url);
        $str2 = str_replace('"', "-", $str);
        $p=explode("/",$str2);
		    $quanti = count($p);
		    for ($i=1; $i<$quanti; $i++) {
			     $bgr .= $p[$i];
		    }
		    $bgr = $bgr."-idstudio".$idstudio;
        $bgr = $bgr .".png";

*/
        ?>


        <!-- **********************MODIFICATO************* -->

        <iframe id ="iframe_id" src="<?php echo $url;//CLICKMAP_DIR."screen_clickmap/".$bgr ?>"  width="<?php echo $width ?>" height="<?php echo $height ?>" allowfullscreen>

        </iframe>

        <canvas id="canvas" width="<?php echo $width ?>" height="<?php echo $height ?>"></canvas>

        </div>




       <!-- SCRIPT PER VISUALIZZARE MAPPA HEATMAP -->
        <script>
            /*window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                              window.webkitRequestAnimationFrame || window.msRequestAnimationFrame; */
            if (!window.requestAnimationFrame) {
                                                window.requestAnimationFrame = (window.webkitRequestAnimationFrame ||
                                                window.mozRequestAnimationFrame ||
                                                window.msRequestAnimationFrame ||
                                                window.oRequestAnimationFrame ||
                                                function (callback) {
                                                    return window.setTimeout(callback, 17 /*~ 1000/60*/);
                                                                    });
                                                }

            function get(id) {
                                return document.getElementById(id);
                             }

            var heat = simpleheat('canvas').data(data).max(100),frame; //chiamo costruttore simpleheatmpat
            <?php

            //iterazione per numero di elementi del vettore che contiene le coordinate del mouse
            for ($j=0; $j<count($vettoreX); $j++){ //sarebbe uguale anche count($vettoreY);
                                                    ?>
                                                    //aggiungo coordinate al data di simpleheatmap
                                                    heat.add([<?php echo $vettoreX[$j]?>,<?php echo $vettoreY[$j]?>,10]);
                                                    <?php
                                                  }
                                                    ?>

            //FUNZIONE PER DISEGNARE HEATMAP
            function draw() {
                            console.time('a');
                            heat.draw();
                            console.timeEnd('a');
                            frame = null;
                            }
        draw();

            var radius = get('radius'),
            blur = get('blur'),
            changeType = 'oninput' in radius ? 'oninput' : 'onchange';

            radius[changeType] = blur[changeType] = function (e) {
            heat.radius(+radius.value, +blur.value);
            frame = frame || window.requestAnimationFrame(draw);
                                                                };
        </script>

	</body>
</html>
