<?php

    require_once("../../lib/config.php");

    if (!isUserLoggedInPart()) {
      header("Location: ".ACCOUNT_DIR."login.php");
    }
    
    $status = $_SESSION['status'];
    switch($status) {
        case 'task':
        $_SESSION['flagtask'] = 1;
            $idstudio = $_SESSION['idstudio'];
            $numtasks = $_SESSION['numtasks'];
            $currenttask = $_SESSION['currenttask'] + 1;
            $_SESSION['currenttask'] = $currenttask;
            if($numtasks >= $currenttask) {
                $result = $loggedInUser->getInfoTask($idstudio, $currenttask);
                $_SESSION['idtask'] = $result['id_task'];
                $_SESSION['obiettivo'] = $result['obiettivo'];
                $_SESSION['istruzioni'] = $result['istruzioni'];
                $_SESSION['url'] = $result['url'];
            }
            if($currenttask == $numtasks) {
                if( $_SESSION['flag_q_aa'] == $_SESSION['flag_q_sus'] && ($_SESSION['flag_q_aa'] == $_SESSION['flag_q_umux'])) {
                    $_SESSION['status'] = 'termina-noquest';
                } else {
                    $_SESSION['status'] = 'questionario';
                }
            }
            header("Location: ".PARTECIPANTE_DIR."partecipante_studio.php");
            break;
            
        case 'questionario':
            if($_SESSION['flag_q_nasatlx']) {
                if($_SESSION['currenttask'] == $_SESSION['numtasks'])
            $_SESSION['status'] = 'termina';
                else 
                    $_SESSION['status'] = 'questionarioNasaTlx';
            } else {
                $_SESSION['status'] = 'termina';
            }
 header("Location: ".PARTECIPANTE_DIR."partecipante_studio.php");
            break;

        case 'questionarioNasaTlx':
        $_SESSION['flagtask'] = 1;
            $idstudio = $_SESSION['idstudio'];
            $numtasks = $_SESSION['numtasks'];
            $currenttask = $_SESSION['currenttask'] + 1;
            $_SESSION['currenttask'] = $currenttask;
            if($numtasks >= $currenttask) {
                $result = $loggedInUser->getInfoTask($idstudio, $currenttask);
                $_SESSION['idtask'] = $result['id_task'];
                $_SESSION['obiettivo'] = $result['obiettivo'];
                $_SESSION['istruzioni'] = $result['istruzioni'];
                $_SESSION['url'] = $result['url'];
                $_SESSION['status'] = 'questionario';
            }														
            header("Location: ".PARTECIPANTE_DIR."partecipante_studio.php");
            break;
            
        case 'termina':
            $idstudio = $_SESSION['idstudio'];
            $iduser = $loggedInUser->user_id;
            $loggedInUser->setFlag($iduser,$idstudio);
            header("Location: ".PARTECIPANTE_DIR."partecipante_home.php");
            break;
            
        default:
            header("Location: ".PARTECIPANTE_DIR."partecipante_home.php");
            break;
    }
     
?>