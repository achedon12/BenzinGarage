<?php

use app\users\Auth;

session_start();

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

require_once("./assets/php/managers/TemplateManager.php");
require_once("./assets/php/managers/GarageManager.php");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/stock.css">
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
