<?php

use app\users\Auth;

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
    </head>
    <body>
        <nav>

            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li class="hover"><a href="/accueil/admin">Accueil</a></li>
                <li ><a href="/admin/utilisateur">Utilisateur</a></li>
                <li><a href="#">Tarification</a></li>
                <li><a href="#">Stock</a></li>
                <li ><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="#">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <a href="/admin/addClient">
                <h1>Ajouter un client</h1>
                <img src="../assets/img/add-clients.png" alt="">
            </a>
            <a href="/admin/editClient">
                <h1>Modifier un client</h1>
                <img src="../assets/img/modify-clients.png" alt="">
            </a>
            <a href="/admin/removeClient">
                <h1>Supprimer un client</h1>
                <img src="../assets/img/delete-clients.png" alt="">
            </a>
            <a href="/admin/addEmploye">
                <h1>Ajouter un employé</h1>
                <img src="../assets/img/add-employe.png" alt="">
            </a>
            <a href="/admin/editEmploye">
                <h1>Modifier un employé</h1>
                <img src="../assets/img/modify-employe.png" alt="">
            </a>
            <a href="/admin/removeEmploye">
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