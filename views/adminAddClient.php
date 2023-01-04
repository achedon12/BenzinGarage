<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/TemplateManager.php";

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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../../assets/css/utilisateurAdministrateur.css">
    <link rel="stylesheet" href="../../assets/css/adminAddClient.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Ajouter un client</title>
</head>
<body>
<?php
TemplateManager::getAdminNavBar("clients");
?>
<main>
    <aside>
        <section class="liste">
            <a href="/admin/utilisateur" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="#" class=" aListeOptionAdmin hoverli "><p>Client</p></a>
            <section class="sousListeSection">
                <a class="hoverliSousList" href="#"><p>Ajouter un client</p></a>
                <a href="/admin/editClient"><p>Modifier un client</p></a>
                <a href="/admin/removeClient"><p>Supprimer un client</p></a>
            </section>
            <a href="/admin/addEmploye" class="aListeOptionAdmin"><p>Garage</p></a>
        </section>
    </aside>
    <section class="addClientWindow">
        <section class="sectionCenterAddClient">
            <form>
            <h1>Créer un client</h1>
                <section class="inputAddClient">
                    <h2>Nom du client : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Prénom du client : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Age du client : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Téléphone du client : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Email du client : </h2>
                    <input type="text">
                </section>
                <input type="submit" class="submitFormAddClient" value="Créer un client">
            </form>
        </section>
    </section>
</main>

</body>
</html>