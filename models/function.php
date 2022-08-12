<?php
    function unosKorisnika($imePrezime,$pol, $email, $sifrovanaLozinka,$id_uloge){
        global $konekcija;

        $upit = "INSERT INTO korisnici(ime_prezime,pol, email, sifra,id_uloge) VALUES (:imePrezime,:pol, :email, :sifra,:id_uloge)";

        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':imePrezime', $imePrezime);
        $priprema->bindParam(':pol', $pol);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':sifra', $sifrovanaLozinka);
        $priprema->bindParam(':id_uloge', $id_uloge);
        $rezultat = $priprema->execute();
        return $rezultat;
    };
    function proveraLogovanje($email, $sifrovanaLozinka){
        global $konekcija;
        $upit = "SELECT * FROM korisnici k JOIN uloge u ON k.id_uloge=u.id_uloge WHERE k.email = :email AND k.sifra = :lozinka";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->execute(); 
        $rezultat="";      
        $rezultat = $priprema->fetch();
        return $rezultat;
    }
    function ispisPoKat($pod){
        global $konekcija;
        $upit="SELECT * from proizvodi  where id_kategorije=:kat";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':kat', $pod);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function sortiranjeCenaOpadajuce()
    {
        global $konekcija;
        $upit="SELECT * from proizvodi order by cena_nova desc";
        $priprema = $konekcija->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function cenaGore()
    {
        global $konekcija;
        $upit="SELECT* from proizvodi join kategorije on proizvodi.id_kategorije=kategorije.id_kategorije order by nova_cena asc";
        $priprema = $konekcija->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function cenaDole()
    {
        global $konekcija;
        $upit="SELECT* from proizvodi join kategorije on proizvodi.id_kategorije=kategorije.id_kategorije order by nova_cena desc";
        $priprema = $konekcija->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function nazivGore()
    {
        global $konekcija;
        $upit="SELECT* from proizvodi join kategorije on proizvodi.id_kategorije=kategorije.id_kategorije order by naziv_proizvoda asc";
        $priprema = $konekcija->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function nazivDole()
    {
        global $konekcija;
        $upit="SELECT* from proizvodi join kategorije on proizvodi.id_kategorije=kategorije.id_kategorije order by naziv_proizvoda desc";
        $priprema = $konekcija->prepare($upit);
        $priprema->execute();
        $rezultat = $priprema->fetchAll();
        return $rezultat;
    }
    function dohvatiSveKorisnike(){
        global $konekcija;
        $upit="SELECT* from korisnici";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function brisanjeKorisnika($id){
        global $konekcija;
        $upit="DELETE FROM korisnici where id_korisnika=:id";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function upisUAnketu($id,$mejl,$vrednost)
    {
        global $konekcija;
        $upit="INSERT into anketa(id_korisnika,mejl_korisnika,vrednost_glasanja)VALUES(:id,:mejl,:vrednost)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $priprema->bindParam(':mejl', $mejl);
        $priprema->bindParam(':vrednost', $vrednost);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function proveraGlasanja($id)
    {
        global $konekcija;
        $upit="SELECT* from anketa where id_korisnika=:id";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $priprema->execute();       
        $rezultat = $priprema->fetch();
        return $rezultat;
    }
    function prikazProsekaAnketa()
    {
        global $konekcija;
        $upit="SELECT avg(vrednost_glasanja) from anketa";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function opsegCena($pod)
    {
        global $konekcija;
        $upit="SELECT* FROM proizvodi where nova_cena<$pod";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function upisPorudzbineupisPorudzbine($pod,$imePrezime,$mejl)
    {
        global $konekcija;
        $upit="INSERT INTO porudzbina(id_kupca,ime_prezime_kupca,sadrzaj) VALUES(:imePrezime,:mejl,:podaci)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':imePrezime', $imePrezime);
        $priprema->bindParam(':mejl', $mejl);
        $priprema->bindParam(':podaci', $pod);
        $rezultat=$priprema->execute();
        return $rezultat;
    }
    function korpa($x){
        global $konekcija;
        $upit="SELECT* from proizvodi where naziv_proizvoda in(:x)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':x', $x);
        $priprema->execute();
        $rezultat=$priprema->fetch();
        return $rezultat;
    }
    function vratiProizvod($pod)
    {
        global $konekcija;
        $upit="SELECT * from proizvodi where naziv_proizvoda = :podaci";
        
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':podaci', $pod);
        $priprema->execute();
        $rezultat=$priprema->fetch();
        return $rezultat;
    }
    function vratiSve()
    {
        global $konekcija;
        $upit="SELECT * from proizvodi";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function podaciAutor()
    {
        global $konekcija;
        $upit="SELECT autor.ime_prezime,korisnici.email,autor.grad,autor.adresa,autor.obrazovanje,autor.trenutna_aktivnost,autor.hobi,autor.sposobnost from korisnici join autor on korisnici.id_korisnika=autor.id_korisnika where autor.autor=1";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function porudzbina($id,$imePrezime,$sadrzaj)
    {
        global $konekcija;
        $upit = "INSERT INTO porudzbina(id_kupca,ime_prezime_kupca,sadrzaj) VALUES (:id,:imePrezime, :sadrzaj)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $priprema->bindParam(':imePrezime', $imePrezime);
        $priprema->bindParam(':sadrzaj', $sadrzaj);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function maxCena()
    {
        global $konekcija;
        $upit="SELECT MAX(nova_cena) from proizvodi";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetch();
        return $rezultat;
    }
    function minCena()
    {
        global $konekcija;
        $upit="SELECT MIN(nova_cena) from proizvodi";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetch();
        return $rezultat;
    }
    function slanjePoruke($ime,$mejl,$poruka)
    {
        global $konekcija;
        $upit="INSERT into poruke(ime_prezime,mejl,poruka)values(:ime,:mejl,:poruka)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':mejl', $mejl);
        $priprema->bindParam(':poruka', $poruka);
        $rezultat = $priprema->execute();
        return $rezultat;

    }
    function dohvatiAnketu()
    {
        global $konekcija;
        $upit="SELECT * from anketa";
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function brisanjeGlasaAnketa($id){
        global $konekcija;
        $upit="DELETE FROM anketa where id_korisnika=:id";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function dohvatiPorudzbinu()
    {
        global $konekcija;
        $upit="SELECT* FROM porudzbina";
        //$priprema = $konekcija->prepare($upit);
        $rez=$konekcija->query($upit);
        $rezultat=$rez->fetchAll();
        return $rezultat;
    }
    function brisanjePorudzbine($id)
    {
        global $konekcija;
        $upit="DELETE FROM porudzbina where id_porudzbine=:id";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function brisanjeProizvoda($id)
    {
        global $konekcija;
        $upit="DELETE FROM proizvodi where id_proizvoda=:id";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':id', $id);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
    function upisiProizvod($ime,$staraCena,$novaCena,$zvezdice,$opis, $slikaAlt,$slikaSrc,$idKat)
    {
        global $konekcija;
        $upit="INSERT into proizvodi(naziv_proizvoda,stara_cena,nova_cena,zvezdice,opis,slika_src,slika_alt,id_kategorije)values(:ime,:staraCena,:novaCena,:zvezdice,:opis,:slikaSrc, :slikaAlt,:idKat)";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':staraCena', $staraCena);
        $priprema->bindParam(':novaCena', $novaCena);
        $priprema->bindParam(':zvezdice', $zvezdice);
        $priprema->bindParam(':opis', $opis);
        $priprema->bindParam(':slikaSrc', $slikaSrc);
        $priprema->bindParam(':slikaAlt', $slikaAlt);

        $priprema->bindParam(':idKat', $idKat);
        $rezultat = $priprema->execute();
        return $rezultat;
    }
?>