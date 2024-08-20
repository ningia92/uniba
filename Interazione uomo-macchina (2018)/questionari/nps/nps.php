<!DOCTYPE html>
<html>
<head>
<style>
div.send{
         float: right;
         margin-right: 2%;
         }
body{
	text-align: center;
}
.button {
    background-color: #F5F5F5;
    color: black;
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
    width:50px;
    height:40px;
    outline:none;

    border:none;
    border-bottom: 2px solid rgb(157, 157, 157);
    border-right: 2px solid rgb(157, 157, 157);

}

.button.button2 {background-color: #F5F5F5; color: black}
.button.button3 {background-color: #F5F5F5; color: black}
.button.button4 {background-color: #F5F5F5; color: black}
.button.button5 {background-color: #F5F5F5; color: black}
.button.button6 {background-color: #F5F5F5; color: black}
.button.button7 {background-color: #F5F5F5; color: black}
.button.button8 {background-color: #F5F5F5; color: black} /* giallo scuro */
.button.button9 {background-color: #F5F5F5; color: black} /* giallo */
.button.button10 {background-color: #F5F5F5; color: black} /*verde */
.button.button11 {background-color: #F5F5F5; color: black} /* verde scuro */

.button:hover{

    background-color: #b6b6b6;
}

.button.clicked{
    background-color: #1dc116; color: black
    opacity:0.4;
    filter: alpha(opacity=40);
    border:none;
    border-top: 2px solid rgb(157, 157, 157);
    border-left: 2px solid rgb(157, 157, 157);
}
</style>
</head>
<body>

<h2>QUESTIONARIO NPS</h2><hr>

<h4>Con quanta probabilit&#224 consiglieresti questo sito ad un amico o ad un conoscente?</h4>

<form name="myForm" action="<?php echo LIB_NPS_DIR;?>invia_nps.php" method="post" >
<?php
               $idutente = $loggedInUser->user_id;
               $idstudio = $_SESSION['idstudio'];
               echo'<form class="form-horizontal" id="form" name="form" action="questionari/invia_nps.php" method="post">
               <input type="hidden" name="idutente" value="'.$idutente.'">
               <input type="hidden" name="idstudio" value="'.$idstudio.'">';
 ?>
<input type="hidden" name="item" value="-1"></input> 
<div style="text-align:center;display: inline-block;padding:0px">
    <p style="width:55px;text-align:center;font-family:segoe ui;padding:0px;margin:0 auto;font-size:70%">Non lo consiglierei affatto</p>
    <input type ="button" onclick="btnClick(this)" class="button" value="0" name="btn_item" style="width:50px;margin:2px auto">
</div>
<input type ="button" onclick="btnClick(this)" class="button button2" value="1" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button3" value="2" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button4" value="3" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button5" value="4" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button6" value="5" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button7" value="6" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button8" value="7" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button9" value="8" name="btn_item">
<input type ="button" onclick="btnClick(this)" class="button button10" value="9" name="btn_item">
<div style="text-align:center;display: inline-block;padding:0px">
    <p style="width:55px;text-align:center;font-family:segoe ui;padding:0px;margin:0 auto;font-size:70%">Lo consiglierei sicuramente</p>
    <input type ="button" onclick="btnClick(this)" class="button button11" value="10" name="btn_item" style="width:50px;margin:2px auto">
</div>

<input type="submit" onclick="return validate()" class="btn btn-default" style="display:block;margin:0 auto;margin-top:2%;width:10%; background-color:#d0d0d0">

</form>

<script>

function validate(){

    var validationOk = document.forms["myForm"]["item"].value!=-1;

    if (!validationOk){

        window.alert("Per favore, inserire un valore");
    }

    return validationOk;
}

function btnClick(btn){

    document.forms["myForm"]["item"].value=btn.value;
    console.log(document.forms["myForm"]["item"].value);

    var buttons=document.getElementsByClassName("button");
    for (i=0;i<11;i++){


        if (buttons[i].getAttribute("Class").includes("clicked")){

            buttons[i].setAttribute("Class",buttons[i].getAttribute("Class").replace(" clicked",""));
        }
    }
    btn.setAttribute("Class",btn.getAttribute("Class")+" clicked");
}
</script>
</body>
</html>
