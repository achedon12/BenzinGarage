<?php
require_once "../database/DatabaseManager.php";
require_once "../managers/PriceManager.php";

$tarifManager = new PriceManager(DatabaseManager::getInstance());
$price = $tarifManager->getAllPrice();
echo json_encode($price);


