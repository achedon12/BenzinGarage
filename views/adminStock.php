
<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/managers/GarageManager.php ";
require_once "assets/php/class/Piece.php ";
require_once "assets/php/managers/TemplateManager.php";

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

if(isset($_POST["plusArticle"]) && $_POST["plusArticle"]!==0){
    $garageManager->plusOneProduct($_POST["plusArticle"]);
    header("Location:./stock");
}
// moins
if(isset($_POST["moinsArticle"]) && $_POST["moinsArticle"]!==0){

    $garageManager->moinsOneProduct($_POST["moinsArticle"]);
    header("Location:./stock");
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
<?php
TemplateManager::getAdminNavBar("stock");
?>
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
            <section class="productContainerTitle"><h2 class="ProductName">Nom</h2> <h2 class="RefProduct"> Reférence </h2> <h2 class="PriceProduct">Prix</h2> <h2 class="QteProduct">Quantitée en stock</h2> <h2 class="QteProductMinimum">Quantité minimum </h2></section>
            <?php
            $test='enstock';
            $test2='pasenstock';

            if (isset($_POST['select']) && $_POST['select']==$test) {
                $pieces = $garageManager->getAllPiecesAvailable();

                foreach ($pieces as $piece) {
                    echo '<section class="productContainer"><h2 class="ProductName">' . $piece->getLibelleArticle() . '</h2> <h2 class="RefProduct">' . $piece->getCodeArticle() . '</h2> <h2 class="PriceProduct">' . $piece->getPrice() . ' €</h2> <h2 class="QteProduct">' . $piece->getStockQuantite() . '</h2> <h2 class="QteProductMinimum">'.$piece->getMinimalQuantite().' </h2>
                                        <input type="submit" value="'.$piece->getCodeArticle().'" class="plusArticle" name="plusArticle" src="../assets/img/plus.png">
                                    <input type="submit" value="'.$piece->getCodeArticle().'" class="moinsArticle" name="moinsArticle" src="../assets/img/moins.png">
                       </section>';
                }
            }elseif (isset($_POST['select']) && $_POST['select']==$test2){
            $pieces = $garageManager->getAllPiecesNotAvailable();
            foreach ($pieces as $piece) {
                echo '<section class="productContainer"><h2 class="ProductName">' . $piece->getLibelleArticle() . '</h2> <h2 class="RefProduct">' . $piece->getCodeArticle() . '</h2> <h2 class="PriceProduct">' . $piece->getPrice() . ' €</h2> <h2 class="QteProduct">' . $piece->getStockQuantite() . '</h2></h2> <h2 class="QteProductMinimum">'.$piece->getMinimalQuantite().' </h2> <input class="inputrefillStock" value="'.$piece->getCodeArticle().'" name="refillStockUn" type="submit"></section>';
            }

            }


            ?>
        </section>

    </form>



</section>


</body>
</html>