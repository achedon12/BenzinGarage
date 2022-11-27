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
$var = $class4->deleteClient( 7);
        // 4	2022-07-12	15:30:00	Nettoyage du véhicule	172440	true	Définie   	2    	FA-235-FB	6
// $var2 = $class3->createIntervention('2021-10-22','14:00','descriptif_test',156540,TRUE,'Facturée',2,'WL-456-MD','4');
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