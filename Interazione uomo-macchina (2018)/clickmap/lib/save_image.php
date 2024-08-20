
<?php
require_once '../../lib/config.php';

$page=$_POST['sito'];
$idstudio=$_POST['idstudio'];
//$idtask = $_GET['idtask'];

$str = str_replace("?", "-", $page);
$str2 = str_replace('"', "-", $str);
$p=explode("/",$str2);
$quanti = count($p);
$sub = "";
for ($i=1; $i<$quanti; $i++)
    {
  $sub .= $p[$i];
}


$imagedata = base64_decode(str_replace('data:image/png;base64,', '', $_POST['imgdata']));
$filename = $sub."-idstudio".$idstudio;
//path where you want to upload image
$file = $_SERVER['DOCUMENT_ROOT']."/utassistant/clickmap/screen_clickmap/".$filename.'.png';
$imageurl  = $_SERVER['DOCUMENT_ROOT']."/utassistant/clickmap/screen_clickmap/".$filename.'.png';
file_put_contents($file,$imagedata);
echo $imageurl;

?>
