<?php
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/managers/UserManager.php");

$class = new UserManager(DatabaseManager::getInstance());

$array = $class->getAllVehicle();
$var = $class->removeAdministrator( '7');

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