<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Formation.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Formation($db);
$data = $instance->mesFormations();
echo json_encode($data);