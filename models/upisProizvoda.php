<?php
 session_start();
 header("Content-type: application/json");
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     include "../config/konekcija2.php";
     include "function.php";

     try{
        $ime=$_POST['ime'];
      $staraCena=$_POST['staraCena'];
      $novaCena=$_POST['novaCena'];
      $zvezdice=$_POST['zvezdice'];
      $opis=$_POST['opis'];
      $slikaAlt=$_POST['slikaAlt'];
      $slikaSrc=$_POST['slikaSrc'];
      $idKat=$_POST['idKat'];
      if(empty($ime)||empty($staraCena)||empty($novaCena)||empty($zvezdice)||empty($opis)||empty($slikaAlt)||empty($slikaSrc)||empty($idKat))
        {
            $odgovor=["odgovor"=>"greska u unosu"];
            echo json_encode($odgovor);
        }
        else
        {
            $resultat=upisiProizvod($ime,$staraCena,$novaCena,$zvezdice,$opis, $slikaAlt,$slikaSrc,$idKat);
        }
      //$brisanje = brisanjeProizvoda($id);
         if($resultat){
             $odgovor = ["odgovor"=>"Proizvod je unet u bazu"];
             echo json_encode($odgovor);
             http_response_code(200);        
         }
         else{
            $odgovor = ["odgovor"=>"Proizvod nije unet u bazu"];
            echo json_encode($odgovor);
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