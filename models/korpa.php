<?php
        session_start();   
        header("Content-type: application/json");
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            include "../config/konekcija2.php";
            include "function.php";
            $odgovor=vratiSve();
            echo json_encode($odgovor);
        }
        
?>
