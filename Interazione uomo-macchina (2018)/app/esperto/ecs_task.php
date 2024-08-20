
<script src = "tracciatore.js"></script>
<script src = "../../content/js/crea_studio.js"></script>
<div id="task" class="">
    <div class="container">
        <!-- task uno -->
        <div id="row1" class="row">
            <div class="col-xs-12">
                <div id="task1" class="panel panel-default">
                    <div id="head_task1" class="panel-heading clearfix">
                        <div class="row">
                            <div class="col-md-9">
                                <span id="title1" style="float:left;">
                                    <strong><h3>Task 1</h3></strong>
                                </span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default floatbutton glyphicon glyphicon-trash" id="delete1" style="font-family: Helvetica;" onclick="alertEliminaTask('row1')">
                                    Elimina Task
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" id="body_task1">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Titolo:</label>
                            <div class="col-xs-9">
                                <input id="obiettivo1" name="obiettivo1" type="text" class="form-control"
                                       placeholder="Specificare l'obiettivo del task" onblur="validateText( 'obiettivo1' )"
                                       onclick="deleteErrorStatus('obiettivo1')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Durata stimata (minuti):</label>
                            <div class="col-xs-9">
                                <input id="durata1" name="durata1" type="number" min="1" class="form-control"
                                       onblur="validateNumber( 'durata1' )" value="5"
                                       onclick="deleteErrorStatus('durata1')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">URL d'inizio del task:</label>
                            <div class="col-xs-9">
                                <input id="url1" name="url1" type="text" class="form-control"
                                       placeholder="http://www.esempio.it" onblur="validateURL( 'url1' )"
                                       onclick="deleteErrorStatus('url1')">
                            </div>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label class="control-label col-xs-3">
                                URL da raggiungere per completare il task correttamente:*</label>
                            <div class="col-xs-9">
                                <input id="urlfinale1" name="urlfinale1" type="text" value="" class="form-control"
                                       placeholder="http://www.esempio.it/prova-progetto-IUM" onblur="validateURL( 'urlfinale1' )"
                                       onclick="deleteErrorStatus('urlfinale1')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Indicazioni da seguire:</label>
                            <div class="col-xs-9">
                                <textarea id="descrizione1" name="descrizione1" class="form-control" rows="6" cols="25"
                                          onblur="validateText( 'descrizione1' )"
                                          placeholder="Descrivere le istruzioni del task"
                                          onclick="deleteErrorStatus('delete1')"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tipologia task: (*)</label>
                            <div class="col-xs-9">
                                <fieldset>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="tipologia1" value="cerca" id="cerca" checked/>
                                            Trovare informazioni online
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="tipologia1" value="download" id="download" />
                                            Scarica e/o consulta documenti
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="tipologia1" value="compila" id="compila" />
                                            Compila moduli online
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div align="right">
                            <!-- Button modal percorso ideale -->
                            <button id="buttonpath1" type="button" align="right" class="btn btn-primary" onclick="setUrl('url1', 'buttonpath1')">
                                <span class="glyphicon glyphicon-plus"></span>
                                Percorso ideale
                            </button>

                            <script>
                                function showHelpPercorsi() {
                                    $('#modalHelpPercorsi').modal('show');
                                }
                            </script>

                                <a href="#" onclick="showHelpPercorsi()">
                                    <img src="help.png" style="max-width:3%;height:auto;">  AIUTO
                                </a>

                        </div>


                        <input id = "setLink1" name = "setLink1" type="hidden" value = " " > </input> <!--variabile che ci permette di salvare il set contenente i links-->

                        <div align="left">
                            <p>(*) facoltativo</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="indice" type="hidden" data-value=1></div> <!--indice che conta a che set siamo-->

        <!-- fine task uno -->
        <div class="row">
            <div class="col-xs-10">
            </div>
            <div class="col-xs-2">
                <button type="button" class="btn btn-success floatbutton" onclick="addTaskForm()">
                    <span class="glyphicon glyphicon-plus">
                        <strong class="h4"> Task </strong>
                    </span>
                </button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-xs-2">
                <button type="button" class="btn btn-primary" onclick="s2f()">
                    <span class="glyphicon glyphicon-arrow-left"></span> PRECEDENTE
                </button>
            </div>
            <div class="col-xs-2 pull-right">
                <button type="button" class="btn btn-primary floatbutton" onclick="s2t()">
                    SUCCESSIVO
                    <span class="glyphicon glyphicon-arrow-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- |||||||||||||||||||||| ELENCO MODAL |||||||||||||||||||||| -->

