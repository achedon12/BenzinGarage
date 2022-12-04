<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/ClientManager.php";

$clientManager = new ClientManager(DatabaseManager::getInstance());

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
<nav>
    <img src="../../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin">Accueil</a></li>
        <li class="hover"><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/employes">Employés</a></li>
        <li><a href="/admin/tarification">Tarification</a></li>
        <li><a href="/admin/stock">Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<main class="create">
    <form method="post">
        <?php  if($_SESSION["errorClient"] === "none"){ echo '<h1 class="errorCreate">Les informations n\'ont pas été correctement remplies</h1>'; }elseif($_SESSION["errorClient"] === "confirmCreate"){ echo '<h1 class="errorCreate">Le client a bien été créé</h1>'; } ?>
        <h1>Créer un nouveau client</h1>
        <section class="inputs">
            <input type="text" placeholder="prénom" id="firstname" name="firstname">
            <input type="text" placeholder="nom" id="name" name="name">
            <input type="text" placeholder="adresse" id="adresse" name="adresse">
            <input type="number" placeholder="code postal" id="codepostal" name="codepostal">
            <input type="text" placeholder="ville" id="city" name="city">
            <input type="email" placeholder="mail" id="mail" name="mail">
            <input type="tel" placeholder="numéro de téléphone" id="telephone" name="telephone">
        </section>
        <section>
            <input type="reset">
            <input type="submit" value="Créer" name="create">
        </section>
    </form>
</main>
</body>
</html>