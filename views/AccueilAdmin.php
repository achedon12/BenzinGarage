<?php

use app\users\Auth;

session_start();

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    </head>
    <body>
        <nav>
            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li class="hover"><a href="#" >Accueil</a></li>
                <li><a href="#">Planning</a></li>
                <li><a href="#">Prise de rendez-vous</a></li>
                <li><a href="#">Stock</a></li>
                <li><a href="#">Tarifs</a></li>
                <li><a href="#">Clients</a></li>
                <li><a href="#">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <a href="#">
                <h1>Ajouter un client</h1>
                <img src="../assets/img/add-clients.png" alt="">
            </a>
            <a href="#">
                <h1>Modifier un client</h1>
                <img src="../assets/img/modify-clients.png" alt="">
            </a>
            <a href="#">
                <h1>Supprimer un client</h1>
                <img src="../assets/img/delete-clients.png" alt="">
            </a>
            <a href="#">
                <h1>Ajouter un rôle à un employé</h1>
                <img src="../assets/img/add-employe.png" alt="">
            </a>
            <a href="#">
                <h1>Modifier les rôles d'un employé</h1>
                <img src="../assets/img/modify-employe.png" alt="">
            </a>
            <a href="#">
                <h1>Supprimer un rôle à un employé</h1>
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
            <a href="#">
                <h1>Interventions</h1>
                <img src="../assets/img/outils.png" alt="">
            </a>
        </main>
    </body>
</html>