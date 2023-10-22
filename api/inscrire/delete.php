<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once 'Inscription.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Inscription($db);
echo json_encode($instance->delete($_GET['ID_APPRENANT'], $_GET['ID_FORMATION']));