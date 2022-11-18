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

$_SESSION["managerId"] = 0;

if(isset($_POST["select"]) && $_POST["select"] !== "--Employé--"){
    $_SESSION["managerId"] = $_POST["select"];
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
            <form method="post" class="selecteur" onchange="submit()">
                <section>
                    <label for="employe-select">Choisir un employé</label>
                    <select id="employe-select" name="select">
                        <?php
                            if ($_SESSION["managerId"] === 0) {
                                echo '<option value="false" disabled selected>--Employé--</option>';
                            }
                            foreach($userManager->getAllUser() as $people){
                                $name  = $people->getName()." ".$people->getFirstName();
                                $code = $people->getId();
                                if($code == $_SESSION["managerId"]){
                                    ?><option value='<?php echo $code ?>' selected><?php echo $name ?></option><?php
                                }else{
                                    ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                                }
                            }
                        ?>
                    </select>
                </section>
            </form>
                <?php
                if($_SESSION["managerId"] === 0){
                    ?>
                    <section class="choose">
                        <h1>Veuillez séléctionner un employé pour commencer l'opération</h1>
                    </section>
                    <?php
                }else{
                        $user = $userManager->getUser($_SESSION["managerId"]);
                        if($user != null){
                    ?>
                    <form class="informations" method="post">
                        <section class="admin">
                            <input type="text" name="name" id="name" value='<?php echo $user->getName()?>'>
                            <input type="text" name="firstname" id="firstname" value='<?php echo $user->getFirstName()?>'>
                            <select id="role-select" name="role-select">
                                <?php
                                foreach($userManager->getRoles() as $role){
                                    if($user->getRole() === $role){
                                        ?><option value='<?php echo $role ?>' selected><?php echo $role ?></option><?php
                                    }else{
                                        ?><option value='<?php echo $role ?>'><?php echo $role ?></option><?php
                                    }
                                }
                                ?>
                            </select>
                        </section>
                        <section>
                            <input type="submit" value="Modifier l'employé" id="modify" class="tier">
                            <input type="submit" value="Supprimer l'employé" id="del" class="tier">
                            <input type="reset" value="Réinitialiser les informations" class="tier">
                        </section>
                    </form>
                    <?php
                    }
                }
            ?>
        </main>
    </body>
</html>