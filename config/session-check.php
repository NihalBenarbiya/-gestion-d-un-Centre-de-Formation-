<?php session_start();
    if(!isset($_SESSION["userRole"]))
    {
        header('Location: index.php');
    }

?>