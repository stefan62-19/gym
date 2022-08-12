 <?php
    //session_start();
    include "pages/header.php";
    include "pages/nav.php";
    //include "models/function.php";
    
?>
<?php if(isset($_SESSION['korisnik'])):?>

<div class="row" style="margin:auto;display:flex;align-item:cenetr;justify-content:center;margin-bottom:50px">

<h1>Koju ocenu bi ste nam dali</h1>
<form id="forma" style="width:70%;">
<p id='prt'><input type="radio" value="1" name="rdb">1</p>
<p><input type="radio"value="2" name="rdb">2</p>
<p><input type="radio" value="3"name="rdb">3</p>
<p><input type="radio"value="4" name="rdb">4</p>
<p><input type="radio"value="5" name="rdb">5</p>
<span style="margin:auto;"><input style="padding:10px;" type="button" id="anketa" value="pošalji"></span><br>
<span id='prosek'></span>
</form>
</div>

<?php endif;?>

<?php include "pages/footer.php"?>