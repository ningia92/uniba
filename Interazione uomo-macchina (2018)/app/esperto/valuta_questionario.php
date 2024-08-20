<?php
    require_once("../../lib/config.php");

    include '../../components/ValutaMenu.php';
    use App\Components\ValutaMenu;

    if (!isUserLoggedInEsp()) {
        header('Location: login.php');
    }

    if (isset($_SESSION['idstudio'])) {
        $id_studio = $_SESSION['idstudio'];
    } else if (isset($_GET['idstudio'])) {
        $id_studio = $_GET['idstudio'];
        $_SESSION['idstudio'] = $_GET['idstudio'];
    }
    function ob_studio($id_studio)
    {
        global $db;
        $query   = "SELECT obiettivo
                      FROM  studio
                      WHERE id_studio =".$id_studio;

        return $db->sql_query($query);
    }

    $ob_studio = ob_studio($id_studio);
    $r = $db->sql_fetchrow($ob_studio);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Valutazione Studio<?php echo $websiteName; ?> </title>
    <?php require_once("../inc/head_inc.php"); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?php echo JS_DIR;?>risultati_nasatlx.js"></script>
</head>
<body>
    <?php require_once("../inc/navbars/navbar_esperto.php"); ?>

    <?php
        function select_qflag($id_studio) {
            global $db;
            $sql_aa = "select count(*) as n_ques from q_attrakdiff where id_studio =  $id_studio";
            $sql_sus = "select count(*) as n_ques from q_sus where id_studio =  $id_studio";
            $sql_nps = "select count(*) as n_ques from q_nps where id_studio =  $id_studio";
            $sql_nasatlx = "select count(*) as n_ques from q_nasatlx where idStudio =  $id_studio";
            $sql_umux = "select count(*) as n_ques from q_umux where id_studio =  $id_studio";

            $dati = array();
            $dati['aa'] = $db->sql_fetchrow($db->sql_query($sql_aa));
            $dati['sus'] = $db->sql_fetchrow($db->sql_query($sql_sus));
            $dati['nps'] = $db->sql_fetchrow($db->sql_query($sql_nps));
            $dati['nasatlx'] = $db->sql_fetchrow($db->sql_query($sql_nasatlx));
            $dati['umux'] = $db->sql_fetchrow($db->sql_query($sql_umux));

            return $dati;
        }

        $dati = select_qflag($id_studio);

        if (isset($dati)) {
            $flag_q_aa = $dati['aa']['n_ques'];
            $flag_q_sus = $dati['sus']['n_ques'];
            $flag_q_nps = $dati['nps']['n_ques'];
            $flag_q_nasatlx = $dati['nasatlx']['n_ques'];
            $flag_q_umux = $dati['umux']['n_ques'];
        }

        $classactive = 'active';

	?>
    <div class="col-md-12 text-center">
        <h1>Questionari</h1>
        <h4><?php echo $r['obiettivo']; ?></h4>
    </div>
    <div class="container-fluid">
        <?php
            echo new ValutaMenu($id_studio);
        ?>
        <div class="col-md-9" style="margin-bottom: 20px">
            <ul class="nav nav-tabs">
                <?php if($flag_q_aa > 0) : ?>
                    <li class="<?php echo $classactive; ?>">
                        <a data-toggle="tab" href="#attrakdiff">Attrakdiff  <span class="badge"></span></a>
                    </li>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_nasatlx > 0) : ?>
                    <li class="<?php echo $classactive; ?>">
                        <a data-toggle="tab" href="#nasatlx">Nasatlx  <span class="badge"></span></a>
                    </li>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_nps > 0) : ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            NPS<b class="caret"></b>  <span class="badge"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo $classactive; ?>">
                                <a data-toggle="tab" href="#NPSscore">Score</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#NPSdiagramma">Diagramma</a>
                            </li>
                        </ul>
                    </li>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_sus > 0) : ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            SUS<b class="caret"></b>  <span class="badge"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo $classactive; ?>">
                                <a data-toggle="tab" href="#SUSscore">Punteggio generale</a>
                            </li>
                            <li><a data-toggle="tab" href="#SUSlearnability">Apprendibilità</a></li>
                            <li><a data-toggle="tab" href="#SUSusability">Usabilità</a></li>
                            <li><a data-toggle="tab" href="#SUSboxchart">Grafico box plot</a></li>
                            <li><a data-toggle="tab" href="#SUSchartscore">Scale qualitative</a></li>
                            <li><a data-toggle="tab" href="#SUShistogram">Grafico dettaglio utenti</a></li>
                        </ul>
                    </li>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_umux > 0) : ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Umux<b class="caret"></b>
                            <span class="badge"></span></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo $classactive; ?>">
                                <a data-toggle="tab" href="#UMUXscore">Score</a>
                            </li>
                            <li><a data-toggle="tab" href="#UMUXboxchart">Boxchart</a></li>
                            <li><a data-toggle="tab" href="#UMUXhistogram">Histogram</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <?php $classactive = 'active' ?>

            <div class="tab-content">
                <?php if($flag_q_aa > 0) : ?>
                    <div id="attrakdiff" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php require_once("../../questionari/attrakdiff/diagramma_attrakdiff.php"); ?>
                        <script>
                            setQuestionariCompletati("attrakdiff", 1);
                        </script>
                    </div>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_nasatlx > 0) : ?>
                    <div id="nasatlx" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php require_once("../../questionari/nasatlx/risultati_nasatlx.php"); ?>
                        <script>
                            setQuestionariCompletati("nasatlx", 1);
                        </script>
                    </div>
                    <?php $classactive = '' ?>
                <?php endif; ?>

                <?php if($flag_q_nps > 0) : ?>
                    <div id="NPSscore" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php require_once("../../questionari/nps/tab_totNpsScore.php"); ?>
                    </div>
                <?php $classactive = '' ?>
                    <div id="NPSdiagramma" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php require_once("../../questionari/nps/NpsDiagram.php"); ?>
                    </div>
                    <script>
                        setQuestionariCompletati("nps", 1);
                    </script>
                <?php endif; ?>

                <?php if($flag_q_sus > 0) : ?>
                    <div id="SUSscore" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/tab_totSusScore.php"); ?>
                    </div>
                <?php $classactive = '' ?>
                    <div id="SUSboxchart" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/boxchart.php"); ?>
                    </div>
                    <div id="SUSchartscore" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/chartscore.php"); ?>
                    </div>
                    <div id="SUShistogram" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/histogram.php"); ?>
                    </div>
                    <div id="SUSlearnability" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/tab_TotSusLearnability.php"); ?>
                    </div>
                    <div id="SUSusability" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/sus/tab_TotSusUsability.php"); ?>
                    </div>
                    <script>
                        setQuestionariCompletati("sus", 1);
                    </script>
                <?php endif; ?>

                <?php if($flag_q_umux > 0) : ?>
                    <div id="UMUXscore" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/umux/tab_totUmuxScore.php"); ?>
                    </div>
                <?php $classactive = '' ?>
                    <div id="UMUXboxchart" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/umux/UmuxBoxchart.php"); ?>
                    </div>
                    <div id="UMUXchartscore" class="tab-pane fade in <?php echo $classactive; ?>">
                        <?php  require_once("../../questionari/umux/UmuxHistogram.php"); ?>
                    </div>
                    <script>
                        setQuestionariCompletati("umux", 1);
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
