<?php
require_once("../../../lib/config.php");
$idutente = $_POST['idutente'];
$idstudio = $_POST['idstudio'];

if(isset($_POST['item'])){
	$answers = $_POST['item'];
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
				$query = "INSERT INTO q_nps VALUES ('$id_utente','$id_studio','$r');";

				if (!($result = $db->sql_query($query))) : ?>

					<h2>Errore invio questionario</h2>
				<?php else : ?>
					<h2>Il questionario &#232 stato completato con successo</h2>
	<?php			endif; } ?>

	<div class="col-sm-2 col-xs-1">
	</div>
	</div>
	</div>
	</div>
