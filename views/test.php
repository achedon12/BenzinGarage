<?php
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/managers/UserManager.php");
require_once("./assets/php/managers/GarageManager.php");
require_once("./assets/php/class/User.php");


$class = new UserManager(DatabaseManager::getInstance());
$class2 = new GarageManager(DatabaseManager::getInstance());

$var2 = $class2->getAvailablePiece('2');
print_r($var2);

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