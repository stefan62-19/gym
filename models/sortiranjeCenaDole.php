<?php
//session_start();
header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija2.php";
        include "function.php";

        try
        {
            $pod = $_POST['podaci'];
            if($pod=="cenaDoGore")
            {
                $proizvod=cenaGore();
            }
            else if($pod=="cenaDoDole")
            {
                $proizvod=cenaDole();
            }
            else if($pod=="nazivDoGore")
            {
                $proizvod=nazivGore();
            }
            else if($pod=="nazivDoDole")
            {
                $proizvod=nazivDole();
            }
            if($proizvod)
            {
                echo json_encode($proizvod);
                http_response_code(200);
            }
           // $proizvod = ispisPoKat($pod);
        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }
?>