<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Apprenant.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Apprenant($db);
$data = $instance->create($_POST['data']);
echo json_encode($data);