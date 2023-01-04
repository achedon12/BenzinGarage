<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "./assets/php/managers/TemplateManager.php";
require_once "./assets/php/managers/GarageManager.php";
require_once "assets/php/class/Piece.php ";

$userManager = new UserManager(DatabaseManager::getInstance());
$garageManager = new GarageManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}


//$_SESSION["articleCommande"]=[];



if(isset($_POST["ajoutProduitCommande"])){
    $_SESSION["articleCommande"][] = $_POST["ajoutProduitCommande"];
}

//print_r($_SESSION["articleCommande"]);

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
    <title><?php if($_SESSION["role"] === UserManager::MANAGER){echo "Chef d'atelier ";}else{echo"Employé ";} ?> : Stock</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/stock.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
    <body>
    <?php
    TemplateManager::getDefaultNavBar("stock");
    ?>
        <main>
            <form method="post" id="recherche">
                <input type="text" name="search" id="id-product" placeholder="Recherche d'un produit par son id">
            </form>

            <section class="sectionListProduct">
                <form method="post">
                <?php

                $pieces = $garageManager->getAllPieces();

                if($_SESSION["role"] === UserManager::MANAGER){
                    if (isset($_POST['search'])) {

                        $pieces = $garageManager->getPieceById((string)$_POST['search']);
                        if ($pieces != null) {
                            echo "test";
                            $piece = new Piece($pieces[0], $pieces[1], $pieces[2], $pieces[3], $pieces[4], $pieces[5]);
                            if ($piece->getStockQuantite()<=$piece->getMinimalQuantite()){
                                echo '<article class="ligne-product">
                                <section class="red">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    <input class="validerCommande" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit">
                                    
                                </section>
                            </article>';
                            }else{
                                echo '<article class="ligne-product">
                                <section class="green">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    <input class="validerCommande" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit">
                                   
                                </section>
                            </article>';
                            }

                        } else {
                            echo "il n'y a pas de produit avec cette référence";
                        }
                    }else{
                    foreach ($pieces as $piece){
                        $qte=$piece->getStockQuantite();
                        $qtemini=$piece->getMinimalQuantite();
                        if ($qte<$qtemini){
                            echo '<article class="ligne-product">
                                <section class="red">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    <input class="validerCommande" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit">
                                    
                                </section>
                            </article>';
                        }else{
                            echo '<article class="ligne-product">
                                <section class="green">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    <input class="validerCommande" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit">
                                    
                                </section>
                            </article>';
                        }
                    }
                    }
                }else{
                    foreach ($pieces as $piece){
                        $qte=$piece->getStockQuantite();
                        $qtemini=$piece->getMinimalQuantite();
                        if ($qte<$qtemini){
                        echo '<article class="ligne-product">
                                <section class="red">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    <input type="submit" name="ajoutProduitCommande" id="'.$piece->getLibelleArticle().'" value="'.$piece->getCodeArticle().'">
                                </section>
                            </article>';
                        }else{
                            echo '<article class="ligne-product">
                                <section class="green">
                                    <p class="product-name">' . $piece->getLibelleArticle() . '</p></br>
                                    <p class="product-ref">Référence : ' . $piece->getCodeArticle() . '</p>
                                    <p class="piece-available">' . $piece->getStockQuantite() . ' pièce(s) restante(s)</p>
                                    
                                </section>
                            </article>';
                        }
                    }
                }
                ?>
            </form>
            </section>

            <?php
            if($_SESSION["role"] === UserManager::MANAGER){
                echo '<section class="button"><button onclick="">Valider commande</button></section>';
            }else{
                echo '<section class="button"><button onclick="">Passer la commande</button></section>';
            }
            ?>
        </main>
    </body>
<script src="/assets/js/chefAtelierRDV.js"></script>
</html>
