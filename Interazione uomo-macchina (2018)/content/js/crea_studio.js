/**
 * verifica che il testo non sia nullo. se nullo inserisce un messaggio di errore se non
 * presente, se non nullo toglie il messaggio di errore se presente.
 */
function checkText(text) {
    var check = true;
    if( !text ) {
        check = false;
    }
    return check;
}

function validateText(id) {
    var elem = $("#" + id);
    if( checkText( elem.val() ) ) {
        $("#" + id + "-error").remove();
        elem.removeClass("input-error");
    } else {
        if ($("#" + id + "-error").length == 0) {
            elem.addClass('input-error');
            elem.after($("<label id='" + id + "-error' class='message-error'> "
                + "inserire un valore nel campo"
                + "</label>"));
        }
    }
}

/**
 * verifica che il valore inserito non sia nullo e rispetti il formato opportuno.
 */
function checkURL( url ) {
    var check = true;
    var r =
        /(http|https):\/\/((www.)?([A-Za-z0-9\-]+\.)+(it|com|org)|localhost)[//]*(([A-Za-z0-9\-]+\/)+[A-Za-z0-9\-]+(\.html|\.php)|)/;
    if( !r.test(url) ) {
        check = false;
    }
    return check;
}

function validateURL(id) {
    var elem = $("#" + id);
    var msg = '';
    if( checkURL( elem.val() )) {
        $("#" + id + "-error").remove();
        elem.removeClass("input-error");
    }else {
        if (elem.val() == '') {
            msg = 'inserire un URL';
        } else {
            msg = 'URL non valido';
        }
        if( $("#" + id + "-error").length != 0){
            $("#" + id + "-error").remove();
        }
        elem.addClass('input-error');
        elem.after($("<label id='" + id + "-error' class='message-error'> "
            + msg + "</label>"));
    }
}

function checkNumber( number ) {
    var check = true;
    if(number == '' || number <= 0) {
        check = false;
    }
    return check;
}

function validateNumber(id) {
    var elem = $("#" + id );
    if( !checkNumber( elem.val())){
        if ($("#" + id + "-error").length == 0) {
            elem.addClass('input-error');
            elem.after($("<label id='" + id + "-error' class='message-error'> "
                + " inserire un valore nel campo</label>"))
        }
    } else {
        $("#" + id + "-error").remove();
        elem.removeClass("input-error");
    }
}

/**
 * agginge una mail nella textarea
 */
function addmail() {
    var value = $('#email').val();
    var text = $('#invited').text();
    if( text == ""){
        $('#invited').text(text + value);
    }else{
        $('#invited').text(text +"\n"+ value);
    }
    $('#email').val('');
}

/**
 * Verifica che la mail sia stata inserita e sia ben formata
 */
function checkMail(mail) {
    var r = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$/;
    var check = true;
    if(!r.test(mail)) {
        check = false;
    }
    return check;
}

/**
 * Verifica che la mail sia stata inserita e sia ben formata
 */
function validateMail(id) {
    var check = false;
    var elem = $("#" + id);
    var mail = elem.val();
    if (checkMail(mail)) {
        check = true;
        $("#" + id + "-error").remove();
        elem.removeClass("input-error");
    } else {
        $("#" + id + "-error").remove();
        var msg;
        if (mail == '') {
            msg = 'inserire una mail';
        } else {
            msg = ' mail inserita non è corretta';
        }
        elem.addClass('input-error');
        elem.after($("<label id='" + id + "-error' class='message-error'>" + msg +
            "</label>"));
    }
    return check;
}

/**
 * allega al controllo in input un evento in base al tipo
 * di valore che esso può contenere
 */
function addcheck( elem, type ) {
    var func = "";
    var func2 = "deleteErrorStatus('"+ elem.attr('id') +"')";
    if( type == "text") {
        func = "validateText('" + elem.attr('id') + "');";
    } else if( type == "number") {
        func = "validateNumber('" + elem.attr('id') + "');";
    } else if( type =="url") {
        func = "validateURL('" + elem.attr('id') + "');";
    }
    elem.attr("onblur",func);
    elem.attr("onclick",func2);
}

/**
 imposta il pulsante elimina
 */
function setDeleteButton( row, attr, newattr ) {
    var btn = row.find('#'+attr);
    btn.attr('id',newattr);
    btn.attr('onclick',"alertEliminaTask('" + row.attr('id')+"')");
}

function setButtonPath( row, attr, newattr, secondAttr ) {
    var btn = row.find('#'+attr);
    btn.attr('id',newattr);
    btn.attr('onclick',"setUrl('"+ secondAttr+"','"+ newattr+"')");
}

function setButtonSave( row, attr, newattr, secondAttr ) {
    var btn = row.find('#'+attr);
    btn.attr('id',newattr);
    btn.attr('onclick',"savePath('"+ secondAttr+"','"+ newattr+"')");
}

//ci permette di aggiornare dinamicamente l'id del set contenente i link del path ideale designato dal valutatore
function aggiornaSetLink (row, attr, newattr)
{
    var btn = row.find('#'+attr);
    btn.attr('id',newattr);
	btn.attr('name',newattr);
    btn.attr('value'," ");
}

function aggiornaIndice(id,attr)
{
    var indice = document.getElementById(id).getAttribute(attr);
    indice++;
    document.getElementById(id).setAttribute(attr,indice);
}

/**
 La funzione verifica che tutti i campi dei task precedenti siano stati
 popolati e sia stati popolati bene.
 */
function checkTaskForm() {
    var check = true;
    if( $('#task').find("[id$=error]").length == 0 ){
        check = false;
    }

    // controllare i campi vuoti qui
    return check;
}

flagpath = false;
flagsave = false;
/**
 *  la funzione aggiunge nel form  i campi opportuni per il nuovo task
 */
function addTaskForm() {
    if( $("[id$=error]").length != 0 || !checkTask())
    {
        $('#modalErrorAggiuntaTask').modal('show');
    }else {
        var counter = $("#count-task");
        var actual = Number(counter.attr('value'));
        var future = actual + 1;
        counter.attr('value', future);

        var row = $("#row" + actual);
        var newrow = row.clone();
        newrow.attr('id', "row" + future);

        //modifica task
        task = newrow.find("#task"+actual);
        task.attr('id', "task" + future );

        head = newrow.find("#head_task"+actual);
        head.attr('id', "head_task" + future );

        body = newrow.find("#body_task"+actual);
        body.attr('id', "body_task" + future );

        title = newrow.find("#title"+actual);
        title.attr('id', "title" + future );
        title.empty();
        title.html('<strong><h3>Task '+future+'</h3></strong>');

        //rinomino i campi name ed id per gli elementi del nuovo task incrementati di 1
        setDeleteButton(newrow, "delete" + actual, "delete" + future );
        setElem(newrow, "obiettivo" + actual, "obiettivo" + future, "text");
        setElem(newrow, "durata" + actual, "durata" + future, "number", 5);
        setElem(newrow, "url" + actual, "url" + future, "url");
        setElem(newrow, "descrizione" + actual, "descrizione" + future, "text");

        setUrlFinale(newrow, "urlfinale" + actual, "urlfinale" + future);
        setElem_facoltativo(newrow, "tipologia" + actual, "tipologia" + future);

        row.after(newrow);
        $("input[name='tipologia"+future+"']").prop("checked",false);

        setButtonPath(newrow, "buttonpath" + actual, "buttonpath" + future, "url" + future );
        setButtonSave(newrow, "buttonsave" + actual, "buttonsave" + future, "buttonpath" + future );
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        aggiornaSetLink(newrow, "setLink" + actual, "setLink" + future); //aggiornamento dell'id del set
        aggiornaIndice("indice", "data-value");

       /* $("#indice").trigger("update");
        var indice=$('#indice').data('value');
        indice+=1;
        $('#indice').attr('data-value',indice); //aggiorno l'indice nel div
*/
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('#buttonpath'+future).attr('disabled',false);
        flagpath = false;
        flagsave = false;

        pageScroll();
    }
}

/**
 * Imposta l'URL d'inizio del percorso ideale
 */
function setUrl(urlNumber, buttonNumber)
{
    if(window.document.getElementById(urlNumber).value == "")
    {
        validateURL(urlNumber);
        $('#modalErrorUrlInizio').modal('show');
    } else
    {
		window.document.getElementById(buttonNumber).classList.remove("btn-danger");
        flagpath = true;
        $('#firstUrl').attr('src',window.document.getElementById(urlNumber).value);
        $('#myModal').modal('show');
    }
}

/*
 * Salva il percorso ideale (disabilita il button)
*/
function savePath(buttonNumber, buttonNumber2)
{
    var bn = window.document.getElementById(buttonNumber);
    if(bn.disabled)
    {
        $('#modalPercorsoEsiste').modal('show');
    } else
    {
        if(flagpath)
        {
            if(!bn.disabled)
            {
                /*var conf = window.confirm("Attenzione: se salvi il percorso non potrai più modificarlo")
                if(conf)
                {*/
					window.document.getElementById(buttonNumber2).classList.remove("btn-danger");
                    bn.classList.remove("btn-danger");
                    flagsave = true;
                    //bn.disabled = true;
                    //window.alert("Percorso salvato");

                    //forse non serve
                    $('#myModal').modal('hide');
                /*} else
                {
                    window.alert("Percorso non salvato");
                }*/
            }
        } else
        {
            bn.classList.add("btn-danger");
            $('#modalErrorPercorso').modal('show');
        }
    }
}

/**
 * la funzione imposta per il task gli attributi dell'elemento con attr, newattr
 */
function setElem(row, attr, newattr, type, value) {
    var elem = row.find("[name=" + attr + "]");
    elem.attr('name', newattr);
    elem.attr('id', newattr);
    if (value) {
        elem.val(value);
    } else {
        elem.val("");
    }
    addcheck( elem, type );
}

function setUrlFinale(row, attr, new_attr)
{
    var url_finale = row.find('#' + attr);
    url_finale.attr('onblur', "validateURL('" + new_attr + "')");
    url_finale.attr('onclick', "deleteErrorStatus('" + new_attr + "')");
    url_finale.attr('id', new_attr);
    url_finale.attr('name', new_attr);
    url_finale.val('');
}

/**
 * la funzione imposta per il task gli attributi dell'elemento con attr, newattr negli input facoltativi
 */
function setElem_facoltativo(row, attr, newattr) {
    var elem = row.find("[name=" + attr + "]");
    elem.attr('name', newattr);
    elem.attr('id', newattr);
}

/**
 * verifica che tutti i campi siano stati inseriti correttamente
 */
function validateAllAndGo() {

    var numTask = $('#count-task').val();
    var check = true;
    //check studio
    if( !checkText($('#title').val()) || !checkURL($('#url').val()) ||
        !checkText($('#descrizione').val()) ) {
        check = false;
        alert('Le informazioni sullo studio non sono state definite correttamente.');
    }
    //check task
    for( var i = 1; numTask >= i; i++ ) {
        if( !checkText($('#obiettivo'+i).val()) || !checkNumber($('#durata'+i).val())
            || !checkURL($('#url'+i).val()) || !checkText($('#descrizione'+i).val())) {
            check = false;
            alert('Le informazioni sul task' + i + ' non sono state definite correttamente.');
        }
    }

    var check_ri = false;
    $('[id$=-bit]').each(
        function(){
            if( $(this).val() == '1'){
                check_ri = true;
            }
        }
    );


    var check_ni = false;
    if ($("#invited").val().length != 0 ) {
        check_ni = true;
    }

    if ( !check_ri && !check_ni ) {
        $('#partecipanti_non_invitati').modal('show');
    }

    //invocazione codice php
    if (check && ( check_ri || check_ni ) ) {
        $('#invited').attr('disabled',false);
        attesaCreaStudio();
        $("#form").submit();
    }
}

function prosegui_creaStudio(){
    var numTask = $('#count-task').val();
    var check = true;
    //check studio
    if( !checkText($('#title').val()) || !checkURL($('#url').val()) ||
        !checkText($('#descrizione').val()) ) {
        check = false;
        alert('Le informazioni sullo studio non sono state definite correttamente.');
    }
    //check task
    for( var i = 1; numTask >= i; i++ ) {
        if( !checkText($('#obiettivo'+i).val()) || !checkNumber($('#durata'+i).val())
            || !checkURL($('#url'+i).val()) || !checkText($('#descrizione'+i).val())) {
            check = false;
            alert('Le informazioni sul task' + i + ' non sono state definite correttamente.');
        }
    }

    if (check) {
        $('#partecipanti_non_invitati').modal('hide');
        $('#invited').attr('disabled',false);
        attesaCreaStudio();
        $( "#form" ).submit();
    }else{
        alert("Errore nell'inserimento dello studio. Studio non creato");
    }
}

//Invito partecipanti gia' registrati
function invite(id){
    var button = $('#button'+id);
    if(button.text()=='invita'){
        button.text('cancella');
        $('#row'+id+'-bit').attr('value', 1);
    }else{
        button.text('invita');
        $('#row'+id+'-bit').attr('value', 0);
    }

}

/*
 Elimina lo stato di errore quando il focus torna sull'input
*/
function deleteErrorStatus( id ) {
    $('#'+ id +'-error').remove();
    $('#' + id ).removeClass('input-error');
}

/**
 alert prima di permettere l'eliminazione del task. Successivamente richiama la funzione deleteTask
 */
function alertEliminaTask( idrow ){
    var count = $('#count-task').attr('value');
    if( count != 1 ) {
        // $("#modalNumeroTask").html('Sei sicuro di voler eliminare il task '+ idrow +'?');
        $('#modalEliminaTask').modal('show');
        $("#proseguiEliminaTask").attr('onclick',"deleteTask('" + idrow + "')");
    }
    else{
        $('#modalUnicoTask').modal('show');
    }
}

/**
 elimina un task
 */
function deleteTask( idrow ) {
    var count = $('#count-task').attr('value');
    if( count != 1 ) {
        $('#count-task').attr('value',--count);
        $('#'+idrow).remove();
        $('div[id^=row]').each(
            function( ix ) {
                ++ix;
                refreshTask( ix, $(this) );
            }
        );
    }
}

/**
 effettua l'aggiornamento degli attributi dei componenti delle
 righe contententi i task ancora presenti
 */
function refreshTask( ix, row ){
    row.attr('id','row'+ix );

    task = row.find('[id^=task]');
    task.attr('id', "task" + ix );

    head = row.find('[id^=head_task]');
    head.attr('id', "head_task" + ix );

    body = row.find('[id^=body_task]');
    body.attr('id', "body_task" + ix );

    title = row.find('[id^=title]');
    title.attr('id', "title" + ix );
    title.empty();
    title.html('<strong><h3>Task '+ ix +'</h3></strong>');
    refreshDeleteButton( ix, row );
    refreshElem( ix, row, 'obiettivo', 'text' );
    refreshElem( ix, row, 'durata', 'number' );
    refreshElem( ix, row, 'url','url' );
    refreshElem( ix, row, 'descrizione','text' );
    refreshElem( ix, row, 'tipologia','' );
    refreshElem( ix, row, 'urlfinale','url' );

}

/**
 effettua il refresh del bottone elimina
 */
function refreshDeleteButton( ix, row ) {
    var btn = row.find('[id^=delete]');
    btn.attr('id', 'delete' + ix);
    btn.attr('onclick',"alertEliminaTask('row" + ix +"')");
}

/**
 effettua l'aggiornamento degli elementi del task
 */
function refreshElem( ix, row, str, type ) {
    var elem = row.find("[name^=" + str + "]");
    elem.attr('name', str + ix);
    elem.attr('id', str + ix);
    refreshCheck(elem, type);
}

/**
 effettua il refresh delle funzioni di checking
 */
function refreshCheck(elem, type){
    var func = "";
    var func2 = "deleteErrorStatus('"+ elem.attr('id') +"')";
    if( type == "text") {
        func = "validateText('" + elem.attr('id') + "');";
    } else if( type == "number") {
        func = "validateNumber('" + elem.attr('id') + "');";
    } else if( type =="url") {
        func = "validateURL('" + elem.attr('id') + "');";
    }
    elem.attr("onblur",func);
    elem.attr("onclick",func2);
}

/**
 Verifica che la mail sia corretta ed in caso positivo l'aggiunge
 nella textarea
 */
function checkAndAdd() {
    if( validateMail('email') ) {
        addmail();
    }
}

/**
 verifica che il bit sia uno
 */
function checkbit( elem ){
    var check = false;
    if( elem.val() == 1 ){
        check = true;
    }
    return check;
}

/**
 * animazione durante l'aggiunta dei Task
 */
function pageScroll(){
    window.scrollBy(0,5);
    scrolldelay = setTimeout('pageScroll()',1);
    setTimeout('clearTimeout(scrolldelay)',600);
}

/**
 * permette di visualizzare una modal con il tempo restante durante la creazione dello studio
 */
function attesaCreaStudio(){
    var conta_non_registrati;
    var num_registrati = $('#count_registered').val();
    var conta_registrati = 0;
    for(i=1; i <= num_registrati; i++){
        if($('#row'+i+'-bit').val() == "1"){
            conta_registrati++;
        }
    }

    if($('#invited').val().length == 0)
    {
        conta_non_registrati = 0;
    }
    else
    {
        conta_non_registrati = $('#invited').val().split('\n').length;
    }


    var mail_totali = conta_non_registrati + conta_registrati;
    $('#Carica').modal('show');
    barraAvanzamento(0,mail_totali);
}
/**
 * gestisce la barra di caricamento durante la creazione dello studio
 */
function barraAvanzamento(conta_mail,mail_totali){
    var bar = $('#bar');
    var bar2 = $('#bar2');
    var text_mail = $('#num_mail');
    conta_mail = conta_mail + 1;
    if(conta_mail <= mail_totali){
        var percentuale = (100/mail_totali)*conta_mail;
        scrolldelay = setTimeout('barraAvanzamento('+ conta_mail + ',' + mail_totali + ')',1500);
        setTimeout('clearTimeout(scrolldelay)',mail_totali * 1500);
        bar.attr('style', "width: " + percentuale + "%;");
        bar2.text("Invio mail... " + parseInt(percentuale) + "%");
        text_mail.text("Invito partecipanti: " + conta_mail + "/" + mail_totali);
    }
}

function checkStudio(){
    var check = true;
    if( !checkText($('#title').val()) || !checkURL($('#url').val()) ||
        !checkText($('#descrizione').val())) {
        check = false;
        validateText('title');
        validateURL('url');
        validateText('descrizione');
    }
    return check;
}

function checkTask(){
    var check = true;
    var numTask = $('#count-task').val();
    for( var i = 1; numTask >= i; i++ ) {
        if( !checkText($('#obiettivo'+i).val()) || !checkNumber($('#durata'+i).val())
            || !checkURL($('#url'+i).val()) || !checkText($('#descrizione'+i).val())) {
            check = false;
            validateText('obiettivo'+i);
            validateNumber('durata'+i);
            validateURL('url'+i);
            validateText('descrizione'+i);
        }
    }
    if(!flagsave)
    {
        check = false;
    }
	var counter = $("#count-task");
	var actual = Number(counter.attr('value'));
    if(!flagpath)
        window.document.getElementById("buttonpath"+actual).classList.add("btn-danger");
    if(!flagsave)
		window.document.getElementById("buttonsave"+actual).classList.add("btn-danger");
    return check;
}

function checkInput(){
    var check = true;
    if(!($('#recaudio').is(':checked') || $('#recvideo').is(':checked') || $('#recbehave').is(':checked'))){
        check = false;
    }
    return check;
}

function showInfoQuestionari() {
    $('#modalInfoQuestionari').modal('show');
}


function esperto_home(){
    $( "#formEsciStudio" ).attr('action','utassistant/app/esperto/esperto_home.php');
    $( "#formEsciStudio" ).submit();
}

function modalLogout(){
    $('#modalLogout').modal('show');
}

function logout(){
    $( "#formLogout" ).attr('action','logout.php');
    $( "#formLogout" ).submit();
}