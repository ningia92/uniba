<?php
    $status = $_SESSION['coda_stato'];

    if(! empty($status)) {
        $prossimo_stato = $status[0];
        switch($prossimo_stato) {
            case "nasatlx":
            case "aa":
            case "sus":
            case "nps":
            case "umux":
                $prossimo_stato = "questionario";
                break;
            default:
                $prossimo_stato = "task";
        }
    } else {
        $prossimo_stato = "fine";
    }

?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
      <!-- Logo -->
        <!--
        <div class="navbar-header">
        <a class="navbar-brand">
        <strong class="h2"> UTAssistant </strong>
        </a>
        </div>
       -->
      <script src="<?php echo JS_DIR;?>partecipa_studio.js"></script>
      <div class="navbar-collapse">
          <ul class="nav navbar-nav">
              <!-- inserisco obiettivo e descrizione task a sinistra del logo UTASSISTANT, precedentemente nella navbar destra -->
              <?php if( $_SESSION['status'] == 'task' ): ?>
                  <li id="infoNav">
                        <a href="#" style="pointer-events: none; cursor: default;">
                        <span class="h5"><strong><u>Obiettivo</u>: </strong><?php echo $obiettivo;?><strong><u><br>Descrizione</u>: </strong><?php echo $istruzioni;?> &nbsp;&nbsp;&nbsp;
                        <!-- <span class="glyphicon glyphicon-info-sign"
                              data-toggle="modal" data-target="#myModal"><strong>Info</strong></span> --></span>
                        </a>
                  </li>

                  <li id="cronometro">
                        <a href="#" style="pointer-events: none; cursor: default;">
                        <span class="h4">
                            <div id="vis">00:00:00</div>
                        </span>
                          </a>
                  </li>

                  <li id="taskID">
                      <a href="#" style="pointer-events: none; cursor: default;">
                          <span class="h4">Task <?php echo $_SESSION['currenttask'];?>/<?php echo $_SESSION['numtasks'];?></span>
                      </a>
                  </li>
              <?php endif; ?>


              <?php switch ($prossimo_stato):
                  case 'task': ?>
                      <li id="taskSux">
                            <a href="#" onclick="stopVideoTask('<?php echo $_SESSION['status']; ?>')">
                                <span class="h4">
                                <span class="glyphicon glyphicon-forward"></span>Avanti - Task</span>
                            </a>
                      </li>
                  <?php break; case'questionario': ?>
                      <li id="questionarioID">
                          <a href="#" onclick="stopVideoTask('<?php echo $_SESSION['status']; ?>')">
                              <span class="h4">
                                  <span class="glyphicon glyphicon-list-alt"></span>Avanti - Compila Questionario
                              </span>
                          </a>
                      </li>
                  <?php break; case'fine': ?>
                      <li id="terminaStudioID">
                          <a href="#" onclick="modalStudioTerminato()">
                              <span class="h4">
                                  <span class="glyphicon glyphicon-stop"></span>Fine
                              </span>
                          </a>
                      </li>
              <?php break; endswitch; ?>

              <li id="exitStudy">
                  <a href="#" onclick="modalInterrompiStudio()" >
                  <span class="h4">
                    <span class="glyphicon glyphicon-log-out"></span> Interrompi studio</span>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</nav>

<div id="modalStudioTerminato" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title ">Studio terminato</h4>
			</div>
			<div class="modal-body">
				<span>Lo studio è terminato. Grazie per la partecipazione.</span>
			</div>
			<div class="modal-footer">
				<form action="" id="terminaStudio" method="post">
					<div class="row">
						<div class="col-xs-6">
							<button id="annulla" type="button" class="btn btn-primary"
								data-dismiss="modal">Torna indietro</button>
						</div>
						<div class="col-xs-6">
							<button type="button" class="btn btn-success"
								onclick="window.location.replace('<?php echo $websiteUrl."app/partecipante/partecipante_home.php"; ?>')">Salva e Esci</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Messaggio Termina-->
<div id="modalMessaggioTermina" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title ">Studio terminato</h4>
			</div>
			<div class="modal-body">
				<span>Grazie per aver partecipato a questo studio</span>
			</div>
			<div class="modal-footer">
				<form action="" id="terminaStudio" method="post">
					<button type="button" class="btn btn-default"
						onclick="window.location.replace('<?php echo $websiteUrl."app/partecipante/partecipante_home.php"; ?>')">Ok</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="modalInterrompiStudio" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title ">Uscire dallo studio?</h4>
			</div>
			<div class="modal-body">
				<span>Interrompendo lo studio non saranno salvati i progressi
					effettuati fino ad ora.<br>Sei sicuro di voler uscire dallo studio?
				</span>
			</div>
			<div class="modal-footer">
				<form action="" id="interrompiStudio" method="post">
					<div class="row">
						<div class="col-xs-6">
							<button id="annulla" type="button" class="btn btn-success"
								data-dismiss="modal">Non interrompere</button>
						</div>
						<div class="col-xs-6">
							<button type="button" class="btn btn-danger"
								onclick="partecipante_esci()">Interrompere</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
