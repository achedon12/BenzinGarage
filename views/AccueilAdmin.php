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
        <title>Accueil administrateur</title>
        <link rel="shortcut icon" href="../assets/img/logo.png">
    </head>
    <body>
        <nav>
            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li class="hover"><a href="/accueil/admin">Accueil</a></li>
                <li><a href="/admin/clients">Clients</a></li>
                <li><a href="/admin/employes">Employés</a></li>
                <li><a href="#">Tarification</a></li>
                <li><a href="#">Stock</a></li>
                <li ><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <a href="/admin/clients/create">
                <h1>Ajouter un client</h1>
                <img src="../assets/img/add-clients.png" alt="">
            </a>
            <a href="/admin/clients/modify">
                <h1>Modifier un client</h1>
                <img src="../assets/img/modify-clients.png" alt="">
            </a>
            <a href="/admin/clients/delete">
                <h1>Supprimer un client</h1>
                <img src="../assets/img/delete-clients.png" alt="">
            </a>
            <a href="/admin/employes/create">
                <h1>Ajouter un employé</h1>
                <img src="../assets/img/add-employe.png" alt="">
            </a>
            <a href="/admin/employes/modify">
                <h1>Modifier un employé</h1>
                <img src="../assets/img/modify-employe.png" alt="">
            </a>
            <a href="/admin/employes/delete">
                <h1>Supprimer un employé</h1>
                <img src="../assets/img/remove-employe.png" alt="">
            </a>
            <a href="#">
                <h1>Tarifications</h1>
                <img src="../assets/img/caisse.png" alt="" id="caisse">
            </a>
            <a href="#">
                <h1>Stock</h1>
                <img src="../assets/img/cartons.png" alt="">
            </a>
            <a href="/admin/interventionPlanning">
                <h1>Interventions</h1>
                <img src="../assets/img/outils.png" alt="">
            </a>
        </main>
    </body>
</html>