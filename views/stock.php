<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once("./assets/php/managers/TemplateManager.php");

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
    <link rel="stylesheet" href="../assets/css/stock.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
    <body>
        <?php
            TemplateManager::getDefaultNavBar("stock");
        ?>
        <main>
            <form method="post">
                <input type="text" name="search" id="id-product" placeholder="Recherche d'un produit par son id">
            </form>
            <section>
                <?php

                $pieces = getAllPieces();

                if($_POST["role"] === UserManager::MANAGER){
                    foreach ($pieces as $piece){
                        echo '<article class="ligne-product">
                               <section>
                                   <p class="product-name">'.$piece->getName().'</p>
                                   <p class="product-ref">Référence : '.$piece->getReference.'</p>
                                   <p class="piece-available">'.$piece->getStock().' pièce(s) restante(s)</p>
                                </section>
                               <img src="../assets/img/add-basket.png" alt="add to basket">
                            </article>';
                    }
                }else{
                    foreach ($pieces as $piece){
                        echo '<article class="ligne-product">
                               <p class="product-name">'.$piece->getName().'</p>
                               <p class="product-ref">Référence : '.$piece->getReference.'</p>
                               <p class="piece-available">'.$piece->getStock().' pièce(s) restante(s)</p>
                            </article>';
                    }
                }
                if($_POST["role"] === UserManager::MANAGER){
                    echo '<section class="button"><button>Valider commande</button></section>';
                }
                ?>
            </section>
        </main>
    </body>
</html>
