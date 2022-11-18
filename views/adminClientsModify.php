<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() !== 2){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

$client = null;

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
        <link rel="stylesheet" href="../../assets/css/adminClientsEmployesModify.css">
        <title>Administrateur | Clients - modifier</title>
        <link rel="shortcut icon" href="../assets/img/logo.png">
    </head>
    <body>
        <nav>
            <img src="../../assets/img/logo.png" alt="logo">
            <ul>
                <li><a href="/admin/accueil">Accueil</a></li>
                <li class="hover"><a href="/admin/clients">Clients</a></li>
                <li ><a href="/admin/employes">Employés</a></li>
                <li><a href="#">Tarification</a></li>
                <li><a href="#">Stock</a></li>
                <li ><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <form method="post" class="client-selecteur">
                <label for="client-select">Choissir un Client:</label>
                <select id="client-select" onchange="submit()" name="select">
                    <option value="">--Client--</option>
                    <?php
                        foreach($userManager->getAllClients() as $client){
                            $name  = $client->getName()." ".$client->getFirstName();
                            $code = $client->getId();
                            ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                        }
                    ?>
                </select>
            </form>
            <?php
                if($client === null){
                    echo "<h1>Veuillez séléctionner un client pour commencer l'opération</h1>";
                }else{
                    ?>
                    <form class="client-informations" method="post">
                        <input type="text" name="name" id="name" value='<?php echo $client->getName()?>'>
                        <input type="text" name="firstname" id="firstname" value='<?php echo $client->getFirstName()?>'>
                        <input type="text" name="adresse" id="adresse" value='<?php echo $client->getAdresse()?>'>
                        <input type="text" name="codepostal" id="codepostal" value='<?php echo $client->getCodePostal()?>'>
                        <input type="text" name="city" id="city" value='<?php echo $client->getCity()?>'>
                        <input type="tel" name="telephone" id="telephone" value='<?php echo $client->getTelephoneNumber()?>'>
                        <input type="submit" value="Modifier le client" id="modify" class="tier">
                        <input type="submit" value="Supprimer le client" id="del" class="tier">
                        <input type="reset" value="Réinitialiser les informations" class="tier">
                    </form>
                    <?php
                }
            ?>
        </main>
    </body>
</html>