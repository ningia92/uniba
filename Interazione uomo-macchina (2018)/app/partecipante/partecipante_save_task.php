<?php
    require_once ("../../lib/config.php");

    if (isset($_POST['id_studio'], $_POST['id_task'], $_POST['id_user'], $_POST['url_raggiunta'], $_POST['timetask'],
        $_POST['url_finale'], $_POST['durata_max'])) {

        $id_studio = $_POST['id_studio'];
        $id_task = $_POST['id_task'];
        $id_user = $_POST['id_user'];
        $url_raggiunta = $_POST['url_raggiunta'];
        $timetask = $_POST['timetask'];
        $url_finale = $_POST['url_finale'];
        $durata_max = $_POST['durata_max'];
        $url_intermedi_coded = $_POST["setLink"]; // aggiunto dal gruppo di studio
        $note = "";
        $esito = 0;

        if (empty($url_finale) === false) {

            $note = "Insuccesso: L\'utente non ha superato il task terminando il tempo a sua disposizione";

            switch ($url_raggiunta === $url_finale) {
                case 0:
                    if ($timetask < $durata_max)
                        $note = "Insuccesso: L\'utente non superato il task e ed è passato al task successivo prima 
                            dello scadere del tempo";
                    break;
                case 1:
                    if ($timetask < $durata_max) {
                        $esito = 1;
                        $note = "Successo: L\'utente ha superato il task entro il tempo prestabilito";
                    } else
                        $note = "Insuccesso: L\'utente ha superato il task ma in un tempo superiore a quello consentito";
                    break;
            }

            $query_sql = "INSERT INTO `ass_user_task` (`id_studio`, `id_task`, `id_user`, `url_raggiunta`, 
                                      `tempo_impiegato`, `esito`, `note` )
                          VALUES ('" . $id_studio . "', '" . $id_task . "', '" . $id_user . "', '" . $url_raggiunta .
                                    "', '" . $timetask . "', '" . $esito . "', '" . $note . "')";

            if ($db->sql_query($query_sql) === false) {
                header('HTTP/1.1 400 Database Error!');
                return new Exception(mysqli_error($db));
            }

            //codice aggiunto dal gruppo di studio
            /*$url_intermedi_coded = '{"links":[
                                    "http://www.sviluppoeconomico.gov.it/index.php/it/", 
                                    "http://www.sviluppoeconomico.gov.it/index.php/it/per-il-cittadino",
                                    "http://www.sviluppoeconomico.gov.it/index.php/it/per-il-cittadino/comunicazioni"
                                    ]}';*/
            $url_intermedi = json_decode($url_intermedi_coded,false);
			
			if(count($url_intermedi->links)==2)
			{
				$query_sql_url = "INSERT INTO ass_url_intermedi (`id_task`, `id_user`, `nome_pagina_partenza`, `url_partenza`, `nome_pagina_raggiunta`, `url_raggiunto`)
					VALUES ('".$id_task."', '".$id_user."', '".$url_intermedi->links[0]."', '".$url_intermedi->links[1]."', ' ' , ' ' );";

						$db->sql_query($query_sql_url);
			}
			else
			{
				for($i = 0; $i < count($url_intermedi->links)-2; $i+=2){
					if(strcmp($url_intermedio,'undefined') !== 0){
						$query_sql_url = "INSERT INTO ass_url_intermedi (`id_task`, `id_user`, `nome_pagina_partenza`, `url_partenza`, `nome_pagina_raggiunta`, `url_raggiunto`)
					VALUES ('".$id_task."', '".$id_user."', '".$url_intermedi->links[$i]."', '".$url_intermedi->links[$i+1]."', '".$url_intermedi->links[$i+2]."', '".$url_intermedi->links[$i+3]."');";

						$db->sql_query($query_sql_url);
					}
				}
			}
            //fine codice aggiunto dal gruppo di studio
        } else {
            header('HTTP/1.1 400 Bad Request');
            return new Exception('La richiesta ha dei dati mancanti. $_POST: ' . var_dump($_POST));
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        return new Exception('La richiesta ha dei dati mancanti. $_POST: ' . var_dump($_POST));
    }