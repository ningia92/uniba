<?php
$posX = $_GET['posX'];
$posY = $_GET['posY'];
$sizeX = $_GET['sizeX'];
$sizeY = $_GET['sizeY'];

$diagramma = "diagram.png";
$p  = "p.png";

$diagramma_size=getimagesize($diagramma); 
$p_size=getimagesize($p); 

$dest = imagecreatetruecolor($diagramma_size[0], $diagramma_size[1]);
	
//RETTANGOLO CONFIDENZA ---------------------------------------
$rettangolo_confidenza=imagecreatetruecolor($sizeX, $sizeY);

// Turn off alpha blending and set alpha flag

imagealphablending($rettangolo_confidenza, false);
imagesavealpha($rettangolo_confidenza, true);

for ($x=0;$x<$sizeX;$x++){
  $opacity = (int) (127.0/30 * 12);
  $color = imagecolorallocatealpha($rettangolo_confidenza, 255, 191, 127, $opacity);
  imageline  ( $rettangolo_confidenza  , $x , 0  , $x  , $sizeY-1  , $color  );
}
//----------------------------------------------------------

$sfondo = imagecreatefrompng($diagramma);
$icona  = imagecreatefrompng($p);

imagecopy($dest, $sfondo, 0, 0, 0, 0, $diagramma_size[0], $diagramma_size[1]);
imagecopy($dest, $rettangolo_confidenza, $posX-($sizeX/2)+(($sizeX/14)/2), $posY-($sizeY/2)+(($sizeY/14)/2), 0, 0, $sizeX, $sizeY);
imagecopy($dest, $icona, $posX-($sizeX/2)+(($sizeX-14)/2), $posY-($sizeY/2)+(($sizeY-14)/2), 0, 0, $p_size[0], $p_size[1]);
header("Content-type: image/png");
imagepng($dest);


?>