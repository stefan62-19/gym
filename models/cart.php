<?php
        session_start();   
        header("Content-type: application/json");
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            include "../config/konekcija2.php";
            include "function.php";
            $kupac=$_SESSION['korisnik'];
            $id=$kupac->id_korisnika;
            $imePrezime=$kupac->ime_prezime;
            //var_dump($kupac);
            $podaci=$_POST['podaci'];
            $rez=porudzbina($id,$imePrezime,$podaci);
            if(strlen($podaci)>3)
            {
                
            
            if($rez)
            {
                echo json_encode("Vaša porudzbina je kreirana");
                http_response_code(201);
            }
            else{
                echo json_encode("Greska sa porudzbinom, pokušajte kasnije");
                http_response_code(500);
            }
        }
        else{
            echo json_encode("Nemate nista u korpi");
        }
        }
        else
        {
            http_response_code(404);
        }
        
?>
