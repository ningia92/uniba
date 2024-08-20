<html lang="it">

<head>

    <meta charset="iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo JS_DIR;?>jquery.min.js"></script>
    <style type="text/css"></style>
    <script type="text/javascript" src="<?php echo JS_DIR;?>bootstrap.js"></script>
    <link href="<?php echo CSS_DIR;?>bootstrap.css" rel="stylesheet">

    <link href="<?php echo CSS_DIR;?>utassistant-error.css" rel="stylesheet">
    <link href="<?php echo CSS_DIR;?>utassistant_general.css" rel="stylesheet">

    <script src="<?php echo JS_DIR;?>crea_studio.js"></script>
    <script src="<?php echo JS_DIR;?>move_pills_attrakdiff.js"></script>

</head>

<!-- ____________________________________________________________________________________________________________

 TAB PILLS - MENU'-

------------------------------------------------------------------------------------------------------------- -->
<body>
<div class="container">
    <?php
		$idutente = $loggedInUser->user_id;
		$idstudio = $_SESSION['idstudio'];
/*       echo'<form class="form-horizontal" id="form" name="form" action="questionari/attrakdiff/lib/invia_attrakdiff.php" method="post">
	   <input type="hidden" name="idutente" value="'.$idutente.'">
	   <input type="hidden" name="idstudio" value="'.$idstudio.'">';*/

		?>
      <form class="form-horizontal" id="form" name="form" action="<?php echo LIB_ATTRAKDIFF_DIR;?>invia_attrakdiff.php" method="post">
	   <input type="hidden" name="idutente" value="<?php echo $idutente; ?>">
	   <input type="hidden" name="idstudio" value="<?php echo $idstudio; ?>">
        <div class="container">
            <div class="row">
                    <h1>Questionario Attrakdiff </h1>
            </div>
            <br>
            <div class="row">

                <div class="ut-btn first-pill col-sm-4 ut-pill-active">
                    <h4>1 - 10</h4>
                </div>
                <div class="ut-btn second-pill col-sm-4 ut-pill-inactive">
                    <h4>11 - 20</h4>
                </div>
                <div class="ut-btn third-pill col-sm-4 ut-pill-inactive">
                    <h4>21 - 27</h4>
                </div>

            </div>
        </div>
        <!-- ____________________________________________________________________________________________________________

 TAB PILLS - DEFINISCI TABS -

