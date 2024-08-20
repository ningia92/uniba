<?php
    require_once ("../../lib/config.php");

    if (! isUserLoggedInEsp()) {
        header("Location: " . ACCOUNT_DIR . "login.php");
    }
    unset($_SESSION['heatmap']); // distruggo la variabile di sessione che fa da flag per capire che stiamo visualizzando Heatmap
    unset($_SESSION['ob']); // distruggo la variabile di sessione con l'obiettivo del task per visualizzazione Heatmap
    unset($_SESSION['ist']); // distruggo la variabile di sessione con la descrizione del task per visualizzazione Heatmap
    unset($_SESSION['idstudio']); // distruggo la variabile di sessione con l'id studio creata per visualizzazione Heatmap
    unset($_SESSION['task_id']); // distruggo la variabile di sessione con l'id task creata per visualizzazione Heatmap
    unset($_SESSION['pagine']); // distruggo la variabile di sessione flag per visualizzare l'icona "pagine" nella navbar
    unset($_SESSION['totScore']); // distruggo la variabile di sessione che indica il punteggio totale del Sus o Umux relativo ad un caso di studio
?>
<!DOCTYPE html>
<html>
<head>
    <title>Esperto Home<?php echo $websiteName; ?> </title>
    <?php require_once("../inc/head_inc.php"); ?>
    <script src="content/js/esperto_home.js"> </script>
    <script src="content/js/gestisciModel.js"></script>

    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
</head>
<body
	<?php
        if (isset($_SESSION["studio_creato"]) && $_SESSION['studio_creato'] == '1') {
            echo "onload=\"showModalStudioCreato()\"";
            $_SESSION['studio_creato'] = '0';
        } else if (isset($_SESSION["partecipanti_invitati"]) && $_SESSION['partecipanti_invitati'] == '1') {
                echo "onload=\"showModalPartecipantiInvitati()\"";
                $_SESSION['partecipanti_invitati'] = '0';
        }
    ?>
>
    <?php require_once("../inc/navbars/navbar_esperto.php"); ?>
    
    <div class="container">
		<div class="row">
			<div class="row">
				<div class="col-xs-12">
					<div class="h5 text-right">esperto: <?php echo $loggedInUser->display_username; ?>
                       &nbsp;</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>STUDI CREATI</strong>
					</div>
					<div class="panel-body">

						<div class="table-responsive" style="min-height: 500px;">
							<table class="table table-hover" >
								<thead id="attributes">
									<tr>
										<th>Titolo</th>
										<th>Descrizione</th>
										<th>URL</th>
										<th>Data</th>
										<th>Opzioni</th>
									</tr>
								</thead>
                                <tbody>
                                    <?php
                                        $result = $loggedInUser->recupera_studi_esperto();
                                        while ($row = $db->sql_fetchrow($result)):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['obiettivo']?>
                                        </td>
                                        <td>
                                            <?php echo $row['descrizione'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['url'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['data_studio'] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Opzioni <span class="caret"> </span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="/utassistant/app/esperto/esp_invita_part.php?idstudio=<?php echo $row['id_studio'] ?>">
                                                                Invita partecipanti</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="dropdown-header">Valuta:</li>
                                                    <?php if( $row['flag_video'] == 1 || $row['flag_comportamento'] == 1){ ?>
                                                        <li>
                                                            <a href="/utassistant/app/esperto/valutaAudioVideo.php?idstudio=<?php echo $row['id_studio'] ?>">Video</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="disabled">
                                                            <a href="#">Video</a>
                                                        </li>
                                                    <?php } if( $row['flag_comportamento'] == 1) { ?>
                                                        <li>
                                                            <a href="/utassistant/smt2/admin/ext/admin-logs/partecipanti_studio.php?idstudio=<?php echo $row['id_studio'] ?>">Attività mouse</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="disabled">
                                                            <a href="#">Attività mouse</a>
                                                        </li>
													 <?php } if( $row['flag_comportamento'] == 1) { ?>
                                                        <li>
                                                            <a href="/utassistant/sankey/tasks_studio.php?idstudio=<?php echo $row['id_studio'] ?>">
                                                                Sankey diagram
                                                            </a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a href="/utassistant/sankey/tasks_studio.php?idstudio=<?php echo $row['id_studio'] ?>"> Sankey diagram </a>
                                                        </li>
                                                    <?php } if( $row['flag_comportamento'] == 1) { ?>
                                                        <li>
                                                            <a href="/utassistant/heatmap/tasks_studio.php?idstudio=<?php echo $row['id_studio'] ?>">
                                                                Heatmap
                                                            </a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="disabled">
                                                            <a href="#"> Heatmap </a>
                                                        </li>
                                                    <?php } if( $row['flag_comportamento'] == 1) { ?>
                                                        <li>
                                                            <a href="/utassistant/clickmap/tasks_studio.php?idstudio=<?php echo $row['id_studio'] ?>">Clickmap</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li class="disabled">
                                                            <a href="#">Clickmap</a>
                                                        </li>
                                                   <?php } if( $row['flag_q_sus'] == 1 || $row['flag_q_aa'] == 1 || $row['flag_q_nps'] == 1 || $row['flag_q_nasatlx'] == 1 || $row['flag_q_umux'] == 1) { ?>
                                                        <li>
                                                            <a href="/utassistant/app/esperto/valuta_questionario.php?idstudio=<?php echo $row['id_studio'] ?>">
                                                                Questionario</a>
                                                        </li>
                                                   <?php } else { ?>
                                                        <li class="disabled">
                                                            <a href="#"> Questionario </a>
                                                        </li>
                                                   <?php } ?>
                                                       <li>
                                                           <a href="#"
                                                              onclick="showTassoSuccesso('<?php echo $row['id_studio'] ?>')">
                                                                    Tasso di successo dei tasks</a>
                                                       </li>
                                                   </ul>
                                                </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModalVideo" role="dialog">
		<div class="modal-dialog modal-lg">

			<!-- Modal content-->
			<div class="modal-content" id="modalmediacontent">
				<table id="tabAudioVideo" class="display"
					class="table table-striped table-bordered" cellspacing="0"
					width="100%">
					<thead>
						<tr>
							<th>Utente</th>
							<th>Obiettivo</th>
							<th>Data completamento</th>
							<th></th>
						</tr>
					</thead>

				</table>
			</div>

		</div>
	</div>

	<!-- Modal Studio creato-->
	<div id="studio_creato" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title ">Studio creato</h4>
				</div>
				<div class="modal-body">
					<span> Studio creato correttamente</span>
				</div>
				<div class="modal-footer">
					<button id="annulla" type="button" class="btn btn-default"
						data-dismiss="modal">ok</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Partecipanti invitati-->
	<div id="partecipanti_invitati" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title ">Partecipanti invitati</h4>
				</div>
				<div class="modal-body">
					<span> I partecipanti sono stati invitati</span>
				</div>
				<div class="modal-footer">
					<button id="annulla" type="button" class="btn btn-default"
						data-dismiss="modal">ok</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tasso di successo-->
	<div id="modal_successo_task" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
		style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h4 class="modal-title">
						<i class="glyphicon glyphicon-info-sign"></i> Tasso di successo
					</h4>
				</div>

				<div class="modal-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<!-- ajax loader -->
						<img src="<?php echo IMG_DIR;?>ajax-loader.gif">
					</div>

					<!-- mysql data will be load here -->
					<div id="dynamic-content"></div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
				</div>

			</div>
		</div>
	</div>
</body>
</html>

