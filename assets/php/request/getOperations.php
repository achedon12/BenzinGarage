<?php

require_once "../database/DatabaseManager.php";
require_once "../managers/OperationManager.php";

$operationManager = new OperationManager(DatabaseManager::getInstance());

$array = $operationManager->getOperations();
echo json_encode($array);