------------------------------------------------------------------------------------------------------------- -->
        <div class="tab-content">
            <div id="studio" class="" style="display: block;">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="br_spaces">
                                <br>
                                <br>
                            </div>
                            <div class="panel panel-default" id="studio">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr class="dispari">
                                            <td class="prova">human</td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item1" value="7" required>
                                            </td>
                                            <td class="prova">technical</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">isolating</td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item2" value="7" required>
                                            </td>
                                            <td class="prova">connective</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">pleasant</td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item3" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item3" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item3" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item3" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item3" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item3" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item3" value="7" required>
                                            </td>
                                            <td class="prova">unpleasant</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">inventive</td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item4" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item4" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item4" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item4" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item4" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item4" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item4" value="7" required>
                                            </td>
                                            <td class="prova">conventional</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">simple</td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item5" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item5" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item5" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item5" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item5" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item5" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item5" value="7" required>
                                            </td>
                                            <td class="prova">complicated</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">professional</td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item6" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item6" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item6" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item6" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item6" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item6" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item6" value="7" required>
                                            </td>
                                            <td class="prova">unprofessional</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">ugly</td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item7" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item7" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item7" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item7" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item7" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item7" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item7" value="7" required>
                                            </td>
                                            <td class="prova">attractive</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">practical</td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item8" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item8" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item8" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item8" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item8" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item8" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item8" value="7" required>
                                            </td>
                                            <td class="prova">impractical</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">likeable</td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item9" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item9" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item9" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item9" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item9" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item9" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item9" value="7" required>
                                            </td>
                                            <td class="prova">disagreeable</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">cumbersome</td>
                                            <td>
                                                <input type="Radio" id="Item10" name="Item10" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item10" name="Item10" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item10" name="Item10" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item10" name="Item10" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item10" name="Item10" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item10" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item10" value="7" required>
                                            </td>
                                            <td class="prova">straightforward</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <!-- Fine panel-default -->
                        </div>
                    </div>
                    <!-- Fine row -->
                    <div class="row">
                        <div class="col-xs-10">
                        </div>
                        <div class="col-xs-2">
                            <div class="br_space">
                                <br>
                            </div>
                            <button type="button" class="btn btn-primary floatbutton" onclick="f2s()">
                                SUCCESSIVO
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </button>
                        </div>
                    </div>
                    <div class="br_spaces">
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <!-- Modal campi incompleti studio-->
            <div id="modalErrorStudio" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Informazioni mancanti </h4>
                        </div>
                        <div class="modal-body">
                            <span> Uno o piÃ¹ campi non sono stati compilati. Ricontrollare e proseguire</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal campi incompleti studio-->
            <div id="modalErrorInput" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Informazioni mancanti </h4>
                        </div>
                        <div class="modal-body">
                            <span> Selezionare almeno un input da catturare. Ricontrollare e proseguire</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal descrizione questionari-->
            <div id="modalInfoQuestionari" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Questionari </h4>
                        </div>
                        <div class="modal-body">
                            <span> Inserire qui la descrizione dei questionari...</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="task" class="" style="display: none;">
                <div class="br_space">
                    <br>
                </div>
                <div class="container">
                    <!-- task uno -->
                    <div id="row1" class="row">
                        <div class="col-xs-12">
                            <div class="br_space">
                                <br>
                            </div>
                            <div id="task1" class="panel panel-default">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr class="dispari">
                                            <td class="prova">stylish</td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item11" value="7" required>
                                            </td>
                                            <td class="prova">tacky</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">predictable</td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item12" value="7" required>
                                            </td>
                                            <td class="prova">unpredictable</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">cheap</td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item13" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item13" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item13" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item13" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item2" name="Item13" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item13" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item13" value="7" required>
                                            </td>
                                            <td class="prova">premium</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">alienanting</td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item14" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item14" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item14" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item14" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item4" name="Item14" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item14" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item14" value="7" required>
                                            </td>
                                            <td class="prova">integrating</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">brings me closer to people</td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item15" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item15" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item15" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item15" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item5" name="Item15" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item15" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item15" value="7" required>
                                            </td>
                                            <td class="prova">separates me from people</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">unpresentable</td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item16" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item16" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item16" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item16" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item6" name="Item16" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item16" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item16" value="7" required>
                                            </td>
                                            <td class="prova">presentable</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">rejecting</td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item17" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item17" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item17" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item17" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item7" name="Item17" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item17" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item17" value="7" required>
                                            </td>
                                            <td class="prova">inviting</td>
                                        </tr>

                                        <tr class="pari">
                                            <td class="prova">unimaginative</td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item18" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item18" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item18" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item18" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item8" name="Item18" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item18" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item18" value="7" required>
                                            </td>
                                            <td class="prova">creative</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">good</td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item19" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item19" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item19" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item19" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item9" name="Item19" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item19" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item19" value="7" required>
                                            </td>
                                            <td class="prova">bad</td>
                                        </tr>

                                        <tr class="dispari">
                                            <td class="prova">confusing</td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="1" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="2" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="3" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="4" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="5" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="6" required>
                                            </td>
                                            <td>
                                                <input type="Radio" id="Item1" name="Item20" value="7" required>
                                            </td>
                                            <td class="prova">clearly structured</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- sfasamento -->
                        </div>
                    </div>
                    <!-- fine task uno -->
                    <div class="row">
                        <div class="col-xs-10">
                        </div>
                        <div class="col-xs-2">

                        </div>
                    </div>
                    <div class="br_spaces">
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-primary" onclick="s2f()">
                                <span class="glyphicon glyphicon-arrow-left"></span> PRECEDENTE
                            </button>
                        </div>
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-primary floatbutton" onclick="s2t()">
                                SUCCESSIVO
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </button>
                        </div>
                    </div>
                    <div class="br_spaces">
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <!-- Modal campi incompleti task-->
            <div id="modalErrorTask" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Informazioni mancanti </h4>
                        </div>
                        <div class="modal-body">
                            <span> Uno o piÃ¹ campi non sono stati compilati. Compilare i campi per poter proseguire</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal campi incompleti nell'ultimo task-->
            <div id="modalErrorAggiuntaTask" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Informazioni mancanti </h4>
                        </div>
                        <div class="modal-body">
                            <span> Uno o piÃ¹ campi non sono stati compilati. Compilare i campi per poter aggiungere un altro Task </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal conferma elimina task-->
            <div id="modalEliminaTask" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Elimina Task </h4>
                        </div>
                        <div class="modal-body">
                           <span id="modalNumeroTask"> Sei sicuro di voler eliminare il task? </span>

                        </div>
                        <div class="modal-footer">
                            <button id="proseguiEliminaTask" type="button" class="btn btn-default" data-dismiss="modal" onclick="#">prosegui</button>
                            <button id="annulla" type="button" class="btn btn-default" data-dismiss="modal">annulla</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal unico task rimasto-->
            <div id="modalUnicoTask" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Unico Task rimasto </h4>
                        </div>
                        <div class="modal-body">
                            <span> Non si possono eliminare tutti i task. Lo studio deve avere almeno un task assegnato </span>
                        </div>
                        <div class="modal-footer">
                            <button id="annulla" type="button" class="btn btn-default" data-dismiss="modal">ok</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="partecipanti" class="" style="display: none;">
                <div class="br_space">
                    <br>
                </div>
                <div class="container">
                    <div class="row">
                        <table class="table table-hover">
                            <tbody>
                                <tr class="pari">
                                    <td class="prova">repelling</td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item21" value="7" required>
                                    </td>
                                    <td class="prova">appealing</td>
                                </tr>

                                <tr class="dispari">
                                    <td class="prova">bold</td>
                                    <td>
                                        <input type="Radio" id="Item2" name="Item22" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item2" name="Item22" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item2" name="Item22" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item2" name="Item22" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item2" name="Item22" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item22" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item22" value="7" required>
                                    </td>
                                    <td class="prova">cautious</td>
                                </tr>

                                <tr class="pari">
                                    <td class="prova">innovative</td>
                                    <td>
                                        <input type="Radio" id="Item4" name="Item23" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item4" name="Item23" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item4" name="Item23" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item4" name="Item23" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item4" name="Item23" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item23" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item23" value="7" required>
                                    </td>
                                    <td class="prova">conservative</td>
                                </tr>

                                <tr class="dispari">
                                    <td class="prova">dull</td>
                                    <td>
                                        <input type="Radio" id="Item5" name="Item24" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item5" name="Item24" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item5" name="Item24" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item5" name="Item24" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item5" name="Item24" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item24" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item24" value="7" required>
                                    </td>
                                    <td class="prova">captivating</td>
                                </tr>

                                <tr class="pari">
                                    <td class="prova">undemanding</td>
                                    <td>
                                        <input type="Radio" id="Item6" name="Item25" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item6" name="Item25" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item6" name="Item25" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item6" name="Item25" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item6" name="Item25" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item25" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item25" value="7" required>
                                    </td>
                                    <td class="prova">challenging</td>
                                </tr>

                                <tr class="dispari">
                                    <td class="prova">motivating</td>
                                    <td>
                                        <input type="Radio" id="Item7" name="Item26" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item7" name="Item26" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item7" name="Item26" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item7" name="Item26" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item7" name="Item26" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item26" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item26" value="7" required>
                                    </td>
                                    <td class="prova">discouraging</td>
                                </tr>

                                <tr class="pari">
                                    <td class="prova">novel</td>
                                    <td>
                                        <input type="Radio" id="Item8" name="Item27" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item8" name="Item27" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item8" name="Item27" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item8" name="Item27" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item8" name="Item27" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item27" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item27" value="7" required>
                                    </td>
                                    <td class="prova">ordinary</td>
                                </tr>

                                <tr class="dispari">
                                    <td class="prova">unruly</td>
                                    <td>
                                        <input type="Radio" id="Item9" name="Item28" value="1" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item9" name="Item28" value="2" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item9" name="Item28" value="3" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item9" name="Item28" value="4" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item9" name="Item28" value="5" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item28" value="6" required>
                                    </td>
                                    <td>
                                        <input type="Radio" id="Item1" name="Item28" value="7" required>
                                    </td>
                                    <td class="prova">manageable</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- fine row -->

                    <!-- fine row -->
                    <div class="br_spaces">
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-primary" onclick="t2s()">
                                <span class="glyphicon glyphicon-arrow-left">
                    </span> PRECEDENTE
                            </button>
                        </div>
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-2">
                            <button type="button" class="btn btn-primary floatbutton" name="creastudio" id="creastudio" onclick="submit()">
                                <span class="glyphicon glyphicon-floppy-disk">
                    </span>
                                <strong class="h4"> Invia</strong>
                            </button>
                        </div>
                    </div>
                    <div class="br_spaces">
                        <br>
                        <br>
                    </div>
                </div>
            </div>


            <!-- Modal creazione studio-->
            <div id="Carica" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Creazione studio in corso...</h4>
                        </div>
                        <div class="modal-body">
                            <span id="num_mail"></span>
                            <div class="progress progress-striped active" style="width:500px">
                                <div id="bar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    <span id="bar2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal studio creato-->
            <div id="StudioCreato" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Studio creato </h4>
                        </div>
                        <div class="modal-body">
                            <span> Studio creato correttamente</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal invitare partecipanti-->
            <div id="partecipanti_non_invitati" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title ">Partecipanti non Invitati </h4>
                        </div>
                        <div class="modal-body">
                            <span> Non Ã¨ stato invitato alcun partecipante. Vuoi creare lo stesso lo studio</span>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xs-6">
                                    <button id="annulla" type="button" class="btn btn-default" data-dismiss="modal">annulla</button>
                                </div>
                                <div class="col-xs-6">
                                    <button id="prosegui" type="button" class="btn btn-default" data-dismiss="modal" onclick="prosegui_creaSFtudio()">prosegui</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="count-task" type="hidden" name="count-task" value="1">
        </form>
</div>


</body>

</html>
