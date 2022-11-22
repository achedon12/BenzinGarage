<?php
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/managers/UserManager.php");
require_once("./assets/php/class/User.php");
$class = new UserManager(DatabaseManager::getInstance());

$array = $class->getAllVehicle();
$var2 = $class->createAdministrator("a", "a", "a");
$user = new User(7,"test","test","test","administrateur");
$var =$class->modifyAdministrator($user,'7');


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