<?php
require_once("./assets/php/database/DatabaseManager.php");
require_once("./assets/php/managers/UserManager.php");
require_once("./assets/php/class/User.php");
$class = new UserManager(DatabaseManager::getInstance());


$var2 = $class->createManager("a", "a", "a");
$var3 = $class->removeManager('8');
//$user = new User(7,"test","test","test","employe");
//$var =$class->modifyEmployee($user,'7');
print_r($var3);

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