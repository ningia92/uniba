<?php
require_once ("../../lib/config.php");

if (! isUserLoggedInEsp()) {
    header("Location: " . ACCOUNT_DIR . "/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Valutazione Studio<?php echo $websiteName; ?> </title>
<script type="text/javascript" src="<?php echo JS_DIR;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>bootstrap.js"></script>
<link href="<?php echo CSS_DIR;?>bootstrap.css" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Annotator -->
<!-- <script src="<?php echo JS_DIR;?>jquery.min.js"></script> -->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>annotator-full.min.js"></script>
<link rel="stylesheet"
	href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>annotator.min.css">

<!--video-js-->
<link href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>video-js/video-js.css"
	rel="stylesheet">
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>video-js/video.min.js"></script>

<!--youtube-js-->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>video-js/vjs.youtube.js"></script>

<!--RangeSlider Pluging-->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>rangeslider.min.js"></script>
<link href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>rangeslider.min.css"
	rel="stylesheet">

<!--Share Pluging-->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>share-annotator.min.js"></script>
<link href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>share-annotator.min.css"
	rel="stylesheet">

<!--Geolocation Pluging-->
<script
	src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>geolocation-annotator.min.js"></script>
<link
	href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>geolocation-annotator.min.css"
	rel="stylesheet">

<!--RichText Pluging-->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>tinymce/tinymce.min.js"></script>
<!--tinymce for richText-->
<script
	src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>richText-annotator.min.js"></script>
<link
	href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>richText-annotator.min.css"
	rel="stylesheet">

<!--OpenVideoAnnotations Pluging-->
<script src="<?php echo LIB_RECVIDEOAUDIO_DIR;?>ova.min.js"></script>
<link href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>ova.min.css"
	rel="stylesheet">

<!--Demo CSS-->
<link href="<?php echo LIB_RECVIDEOAUDIO_DIR;?>demo.css"
	rel="stylesheet">

</head>
<body>

        <?php require_once("../inc/navbars/navbar_esperto.php"); ?>
        <div class="container">
		<div class="col-md-1"></div>
		<div class="col-md-10  well" id="bg">
			<div id="annotationdiv">
                <?php
                
if (isset($_GET['path']) && isset($_GET['tipomedia'])) {
                    if ($_GET['tipomedia'] == "video") {
                        ?><h2>Stai analizzando il file video: <?php echo nameFile($_GET['path']);?></h2>
				<video id="vid4" muted class="video-js vjs-default-skin" controls
					preload="none" width="860" height="630" data-setup="">
				<source src="<?php echo $_GET['path'];?>" type="video/webm" />
					<track kind="captions" src="demo.captions.vtt" srclang="en"
						label="English"></track>
				</video>
              <?php
                    
} else {
                        
                        ?>
                    <h2>Stai analizzando il file audio: <?php echo nameFile($_GET['path']);?></h2>
				<audio id="vid4" class="video-js vjs-default-skin" controls
					preload="none" width="700" height="300" data-setup="">
					<source src="<?php echo $_GET['path'];?>" type="audio/wav" />
					<track kind="captions" src="demo.captions.vtt" srclang="en"
						label="English"></track>
				</audio>
                    <?php
                    }
                } else {
                    echo "<h3>Errore caricamento media!</h3>";
                }

                function nameFile($path)
                {
                    $pieces = explode("/", $path);
                    return $pieces[count($pieces) - 1];
                }
                ?>

                </div>
		</div>
		<div class="col-md-1"></div>

	</div>
	<script>
            
      /*      if (JSON.parse(sessionStorage.getItem('idStudio'))[1] == "video")
            {
                $("#annotationdiv").append('<div><h2>Stai analizzando il file video:'+sessionStorage.getItem("datoVideo").split("/")[(sessionStorage.getItem("datoVideo").split("/")).length -1]+'</h2></div><video id="vid4" muted class="video-js vjs-default-skin" controls preload="none" width="860" height="630" data-setup="">' +
                        '<source src="' + sessionStorage.getItem("datoVideo") + '" type="video/webm" />' +
                        '<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>' +
                        '</video>');
            } else {
                $("#annotationdiv").append('<div><h2>Stai analizzando il file audio:'+sessionStorage.getItem("datoAudio").split("/")[(sessionStorage.getItem("datoAudio").split("/")).length -1]+'</h2></div><audio id="vid4" class="video-js vjs-default-skin" controls preload="none" width="700" height="300" data-setup="">' +
                        '<source src="' + sessionStorage.getItem("datoAudio") + '" type="audio/wav" />' +
                        '<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>' +
                        '</audio>');
            }*/
        </script>


	<script>
//Options to load in Open Video Annotation, for all the plugins
            var options = {
                optionsAnnotator: {
                    permissions: {},
                    store: {
                        // The endpoint of the store on your server.
                        prefix: 'http://danielcebrian.com/annotations/api/',
                        annotationData: {uri: 'http://danielcebrian.com/annotations/demo.html'},
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
                    share: {}, //Share plugin
                    annotator: {}, //Annotator core
                },
                optionsVideoJS: {techOrder: ["html5", "flash", "youtube"]},
                optionsRS: {},
                optionsOVA: {posBigNew: 'none'/*,NumAnnotations:20*/},
            }
//Load the plugin Open Video Annotation
            var ova = new OpenVideoAnnotation.Annotator($('#annotationdiv'), options);
        </script>

</body>
</html>
