<?php
    include "config/konekcija2.php";
?>
<?php
        global $konekcija;
        $upit="SELECT * FROM cenovnik";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        $html="";
        for($i=0;$i<count($rezultat);$i++)
        {
            echo
            "<div class='col-lg-4 col-md-6 mb-4' id=' hover'>
              <div class='card h-100' id=".$rezultat[$i]->naziv_cenovnika."  style='color:white;text-align:center;border-radius:20px;'>
              <h3>".$rezultat[$i]->naziv_cenovnika."</h3><br>
              <h2>".$rezultat[$i]->cena."RSD</h2><br>
              <h5>".$rezultat[$i]->period."</h5><br>
              <h6>".$rezultat[$i]->opis."</h6><br>
              <p>".$rezultat[$i]->lokacija."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->vreme."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->kolicina."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->vrsta."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->dodatak."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->zona."<span class='material-icons md-dark'>done</span></p><br>
              <p>".$rezultat[$i]->grupe."<span class='material-icons md-dark'>done</span></p><br>
              </div>
            </div>";
        }
?>
