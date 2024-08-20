<?php
    include '../../components/ValutaMenu.php';
    use App\Components\ValutaMenu;

    require_once ("../../lib/config.php");

    if (! isUserLoggedInEsp()) {
        header("Location: " . ACCOUNT_DIR . "/login.php");
    }

    $_POST['tipomedia'] = 'video';
    if (isset($_SESSION['idstudio'])) {
        $_POST['idstudio'] = $_SESSION['idstudio'];
    } else if (! isset($_GET['idstudio'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $id_studio = $_GET['idstudio'];

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
    <title>Valutazione Studio<?php echo $websiteName; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo JS_DIR;?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_DIR;?>bootstrap.js"></script>
    <link href="<?php echo CSS_DIR;?>bootstrap.css" rel="stylesheet">

    <!-- Annotator -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="http://assets.annotateit.org/annotator/v1.2.7/annotator-full.min.js"></script>
    <link rel="stylesheet" href="http://assets.annotateit.org/annotator/v1.2.7/annotator.min.css">

    <!--video-js-->
    <link href="http://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <script src="../../recVideoAudio/lib/lib/video-js/video.min.js"></script>

    <!--Youtube Pluging-->
    <script src="../../recVideoAudio/lib/lib/video-js/vjs.youtube.js"></script>

    <!--RangeSlider Pluging-->
    <script src="../../recVideoAudio/lib/lib/rangeslider.min.js"></script>
    <link href="../../recVideoAudio/lib/lib/rangeslider.min.css" rel="stylesheet">

    <!--Share Pluging-->
    <script src="../../recVideoAudio/lib/lib/share-annotator.min.js"></script>
    <link href="../../recVideoAudio/lib/lib/share-annotator.min.css" rel="stylesheet">

    <!--Geolocation Pluging-->
    <script src="../../recVideoAudio/lib/lib/geolocation-annotator.min.js"></script>
    <link href="../../recVideoAudio/lib/lib/geolocation-annotator.min.css" rel="stylesheet">

    <!--RichText Pluging-->
    <script src="../../recVideoAudio/lib/lib/tinymce/tinymce.min.js"></script>
    <!--tinymce for richText-->
    <script src="../../recVideoAudio/lib/lib/richText-annotator.min.js"></script>
    <link href="../../recVideoAudio/lib/lib/richText-annotator.min.css" rel="stylesheet">

    <!--OpenVideoAnnotations Pluging-->
    <script src="../../recVideoAudio/lib/build/ova.min.js"></script>
    <link href="../../recVideoAudio/lib/build/ova.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php require_once '../inc/navbars/navbar_esperto.php';?>
    <input type="hidden" id="username" value="<?php echo $loggedInUser->clean_username?>">
    <div class="col-md-12 text-center">
        <h1>Video</h1>
        <h4><?php echo $r['obiettivo']; ?></h4>
    </div>
    <?php
        echo new ValutaMenu($id_studio);
    ?>
    <div class="col-md-9">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <table id="tabAudioVideo" class="display" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Utente</th>
                                <th>Obiettivo</th>
                                <th>Data completamento</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col col-lg-2"></div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2"></div>
                <div id="openannotatorbox"></div>
                <div class="col col-lg-2"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var tipomedia = "<?php echo $_POST['tipomedia'];?>";
        var i = 0;
        $('#tabAudioVideo').DataTable({
            "ajax": {
                "url": "/utassistant/recVideoAudio/recupera_audio_video.php",
                "type": "POST",
                "data": {
                    idstudio: <?php echo $id_studio; ?>,
                    tipomedia: "<?php echo $_POST['tipomedia'];?>"
                }
            },
            "columns": [{
                    "data": "username"
                },
                {
                    "data": "obiettivo"
                },
                {
                    "data": "data_completamento"
                },
                {
                    "data": null,
                    "fnCreatedCell": function(nTd, sData, oData) {
                        $(nTd).html("<button id=\"vid" + ++i + "\" type=\"button\" class=\"btn btn-primary\"'>Riproduci <?php echo $_POST['tipomedia'];?></button>");

                        var path = oData.path;
                        var namefile = path.substring(path.lastIndexOf("/") + 1, path.lenght);

                        var video_audio_src = '';
                        //	var video_audio_title = '';

                        if (tipomedia == "video") {
                            //	video_audio_title = '<h2 id="vid' + i + 'title">Stai analizzando il file video:' + namefile +'</h2>';
                            video_audio_src =
                                '<video id="vid' + i + '" muted class="video-js vjs-default-skin" controls autoplay preload="none" width="860" height="630" data-setup="">' +
                                '<source src="<?php echo $websiteUrl; ?>' + path + '" type="video/webm" />' +
                                '<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>' +
                                '</video>';
                        } else {
                            //	video_audio_title = '<h2 id="vid' + i + 'title">Stai analizzando il file audio:'+ namefile +'</h2>';
                            video_audio_src =
                                '<video id="vid' + i + '" class="video-js vjs-default-skin" controls autoplay preload="none" width="700" height="300" data-setup="">' +
                                '<source src="<?php echo $websiteUrl; ?>' + path + '" type="audio/wav" />' +
                                '<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>' +
                                '</video>';
                        }

                        $("#openannotatorbox").append(video_audio_src);
                    }
                }
            ],
            "initComplete": function() {

                var options = {
                    optionsAnnotator: {
                        permissions: {},

                        //auth: {tokenUrl:'http://catch.aws.af.cm/annotator/token'},

                        store: {
                            // The endpoint of the store on your server.
                            //prefix: 'http://afstore.aws.af.cm/annotator',
                            prefix: 'http://danielcebrian.com/annotations/api',

                            annotationData: {
                                uri: 'http://danielcebrian.com/annotations/demo.html'
                            },

                            loadFromSearch: {
                                limit: 10000,
                                uri: 'http://danielcebrian.com/annotations/demo.html',
                            }
                        },
                        richText: {
                            tinymce: {
                                selector: "li.annotator-item textarea",
                                plugins: "media image insertdatetime link code",
                                menubar: false,
                                toolbar_items_size: 'small',
                                extended_valid_elements: "iframe[src|frameborder|style|scrolling|class|width|height|name|align|id]",
                                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media rubric | code ",
                            }
                        },
                    },
                    optionsVideoJS: {
                        techOrder: ["html5", "flash", "youtube"]
                    },
                    optionsRS: {},
                    optionsOVA: {
                        posBigNew: 'none'
                    },
                }

                var ova = new OpenVideoAnnotation.Annotator($('#openannotatorbox'), options);

                //change the user (Experimental)
                ova.setCurrentUser(<?php echo $loggedInUser->user_id;?>);
                $("#openannotatorbox").hide();
            }
        });
        $(document).on("click", "button", function() {
            var id = $(this).attr("id");
            $("div[id^='vid']").hide().addClass("center-block");
            $("#openannotatorbox").show();
            $("div#" + id).slideToggle(400, 'swing', function() {
                $("html, body").animate({
                    scrollTop: $('#openannotatorbox').offset().top
                }, "slow");
            });
        });
    </script>
</body>
</html>