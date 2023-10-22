<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Certificat.php';

$database = new Database();
$db = $database->getConnection();

$instance = new Certificat($db);
$data = $instance->read($_GET['id']);
echo json_encode($data);