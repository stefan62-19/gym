<?php session_start();?>
<button id="myBtn" title="Go to top"><span class="material-icons md-dark">keyboard_arrow_up</span></button>
<div id="posleKorpa" class="container-fluid pl-0 pr-0 bg-img clearfix parallax-window2" data-parallax="scroll" data-image-src="assets/images/banner2.jpg">
  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container"> 
      <a class="navbar-brand mr-auto" href="#"><img src="assets/images/logo.png" alt="FoxPro" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> 
        <span class="navbar-toggler-icon"></span> </button>     
      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto" id="meni">
        <?php
    require_once "config/konekcija.php"; 
    if($konekcija)
    {      
        $upit = "select * from nav_menu";
        $rezultat=$konekcija->query($upit);
        $html="";
        if(isset($_SESSION['korisnik']))
        {
          foreach($rezultat as $red) 
          {
          $html.= "<li><a href=".$red['meni_href'].">".$red['meni_ime']."</a></li>&nbsp &nbsp &nbsp";
          } 
          $html.="<li><a href='models/odjava.php'>Odjavite se</a></li>";
      
        }
        else{
          foreach($rezultat as $red) 
          {
          $html.= "<li><a href=".$red['meni_href'].">".$red['meni_ime']."</a></li>&nbsp &nbsp &nbsp";
          }
        }
    }
    else{
        echo "Nema konekcije sa bazom";
    }
    echo($html);
        ?>
                    
        <ul class="navbar-nav ml-5">
          <li class="nav-item"> <a class="nav-link btn btn-danger" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container">
    
    <div class="fh5co-banner-text-box">
      <div class="quote-box pl-5 pr-5 wow bounceInRight">
        <h2 style="text-align: center;"> Teretana i Fitnes <br><span style="text-align: center;">FoxPro</span> </h2>
      </div>
      <a href="index.php #autor" class="btn text-uppercase btn-outline-danger btn-lg mr-3 mb-3 wow bounceInUp">Autor</a> <a href="dokumentacija62_19.pdf" class="btn text-uppercase btn-outline-danger btn-lg mb-3 wow bounceInDown"> Dokumentacija</a> <br>
      <?php
                    if(isset($_SESSION['korisnik'])):
                ?>
<a href="anketa.php" class="btn text-uppercase btn-outline-danger btn-lg mr-3 mb-3 wow bounceInUp">Anketa</a>
<?php endif ?>
    </div>
  </div>
</div>