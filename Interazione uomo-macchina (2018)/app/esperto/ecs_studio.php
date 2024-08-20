<div class="row">
    <div class="container" id="studio">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="row">
                            <div class="col-xs-6">
                                <span id="title1">
                                    <strong><h3>Definizione Studio</h3></strong>
                                </span>
                            </div>
                            <div class="col-xs-6">
                            </div>
                        </div>
                    </div>
                    <div id="studio_body" class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-11">
                                    <fieldset>
                                        <legend>
                                            <strong><h4>Informazioni dello studio</h4></strong>
                                        </legend>
                                        <div id="titolo_div" class="form-group">
                                            <label for="title" class="control-label col-xs-2">Titolo:</label>
                                            <div class="col-xs-10">
                                                <input id="title" name="title" type="text" class="form-control"
                                                       placeholder="Inserire il titolo dello studio"
                                                       onblur="validateText('title')"
                                                       onclick="deleteErrorStatus('title')">
                                            </div>
                                        </div>
                                        <div id="url_div" class="form-group">
                                            <label for="url" class="control-label col-xs-2">URL:</label>
                                            <div class="col-xs-10">
                                                <input id="url" name="url" type="text" class="form-control"
                                                       placeholder="Es. http://www.esempio.it" onblur="validateURL('url')"
                                                       onclick="deleteErrorStatus('url')">
                                            </div>
                                        </div>
                                        <div id="descr_div" class="form-group">
                                            <label for="descrizione" class="control-label col-xs-2"">Descrizione:</label>
                                            <div class="col-xs-10">
                                                <textarea id="descrizione" name="descrizione" class="form-control" rows="6"
                                                          cols="25" onblur="validateText('descrizione')"
                                                          onclick="deleteErrorStatus('descrizione')"
                                                          placeholder="inserire una descrizione per lo studio"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>
                                            <strong><h4>Input da catturare</h4></strong>
                                        </legend>
                                        <div>
                                            <label><h5>Selezionare una o più delle seguenti tipologie di rilevamento
                                                    dati. In fase di valutazione, i risultati dello studio saranno
                                                    visualizzati in base ai dati che si desidera raccogliere durante
                                                    l'esecuzione del test.</h5></label>
                                        </div>
                                        <div id="recvideo_div">
                                            <input id="recvideo" name="rec" type="checkbox" value="video" checked>
                                            <label for="recvideo">Registra desktop e microfono</label>
                                        </div>
                                        <div id="recbehave_div">
                                            <input id="recbehave" name="recbehave" type="checkbox">
                                            <label for="recbehave">Registra attività mouse</label>
                                        </div>
                                        <div class="br_space">
                                            <br>
                                        </div>
                                    </fieldset>
                                    <div class="br_space">
                                        <br>
                                    </div>
                                    <fieldset>
                                        <legend><strong><h4>Questionario da somministrare</h4></strong></legend>
                                        <div class="row clreafix">
                                            <div class="col-xs-10">
                                                <div>
                                                    <label><h5>Selezionare il questionario da somministrare al termine
                                                            dello studio</h5></label>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="#" onclick="showInfoQuestionari()">
                                                    <span class="glyphicon glyphicon-info-sign">
                                                        <strong class="h4"> Info</strong
                                                    </span>
                                                </a>
                                            </div>
                                        </div>


                                        <div id="attrakdiff_div">
                                            <input id="attrakdiff" name="attrakdiff" type="checkbox" value="attrakdiff">
                                            <label for="attrakdiff">Questionario ATTRAKDIFF</label>
                                        </div>
                                        <div id="sus_div">
                                            <input name="sus" type="checkbox" value="sus" id="sus">
                                            <label for="sus">Questionario SUS</label>
                                        </div>
                                        <div id="nps_div">
                                            <input name="nps" type="checkbox" value="nps" id="nps">
                                            <label for="nps">Questionario NPS</label>
                                        </div>
										<div id="nasatlx_div">
                                            <input name="nasatlx" type="checkbox" value="nasatlx" id="nasatlx">
                                            <label for="nasatlx">Questionario NASA TLX (al completamento di ogni task)</label>
                                        </div>
										<div id="umux_div">
                                            <input name="umux" type="checkbox" value="umux" id="umux">
                                            <label for="umux">Questionario UMUX-lite</label>
                                        </div>
                                        <div class="br_space">
                                        <br>
                                        </div>
                                    </fieldset>
                                    <div class="br_space">
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fine panel-default -->
            </div>
        </div>
        <!-- Fine row -->
        <div class="row" style="margin-bottom: 20px">
            <div class="col-xs-10">
            </div>
            <div class="col-xs-2">
                <button type="button" class="btn btn-primary floatbutton" onclick="f2s()">
                    SUCCESSIVO
                    <span class="glyphicon glyphicon-arrow-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal campi incompleti studio-->
