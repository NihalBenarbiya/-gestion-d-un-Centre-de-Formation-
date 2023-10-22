<?php session_start();
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../secretaire/Secretaire.php';
include_once '../apprenant/Apprenant.php';

$database = new Database();
$db = $database->getConnection();
$user = $_POST['data'];


//var_dump($_POST['data']); exit();
if($_SESSION['userRole'] == "secretaire"){
    $instance = new Secretaire($db);
    $user['ID_SECRETAIRE'] =  $_SESSION['userID'];
}else{
    $instance = new Apprenant($db);
    $user['ID_APPRENANT'] =  $_SESSION['userID'];
}
$data = $instance->update($user);




echo json_encode($data);