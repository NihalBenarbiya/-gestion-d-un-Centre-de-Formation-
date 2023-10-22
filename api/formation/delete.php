<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once 'Formation.php';

$database = new Database();
$db = $database->getConnection();
$instance = new Formation($db);
echo json_encode($instance->delete($_GET['id']));