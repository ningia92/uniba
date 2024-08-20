<?php
require_once ("../../lib/config.php");

$result = "";

/*if(isset($_SESSION['idstudio']) && isset($_SESSION['id_user']))
{

  $sql_stat = "delete from smt2_ass_task_users_records as smt where smt.id_user =".$_SESSION['id_user']." and smt.id_task in (select id_task from task as t where t.id_studio = ".$_SESSION['idstudio'].")";
  echo $sql_stat;
  if($db->sql_query($sql_stat))
  {
    $result = $result."records : OK <br>";
  }
  else {
    $result = $result."records : KO <br>";
  }

if(isset($_SESSION['flag_audio']) && $_SESSION['flag_audio'] == 1)
{
  $sql_audio = "delete from file_audio as f_audio where f_audio.user_id = ".$_SESSION['id_user']." and f_audio.task_id in (select id_task from task as t where t.id_studio = ".$_SESSION['idstudio'].")";
  echo $sql_audio;
  if($db->sql_query($sql_audio))
  {
    $result = $result."audio : OK <br>";
  }
  else {
    $result = $result."audio : KO <br>";
  }
}

if(isset($_SESSION['flag_video']) && $_SESSION['flag_video'] == 1)
{
  $sql_video = "delete from file_video as f_video where f_video.user_id = ".$_SESSION['id_user']." and f_video.task_id in (select id_task from task as t where t.id_studio = ".$_SESSION['idstudio'].")";
  echo $sql_video;
  if($db->sql_query($sql_video))
  {
    $result = $result."video : OK <br>";
  }
  else {
    $result = $result."video : KO <br>";
  }
}*/

$sql_task_completati = "DELETE FROM ass_user_task WHERE id_studio = ".$_SESSION['idstudio']." AND id_user= ".$_SESSION['id_user'];
echo $sql_task_completati;
if($db->sql_query($sql_task_completati))
{
  $result = $result."task completati : OK <br>";
}
else {
  $result = $result."task completati : KO <br>";
}

echo $result;
//}
?>
