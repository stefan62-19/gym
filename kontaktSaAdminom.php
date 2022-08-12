<?php
    include "pages/header.php";
    include "pages/nav.php";
    include "models/function.php";
    include "config/konekcija.php";
    //$autor=podaciAutor();
    //var_dump($autor);
?>  

                <?php
                    if(isset($_SESSION['korisnik'])):
                ?>
      <div class="col-md-6 footer2 wow bounceInUp" style="margin:auto;margin-bottom:50px;" data-wow-delay=".25s" id="contact">
        <div class="form-box"id="kontakt12">
          <h4 style="text-align:center;">KONTAKT SA ADMINISTRATOROM</h4>
          <textarea style="margin:auto;"id="textarea" name="w3review" rows="7" cols="50">
</textarea>
<button id="adminSub" class="btn btn-submit btn-sm mt-3">Pošalji</button>
        </div>
      </div>
               <?php endif ?>
               <?php
                    if(!isset($_SESSION['korisnik'])):
                ?>
            <div  style='display:flex;align-item:center;flex-direction:center;'><h1><b>Da bi ste kontaktirali administratora potrebno je da se prijavite</b></h1></div>
               <?php endif ?>
<?php 
  include "pages/footer.php"
?>