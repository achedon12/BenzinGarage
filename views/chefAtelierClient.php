<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once("./assets/php/managers/TemplateManager.php");
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
    <title>Chef d'atelier : Client</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body>
<nav class="nav-bar">
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/chefatelier">Accueil</a></li>
        <li><a href="">Planning</a></li>
        <li><a href="/chefAtelier/RDV">Prise de rendez-vous</a></li>
        <li><a href="/chefAtelier/stock">Stock</a></li>
        <li><a href="">Tarification</a></li>
        <li  class="hover"><a href="/chefAtelier/client">Clients</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>

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
                        <p>'.$clientSelected->getName().' '.$clientSelected->getFirstName().'</p>
                        <p>Tel : '.$clientSelected->getTelephoneNumber().'</p>
                        <p>Mail : '.$clientSelected->getEmail().'</p>
                        <p>Adresse :  '.$clientSelected->getAdresse().' '.$clientSelected->getCodePostal().' '.$clientSelected->getCity().'</p>
                        
                       
                    </section>';
        }
        else{
            echo "<h2 style='margin: auto'>aucun client sélectionné</h2>";
        }
        ?>





    </section>
</main>
</body>
</html>

