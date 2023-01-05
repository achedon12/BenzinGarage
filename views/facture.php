<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/TemplateManager.php";
require_once "assets/php/managers/FactureManager.php";

$factureManager = new FactureManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/facture.css">
    <title>Factures</title>
</head>
<body>
    <?php
    TemplateManager::getAdminNavBar("facture");
    ?>
    <main>
        <a href="/admin/facture/create">
            <h1>Créer une Facture</h1>
            <img src="../assets/img/facture.png" alt="facture">
        </a>
        <a href="/admin/facture/liste">
            <h1>Liste des Facture</h1>
            <img src="../assets/img/facture.png" alt="factures-liste">
        </a>
    </main>
</body>
</html>