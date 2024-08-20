<?php
require_once ("../../lib/config.php");

$durata_max = "";

/*
 * Uncomment the "else" clause below if e.g. userpie is not at the root of your site.
 */
if (! isUserLoggedInPart()) {
    header("Location: " . ACCOUNT_DIR . "login.php");
}

if (isset($_POST['id_studio'])) {


    $_SESSION['id_user'] = $loggedInUser->user_id;
    $idstudio = $_POST['id_studio'];
    $_SESSION['idstudio'] = $idstudio;
    $currenttask = 1;
    $_SESSION['currenttask'] = $currenttask;

    $flags = $loggedInUser->getStudyFlags($idstudio);
    $_SESSION['flag_audio'] = $flags['flag_audio'];
    $_SESSION['flag_video'] = $flags['flag_video'];
    $_SESSION['flag_comportamento'] = $flags['flag_comportamento'];
    $_SESSION['flag_q_aa'] = $flags['flag_q_aa'];
    $_SESSION['flag_q_sus'] = $flags['flag_q_sus'];
    $_SESSION['flag_q_nps'] = $flags['flag_q_nps'];
    $_SESSION['flag_q_nasatlx'] = $flags['flag_q_nasatlx'];
    $_SESSION['flag_q_umux'] = $flags['flag_q_umux'];

    $numtasks = $loggedInUser->getNumTask($idstudio);
    $_SESSION['numtasks'] = $numtasks;

    $results = $loggedInUser->getInfoTask($idstudio, $currenttask);
    $_SESSION['idtask'] = $results['id_task'];
    $_SESSION['obiettivo'] = $results['obiettivo'];
    $_SESSION['istruzioni'] = $results['istruzioni'];
    $_SESSION['url'] = $results['url'];
    $idtask = $_SESSION['idtask'];
    $obiettivo = $_SESSION['obiettivo'];
    $istruzioni = $_SESSION['istruzioni'];
    $url = $_SESSION['url'];


    $_SESSION['durata_max'] = $results['durata_max'];
    $_SESSION['urlfinale'] = $results['urlfinale'];
    $url_finale = $_SESSION['urlfinale'];
    $durata_max = $results['durata_max'];

    $coda_stato = array();


    for($i=0 ; $i < $numtasks; $i++)
    {
        $coda_stato[] = "task";
        if($_SESSION['flag_q_nasatlx']==1) {
            $coda_stato[] = "nasatlx";
        }
    }

    if($_SESSION['flag_q_aa']==1) {
        $coda_stato[] = "aa";
    }
    if($_SESSION['flag_q_sus']==1) {
        $coda_stato[] = "sus";
    }
    if($_SESSION['flag_q_nps']==1) {
        $coda_stato[] = "nps";
    }
    if($_SESSION['flag_q_umux']==1) {
        $coda_stato[] = "umux";
    }


    $_SESSION['status'] = array_shift($coda_stato);
    $_SESSION['coda_stato'] = $coda_stato;

} else {

    $coda_stato = $_SESSION['coda_stato'];
    $_SESSION['status'] = array_shift($coda_stato);
    $_SESSION['coda_stato'] = $coda_stato;

    if($_SESSION['status'] == "task")
    {
        $currenttask = $_SESSION['currenttask'];
        //aggiornare currentTask
       // echo '<div type = "hidden" id = "setLink'.$currenttask.'" name = "setLink'.$currenttask.'"  value = " "></div>'; //scriviamo a runtime un nuovo set
       // echo '<div type = "hidden" id = "indice"'.$currenttask.' data-locations = " "></div>';
        //echo "<div type = 'hidden' id = 'indice''.$currenttask.' data-locations = ' '></div>";


        $_SESSION['currenttask'] = ++$currenttask;


        $results = $loggedInUser->getInfoTask($_SESSION['idstudio'], $currenttask);
        $_SESSION['idtask'] = $results['id_task'];
        $_SESSION['obiettivo'] = $results['obiettivo'];
        $_SESSION['istruzioni'] = $results['istruzioni'];
        $_SESSION['url'] = $results['url'];
        $idtask = $_SESSION['idtask'];
        $obiettivo = $_SESSION['obiettivo'];
        $istruzioni = $_SESSION['istruzioni'];
        $url = $_SESSION['url'];


        $_SESSION['durata_max'] = $results['durata_max'];
        $_SESSION['urlfinale'] = $results['urlfinale'];
        $url_finale = $_SESSION['urlfinale'];
        $durata_max = $results['durata_max'];
    }


    if(empty($coda_stato))
    {
        $loggedInUser->setFlag($_SESSION['id_user'], $_SESSION['idstudio']);
    }

}
?>
<!--variabile che ci permette di salvare il set contenente i link visitati dall'utente-->
<input id = "setLink1" name = "setLink1" type="hidden" value = " " >
<!--indice che conta a che set siamo-->
<!--<div id="indice" type="hidden" data-value=1></div>-->
<!DOCTYPE html>
<html>

