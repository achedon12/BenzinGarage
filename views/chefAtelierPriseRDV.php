<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once("./assets/php/managers/TemplateManager.php");
require_once "./assets/php/managers/GarageManager.php";
require_once "./assets/php/managers/ClientManager.php";
require_once "assets/php/class/Piece.php ";
require_once "assets/php/managers/InterventionManager.php";
$interventionManager= new InterventionManager(DatabaseManager::getInstance());
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
    <title>Chef d'atelier : Prise de rendez-vous</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="stylesheet" href="../assets/css/chefAtelierPriseRDV.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body>
<nav class="nav-bar">
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/chefatelier">Accueil</a></li>
        <li><a href="">Planning</a></li>
        <li class="hover"><a href="/chefAtelier/RDV">Prise de rendez-vous</a></li>
        <li><a href="/chefAtelier/stock">Stock</a></li>
        <li><a href="">Tarification</a></li>
        <li><a href="/chefAtelier/client">Clients</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>

<main>
    <form method="post" class="formRDV">
        <section class="InfoClient">
            <section class="NomPrenom">
                <h2>Prenom</h2>
                <h2>Nom de famille</h2>
            </section>
            <section class="Date">
                <h2>Date : ../../....</h2>
            </section>
            <section class="CompteClient">
                <h2>Possède un compte client :</h2>
                <a href="#popInscription">Non</a>

            </section>
            <section class="ValiderPrix">
                <input type="button" onclick="submit()" value="Ajouter le rendez-vous" name="ValiderRDV">
                <h2>58€</h2>
            </section>
        </section>

        <section class="infoIntervetion">
            <section class="interventionRDV">
                <h2>Parre-Brise</h2>


            </section>

        </section>
        <form method="post" onchange="submit()">
            <input list="listeInterventions" id="myClient" name="myClient"/>
        </form>
        <datalist id="listeInterventions">
            <?php
            $interventions = $interventionManager->getInterventionList();
            //            print_r($clients);
            foreach ($interventions as $intervention){
                echo '<option value="'.$intervention->getId().'" class="listeClientHorizontal">'.$intervention->getDescriptifDemande().'</option>';

            }
            ?>
        </datalist>



        <section id="popInscription">
            <section id="intoPopUpRDV">
                <h2>Inscription d'un client</h2>
                <form method="post" id="formInscriptionClient">
                    <label for="NomClient"> Nom du client
                        <input type="text" name="NomClient" placeholder="Nom" required>
                    </label>
                    <label for="PrenomClient"> Prenom du client
                        <input type="text" name="PrenomClient" placeholder="Prenom" required>
                    </label>
                    <label for="adresseClient"> Adresse du client
                        <input type="text" name="adresseClient" placeholder="adresse" required>
                    </label>
                    <label for="codePostalClient"> code postal du client
                        <input type="text" name="codePostalClient" placeholder="Code Postal" required>
                    </label>
                    <label for="telClient"> Téléphone du client
                        <input type="text" name="telClient" placeholder="Téléphone" required>
                    </label>
                    <label for="mailClient"> Adresse e-mail du client
                        <input type="text" name="mailClient" placeholder="Mail" required>
                    </label>
                    <input type="button" class="validerIntervention" name="ValiderInscriptionClient" onclick="submit()" value ="Valider l'inscription du client">

                </form>
                <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>

            </section>

        </section>
    </form>
</main>
</body>
</html>

