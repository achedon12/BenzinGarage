<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
    $_SESSION["errorEmployee"] = 0;
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["create"])){
    if(empty($_POST["firstname"]) || empty($_POST["name"]) || empty($_POST["password"])){
        $_SESSION["errorClient"] = "none";
    }else{
        if($userManager->createUser($_POST["name"],$_POST["firstname"],$_POST["adresse"],$_POST["codepostal"],$_POST["city"],$_POST["telephone"],$_POST["mail"])){
            $_SESSION["errorClient"] = "confirmCreate";
        }else{
            $_SESSION["errorClient"] = "none";
        }
    }
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
    <link rel="stylesheet" href="../../assets/css/adminClientsEmployesCreate.css">
    <title>Administrateur | Clients - modifier</title>
    <link rel="shortcut icon" href="../../assets/img/logo.png">
</head>
<body>
<nav>
    <img src="../../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin">Accueil</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li class="hover"><a href="/admin/employes">Employés</a></li>
        <li><a href="/admin/tarification">Tarification</a></li>
        <li><a href="/admin/stock">Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<main class="create">
    <form method="post">
        <?php  if($_SESSION["errorEmployee"] === "none"){ echo '<h1 class="errorCreate">Les informations n\'ont pas été correctement remplies</h1>'; }elseif($_SESSION["errorClient"] === "confirmCreate"){ echo '<h1 class="errorCreate">L\'employé a bien été créé</h1>'; } ?>
        <h1>Créer un nouvel employé</h1>
        <section class="inputs">
            <input type="text" placeholder="prénom" id="firstname" name="firstname">
            <input type="text" placeholder="nom" id="name" name="name">
            <input type="password" id="password" placeholder="password" name="password">
        </section>
        <select id="role-select" name="select">
            <option value="">--Rôle--</option>
            <?php
            foreach($userManager->getRoles() as $role){
                ?><option value='<?php echo $role ?>'><?php echo $role ?></option><?php
            }
            ?>
        </select>
        <section>
            <input type="reset">
            <input type="submit" value="Créer" name="create">
        </section>
    </form>

</main>
</body>
</html>