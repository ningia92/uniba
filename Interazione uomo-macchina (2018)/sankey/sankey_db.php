<?php
//FUNZIONI CHE LAVORANO SU DATABASE PER LA SEZIONE SANKEY
//require_once '../lib/config.php';
//funzione che effettua la query per selezionare obiettivo, idtask e url dello studio in questione
function info_task($id_studio)
                                {

    $Sql   = "SELECT obiettivo, id_task, url
              FROM  task
              WHERE id_studio =".$id_studio;

    $Dati  = mysql_query($Sql);
    return $Dati;
                                }

//funzione che effettua la query per selezionare obiettivo del task corrente
function ob_task($id_studio)
                                {

    $Sql   = "SELECT obiettivo, id_task
              FROM  task
              WHERE id_studio =".$id_studio;

    $Dati  = mysql_query($Sql);
    return $Dati;
                                }

//funzione che effettua la query per recuperare pagine visitate nel task corrente
 function rec_pagine($id_task)
                                {
            //query per recuperare pagine visitate nel task
            $Sql   = "SELECT DISTINCT smt2_cache.url 
                                        from smt2_cache
                                        join smt2_records
                                        on smt2_cache.id = smt2_records.cache_id
                                        join smt2_ass_task_users_records
                                        on smt2_ass_task_users_records.id_records = smt2_records.id
                                        where smt2_ass_task_users_records.id_task =".$id_task;
            $Dati  = mysql_query($Sql);
            return $Dati;

                                }

//funzione che effettua la query per selezionare obiettivo(nome) del caso di studio
function ob_studio($id_studio)
{
    global $db;
    $query   = "SELECT obiettivo
              FROM  studio
              WHERE id_studio =".$id_studio;

    return $db->sql_query($query);
}
//funzione che effettua la query per recuperare obiettivo e istruzioni del task in questione da far visualizzare poi sulla navbar durante la visualizzazione dell'heatmap o sulla pagina tasks_studio_2
function rec_ob($id_task)
                            {

            $Sql2   = "SELECT obiettivo, istruzioni FROM task WHERE id_task=".$id_task;
            $Dati2  = mysql_query($Sql2);
            return $Dati2;
                            }


































?>