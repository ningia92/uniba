<?php

  require_once("../../../lib/config.php");

  //Prevent the user visiting the logged in page if he/she is not logged in
  if(!isUserLoggedIn()) { header("Location: login.php"); die(); }
?>

<?php
  /*
    Below is a very simple example of how to process a login request.
    Some simple validation (ideally more is needed).
  */

//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $password = $_POST["password"];
    $password_new = $_POST["passwordc"];
    $password_confirm = $_POST["passwordcheck"];

    //Perform some validation
    //Feel free to edit / change as required

    if(trim($password) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
    }
    else if(trim($password_new) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_NEW_PASSWORD");
    }
    else if(minMaxRange(8,50,$password_new))
    {
      $errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
    }
    else if($password_new != $password_confirm)
    {
      $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }

    //End data validation
    if(count($errors) == 0)
    {
      //Confirm the hash's match before updating a users password
      $entered_pass = generateHash($password,$loggedInUser->hash_pw);

      //Also prevent updating if someone attempts to update with the same password
      $entered_pass_new = generateHash($password_new,$loggedInUser->hash_pw);

      if($entered_pass != $loggedInUser->hash_pw)
      {
        //No match
        $errors[] = lang("ACCOUNT_PASSWORD_INVALID");
      }
      else if($entered_pass_new == $loggedInUser->hash_pw)
      {
        //Don't update, this fool is trying to update with the same password ÃÂ¬ÃÂ¬
        $errors[] = lang("NOTHING_TO_UPDATE");
      }
      else
      {
        //This function will create the new hash and update the hash_pw property.
        $loggedInUser->updatePassword($password_new);
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Aggiorna Password | <?php echo $websiteName; ?> </title>
<?php require_once("../head_inc.php"); ?>

</head>
<body>
<?php require_once("../navbars/navbar_esperto.php"); ?>

<div class = "container" id="content">
<p>Il sistema Tester e il sistema User sono integrati all&rsquo;interno della piattaforma UTAssistant. In homepage, un unico modulo per il login, consente sia agli esperti d&rsquo;usabilit&agrave; sia ai partecipati di accedere ai sotto-sistemi Tester e User, rispettivamente.</p>
<p>Il sistema Tester consente ad un esperto d&rsquo;usabilit&agrave; la creazione di uno o pi&ugrave; studi definendone:</p>
<ul>
<li>Titolo ;</li>
<li>URL Sito da valutare;</li>
<li>Istruzioni per il partecipante;</li>
<li>Questionario da somministrare al partecipante al termine dello studio;</li>
<li>Tipi di dati che il sistema&nbsp;<em>User</em>&nbsp;dovr&agrave; automaticamente catturare durante lo studio, per esempio, lo screen capture, click e movimento del mouse, l&rsquo;audio/video della webcam dell&rsquo;utente;</li>
<li>Una lista di task caratterizzati da titolo, descrizione e durata massima;</li>
<li>Utenti che partecipano allo studio tramite l&rsquo;inserimento della loro email.</li>
</ul>
<p>Gli utenti invitati a partecipare allo studio ricevono un&rsquo;email di notifica contenente un link per l&rsquo;ingresso al sistema Tester che li guida nell&rsquo;esecuzione dello studio. Lo studio pu&ograve; anche essere avviato entrando nel sistema Tester mediante apposito login nel sistema.</p>
<p>Quando un partecipante avvia uno studio, il sistema Tester mostra all&rsquo;utente un messaggio che notifica la raccolta di dati sensibili. Se il partecipante accetta di proseguire, il sistema mostra la descrizione dello studio&nbsp;prima di iniziare l&rsquo;erogazione dei task.</p>
<p>All&rsquo;inizio di ogni task, il sistema mostra al partecipante il titolo, l&rsquo;obiettivo del task e un pulsante &ldquo;Avvia&rdquo; per iniziare l&rsquo;esecuzione del task. Cliccando sul pulsante start il sistema mostra a pieno schermo il sito da valutare; una toolbar in alto visualizza costantemente titolo e descrizione del task, come anche i pulsanti per avanzare al task successivo o abbandonare lo studio.</p>
<p>Finita l&rsquo;esecuzione di tutti i task, viene erogato un questionario (se impostato dall&rsquo;esperto d&rsquo;usabilit&agrave;). Finita la compilazione del questionario lo studio &egrave; concluso.</p>
<p>L&rsquo;analisi dei risultati dello studio &egrave; offerta dalle funzionalit&agrave; che sono&nbsp;elencate&nbsp;nell'home&nbsp;page del sistema&nbsp;Tester, nel menu "Opzioni"&nbsp;accanto&nbsp;ad ogni&nbsp;studio creato.</p>
</div>
</body>
</html>


