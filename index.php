<?php
    session_start();

    if(isset($_SESSION["userRole"]))
    {
        if($_SESSION["userRole"] == "secretaire")
        {
            header('Location: gestion-des-formations.php');
        }else{
            header('Location: consulter-emploie.php');
        }
    }else{
        header('Location: se-connecter.php'); exit();
    }



?>