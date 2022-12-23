
<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/managers/GarageManager.php ";
require_once "assets/php/class/Piece.php ";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());
$garageManager = new GarageManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST["select"]) && $_POST["select"] !== "null"){
    $_SESSION["typeProduct"] = $_POST["select"];
}


if(!Auth::isConnected()){
    render("connexion.php");
    return;
}
$garageManager=new GarageManager(DatabaseManager::getInstance());

if(isset($_POST['refillstock'])){

    $pieces=$garageManager->getAllPiecesNotAvailable();
    foreach ($pieces as $piece) {
        print_r($piece);
        $garageManager->setAvailablePieceWhenRefill($piece->getCodeArticle());

    }
}

if(isset($_POST['refillStockUn'])){

    $garageManager->setAvailablePieceWhenRefill($_POST['refillStockUn']);
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
    <h1> <?php
        if (!isset($_POST['select'])){
            echo "pas de produit selectionné";

        }else{
            if($_SESSION['typeProduct']== 'enstock'){echo "Les produits en stock";}
            elseif($_SESSION['typeProduct']== 'null'){echo "pas de produit selectionné";}
            else{echo "Les produits  pas en stock";}
        }
        ?> </h1>
    <form method="post" onchange="submit()">
        <section class="AllProduct">
            <section class="productContainerTitle"><h2 class="ProductName">Nom</h2> <h2 class="RefProduct"> Reférence </h2> <h2 class="PriceProduct">Prix</h2> <h2 class="QteProduct">Quantitée en stock</h2></section>
            <?php
            $test='enstock';
            $test2='pasenstock';

            if (isset($_POST['select']) && $_POST['select']==$test) {
                $pieces = $garageManager->getAllPiecesAvailable();

                foreach ($pieces as $piece) {
                    echo '<section class="productContainer"><h2 class="ProductName">' . $piece->getLibelleArticle() . '</h2> <h2 class="RefProduct">' . $piece->getCodeArticle() . '</h2> <h2 class="PriceProduct">' . $piece->getPrice() . ' €</h2> <h2 class="QteProduct">' . $piece->getStockQuantite() . '</h2> 
    
                       </section>';
                }
            }elseif (isset($_POST['select']) && $_POST['select']==$test2){
            $pieces = $garageManager->getAllPiecesNotAvailable();

            foreach ($pieces as $piece) {
                echo '<section class="productContainer"><h2 class="ProductName">' . $piece->getLibelleArticle() . '</h2> <h2 class="RefProduct">' . $piece->getCodeArticle() . '</h2> <h2 class="PriceProduct">' . $piece->getPrice() . ' €</h2> <h2 class="QteProduct">' . $piece->getStockQuantite() . '</h2> <input class="inputrefillStock" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit"></section>';
            }
            echo '<input  value="refillstock" class="refillStock" type="submit">';
            }


            ?>
        </section>

    </form>



</section>


</body>
</html>