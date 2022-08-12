<?php
session_start();
header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija2.php";
        include "function.php";

        try{
            $vrednost=$_POST['vrednost'];
            $id_kor=$_SESSION['korisnik']->id_korisnika;
            $mejl=$_SESSION['korisnik']->email;
            $rezultat=0;
             if(!proveraGlasanja($id_kor))
            {
                $rezultat=upisUAnketu($id_kor,$mejl,$vrednost);
            }
            else{
                $upis = 0;//vec glasano
            }
            if($rezultat){
                
                $upis = 1;//vas rezultat je upisan                

            }
            $prosekGlasanja=prikazProsekaAnketa();
            if($upis)
            {
                $odgovor=["uspeh"=>"Vas glas je upisan u bazu","prosek"=>$prosekGlasanja];
            }
            else
            {
                $odgovor=["uspeh"=>"Vec ste glasali sa ovog naloga","prosek"=>$prosekGlasanja];
            }
                echo json_encode($odgovor);
                http_response_code(200);

        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>
