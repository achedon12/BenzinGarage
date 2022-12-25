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
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
        <title>Accueil chef atelier</title>
        <link rel="shortcut icon" href="../assets/img/logo.png">
    </head>
    <body>
        <nav class="nav-bar">
            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li class="hover"><a href="/accueil/chefatelier">Accueil</a></li>
                <li><a href="">Planning</a></li>
                <li><a href="">Prise de rendez-vous</a></li>
                <li><a href="/chefAtelier/stock">Stock</a></li>
                <li><a href="">Tarification</a></li>
                <li ><a href="">Clients</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <a href="/chefAtelier/interventionPlanning">
                <h1>Planning</h1>
                <img src="../assets/img/planning.png" alt="">
            </a>
            <a href="">
                <h1>Prise de rendez-vous</h1>
                <img src="../assets/img/add-clients.png" alt="">
            </a>

            <a href="/chefAtelier/stock">
                <h1>Stock</h1>
                <img src="../assets/img/cartons.png" alt="">
            </a>
            <a href="">
                <h1>Tarifications</h1>
                <img src="../assets/img/caisse.png" alt="">
            </a>
            <a href="">
                <h1>Clients</h1>
                <img src="../assets/img/modify-clients.png" alt="">
            </a>
        </main>
    </body>
</html>
