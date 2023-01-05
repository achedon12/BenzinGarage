<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/managers/TemplateManager.php";
require_once "assets/php/managers/ModeleManager.php";



$clientManager = new ClientManager(DatabaseManager::getInstance());
$modeleManager = new ModeleManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
    $_SESSION["errorClient"] = 0;
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["create"])){
    if(empty($_POST["firstname"]) || empty($_POST["name"]) || empty($_POST["adresse"]) || empty($_POST["codepostal"]) || empty($_POST["city"]) || empty($_POST["mail"]) || empty($_POST["telephone"])){
        $_SESSION["errorClient"] = "none";
    }else{
        if($clientManager->createClient($_POST["name"],$_POST["firstname"],$_POST["adresse"],$_POST["codepostal"],$_POST["city"],$_POST["telephone"],$_POST["mail"])){
            $client = $clientManager->getClientByFirstnameAndName($_POST["firstname"],$_POST["name"])[0];
            $clientManager->createVehicule($_POST["noimma"],$_POST["noserie"],$_POST["dateService"] ,$_POST["numModel"],$client["codeclient"]);
            $_SESSION["errorClient"] = "confirmCreate";
        }else{
            $_SESSION["errorClient"] = "none";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../../assets/css/adminClientsEmployesCreate.css">
    <title>Administrateur | Clients - modifier</title>
    <link rel="shortcut icon" href="../../assets/img/logo.png">
</head>
<body>
<?php
TemplateManager::getAdminNavBar("clientsFar");
?>
<main class="create">
    <form method="post" >
        <?php  if($_SESSION["errorClient"] === "none"){ echo '<h1 class="errorCreate">Les informations n\'ont pas été correctement remplies</h1>'; }elseif($_SESSION["errorClient"] === "confirmCreate"){ echo '<h1 class="errorCreate">Le client a bien été créé</h1>'; } ?>
        <h1 style="width: 100%">Créer un nouveau client</h1>
            <section class="inputs">
                <input type="text" placeholder="prénom" id="firstname" name="firstname">
                <input type="text" placeholder="nom" id="name" name="name">
                <input type="text" placeholder="adresse" id="adresse" name="adresse">
                <input type="number" placeholder="code postal" id="codepostal" name="codepostal">
                <input type="text" placeholder="ville" id="city" name="city">
                <input type="email" placeholder="mail" id="mail" name="mail">
                <input type="tel" placeholder="numéro de téléphone" id="telephone" name="telephone">
            </section>
            <h1> Information véhicule</h1>
            <section class="inputs2">
                <article>
                    <label for="noimma"> Numéro d'immatriculation</label>
                    <input type="text" name="noimma" placeholder="Plaque d'immatriculation" required>
                </article>
                <article>
                    <label for="noserie"> Numéro de série</label>
                    <input type="text" name="noserie" placeholder="No de série" required>
                </article>
                <article>
                    <label for="dateService"> date de mise en service</label>
                    <input type="date" name="dateService"  required>
                </article>
                <article>
                    <label for="numModel"> Numéro de modele</label>
                    <input list="Modeles" id="myClient" name="numModel" required/>
                    <datalist id="Modeles">
                        <?php
                        $res = $modeleManager->getAllModele();
                        foreach ($res as $modele){
                            echo '<option value="'.$modele->getNummodele().'" class="listeClientHorizontal">'.$modele->getModele().'</option>';
                        }
                        ?>
                    </datalist>
                </article>
            </section>

        <section>
            <input type="reset">
            <input type="submit" value="Créer" name="create">
        </section>
    </form>
</main>
</body>
</html>
<?php
$_SESSION["errorClient"] = 0;
?>