<?php

require_once "../database/DatabaseManager.php";
require_once "../managers/OperationManager.php";

$id = $_GET["id"] ?? "";
$codeop = $_GET["codeop"] ?? "";

$operationManager = new OperationManager(DatabaseManager::getInstance());

$response = $operationManager->deleteOperationForIntervention((int)$id, $codeop);
echo json_encode($response);
