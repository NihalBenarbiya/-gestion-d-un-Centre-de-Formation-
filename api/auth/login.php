<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
include_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

$userExists = false;

$email = $_POST['EMAIL'];
$mdp = $_POST['MDP'];

$stmt = $db->prepare("SELECT * FROM secretaire WHERE EMAIL=:EMAIL AND MDP=:MDP");
$stmt->bindParam(":EMAIL", $email);
$stmt->bindParam(":MDP", $mdp);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $userExists = true;
    $_SESSION["userID"] = $row['ID_SECRETAIRE'];
    $_SESSION["userName"] = $row['NOM']. " " .$row['PRENOM'];
    $_SESSION["userRole"] = "secretaire";
}

if($userExists == false){
    $stmt = $db->prepare("SELECT * FROM apprenant WHERE EMAIL=:EMAIL AND MDP=:MDP");;
    $stmt->bindParam(":EMAIL", $email);
    $stmt->bindParam(":MDP", $mdp);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $userExists = true;
        $_SESSION["userID"] = $row['ID_APPRENANT'];
        $_SESSION["userName"] = $row['NOM']. " " .$row['PRENOM'];
        $_SESSION["userRole"] = "apprenant";
    }
}


echo json_encode($userExists);