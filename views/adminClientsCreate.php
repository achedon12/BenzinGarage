<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

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
        <li><a href="#">Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<main class="create">
    <form method="post">
        <h1>Créer un nouveau client</h1>
        <section class="inputs">
            <input type="text" placeholder="prénom" id="firstname">
            <input type="text" placeholder="nom" id="name">
            <input type="text" placeholder="adresse" id="adresse">
            <input type="text" placeholder="code postal" id="codepostal">
            <input type="text" placeholder="ville" id="city">
            <input type="email" placeholder="mail" id="mail">
            <input type="tel" placeholder="numéro de téléphone" id="telephone">
        </section>
        <section>
            <input type="reset">
            <input type="submit" value="Créer">
        </section>
    </form>

</main>
</body>
</html>