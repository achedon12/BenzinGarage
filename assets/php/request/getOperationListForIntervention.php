<?php

require_once "../database/DatabaseManager.php";
require_once "../managers/OperationManager.php";

$id = $_GET["id"] ?? "";

$operationManager = new OperationManager(DatabaseManager::getInstance());

$array = $operationManager->getOperationListForIntervention((int)$id);
echo json_encode($array);
