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
        <link rel="stylesheet" href="../assets/css/accueil.css">
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