<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/database.php';
include_once 'Formation.php';

$database = new Database();
$db = $database->getConnection();

$instance = new Formation($db);
$data = $instance->read($_GET['id']);
echo json_encode($data);