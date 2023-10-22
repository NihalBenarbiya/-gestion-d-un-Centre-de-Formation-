<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once 'Inscription.php';

$database = new Database();
$db = $database->getConnection();

$instance = new Inscription($db);
$data = $instance->update($_POST['data'], $_POST['ID_APPRENANT'], $_POST['ID_FORMATION']);
echo json_encode($data);