<div id="modalErrorStudio" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Informazioni mancanti</h4>
            </div>
            <div class="modal-body">
                <span>Uno o più campi non sono stati compilati. Ricontrollare e proseguire</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal campi incompleti studio-->
<div id="modalErrorInput" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Informazioni mancanti </h4>
            </div>
            <div class="modal-body">
               <span>Selezionare almeno un input da catturare. Ricontrollare e proseguire</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal descrizione questionari-->
<div id="modalInfoQuestionari" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Questionari </h4>
            </div>
            <div class="modal-body">
                <span>
                    La <strong>System Usability Scale(SUS)</strong> fornisce un affidabile strumento "veloce e sporco"
                    per misurare l'usabilità. Consiste in un questionario di 10 elementi con cinque opzioni di
                    risposta per gli intervistati; da "Pienamente d'accordo" a "Pienamente in disaccordo".<br>
                    Esso consente di valutare una vasta gamma di prodotti e servizi, tra cui hardware, software,
                    dispositivi mobili, siti web e applicazioni.<br><br>
                    <strong>AttrakDiff</strong> rende possibile la valutazione anonima di qualsiasi prodotto da
                    parte di utenti, clienti, ecc. Dalla valutazione dei dati è possibile valutare quanto è piacevole
                    il prodotto in termini di usabilità e di aspetto, e se è necessaria un'ottimizzazione.<br>
                    Consiste in un questionario di 28 elementi con sette opzioni di risposta in base all'intensità delle
                    voci. I poli di ogni elemento sono aggettivi opposti.<br><br>
                    Il <strong>Net Promoter Score(NPS)</strong> è uno strumento di gestione che pu&#242 essere usato per
                    valutare la fedelt&#225 in una relazione impresa-cliente.<br>&#200 un'alternativa alla tradizionale
                    ricerca di soddisfazione del cliente e dichiara di essere correlata con la crescita dei ricavi.<br>
                    L'NPS è calcolato in base alle risposte ad una singola domanda:<br>
                    "Quanto consiglieresti la nostra compagnia/prodotto/servizio ad un amico o un collega?"<br>
                    La risposta a questa domanda è basata su una scala da 0 a 10.</span><br>
                    Il questionario <strong>Nasa TLX</strong> consente di valutare il carico di lavoro complessivo che
                    l’utente ha percepito durante l’esecuzione di un particolare task. Il questionario viene somministrato
                    all’utente dopo il completamento di ogni task dello studio. Il calcolo del carico di lavoro viene
                    effettuato utilizzando sei scale differenti: sforzo mentale, sforzo fisico, sforzo temporale,
                    prestazioni, fatica e frustrazione. Ognuna di queste scale ha una precisa definizione che l’utente è
                    tenuto a leggere attentamente prima di scegliere un valore della scala, altrimenti il risultato del
                    questionario potrebbe non essere utile per la valutazione del carico di lavoro per lo specifico task.
                    L’intervallo di valori possibili per ogni scala va da 0 a 100 e viene diviso in sotto intervalli di
                    cinque punti. Dopo che l’utente ha scelto un valore per ognuna delle sei scale, il questionario viene
                    salvato per poter essere successivamente analizzato da parte di chi effettua lo studio di usabilità.
                    Quando si salvano le risposte del questionario, viene anche calcolata la media dei valori di tutte
                    le scale così che il progettista potrà avere una visione di insieme dei valori relativi a tutte le scale
                    e quindi del carico di lavoro complessivo del task.<br>
                    L'<strong>Usability Metric for User Experience (UMUX-lite)</strong> è un recente questionario
                    alternativo al SUS, composto da due sole affermazioni. È in fase di adattamento e test da parte del
                    CognitiveLab dell’Università degli Studi di Perugia.
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
            </div>
        </div>
    </div>
</div>

