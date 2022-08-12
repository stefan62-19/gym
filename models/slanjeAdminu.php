<?php
session_start();
header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija2.php";
        include "function.php";

        try{
            $pod = $_POST['podaci'];
            //var_dump($_SESSION['korisnik']);
            if(isset($_SESSION['korisnik']))
            {
                $imePrezime=$_SESSION['korisnik']->ime_prezime;
                $mejl=$_SESSION['korisnik']->email;
            }
            else{
                $imePrezime=$_POST['imePrezime'];
                $mejl=$_POST['email'];
            }
            
            $poruka = slanjePoruke($imePrezime,$mejl,$pod);
            if($poruka)
            {
                echo json_encode("Poruka je dostavljena administratoru");
                http_response_code(200);
            }
            else{              
                echo json_encode("Došlo je do greške");
                http_response_code(500);
            }
           
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>