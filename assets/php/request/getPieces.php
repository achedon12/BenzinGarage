<?php

require_once "../database/DatabaseManager.php";
require_once "../managers/GarageManager.php";

$id = $_GET["id"] ?? "";

$garagemanager = new GarageManager(DatabaseManager::getInstance());

$array = $garagemanager->getAllPieces();
echo json_encode($array);

