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

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
        <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
        <link rel="stylesheet" href="../assets/css/adminAddClient.css">
        <link rel="stylesheet" href="../assets/css/adminEditClient.css">
        <link rel="shortcut icon" href="../assets/img/logo.png">
        <title>Modifier un client</title>
    </head>
<body>
<?php
TemplateManager::getAdminNavBar("clients");
?>
<main>
    <aside>
        <section class="liste">
            <a href="/admin/utilisateur" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="/admin/addClient" class=" aListeOptionAdmin hoverli "><p>Client</p></a>
            <section class="sousListeSection">
                <a  href="/admin/addClient"><p>Ajouter un client</p></a>
                <a class="hoverliSousList"  href="#"><p>Modifier un client</p></a>
                <a href="/admin/removeClient"><p>Supprimer un client</p></a>
            </section>
            <a href="/admin/addEmploye" class="aListeOptionAdmin"><p>Garage</p></a>
        </section>
    </aside>
    <section class="windowEditClient">
        <section class="listClient">
            <a href="#">Mr Dupont</a>
            <a href="#">Mme De L'arbre</a>
            <a href="#">Mr Jean</a>
            <a href="#">Mme Delettre</a>
            <a href="#">Mme Louise</a>
            <a href="#">Mr Marquis</a>
            <a href="#">Mme Loise</a>
            <a href="#">test</a>
        </section>


        <section class="infoClient">
            <form action="" method="post">
                <section class="infoClientEdit">
                    <label><p>Prénom : </p><input type="text" class="inputEditClient" id="prenomUser" name="prenom" placeholder="test"/></label>
                    <label><p>Téléphone : </p><input type="text" class="inputEditClient" id="telephoneUser" name="prenom" /></label>
                    <label><p>Nom : </p><input type="text" class="inputEditClient" id="nomUser" name="prenom" /></label>
                    <label><p>Age : </p><input type="text" class="inputEditClient" id="ageUser" name="prenom" /></label>
                    <label><p>Voiture : </p><input type="text" class="inputEditClient" id="voitureUser" name="prenom" /></label>
                    <label><p>Plaque : </p><input type="text" class="inputEditClient" id="plaqueUser" name="prenom" /></label>
                </section>
                <section class="validateButton">
                    <input class="submitFormEditClient" type="button" value="Modifier le client">
                    <input class="resetFormEditClient" type="reset" value="Réinitialiser les informations">
                </section>
            </form>
        </section>


    </section>
</main>

</body>
</html>