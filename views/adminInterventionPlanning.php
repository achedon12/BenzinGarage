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

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
        <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
        <link rel="stylesheet" href="../assets/css/adminAddClient.css">
        <link rel="stylesheet" href="../assets/css/adminInterventionPlanning.css">
        <link rel="shortcut icon" href="../assets/img/logo.png">
        <title>Planning</title>
    </head>
    <body>
        <nav>
            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li><a href="/accueil/admin">Accueil</a></li>
                <li><a href="/admin/clients">Clients</a></li>
                <li><a href="/admin/employes">Employés</a></li>
                <li><a href="#">Tarification</a></li>
                <li><a href="/admin/stock">Stock</a></li>
                <li class="hover"><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
    <main>

        <section class="interventionWindow">
            <section class="choixPlanning">
                <select>
                    <option value="fr">francois</option>
                    <option value="nl">géraldine</option>
                    <option value="en">chef d'atelier</option>
                    <option value="other">administrateur</option>
                </select>
            </section>

            <section class="planing">
                    <section class="hours">
                        <p>8h</p>
                        <p>9h</p>
                        <p>10h</p>
                        <p>11h</p>
                        <p>12h</p>
                        <p>13h</p>
                        <p>14h</p>
                        <p>15h</p>
                        <p>16h</p>
                        <p>17h</p>
                        <p>18h</p>
                    </section>
                    <section class="day "><p>Lundi</p>
                        <section class="planningDayZone">
                            <section class="quinzeMinute"></section>
                            <a class="reservation" id=""href="#popUpRDV"><p>Mr. Jean</p></a>
                            <section class="trenteMinutes"> </section>
                            <a class="reservation" id=""href="#popUpRDV"><p>Mr. Jean</p></a>
                        </section>
                    </section>
                    <section class="day "><p>Mardi</p><section class="planningDayZone"></section></section>
                    <section class="day "><p>Mercredi</p><section class="planningDayZone"></section></section>
                    <section class="day "><p>Jeudi</p><section class="planningDayZone"></section></section>
                    <section class="day "><p>Vendredi</p><section class="planningDayZone"></section></section>
            </section>

            <section id="popUpRDV">
                <section id="intoPopUpRDV">
                    <h1 class="nomClientIntervention">Mr. Jean</h1>
                    <h1 class="heureIntervention">8h20 - 10h00 (1h40)</h1>
                    <section class="typeIntevrentionZone">
                        <section class="aIntervention"><p>Changement des pneux</p><img src="../assets/img/not%20done.png" alt=""></section>
                        <img class="plusAIntervention" src="../assets/img/plus.png" alt="">
                        <section class="aIntervention"><p>Changement des pneux</p><img src="../assets/img/not%20done.png" alt=""></section>
                        <section class="aIntervention"><p>Changement des pneux</p><img src="../assets/img/not%20done.png" alt=""></section>
                    </section>
                    <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>
                    <button class="validerIntervention">Valider l'intervention</button>
                </section>
            </section>
        </section>
    </main>

    </body>
</html>