<head>
    <script src="<?php echo JS_DIR; ?>jquery.js"> </script>
    <script src="https://cdn.WebRTC-Experiment.com/RecordRTC.js"></script>
    <script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>recAudioVideoGruppo4.js"></script>
    <title>Partecipante Home
        <?php echo $websiteName; ?>
    </title>
    <?php require_once("../inc/head_inc.php"); ?>

    <!-- INSERISCO CODICE PHP PER SETTARE IN DELLE VARIABILI I COOKIE CHE SERVIRANNO NELL'HEATMAP,SMT2 -->
    <?php
    // Crea i cookie
    $cookie_name = "id_user";
    $cookie_value = $_SESSION["id_user"];

    // setcookie($cookie_name, $cookie_value, time() + (86400 * 30),"/");

    $cookie_name2 = "id_task";
    $cookie_value2 = $_SESSION["idtask"];

    // setcookie($cookie_name, $cookie_value, time() + (86400 * 30),"/");
    ?>


</head>

<?php if ($_SESSION['status'] == "task") : ?>

    <body onload='inizioStudio()' style="margin0; overflow: hidden;">

<?php  else: ?>

    <body style="margin: 0; overflow-y: scroll;">

<?php  endif; ?>

<?php require_once("../inc/navbars/partecipante_studio_navbar.php"); ?>

<div class="container" style="display: none;">
    <div class="col-md-8 col-sm-10 col-xs-12 well" id="bg">
        <div class="row col-md-12 col-xs-12" id="stream">
            <div class='col-md-6 col-xs-10'>
                <video id='idstream' autoplay muted></video>
            </div>
            <script>
                var idTaskJS = <?= $_SESSION['idtask'] ?>;
                var idUserJS = <?= $loggedInUser->user_id ?>;
                var idStudioJS = <?= $_SESSION['idstudio'] ?>;
                var idFlagAudioJS = <?= $_SESSION['flag_audio'] ?>;
                var idFlagVideoJS = <?= $_SESSION['flag_video'] ?>;
                var idURLfinaleJS = "<?= $_SESSION['urlfinale'] ?>";
                var idDurataMaxJS = <?= $_SESSION['durata_max'] ?>;
                var setLink;
                //  var arrayVaribiali = [idTaskJS, idUserJS, idStudioJS, idFlagAudioJS, idFlagVideoJS];
                sessionStorage.setItem("idTask", idTaskJS);
                sessionStorage.setItem("idUser", idUserJS);
                sessionStorage.setItem("idStudio", idStudioJS);
                sessionStorage.setItem("flagAudio", idFlagAudioJS);
                sessionStorage.setItem("flagVideo", idFlagVideoJS);
                sessionStorage.setItem("urlFinale", idURLfinaleJS);
                sessionStorage.setItem("durataMax", idDurataMaxJS);
                setSessionStorage();
                //   console.log("Depositato session storage",arrayVaribiali);
            </script>
        </div>
    </div>
</div>



<?php
if ($_SESSION['status'] == 'task') :
    ?>
    <!-- Modal inizio-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">Titolo compito: <?php echo $obiettivo; ?> </h4>
                </div>
                <div class="modal-body">
                    <b>Istruzioni compito</b> <p><?php echo $istruzioni; ?></p>
                </div>
                <div class="modal-footer">
                    <button onclick= "avvia(<?php echo $_SESSION['durata_max'] ?>)"
                            type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            var flagVideo = <?= $_SESSION['flag_video'] ?>;
            var flagScreen = <?= $_SESSION['flag_comportamento']; ?>;
            $(document).ready(function(){
               // debugger;
                if (flagScreen === 1 && flagVideo === 0) {
                    //captureAudioPlusScreen();
                } else if (flagVideo === 1) {
                    captureAudioPlusScreen();
                    //captureAudioPlusVideo();
                }
            });
        </script>
    </div>


    <?php
