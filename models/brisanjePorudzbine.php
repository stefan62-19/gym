<?php
 session_start();
 header("Content-type: application/json");
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     include "../config/konekcija2.php";
     include "function.php";

     try{
         $id = $_POST['id'];
        $brisanje = brisanjePorudzbine($id);
         if($brisanje){
             $odgovor = ["odgovor"=>"Porudzbina sa id-jem:".$id."je uspesno obrisana"];
             echo json_encode($odgovor);
             http_response_code(200);        
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