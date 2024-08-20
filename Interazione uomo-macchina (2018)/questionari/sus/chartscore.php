<?php
require_once("../../lib/config.php");
include_once("lib/Sus_func.php");

//$totsus=$_SESSION['totScore'];
$id_studio = $_SESSION["idstudio"];
$totsus = (isset($_SESSION['totScore']) ? $_SESSION['totScore'] : null); //evito warning in caso non sia stata ancora definita la variabile


$x=217;
if($totsus!=0){
for($i=0;$i<=$totsus;$i++){
	$x=$x+5.54;
}
}

?>


		<style type="text/css">
			.immagine {
  				 position: relative;
  				 left: 130;
   				 width: 100%;
   				 top:100px;
			}

			#tacca {
  				 position: absolute;
   				 color: red;
   				 font-size: 400%;
   				 top: 135px;
   				 left: <?php echo $x?>px;
   				 width: 100%;
   				}

			#x {

				position:relative;
				right:130;

			}



  		</style>



		 <?php
            $ob_studio = obiettivo_studio($id_studio); //chiamo funzione che effettua query per recuperare nome caso di studio
            $r = $db->sql_fetchrow($ob_studio);
    ?>
     <div class="container-fluid">
    <div class="row">
	<div class="col-sm-2 col-xs-1">
	</div>

	<div class="col-sm-8 col-xs-10">
    <h2 align="center">Risultati del questionario SUS dello studio: <?php echo $r['obiettivo'] ?></h2> <!--mostro a video il titolo dello studio corrente-->
        <div class="immagine" >

		 <img style="" src="<?php echo IMG_DIR;?>sus.png" alt="testo alternativo" />
		 <h4 id="tacca">|</h4>
		</div>
	</div>
<div class="col-sm-2 col-xs-1">
</div>
</div>
</div>