endif;
?>
<?php if ($_SESSION['status'] == 'task') : ?>
    <div class="embed-responsive embed-responsive-16by9">

        <iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" id="iframe_id" class="embed-responsive-item" name="iframe_id"
                onload="injectJS();	tracciaPartecipante();"
                src="<?php
                    echo $url;
                ?> " style="height: 100%; left: 0px; position: absolute; top: 0px; width: 100%" >
        </iframe>

        <!-- PRIMO SCRIPT PER SETTARE I COOKIE -->
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script>
            //setto i cookie per smt2
            var now = new Date();
            var time = now.getTime();
            var expireTime = time + 1000*36000000;
            now.setTime(expireTime);

            document.cookie='<?php echo $cookie_name ?>=<?php echo $cookie_value ?>;expires='+now.toGMTString()+';path=/' ;
            document.cookie='<?php echo $cookie_name2 ?>=<?php echo $cookie_value2 ?>;expires='+now.toGMTString()+';path=/' ;



        </script>

        <!-- SECONDO SCRIPT PER FARE INJECTION NELL'HEAD DELL'IFRAME DEI DUE JAVASCRIPT DEL PLUG-IN SMT2 -->
        <script>
            function injectJS() {


                    var iFrameHead = window.frames["iframe_id"].document.getElementsByTagName("head")[0];//head dell'iframe
                    var iFrameBody = window.frames["iframe_id"].document.getElementsByTagName("body")[0];//body dell'iframe

                var myscript_smt2 = document.createElement('script');
                myscript_smt2.type = 'text/javascript';
                myscript_smt2.src = "<?php echo $websiteUrl;?>smt2/core/js/smt2e.min.js"; //PERCORSO ASSOLUTO
                iFrameHead.appendChild(myscript_smt2); //inserisco primo script nell'head dell'iframe

                var myscript_aux = document.createElement('script');
                myscript_aux.type = 'text/javascript';
                myscript_aux.src = "<?php echo $websiteUrl;?>smt2/core/js/smt-aux.min.js"; //PERCORSO ASSOLUTO
                iFrameHead.appendChild(myscript_aux); //inserisco primo script nell'head dell'iframe

                var myscript_record = document.createElement('script');
                myscript_record.type = 'text/javascript';
                myscript_record.src = "<?php echo $websiteUrl;?>smt2/core/js/smt-record.min.js"; //PERCORSO ASSOLUTO
                iFrameHead.appendChild(myscript_record); //inserisco primo script nell'head dell'iframe

                //inserisco il secondo script di smt2 quando carica il primo script
                myscript_record.onload = function() {
                    var myscript2 = document.createElement('script');
                    myscript2.type = 'text/javascript';
                    myscript2.innerHTML = 'try{smt2.record({warn:false,warnText:"smt2e is going to track your cursor activity."});smt2.methods.init();} catch(err) {addAlert("Avvio SMT2 fallito");}';
                    iFrameHead.appendChild(myscript2); //lo inserisco nell'head dell'iframe
                };
				
            }
        </script>

    </div>

<?php else :

    switch ($_SESSION['status']) {
        case "aa":
            require_once("../../questionari/attrakdiff/attrakdiff.php");
            break ;
        case "sus":
            require_once("../../questionari/sus/sus.php");
            break ;
        case "nps":
            require_once("../../questionari/nps/nps.php");
            break ;
        case "umux":
            require_once("../../questionari/umux/umux.php");
            break ;
        case "nasatlx":
            require_once("../../questionari/nasatlx/nasatlx.php");
            break ;
    }
endif;?>

<div id="modalMessaggioTempoMassimo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Tempo massimo raggiunto</h4>
            </div>
            <div class="modal-body">
				<span>Il task è terminato per tempo massimo raggiunto. Premere "Ok"
					per andare avanti.</span>
            </div>
            <div class="modal-footer">
                <form action="" id="terminaTask" method="post">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-default"
                                onclick="stopVideoTask('<?php echo $_SESSION['status']; ?>');stopTime();" data-dismiss="modal">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://cdn.WebRTC-Experiment.com/getScreenId.js"></script>
<script src="tracciatorePartecipante.js"></script>  <!--script che permette di tracciare i link visitati dall'utente-->
</body>
</html>


