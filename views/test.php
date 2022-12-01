<?php
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/managers/UserManager.php");
require_once("./assets/php/managers/GarageManager.php");
require_once("./assets/php/managers/InterventionManager.php");
require_once("./assets/php/managers/ClientManager.php");
require_once("./assets/php/class/User.php");


$class = new UserManager(DatabaseManager::getInstance());
$class2 = new GarageManager(DatabaseManager::getInstance());
$class3 = new InterventionManager(DatabaseManager::getInstance());
$class4 = new ClientManager(DatabaseManager::getInstance());

// $interv = new Intervention("5","2021-05-05", "12:00:00", "test", 0, false, "test", "test", "test", "test");
$client = new Client('7', 'test', 'test', 'test', '04555', 'Paris', '0635254585', 'test@gmail.com', '2022-02-01');
$var = $class4->modifyClient($client,'7');
print_r($var);


?>

<!DOCTYPE html>
<html lang="">
    <head>
        <title>Page de test</title>
    </head>
    <body style="display: flex; justify-content: center; flex-direction: column">
        <h1 style="align-self: center">Page de test</h1>
    </body>
</html>