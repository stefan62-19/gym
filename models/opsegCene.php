<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/konekcija2.php";
        include "function.php";

        try{
            $pod = $_POST['podatak'];
            $proizvod = opsegCena($pod);
            if(count($proizvod))
            {
                echo json_encode($proizvod);
            }
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