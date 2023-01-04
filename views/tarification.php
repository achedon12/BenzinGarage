<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/managers/GarageManager.php ";
require_once "assets/php/class/Piece.php ";
require_once "./assets/php/managers/TemplateManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());
$garageManager = new GarageManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["select"]) && $_POST["select"] !== "--Produit--"){
    $_SESSION["productId"] = $_POST["select"];
}

if(isset($_POST["submitProduitChangement"])){
    if(empty($_POST["newPrice"])) {
        $_SESSION["modifyProduct"] = "none";
    }else{
        $produit =$garageManager->getPieceById($_SESSION['productId']);
        $newprice= new Piece($_SESSION['productId'],$produit[1],$produit[2],$produit[3],$_POST['newPrice'],$produit[5]);
        if($garageManager->modifyPiece($newprice,$_SESSION["productId"])) {
            $garageManager->modifyPiece($newprice,$_SESSION["productId"]);
            $_SESSION["productId"] = null;
        }
    }
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

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="stylesheet" href="../assets/css/chefAtelierPriseRDV.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <link rel="stylesheet" href="../assets/css/adminClientsEmployesModify.css">
    <link rel="stylesheet" href="../assets/css/adminTarification.css">

    <title><?php if($_SESSION["role"] === UserManager::MANAGER){echo "Chef d'atelier ";}else{echo"Employé ";} ?> : Tarification</title>
</head>
<body>
<?php
TemplateManager::getDefaultNavBar("tarifs");
?>
<form method="post" class="selecteur" onchange="submit()">
    <section>
        <label for="myClient">Liste des Produits</label>

        <form method="post" onchange="submit()">
            <input list="Clients" id="myClient" name="select" placeholder="Nom produit"/>
        </form>
        <datalist id="Clients">
            <?php
            foreach ($garageManager->getAllPieces() as $product){
                $nameProduct = $product->getLibelleArticle();
                $codeProduct = $product->getCodeArticle();
                $originPrice= $garageManager->getPiecePrice($product->getCodeArticle());
                if ($codeProduct == $_SESSION["productId"]) {
                    echo '<option value="' . $codeProduct . '" selected>' . $nameProduct . '</option>';
                }else{
                    echo '<option value="' . $codeProduct . '">' . $nameProduct . '</option>';
                }
            }

            ?>
        </datalist>
    </section>
</form>
<section class="produit" style="height: 50%; width: 50%">
    <h1> type du produit :
        <?php
        if (!isset($_SESSION["productId"])){
            echo 'pas de produit selectionné';
        }else{
            echo $garageManager->getPieceById($_SESSION["productId"])[3];

        }

        ?>
    </h1>
    <h2>Réference : <?php
        if (!isset($_SESSION["productId"])){
            echo '<h1>Pas de produit selectionné</h1>';
        }else{
            echo '<h1>'.$garageManager->getPieceById($_SESSION["productId"])[1].'</h1>';
        }
        ?>   </h2>
    <form action="" method="post" >


        <section class="containerPrices">
            <input type="text" name="originPrice" disabled value=" <?php
            if(isset($_SESSION["productId"])) {
                echo $garageManager->getPieceById($_SESSION["productId"])[4];
            }else{
                echo "";
            }
            ?> " class="sortiePrix">
        <?php
        if($_SESSION["role"] === UserManager::MANAGER){echo '<input type="text" name="newPrice" placeholder="Nouveau prix" class="sortiePrix">';}else{echo "";}

        ?>
        </section>

    </form>



</section>


</body>
</html>
