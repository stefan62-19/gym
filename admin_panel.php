<?php
    include "pages/header.php";
    include "pages/nav.php";
    include "config/konekcija2.php";
    include "models/function.php";
    
    $sviKorisnici=dohvatiSveKorisnike();
    $anketa=dohvatiAnketu();
    $porudzbina=dohvatiPorudzbinu();
    $proizvodi=vratiSve();
    //var_dump($sviKorisnici);

?>
<?php if(isset($_SESSION['korisnik'])):?>


<?php if($_SESSION['korisnik']->ime_uloge=='admin'):?>
    
    <?php 
        include "pages/formProizvod.php";
        ?>
<h1 style=" background:#ffebbb;   color: #ff8013;text-align:center;width:100%">Proizvodi</h1>
<div id="porudzbinaAdmin" style="display:flex;justify-content:center;align-item:center;margin-bottom:50px">
<table id="porudzbinaTb"style="border-collapse: collapse;">
<tr>
<tr><td>Id proizvoda</td>
        <td>naziv_proizvoda</td>
        <td>stara_cena</td>
        <td>nova_cena</td>
        <td>zvezdice</td>
        <td>opis</td>
        <td>slika_src</td>
        <td>slika_alt</td>
        <td>id_kategorije</td>
<?php
for($i=0;$i<count($proizvodi);$i++)
    {
        echo "<tr><td>".$proizvodi[$i]->id_proizvoda."</td>
        <td>".$proizvodi[$i]->naziv_proizvoda."</td>
        <td>".$proizvodi[$i]->stara_cena."</td>
        <td>".$proizvodi[$i]->nova_cena."</td>
        <td>".$proizvodi[$i]->zvezdice."</td>
        <td>".$proizvodi[$i]->opis."</td>
        <td>".$proizvodi[$i]->slika_src."</td>
        <td>".$proizvodi[$i]->slika_alt."</td>
        <td>".$proizvodi[$i]->id_kategorije."</td>
        <td><input type='button' class='btnProizvod btn' value='izbrisi' data-id='".$proizvodi[$i]->id_proizvoda."'/></td>";
    }
    
?>
</table>
</div>
<h1 style="background:#ffebbb;   color: #ff8013;text-align:center;width:100%">Korisnici</h1>
<div id="panel" style="display:flex;justify-content:center;align-item:center;">
<table id="korTb"style="border-collapse: collapse;">
<tr>
<tr><td>Id korisnika</td>
        <td>Ime i prezime</td>
        <td>Pol</td>
        <td>Email</td>
        <td>Sifra</td>
        <td>Datum Registracije</td>
        <td>Id uloge</td>
<?php
for($i=0;$i<count($sviKorisnici);$i++)
    {
        echo "<tr><td>".$sviKorisnici[$i]->id_korisnika."</td>
        <td>".$sviKorisnici[$i]->ime_prezime."</td>
        <td>".$sviKorisnici[$i]->pol."</td>
        <td>".$sviKorisnici[$i]->email."</td>
        <td>".$sviKorisnici[$i]->sifra."</td>
        <td>".$sviKorisnici[$i]->datum_registracije."</td>
        <td>".$sviKorisnici[$i]->id_uloge."</td>
        <td><input type='button' class='btnA btn' value='izbrisi' data-id='".$sviKorisnici[$i]->id_korisnika."'/></td>";
    }
    
?>
</table>
</div>
<h1 style="background:#ffebbb;   color: #ff8013;text-align:center;width:100%">Anketa</h1>
<div id="anketaPanel" style="display:flex;justify-content:center;align-item:center;">
<table id="anketaTb"style="border-collapse: collapse;">
<tr>
<tr><td>Id korisnika</td>
        <td>Email_korisnika</td>
        <td>vrednost_glasanja</td>

<?php
for($i=0;$i<count($anketa);$i++)
    {
        echo "<tr><td>".$anketa[$i]->id_korisnika."</td>
        <td>".$anketa[$i]->mejl_korisnika."</td>
        <td>".$anketa[$i]->vrednost_glasanja."</td>
        <td><input type='button' class='btnI btn' value='izbrisi' data-id='".$anketa[$i]->id_korisnika."'/></td>";
    }
    
?>
</table>
</div>
<h1 style="background:#ffebbb;   color: #ff8013;text-align:center;width:100%">Porudzbine</h1>
<div id="porudzbinaAdmin" style="display:flex;justify-content:center;align-item:center;margin-bottom:50px">
<table id="porudzbinaTb"style="border-collapse: collapse;">
<tr>
<tr><td>Id porudzbine</td>
        <td>id_kupca</td>
        <td>ime_prezime_kupca</td>
        <td>sadrzaj</td>
<?php
for($i=0;$i<count($porudzbina);$i++)
    {
        echo "<tr><td>".$porudzbina[$i]->id_porudzbine."</td>
        <td>".$porudzbina[$i]->id_kupca."</td>
        <td>".$porudzbina[$i]->ime_prezime_kupca."</td>
        <td>".$porudzbina[$i]->sadrzaj."</td>
        <td><input type='button' class='btnPorudzbina btn' value='izbrisi' data-id='".$porudzbina[$i]->id_porudzbine."'/></td>";
    }
    
?>
</table>
</div>
</table>
</div>


<?php endif ?>
<?php if($_SESSION['korisnik']->ime_uloge=='korisnik'):?>
    <div style="height:200px ;display:flex;align-item:center;justify-content:center;">
    <h1 style="font-size:50px;text-align:center;">Vi niste administrator</h1>
</div>
<?php endif ?>
<?php endif ?>
<?php if(!isset($_SESSION['korisnik'])):?>
<div style="height:200px ;display:flex;align-item:center;justify-content:center;">
    <h1 style="font-size:50px;text-align:center;">Vi niste autorizovani korisnik kategorije administrator</h1>
</div>
<?php endif ?>
<?php include "pages/footer.php"?>