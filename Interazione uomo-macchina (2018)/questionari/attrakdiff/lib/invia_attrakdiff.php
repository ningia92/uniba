<?php
include_once("../../../lib/config.php");
$idutente = $_POST['idutente'];
$idstudio = $_POST['idstudio'];

if(isset($_POST))
{
    $answers = array();
    for($i=1;$i<=28;$i++)
    {
        if(!empty($_POST["Item$i"]))
        {
            $answers[$i] = $_POST["Item$i"];
        } else {
		$answers[$i] = 4;
		}
    }
}



?>


<html>
<head>
<title>Attrakdiff</title>
<?php require '../../../app/inc/head_inc.php'; ?>
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>recAudioVideoGruppo4.js"></script>
</head>

<body>
    <?php require '../../../app/inc/navbars/partecipante_studio_navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-2 col-xs-1"></div>
    <div class="col-sm-8 col-xs-10 text-center">
<?php
Scrivi_questionario($idutente,$idstudio,$answers);

function Scrivi_questionario($id_utente,$id_studio,$r) {

    global $db;
				$query = "INSERT INTO q_attrakdiff VALUES ('$id_utente','$id_studio','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]','$r[8]','$r[9]','$r[10]','$r[11]','$r[12]','$r[13]','$r[14]','$r[15]','$r[16]','$r[17]','$r[18]','$r[19]','$r[20]','$r[21]','$r[22]','$r[23]','$r[24]','$r[25]','$r[26]','$r[27]','$r[28]');";

				if ($db->sql_query($query)) : ?>

				    <h2>Il questionario è stato completato con successo</h2>
<?php else : ?>

				    <h2>Errore invio questionario</h2>

          <?php endif;
				}
?>

<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>
</div>