<!-- Modal inserimento percorso ideale -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="myModalLabel" class="modal-title" align="left">Definisci il percorso di navigazione ideale</h4>
            </div>
            <div class="modal-body">
                <iframe id="firstUrl" src="about:blank" width="100%" height="470" frameborder="0" onload="tracciaPercorso()">
                    Il browser utilizzato non supporta gli iframe.
                </iframe>
            </div>
            <div class="modal-footer">
                <!--pulsante per salvare il percorso ideale-->
                <button id="buttonsave1" align="right" type="button" class="btn btn-primary" onclick="avvaloraURLFinale();stopTime();savePath('buttonpath1', 'buttonsave1');" data-dismiss="modal">
                    Salva
                </button>

                <button type="button" class="btn btn-default" onclick="eliminaTutto()" data-dismiss="modal">
                    Annulla
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal URL inizio mancante -->
<div id="modalErrorUrlInizio" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">URL d'inizio mancante </h4>
            </div>
            <div class="modal-body">
                <span> Inserire URL d'inizio del task </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal percorso mancante -->
<div id="modalErrorPercorso" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Percorso ideale mancante </h4>
            </div>
            <div class="modal-body">
                <span> Inserire il percorso di navigazione ideale </span>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal percorso già salvato -->
<div id="modalPercorsoEsiste" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Percorso già salvato </h4>
            </div>
            <div class="modal-body">
                <span> Aggiungere un nuovo task o proseguire </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal campi incompleti task-->
<div id="modalErrorTask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Informazioni mancanti </h4>
            </div>
            <div class="modal-body">
                <span> Uno o più campi non sono stati compilati oppure non è stato inserito/salvato il percorso ideale. Ricontrollare e proseguire </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal campi incompleti nell'ultimo task-->
<div id="modalErrorAggiuntaTask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Informazioni mancanti </h4>
            </div>
            <div class="modal-body">
                <span>  Uno o più campi non sono stati compilati oppure non è stato inserito/salvato il percorso ideale. Ricontrollare e proseguire per poter aggiungere un altro Task </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal conferma elimina task-->
<div id="modalEliminaTask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Elimina Task </h4>
            </div>
            <div class="modal-body">
                <span id="modalNumeroTask">Sei sicuro di voler eliminare il task?</span>
            </div>
            <div class="modal-footer">
                <button id="proseguiEliminaTask" type="button" class="btn btn-danger" data-dismiss="modal" onclick="#">
                    prosegui</button>
                <button id="annulla" type="button" class="btn btn-default" data-dismiss="modal">annulla</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal unico task rimasto-->
<div id="modalUnicoTask" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Unico Task rimasto </h4>
            </div>
            <div class="modal-body">
                <span> Non si possono eliminare tutti i task. Lo studio deve avere almeno un task assegnato </span>
            </div>
            <div class="modal-footer">
                <button id="annulla" type="button" class="btn btn-default" data-dismiss="modal">ok</button>
            </div>
        </div>
    </div>
</div>


<!-- modal per l'aiuto all'inserimento del percorso ideale -->
<div id="modalHelpPercorsi" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Selezione Percorso Ideale</h4>
            </div>
            <div class="modal-body">
                <span>
                    Per selezionare il <strong>Percorso Ideale</strong> basta navigare nel sito il cui URL è stato inserito
                    nel campo apposito.<br>
                    Una volta raggiunto l'<strong>URL da raggiungere</strong> basta semplicemente cliccare sul pulsante salva<br>
                    Non preoccuparti, prima del salvataggio avrai sempre la possibilità di modificare la tua scelta e
                    <strong>ripartire dall'inizio</strong>
                </span>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>