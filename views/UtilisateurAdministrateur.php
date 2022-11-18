<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() !== 2){
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
        <title>Gestion des utilisateur</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
        <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
        <link rel="shortcut icon" href="../assets/img/logo.png">
    </head>
    <body>
    <nav>
        <img src="../assets/img/logo.png" alt="logo">
        <ul>
            <li><a href="/accueil/admin" >Accueil</a></li>
            <li ><a href="#">Clients</a></li>
            <li ><a href="#">Employés</a></li>
            <li><a href="#">Tarification</a></li>
            <li><a href="#">Stock</a></li>
            <li><a href="/admin/interventionPlanning">Intervention</a></li>
            <li><a href="/disconnect">Deconnexion</a></li>
        </ul>
    </nav>
   <main>
       <aside>
           <ul>
               <li class="hoverli"><a href="/admin/utilisateur">Tableau de bord</a></li>
               <li><a href="/admin/addClient">Client</a></li>
               <li><a href="/admin/addEmploye">Garage</a></li>
           </ul>
       </aside>
       <section class="main">
           <a href="/admin/addClient">
               <h1>Ajouter un client</h1>
               <img src="/assets/img/add-clients.png" alt="">
           </a>
           <a href="/admin/editClient">
               <h1>modifier un client</h1>
               <img src="/assets/img/modify-clients.png" alt="">
           </a>
           <a href="/admin/removeClient">
               <h1>Supprimer un client</h1>
               <img src="/assets/img/delete-clients.png" alt="">
           </a>
           <a href="/admin/addEmploye">
               <h1>Ajouter un rôle à un employé</h1>
               <img src="/assets/img/add-employe.png" alt="">
           </a>
           <a href="/admin/editEmploye">
               <h1>Modifier un employé</h1>
               <img src="/assets/img/modify-employe.png" alt="">
           </a>
           <a href="/admin/removeEmploye">
               <h1>Supprimer un employé </h1>
               <img src="/assets/img/remove-employe.png" alt="">
           </a>
       </section>
   </main>

    </body>
</html>