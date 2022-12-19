
<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/GarageManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}
$garageManager=new GarageManager(DatabaseManager::getInstance());


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
    <link rel="stylesheet" href="../assets/css/adminClientsEmployesModify.css">
    <link rel="stylesheet" href="../assets/css/adminTarification.css">
    <link rel="stylesheet" href="../assets/css/adminStock.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">

    <title>Modifier un client</title>
</head>
<body>
<nav>
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin">Accueil</a></li>
        <li><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/employes">Employés</a></li>
        <li><a href="/admin/tarification">Tarification</a></li>
        <li class="hover"><a href="/admin/stock" >Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<form method="post" class="selecteur" onchange="submit()">
    <section>
        <label for="client-select">Choisir une catégorie</label>
        <select id="client-select" name="select">
            <option value="null">---Choisir une catégorie---</option>
            <option value="enstock">Produit en Stock</option>
            <option value="pasenstock">Produit pas en Stock</option>
        </select>
    </section>
</form>
<section class="produit">
    <h1>Les produits <?php
        if((isset($_POST['select'])) && $_POST['select']== 'enstock'){echo "en stock";}else{echo "pas en stock";}  ?> </h1>
    <form action="" class="AllProduct">

        <?php
        if (isset($_POST['select']) && $_POST['select']== 'enstock'){
            $pieces = $garageManager->getAllPiecesAvailable();

            foreach ($pieces as $piece){
                echo    '<section class="productContainer"><h2 class="ProductName">Nom :'. $piece->getLibelleArticle().'</h2> <h2 class="RefProduct">Ref : '. $piece->getCodeArticle() .'</h2> <h2 class="PriceProduct">Prix : '. $piece->getPrice() .' €</h2> <h2 class="QteProduct"> Quantite : '. $piece->getStockQuantite() .'</h2>

                   </section>';
            }

        }




        ?>







    </form>




</section>


</body>
</html>