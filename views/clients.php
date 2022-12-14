<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "./assets/php/managers/TemplateManager.php";
require_once "./assets/php/managers/GarageManager.php";
require_once "./assets/php/managers/ClientManager.php";
require_once "assets/php/class/Piece.php ";

$userManager = new UserManager(DatabaseManager::getInstance());
$garageManager = new GarageManager(DatabaseManager::getInstance());
$clientsManager = new ClientManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php if($_SESSION["role"] === UserManager::MANAGER){echo "Chef d'atelier ";}else{echo"Employé ";} ?> : Client</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body>
<?php
TemplateManager::getDefaultNavBar("clients");
?>
<main>
    <section class="formChoixClient">
        <label for="myClient">Liste des Clients</label>
        <form method="post" onchange="submit()">
            <input list="Clients" id="myClient" name="myClient"/>
        </form>
        <datalist id="Clients">
            <?php
                $clients = $clientsManager->getAllClients();
    //            print_r($clients);
                foreach ($clients as $client){
                    echo '<option value="'.$client->getId().'" class="listeClientHorizontal">'.$client->getFirstName().' '.$client->getName().'</option>';

                }
            ?>


        </datalist>

    </section>



    <section class="infoClientSelect">
        <?php
        if(isset($_POST['myClient'])){
            $clientSelected = $clientsManager->getClientByID($_POST['myClient']);

            echo '<section class="info">
                        <p>Nom Prénom : '.$clientSelected->getName().' '.$clientSelected->getFirstName().'</p>
                        <p>Tel : '.$clientSelected->getTelephoneNumber().'</p>
                        <p>Mail : '.$clientSelected->getEmail().'</p>
                        <p>Adresse :  '.$clientSelected->getAdresse().' '.$clientSelected->getCodePostal().' '.$clientSelected->getCity().'</p>
                        <p>Information Véhicule : </p>';
            if ($clientsManager->clientHasVehicle($clientSelected->getId())){
                echo '<p>Plaque Immatriculation : '.$userManager->getVehiculeByUserId($clientSelected->getId())->getNumberPlate().'</p>
                    <p>Numero de Série : '.$userManager->getVehiculeByUserId($clientSelected->getId())->getNumeroSerie().'</p>
                    <p>Date de mise en circulation : '.$userManager->getVehiculeByUserId($clientSelected->getId())->getDateMiseEnCirculation().'</p>
                </section>';
            }else{
                echo "<p>Il n'y a pas de véhicule enregistré</p>";
            }


        }
        else{
            echo "<h2 style='margin: auto'>aucun client sélectionné</h2>";
        }
        ?>





    </section>
</main>
</body>
</html>

