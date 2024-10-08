<?php

require_once("../../lib/config.php");
include "../../exception/UTAEmailException.php";

if (! empty($_POST)) {
    $errors = array();
    $titolo = trim($_POST["title"]);
    $url = trim($_POST["url"]);
    $descrizione = trim($_POST["descrizione"]);
    $flag_head = "";
    $flag_value = "";

    if (isset($_POST["rec"])) {
        $flag_head.= ", `flag_audio`";
        $flag_value.= (", '0'");
        $flag_head.= ", `flag_video`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_audio`";
        $flag_value.= (", '0'");
        $flag_head.= ", `flag_video`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["recbehave"])) {
        $flag_head.= ", `flag_comportamento`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_comportamento`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["attrakdiff"])) {
        $flag_head.= ", `flag_q_aa`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_q_aa`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["sus"])) {
        $flag_head.= ", `flag_q_sus`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_q_sus`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["nps"])) {
        $flag_head.= ", `flag_q_nps`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_q_nps`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["nasatlx"])) {
        $flag_head.= ", `flag_q_nasatlx`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_q_nasatlx`";
        $flag_value.= (", '0'");
    }

    if (isset($_POST["umux"])) {
        $flag_head.= ", `flag_q_umux`";
        $flag_value.= (", '1'");
    } else {
        $flag_head.= ", `flag_q_umux`";
        $flag_value.= (", '0'");
    }

    //Popolo la tabella studio con i dati relativi allao studio creato
    $loggedInUser->insertStudio($titolo, $descrizione, $url, $flag_head, $flag_value);

    //Ritorna l'ID del nuovo studio creato
    $id_studio = $loggedInUser->getIDNuovoStudio();
    $titolo = $loggedInUser -> getTitoloStudio( $id_studio );

    //Task
    $num_task = $_POST["count-task"];
    for ($i = 1; $i <= $num_task; $i++) {
        $obiettivo = trim($_POST["obiettivo{$i}"]);
        $durata = trim($_POST["durata{$i}"]);
        $url = trim($_POST["url{$i}"]);
        $istruzioni = trim($_POST["descrizione{$i}"]);
               //Aggiunte
        $urlfinale = trim($_POST["urlfinale{$i}"]);
        $tipologia = trim($_POST["tipologia{$i}"]);
        //Fine aggiunte da noi

		$url_intermedi_coded = trim($_POST["setLink{$i}"]);
		$url_intermedi = json_decode($url_intermedi_coded,false);
		
        //Modifica da noi - Aggiunte urlfinale e tipologia
        $loggedInUser->insertNewTask($id_studio, $obiettivo, $istruzioni, $durata, $url, $url_intermedi->links, $urlfinale, $tipologia);
        //Fine modifiche
    }

    //INVITA PARTECIPANTI REGISTRATI
    $num_registered = $_POST["count_registered"];
    for ($i = 1; $i <= $num_registered; $i++) {
        if ($_POST["row".$i."-bit"] == "1") {
            $email_address = $_POST["row".$i];
            assegna_studio($email_address, $id_studio);
            /**
             * Commentato momentaneamente. Timeout sul server durante la connessione al SMTP di google
             */
            //send_Email_Registered_Study_Invitation($email_address, $titolo);
        }
    }

    //INVITA PARTECIPANTI NON REGISTRATI
    $mails = explode("\n", $_POST['invited']);
    if (count($mails) > 0 && $mails[0] !== "") {
        /**
         * Commentato momentaneamente. Timeout sul server durante la connessione al SMTP di google
         */
        //invita_part_non_registrati($mails, $titolo, $id_studio);
    }
    //permette alla pagina esperto_home di avere conferma sull'inserimento dello studio
    $_SESSION['studio_creato'] = '1';
}

header("Location: ".ESPERTO_DIR."esperto_home.php");