<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include "../config/konekcija2.php";
        include "function.php";

        try
        {
            $rezultat=podaciAutor();
            //var_dump($rezultat);
            //if($rezultat)

        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>