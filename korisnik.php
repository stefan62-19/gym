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
                <div class="container-fluid fh5co-network">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4 class="wow bounceInUp">Postigni više!</h4>
        <h2 class="wow bounceInRight">Personalni trener</h2>
        <hr />
        <h5 class="wow bounceInLeft">POSVEĆENI
          VAMA</h5>
        <p class="wow bounceInDown">Početnik ili ne, personalni trener ti pomaže da ostaneš
          fokusiran i brže ostvariš svoje ciljeve!
          Radi 24 sata*, svakog dana u godini.
          Naše lokacije su za vas otvorene i tokom praznika!</p>
      </div>
      <div class="col-md-6">
        <figure class="wow bounceInDown"> <img src="assets/images/about-img.jpg" alt="gym" class="img-fluid" /> </figure>
      </div>
    </div>
  </div>
</div>

<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="assets/images/about-us-bg.jpg">
  <div class="container">
    <div class="col-sm-6 offset-sm-6" id="onama">
      <h2 class="wow bounceInLeft" data-wow-delay=".25s">O nama</h2>
      <hr/>
      <p class="wow bounceInRight" data-wow-delay=".25s">FoxPro teretane su napravljene sa osnovnom idejom da svojim klijentima i svim vežbačima pruže odlične uslove za treniranje. Stotine najrazličitijih, vrhunskih sprava za vežbanje vas čekaju u svim FoxPro teretanama. Vrhunska ventilacija, higijena i moderne radne jedninice čine FoxPro teretane među najboljim teretanama u regionu.
        Lanac FoxPro teretana je nastao iz ljubavi prema sportu, a praćen je predanošču i velikom posvećenošću vežbanju. Naša misija je da neprestano poboljšavamo uslove vežbanja, kako u Beogradu, tako i u ostalim gradovima. 
      </p>
    <div id="skloni">
      <a class="btn btn-lg btn-outline-danger d-inline-block text-center mx-auto wow bounceInDown"id="pvise">Više</a> 
    </div>
  </div>
  </div>
</div>
<div class="container-fluid fh5co-content-box">
  <div class="container">
    <div class="row">
      <div class="col-md-5 pr-0"><img src="assets/images/rode-gym.jpg" alt="gym" class="img-fluid wow bounceInLeft" /> </div>
      <div class="col-md-7 pl-0">
        <div class="wow bounceInRight" data-wow-delay=".25s">
          <div class="card-img-overlay" style="top: 12%;">
            <p id="vise">Naš cilj je da svima pružimo najbolje moguće uslove za vežbanje i da pomognemo svima onoliko koliko smo u mogućnosti.<br>
              FoxPro JE PROGLAŠEN NAJBOLJIM KLUBOM U DRŽAVI U BODIBILDINGU I FITNESU ZA 2019. I 2020. GODINU.<br>
              Ponosni smo da pored ispunjavanja svojih društvenih obaveza , veliku pažnju pridajemo i humanitarnim akcijama.<br>
Ovo su samo neke od njih…
            </p>
          </div>
          <img src="assets/images/gym-girls.jpg" alt="girls in gym" class="img-fluid" /> </div>
      </div>
    </div>
    <div class="row trainers pl-0 pr-0"id="treneri">
      <div class="col-12 bg-50">
        <div class="quote-box2 wow bounceInDown" data-wow-delay=".25s">
          <h2> Treneri </h2>
        </div>
      </div>
      <div class="col-md-6 pr-5 pl-5">
        <div class="card text-center wow bounceInLeft" data-wow-delay=".25s"> <img class="card-img-top rounded-circle img-fluid" src="assets/images/trainers1.jpg" alt="Card image">
          <div class="card-body mb-5">
            
            <p class="card-text" id="petar" style="text-align: left;">
            <?php
            include "config/konekcija.php";
            if($konekcija)
            {      
            $upit = "select* from treneri inner join opis_posla on treneri.id_trenera=opis_posla.id_trenera where treneri.id_trenera=2";
            $rezultat=$konekcija->query($upit);
            
            $ispis="";
            
            foreach($rezultat as $red) 
                {
                
                $ispis.="<h1>".$red['ime_trenera']."</h1><br>
                <span>Rodjen:".$red['datum_rodjenja']."</span><br>
                mail: <a href='".$red['mejl']."'>".$red['mejl']."</a>.<br>
                telefon: <a href='".$red['telefon']."'>".$red['telefon']."</a><br>
                <span>".$red['opis']."</span>";
                
                }
            }
            else{
                echo "Nema konekcije sa bazom";
            }
            echo($ispis);
        ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6 pl-5 pr-5">
        <div class="card text-center wow bounceInRight" data-wow-delay=".25s"> <img class="card-img-top rounded-circle img-fluid" src="assets/images/trainers2.jpg" alt="Card image">
          <div class="card-body mb-5">
            
            <p class="card-text" id="marko"style="text-align: left;">
            <?php
            include "config/konekcija.php";
            if($konekcija)
            {      
            $upit = "select* from treneri inner join opis_posla on treneri.id_trenera=opis_posla.id_trenera where treneri.id_trenera=1";
            $rezultat=$konekcija->query($upit);
            
            $ispis="";
            
            foreach($rezultat as $red) 
                {
                
                $ispis.="<h1>".$red['ime_trenera']."</h1><br>
                <span>Rodjen:".$red['datum_rodjenja']."</span><br>
                mail: <a href='".$red['mejl']."'>".$red['mejl']."</a>.<br>
                telefon: <a href='".$red['telefon']."'>".$red['telefon']."</a><br>
                <span>".$red['opis']."</span>";
                
                }
            }
            else{
                echo "Nema konekcije sa bazom";
            }
            echo($ispis);
        ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 bg-50">
        
          <h2 style="text-align:center;"> Cenovnik </h2>
        
      
    <div class="row gallery">
    
            <?php
            include ("models/cenovnik.php");
            ?>
    </div>
    <div class="row" id="autor">
      <div class="col-md-6">
        <div class="card"> <img class="card-img-top img-fluid wow bounceInUp" data-wow-delay=".25s" src="assets/images/me.jpg" alt="Card image">
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body mb-4 wow bounceInLeft" data-wow-delay=".25s">
          <?php                     
          $rezultat=podaciAutor();       
          if($rezultat[0]):
          ?>
            <h4 class="card-title">AUTOR</h4>
            <p class="card-text"><b>Ime i prezime:</b>&nbsp<?= $rezultat[0]->ime_prezime ?></p><br>
            <p class="card-text"><b>Grad:</b>&nbsp<?= $rezultat[0]->grad ?></p><br>
            <p class="card-text"><b>Adresa:</b>&nbsp<?=  $rezultat[0]->adresa ?></p><br>
            <p class="card-text"><b>Obrazovanje:</b> &nbsp <?=  $rezultat[0]->obrazovanje ?></p><br>
            <p class="card-text"><b>Trenutno:</b>&nbsp<?=  $rezultat[0]->trenutna_aktivnost ?></p><br>
            <p class="card-text"><b>Hobi:</b>&nbsp<?=  $rezultat[0]->hobi ?></p><br>
            <p class="card-text"><b>Sposobnosti:</b>&nbsp<?= $rezultat[0]->sposobnost ?></p>
            <p>

            </p>
            <?php endif ?>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>


<?php
    include "pages/footer.php";
?>