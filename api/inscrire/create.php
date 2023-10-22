<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Inscription.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Inscription($db);
$data = $instance->create($_POST['data']);
echo json_encode($data);