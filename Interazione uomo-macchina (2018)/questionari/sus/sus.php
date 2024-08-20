<html>
   <head>
      <meta charset="utf-8">
      <title>QUESTIONARIO SUS</title>
      <meta name="description" content="questionario sus">
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
      <div class="container">
         <form action="<?php echo LIB_SUS_DIR;?>invia_sus.php" method="post" >
            <?php
               $idutente = $loggedInUser->user_id;
               $idstudio = $_SESSION['idstudio'];	
                  echo '<input type="hidden" name="idutente" value="'.$idutente.'">
                  <input type="hidden" name="idstudio" value="'.$idstudio.'">';
               ?>
            <center>
               <label><strong class="h2"> Questionario SUS </strong></label>
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
                     <th width="7%" style="text-align:center;">Fortemente d'accordo</th>
                  </tr>
               </thead>
               <tbody>
                  <!--<tr class="dispari">-->
                  <tr>
                     <td class="prova"> 1. Penso che mi piacerebbe utilizzare questo sito frequentemente</td>
                     <td><input type="Radio" id="Item1" name="Item1" value=1 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=2 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=3 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=4 required></td>
                     <td><input type="Radio" id="Item1" name="Item1" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 2. Ho trovato il sito inutilmente complesso</td>
                     <td><input type="Radio" id="Item2" name="Item2" value=1 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=2 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=3 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=4 required></td>
                     <td><input type="Radio" id="Item2" name="Item2" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 3. Ho trovato il sito molto semplice da usare</td>
                     <td><input type="Radio" id="Item3" name="Item3" value=1 required></td>
                     <td><input type="Radio" id="Item3" name="Item3" value=2 required></td>
                     <td><input type="Radio" id="Item3" name="Item3" value=3 required></td>
                     <td><input type="Radio" id="Item3" name="Item3" value=4 required></td>
                     <td><input type="Radio" id="Item3" name="Item3" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 4. Penso che avrei bisogno del supporto di una persona già in grado di utilizzare il sito</td>
                     <td><input type="Radio" id="Item4" name="Item4" value=1 required></td>
                     <td><input type="Radio" id="Item4" name="Item4" value=2 required></td>
                     <td><input type="Radio" id="Item4" name="Item4" value=3 required></td>
                     <td><input type="Radio" id="Item4" name="Item4" value=4 required></td>
                     <td><input type="Radio" id="Item4" name="Item4" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 5. Ho trovato le varie funzionalità del sito bene integrate</td>
                     <td><input type="Radio" id="Item5" name="Item5" value=1 required></td>
                     <td><input type="Radio" id="Item5" name="Item5" value=2 required></td>
                     <td><input type="Radio" id="Item5" name="Item5" value=3 required></td>
                     <td><input type="Radio" id="Item5" name="Item5" value=4 required></td>
                     <td><input type="Radio" id="Item5" name="Item5" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 6. Ho trovato incoerenze tra le varie funzionalità del sito </td>
                     <td><input type="Radio" id="Item6" name="Item6" value=1 required></td>
                     <td><input type="Radio" id="Item6" name="Item6" value=2 required></td>
                     <td><input type="Radio" id="Item6" name="Item6" value=3 required></td>
                     <td><input type="Radio" id="Item6" name="Item6" value=4 required></td>
                     <td><input type="Radio" id="Item6" name="Item6" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 7. Penso che la maggior parte delle persone possano imparare ad utilizzare il sito facilmente </td>
                     <td><input type="Radio" id="Item7" name="Item7" value=1 required></td>
                     <td><input type="Radio" id="Item7" name="Item7" value=2 required></td>
                     <td><input type="Radio" id="Item7" name="Item7" value=3 required></td>
                     <td><input type="Radio" id="Item7" name="Item7" value=4 required></td>
                     <td><input type="Radio" id="Item7" name="Item7" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 8. Ho trovato il sito molto difficile da utilizzare </td>
                     <td><input type="Radio" id="Item8" name="Item8" value=1 required></td>
                     <td><input type="Radio" id="Item8" name="Item8" value=2 required></td>
                     <td><input type="Radio" id="Item8" name="Item8" value=3 required></td>
                     <td><input type="Radio" id="Item8" name="Item8" value=4 required></td>
                     <td><input type="Radio" id="Item8" name="Item8" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 9. Mi sono sentito a mio agio nell’utilizzare il sito </td>
                     <td><input type="Radio" id="Item9" name="Item9" value=1 required></td>
                     <td><input type="Radio" id="Item9" name="Item9" value=2 required></td>
                     <td><input type="Radio" id="Item9" name="Item9" value=3 required></td>
                     <td><input type="Radio" id="Item9" name="Item9" value=4 required></td>
                     <td><input type="Radio" id="Item9" name="Item9" value=5 required></td>
                  </tr>
                  <tr>
                     <td class="prova"> 10. Ho avuto bisogno di imparare molti processi prima di riuscire ad utilizzare </td>
                     <td><input type="Radio" id="Item10" name="Item10" value=1 required></td>
                     <td><input type="Radio" id="Item10" name="Item10" value=2 required></td>
                     <td><input type="Radio" id="Item10" name="Item10" value=3 required></td>
                     <td><input type="Radio" id="Item10" name="Item10" value=4 required></td>
                     <td><input type="Radio" id="Item10" name="Item10" value=5 required></td>
                  </tr>
               </tbody>
            </table>
            <div class="send">
               <input type="submit" class="btn btn-success" value="Invia">
            </div>
         </form>
      </div>
   </body>
</html>