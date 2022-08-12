<?php 
//session_start();
  include "pages/header.php";
  include "pages/nav.php";
?>
    <div class="w3-content w3-section" style="margin: auto;">
      <img class="mySlides" src="assets/images/slider1.PNG" style='width:100%;' >
      <img class="mySlides" src="assets/images/slider2.PNG" style='width:100%;'>
      <img class="mySlides" src="assets/images/slider3.PNG" style='width:100%;'>
    </div>
    <div class="box">
    <div class=col-lg-2>
      <div class="card p-3 mt-4" id="cart">
        <label id="cartdod" for=""><span class="material-icons md-dark"style="font-size:50px">shopping_cart</span></label>
        <div id="cart-content"></div>
      </div>
      <div id='treci'style="background-color:white;border: 1px solid rgba(0,0,0,.125);">
        <label >Opseg cene u dinarima &nbsp;</label><br><span style=" color: black; " id="range1"></span><input type="range" min=200 max=990 id="range" /><span id="range2" style=" color: black; "></span>
       </div>
      
        <div id='drugi'>
          <select id='ddlB' style="width:100%;">
            <option value="">Sortiraj</option>
              <option value="nazivDoGore">Od A-Z</option>
              <option value="nazivDoDole">Od Z-A</option>
              <option value="cenaDoGore">Cena rastuce</option>
              <option value="cenaDoDole">Cena opadajuce</option>
          </select>
      </div>
      <div class="row" id="row1">
        <div id='prvi'>
            <select name='name' id='ddl'style="width:100%;">
            <?php
              include "config/konekcija2.php";
            if($konekcija)
            {
              $upit="SELECT* FROM kategorije";
              $priprema = $konekcija->query($upit);
              $rezultat = $priprema->fetchAll();
              $ispis="";  
              foreach($rezultat as $red){
                $ispis .= "<option class='list-group-item' value='".$red->id_kategorije."'>
                ".$red->naziv_kat."
              </option>";
              }
             echo ($ispis);
            }
            ?> 
            </select>
        </div>
    </div>
    </div>
    <div class="row" id="proizvodi" class="col-md-8">
    
    <?php
      include "config/konekcija2.php";
      
      if($konekcija)
            {
              $upit="SELECT* FROM proizvodi JOIN kategorije on proizvodi.id_kategorije=kategorije.id_kategorije";
              $priprema = $konekcija->query($upit);
              $rezultat = $priprema->fetchAll();
              $ispis="";
                foreach($rezultat as $red){
                    $br=$red->zvezdice;
                    $zvzIspis="";
                      for($i=0;$i<$br;$i++)
                      {
                          $zvzIspis.="<span class='material-icons md-dark'>star</span>";
                      }
                      for($n=0;$n<5-$br;$n++)
                      {
                          $zvzIspis.="<span style='color:orange;'class='material-icons md-dark'>star_border</span>";
                      }                  
                        $ispis.="<div class='col-lg-4 col-md-6 mb-4' id='raspored' >
                        <div class='card h-100'>
                        <a href='#'><img class='card-img-top' src='assets/images/".$red->slika_src."'alt='".$red->slika_alt."'></a>
                          <div class='card-body' style='display: grid'> 
                            <h4 class='card-title'>
                              <h2 style='color:orange;'>".$red->naziv_proizvoda."</h1>
                            </h4>
                            <p class='card-text'>".$red->naziv_kat."</p>
                            <p>".$zvzIspis."</p>
                            <h5>".$red->nova_cena."RSD</h5>
                            <s>".$red->stara_cena. "RSD</s><p>
                            <p class='card-text'>".$red->opis."</p>
                            <button class='btn korpa' data-naziv='".$red->naziv_proizvoda."'  data-name='".$red->id_proizvoda."'>Ubaci u korpu</button>            
                          </div>          
                        </div>                        
                      </div>";
                      };               
              echo ($ispis);
            }
    ?>
    </div>
</div>
<div id="baza">
</div>
<?php 
  include "pages/footer.php"
?>