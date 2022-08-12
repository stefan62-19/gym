<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija.php";
        include "function.php";
        try{
            $imePrezime = $_POST['imeprezime'];
            $pol=$_POST['pol'];
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            // provera podataka
            // var_dump($imePrezime);
            // var_dump($pol);
            // var_dump($email);
            // var_dump($lozinka);
            $sifrovanaLozinka = md5($lozinka);
            $idUloga = 2;
            $greske=[];
            //$regImePrezime='/^[A-ZŽČĆĐŠ][a-zžćčđš]{2,15}\s[A-ZŽČĆĐŠ][a-zžćčđš]{2,15}$/';
            $regemail='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            $regpass='/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/';
            $polNiz=['M','Z'];
            // if(!preg_match($regImePrezime,$imePrezime));{
            //     array_push($greske,"Greska Ime prezime");
            // }
            if(!preg_match($regemail,$email)){
                array_push($greske,"Greska email");
            }
            if(!preg_match($regpass,$lozinka)){
                array_push($greske,"Greska password");
            }
            if(!in_array($pol, $polNiz)){
                array_push($greske,"Niste izabrali pol");
            }
            if(empty($greske))
            {
                $unosKorisnika = unosKorisnika($imePrezime,$pol, $email, $sifrovanaLozinka,$idUloga);
                
                if($unosKorisnika)
                {
                    $odgovor = ["poruka"=>"Uspešan unos"];
                    echo json_encode($odgovor);
                    http_response_code(201);
                }
            }
            else
            {
                $odg=implode(",",$greske);
                echo json_encode($greske);
                http_response_code(401);
            }
            
            // if($unosKorisnika){
            //     $odgovor = ["poruka"=>"Uspešan unos."];
            //     echo json_encode($odgovor);
            //     http_response_code(201);
            // } 
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>
