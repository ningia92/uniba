<?php
$connect = mysql_pconnect('localhost', 'root', '');
$db = mysql_select_db('smartmuseum', $connect);
//$db = mysql_select_db(, $connect);

$NumPassaporto = $_POST['NumPassaporto'];

$query = sprintf("SELECT NumPassaporto FROM reperto WHERE '%u' = reperto.NumPassaporto",mysql_real_escape_string($NumPassaporto));
$temp = mysql_query($query);
if(mysql_num_rows($temp) == 0) {	//ovvero nessun reperto con quel passaporto
	$str2= "<script type='text/javascript'>alert('Numero passaporto non trovato!');</script>";
	echo $str2;
	header('Refresh:0; URL=loginform.php');
}

$query_destroy = sprintf( "delete from reperto where '%u' = reperto.NumPassaporto",mysql_real_escape_string($NumPassaporto));
$res = mysql_query($query_destroy);

//se ci sono file multimediali
$query_file_multi = sprintf("SELECT * FROM multimedia WHERE '%u' = multimedia.NumPassaporto",mysql_real_escape_string($NumPassaporto));
$query_file_multi_del = sprintf("DELETE FROM multimedia WHERE '%u' = multimedia.NumPassaporto",mysql_real_escape_string($NumPassaporto));

if(mysql_num_rows( mysql_query($query_file_multi) ) > 0)
	$multi_des = mysql_query($query_file_multi_del);

mysql_close($connect);
?>
