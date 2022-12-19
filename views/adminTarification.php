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
<?php

?>
<form method="post" class="selecteur" onchange="submit()">
    <section>
        <label for="client-select">Choisir un produit</label>
        <select id="client-select" name="select">
            <?php
            if(!isset($_SESSION["productId"])){
                echo '<option value="false" selected>--Produit--</option>';
            }
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
        </select>
    </section>
</form>
<section class="produit">
    <h1> nom du produit :
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
            echo '<h1>pas de produit selectionné</h1>';
        }else{
            echo '<h1>'.$garageManager->getPieceById($_SESSION["productId"])[1].'</h1>';
        }
        ?>   </h2>
    <form action="" method="post">

        <section class="containerPrices">
            <input type="text" name="originPrice" value=" <?php
            if(isset($_SESSION["productId"])) {
                echo $garageManager->getPieceById($_SESSION["productId"])[4];
            }else{
                echo "";
            }
            ?> " class="sortiePrix">
            <input type="text" name="newPrice" placeholder="Nouveau prix" class="sortiePrix">
        </section>
        <section class="validatePrix">
            <input class="submitEditPrice" type="submit" name="submitProduitChangement" value="Valider des informations">
            <input class="submitEditPrice" type="reset" value="Réinitialiser informations">
        </section>
    </form>



</section>


</body>
</html>
