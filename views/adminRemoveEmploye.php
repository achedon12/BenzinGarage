<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() !== 2){
    session_start();
}

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Supprimer un client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
    <link rel="stylesheet" href="../assets/css/adminAddClient.css">
    <link rel="stylesheet" href="../assets/css/adminEditClient.css">
    <link rel="stylesheet" href="../assets/css/adminRemoveClient.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body>
<nav>
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin" >Accueil</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/employes">Employés</a></li>
        <li><a href="/admin/tarification">Tarification</a></li>
        <li><a href="/admin/stock">Stock</a></li>
        <li><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<main>
    <aside>
        <section class="liste">
            <a href="/admin/utilisateur" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="/admin/addClient" class=" aListeOptionAdmin"><p>Client</p></a>
            <a href="/admin/addEmploye" class="aListeOptionAdmin hoverli"><p>Garage</p></a>
            <section class="sousListeSection">
                <a  href="/admin/addEmploye"><p>Ajouter un employé</p></a>
                <a href="/admin/editEmploye"><p>Modifier un employé</p></a>
                <a class="hoverliSousList" href="/admin/removeEmploye"><p>Supprimer un employé</p></a>
            </section>
        </section>
    </aside>
    <section class="windowEditClient">
        <section class="listClient">
            <a href="#">Jean- Marc Henri</a>
            <a href="#">Louis Dupont</a>
            <a href="#">Hervé</a>
            <a href="#">Marc Paul</a>
        </section>

        <section class="infoClient">
            <section class="infoClientDel">
                <p>Nom : Mr Jean-Marc Dupont</p>
                <p>Téléphone : 06 48 89 15 32</p>
                <p>Age : 46 ans</p>
                <p>Voiture : Citroën C4</p>
                <p>Plaque 25 - D8E - FT</p>
                <button type="button" onclick=""> Supprimer le client</button>
            </section>
        </section>

    </section>
</main>

</body>
</html>
