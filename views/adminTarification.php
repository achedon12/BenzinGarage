<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

$_SESSION["userId"] = 0;

if(isset($_POST["select"]) && $_POST["select"] !== "--Client--"){
    $_SESSION["userId"] = $_POST["select"];
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/adminClientsEmployesModify.css">
    <link rel="stylesheet" href="../assets/css/adminTarification.css">

    <title>Tarification</title>
</head>
<body>
    <nav>
        <img src="../assets/img/logo.png" alt="logo">
        <ul>
            <li ><a href="/accueil/admin">Accueil</a></li>
            <li><a href="/admin/clients">Clients</a></li>
            <li><a href="/admin/employes">Employés</a></li>
            <li class="hover"><a href="/admin/tarification">Tarification</a></li>
            <li><a href="/admin/stock">Stock</a></li>
            <li ><a href="/admin/interventionPlanning">Intervention</a></li>
            <li><a href="/disconnect">Deconnexion</a></li>
        </ul>
    </nav>

    <form method="post" class="selecteur" onchange="submit()">
        <section>
            <label for="client-select">Choisir un client</label>
            <select id="client-select" name="select">
                <?php

                ?>
            </select>
        </section>
    </form>

    <section class="produit">
        <h1>Nom du produit</h1>
        <h2>Réference : sldjshdfouxhcv</h2>
        <form action="" method="post">

            <section class="containerPrices">
                <input type="text" value="" class="sortiePrix">
                <input type="text" placeholder="Nouveau prix" class="sortiePrix">
            </section>
            <section class="validatePrix">
                <input class="submitEditPrice" type="submit" name="submitProduitChangement" value="Valider des informations">
                <input class="resetEditPrice" type="reset" value="Réinitialiser informations">
            </section>
        </form>



    </section>


</body>
</html>
