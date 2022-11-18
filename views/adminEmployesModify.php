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

$user = null;

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
        <link rel="stylesheet" href="../../assets/css/adminClientsEmployesModify.css">
        <title>Administrateur | Clients - modifier</title>
        <link rel="shortcut icon" href="../../assets/img/logo.png">
    </head>
    <body>
        <nav>
            <img src="../../assets/img/logo.png" alt="logo">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="/admin/clients">Clients</a></li>
                <li class="hover"><a href="/admin/employes">Employés</a></li>
                <li><a href="#">Tarification</a></li>
                <li><a href="#">Stock</a></li>
                <li ><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
        <main>
            <form method="post" class="employe-selecteur">
                <section>
                    <label for="employe-select">Choisir un employé</label>
                    <select id="employe-select" onchange="submit()" name="select">
                        <option value="">--Employé--</option>
                        <?php
                            foreach($userManager->getAllGarageUser() as $people){
                                $name  = $people->getName()." ".$people->getFirstName();
                                $code = $people->getId();
                                ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                            }
                        ?>
                    </select>
                </section>
            </form>
            <?php
            if($user === null){
                echo "<section class='choose'><h1>Veuillez séléctionner un employé pour commencer l'opération</h1></section>";
            }else{
                ?>
                <form class="employe-informations" method="post">
                    <input type="text" name="name" id="name" value='<?php echo $user->getName()?>'>
                    <input type="text" name="firstname" id="firstname" value='<?php echo $user->getFirstName()?>'>
                    <input type="text" name="adresse" id="adresse" value='<?php echo $user->getAdresse()?>'>
                    <input type="text" name="codepostal" id="codepostal" value='<?php echo $user->getCodePostal()?>'>
                    <input type="text" name="city" id="city" value='<?php echo $user->getCity()?>'>
                    <input type="tel" name="telephone" id="telephone" value='<?php echo $user->getTelephoneNumber()?>'>
                    <input type="submit" value="Modifier l'employé" id="modify" class="tier">
                    <input type="submit" value="Supprimer l'employé" id="del" class="tier">
                    <input type="reset" value="Réinitialiser les informations" class="tier">
                </form>
                <?php
            }
            ?>
        </main>
    </body>
</html>