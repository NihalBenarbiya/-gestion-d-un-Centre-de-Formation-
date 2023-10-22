<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Secretaire.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Secretaire($db);
$data = $instance->create($_POST['data']);
echo json_encode($data);