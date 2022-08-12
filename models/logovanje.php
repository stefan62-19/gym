<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija2.php";
        include "function.php";

        try{
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            // provera
            $greske=[];
            $regemail='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            $regpass='/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/';
            if(!preg_match($regemail,$email)){
                array_push($greske,"Greska email");
            }
            if(!preg_match($regpass,$lozinka)){
                array_push($greske,"Greska password");
            }
            $sifrovanaLozinka = md5($lozinka);
            //var_dump($greske);
            if(empty($greske))
            {
                $korisnikObj = proveraLogovanje($email, $sifrovanaLozinka);
                //var_dump($korisnikObj);
                if($korisnikObj)
                {
                    $_SESSION['korisnik'] = $korisnikObj;
                    //$odgovor= $_SESSION['korisnik']->ime_uloge;
                    $odgovor = ["nazivUloge"=>$korisnikObj->ime_uloge];

                    echo json_encode($odgovor);
                    http_response_code(200);
                }
            }
            else
            {
                //$odg=implode(",",$greske);
                echo json_encode($greske);
                http_response_code(401);
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