<?php
    include '../components/ValutaMenu.php';
    use App\Components\ValutaMenu;

    require_once("../lib/config.php");
    include_once("sankey_db.php");

    if (!isUserLoggedInEsp()) {
        header('Location: login.php');
    }

    unset($_SESSION['ob']); //distruggo la variabile di sessione con l'obiettivo del task per visualizzazione Sankey
    unset($_SESSION['ist']); //distruggo la variabile di sessione con la descrizione del task per visualizzazione Sankey
    unset($_SESSION['task_id']); //distruggo la variabile di sessione con l'id task creata per visualizzazione Sankey
    unset($_SESSION['pagine']); //distruggo la variabile di sessione flag per visualizzare l'icona "pagine" nella navbar

    if (! isset($_SESSION['idstudio'])){
        $_SESSION['idstudio'] = $_GET['idstudio'];
        $id_studio = $_SESSION['idstudio'];
    } else {
        $id_studio = $_SESSION['idstudio'];
    }
?>

<?php require '.././smt2/config.php'; ?>
<?php include INC_DIR.'header.php'; ?>

<!DOCTYPE HTML>
<html>
	<head>
        <title>Tasks Sankey Diagram UTAssistant</title>
        <style>
            .h5 {color:black; position: relative;  right:-19px; top: -95px;}
        </style>
	</head>
	<body>
        <?php require_once("../app/inc/navbars/navbar_esperto.php"); ?>
        <?php
            $ob_studio = ob_studio($id_studio);
            $r = $db->sql_fetchrow($ob_studio);
        ?>
        <div class="col-md-12 text-center">
            <h1>Sankey Diagram</h1>
            <h4><?php echo $r['obiettivo'] ?></h4>
        </div>
		<div class="container-fluid">
            <div class="row">
                <?php
                    echo new ValutaMenu($id_studio);
                ?>
                <div class="col-md-9">
                    <div class="panel panel-default">
                    <div class="panel-heading"><b>Tasks</b></div>
                    <div class="panel-body">
                    <form action="tasks_studio_2.php" method="post">
                        <?php
                            echo '<table class="table table-hover"><tr><th>Obiettivo</th><th>URL Principale</th><th>Azioni</th></tr><tbody>';

                            //Recupero le informazioni sui tasks del caso di studio in questione
                            $Dati = info_task($id_studio);
                            while($row = mysql_fetch_array($Dati)) {

                                //visualizzo in tabella obiettivi dei tasks e url principale inviando al click idtask e url
                                echo '<tr><td>'
                                .$row["obiettivo"].'</td>
                                <td>'.$row["url"].'<input id="url_" type="hidden" name="url_" value="'.$row["url"].'"></input></td>
                                <td><button type="submit" class="btn btn-default btn-sm" name="task_id" value="'.$row["id_task"].'" checked="checked"><span class="glyphicon glyphicon-fire"></span>&nbsp;Sankey Diagram</button>
                                </td></tr>';
                            }
                        ?>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
		</div>
	</body>
</html>
