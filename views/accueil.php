<?php

use app\users\Auth;

session_start();

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

require_once("./assets/php/managers/TemplateManager.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueil.css">
    </head>
    <body>
        <?php
            TemplateManager::getDefaultNavBar();
        ?>
        <main>
            <a href="#">
                <h1>Planning</h1>
                <img src="../assets/img/planning.png" alt="planning">
            </a>
            <a href="#">
                <h1>Prise de rendez-vous</h1>
                <img src="../assets/img/add-clients.png" alt="planning">
            </a>
            <a href="#">
                <h1>Clients</h1>
                <img src="../assets/img/add-clients.png" alt="planning">
            </a>
            <a href="#">
                <h1>Stock</h1>
                <img src="../assets/img/cartons.png" alt="planning">
            </a>
            <a href="#">
                <h1>Tarifs</h1>
                <img src="../assets/img/caisse.png" alt="planning">
            </a>
        </main>
    </body>
</html>