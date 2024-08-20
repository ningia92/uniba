<?php
$page=$_GET['sito'];
$idstudio=$_GET['idstudio'];
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
$def="phantomjs rasterize.js ".$page." ..\\screen_clickmap\\".$sub."-idstudio".$idstudio.".png";
//$def="phantomjs rasterize.js ".$page." screen_clickmap\\".$sub."-idstudio".$idstudio."-idtask".$idtask.".png";
//echo $def;
$out = shell_exec($def);

echo $out;
?>
