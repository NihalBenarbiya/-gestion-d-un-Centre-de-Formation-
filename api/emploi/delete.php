<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once 'Emploi.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Emploi($db);
echo json_encode($instance->delete($_GET['id']));