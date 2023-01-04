<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/TemplateManager.php";
require_once "assets/php/managers/FactureManager.php";

$factureManager = new FactureManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["select"]) && $_POST["select"] !== "--Facture--"){
    $_SESSION["facture"] = $_POST["select"];
}

if(isset($_POST["create-facture"])){
    $factureManager->createFacturePDF($factureManager->getFacture($_SESSION["facture"]));
}

print_r($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../../assets/css/facture.css">
    <title>Factures | Création</title>
</head>
<body>
<?php
TemplateManager::getAdminNavBar("factureFar");
?>
<main class="create">
    <form method="post" class="selecteur" onchange="submit()">
        <section>
            <label for="facture-select">Choisir une facture</label>
            <select id="facture-select" name="select">
                <?php
                if($_SESSION["facture"] === 0){
                    echo '<option value="false" disabled selected>--Facture--</option>';
                }
                foreach($factureManager->getAllFacture() as $facture){
                    $code = $facture->getFactureNumber();
                    $name = $facture->getFactureDate();
                    if($code == $_SESSION["facture"]){
                        ?><option value='<?php echo $code ?>' selected><?php echo $name ?></option><?php
                    }else{
                        ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                    }
                }
                ?>
            </select>
        </section>
    </form>
    <?php
    if($_SESSION["facture"] == 0){
        echo '<section class="head"><h1 class="no-facture">Aucune facture sélectionnée</h1></section>';
    }else{
        echo '<form method="post" class="create-facture"><button name="create-facture">Créer facture</button></form>';
    }
    ?>
</main>
</body>
</html>