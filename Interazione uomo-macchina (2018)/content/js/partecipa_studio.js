/*
La funzione mostra una finestra modale
che contiene la descrizione corrente.
*/
function showModal() {
    $('#myModal').modal('show');
}

function close_tab(){
    window.close();
}

/*function modalStudioTerminato(){
     $('#modalStudioTerminato').modal('show');
}*/

function home_partecipante(){
     window.location.replace("partecipante_home.php");
}

function modalInterrompiStudio(){
     $('#modalInterrompiStudio').modal('show');
}

function partecipante_esci(){

    ferma();

  /*  $.ajax("/utassistant/app/partecipante/partecipante_save_task.php" + "?azione=elimina" +  "&id_user=" + idUserJS + "&id_studio=" + idStudioJS).done(function() {
      console.log("dati eliminati");
    }).fail(function() {
      console.log("errore eliminazione dati");
    });*/

  $.post( "/utassistant/app/partecipante/data_delete.php", function( data ) {
  console.log(data);
});

    $( "#interrompiStudio" ).attr('action','/utassistant/app/partecipante/partecipante_home.php');
    $( "#interrompiStudio" ).submit();
}

function inizioStudio() {
    $('#myModal').modal({backdrop: 'static', keyboard: false});
    $('#myModal').modal('show');
    //$('#modalInizioStudio').modal('show');
}

function modalIniziaStudio(){
     $('#myModal').modal('show');
}

function modalAvviaStudio(idstudio){
    $('#modalAvviaStudio').modal({backdrop: 'static', keyboard: false});
    $('#modalAvviaStudio').modal('show');
    $( "#id_studio" ).attr('value',idstudio);
}

function modalMessaggioTermina() {
    $('#modalStudioTerminato').modal('hide');
    $('#modalMessaggioTermina').modal('show');
}

/*function modalInterrompiTask(){
     $('#modalMessaggioTempoMassimo').modal('show');
}*/
