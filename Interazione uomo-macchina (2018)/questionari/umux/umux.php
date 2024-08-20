<html>
   <head>
      <meta charset="utf-8">
      <title>QUESTIONARIO UMUX-Lite</title>
      <meta name="description" content="questionario umux">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="questionari, domande">
    <link rel="stylesheet" href="<?php echo CSS_DIR;?>bootstrap.min.css">
      <script src="<?php echo JS_DIR;?>jquery.min.js"></script>
      <script src="<?php echo JS_DIR;?>bootstrap.min.js"></script>
      <style> 
         div.send{
         float: right;
         margin-right: 2%;
         }
         th.intestazione{
         text-align: center; 
         width:10%;
         }
         td:not(.prova){
         text-align: center;
         }    
      </style>
   </head>
   <body>
       
       <div class="col-xs-2">
            <a href="#" onclick=" $('#modalInfoUmux').modal('show');">
            <span class="glyphicon glyphicon-info-sign"><strong class="h4"> Info</strong></span>
            </a>
       </div>
       
      <div class="container">
         <form action="<?php echo LIB_UMUX_DIR;?>invia_umux.php" method="post" >
            <?php
               $idutente = $loggedInUser->user_id;
               $idstudio = $_SESSION['idstudio'];	
               echo'
                  <input type="hidden" name="idutente" value="'.$idutente.'">
                  <input type="hidden" name="idstudio" value="'.$idstudio.'">';
               ?>
            <center>
               <label><strong class="h2"> Questionario UMUX-Lite </strong></label>
            </center>     
            <table class="table table-hover" >
               <!--<table class="table table-bordered">-->
               <thead>
                  <tr>
                     <th width="65%"></th>
                     <th width="7%" style="text-align:center;">Fortemente in disaccordo</th>
                     <th width="7%"></th>
                     <th width="7%"></th>
                     <th width="7%"></th>
                     <th width="7%"></th>
                     <th width="7%"></th>
                     <th width="7%" style="text-align:center;">Fortemente d'accordo</th>
                  </tr>
               </thead>
               <tbody>
                  <!--<tr class="dispari">-->
                  <tr>
                     <td class="prova"> 1. Le caratteristiche del sito web incontrano le mie necessità</td>
                     <td><input type="Radio" id="Item1" name="Item1" value=1 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=2 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=3 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=4 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=5 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=6 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=7 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 2. Questo sito web è facile da usare</td>
                     <td><input type="Radio" id="Item2" name="Item2" value=1 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=2 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=3 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=4 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=5 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=6 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=7 required></td>
                  </tr>
               </tbody>
            </table>
            <div class="send">
               <input type="submit" class="btn btn-success" value="Invia">
            </div>
         </form>
         <!-- <div class="send"> -->
         <!-- <button type="button" class="btn btn-success" onclick="getElements()">Next</button> -->
         <!-- </div> -->
      </div>
   </body>
</html>

<!-- Modal descrizione Umux-Lite-->
<div id="modalInfoUmux" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title ">Info Umux </h4>
      </div>
      <div class="modal-body">
            <span>
                L'<strong>Usability Metric for User Experience (UMUX-lite)</strong> è un recente questionario alternativo al SUS, composto da due sole affermazioni. È in fase di adattamento e test da parte del CognitiveLab dell’Università degli Studi di Perugia.
          </span> 
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
      </div>
    </div>
  </div>
</div>


