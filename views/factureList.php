<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/TemplateManager.php";
require_once "assets/php/managers/FactureManager.php";
require_once "assets/php/managers/InterventionManager.php";
require_once "assets/php/managers/ClientManager.php";

$interventionManager = new InterventionManager(DatabaseManager::getInstance());
$factureManager = new FactureManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
    $_SESSION["facture"] = 0;
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["select"]) && $_POST["select"] !== "--Facture--"){
    $_SESSION["facture"] = $_POST["select"];
}

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
    <title>Factures | Liste</title>
</head>
<body>
<?php
TemplateManager::getAdminNavBar("factureFar");
?>
<main>
    <form method="post" class="selecteur" onchange="submit()">
        <section>
            <label for="facture-select">Choisir une Facture</label>
            <form method="post" onchange="submit()" >
                <input list="facture-select" id="myClient" name="select" placeholder="Facture" style="margin-top: 25px"/>
            </form>
            <datalist id="facture-select">
                <?php
                if($_SESSION["facture"] === 0){
                    echo '<option value="false" disabled selected>--Facture--</option>';
                }
                foreach($factureManager->getAllFacture() as $facture){
                    $code = $facture->getFactureNumber();
                    $client = $clientManager->getClientByID($interventionManager->getCodeClientFromDemandeIntervention($facture->getNumDde()));
                    if($client !== null){
                        $name = $client->getName()." ".$client->getFirstName()." ".$facture->getFactureDate();
                        if($code == $_SESSION["facture"]){
                            ?><option value='<?php echo $code ?>' selected><?php echo $name ?></option><?php
                        }else{
                            ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                        }
                    }
                }
                ?>
            </datalist>
        </section>
    </form>
    <section class="create">
        <?php
        if($_SESSION["facture"] == 0){
            echo '<section class="head"><h1 class="no-facture">Aucune Facture sélectionnée</h1></section>';
        }else{
            $facture = $factureManager->getFacture($_SESSION["facture"]);
            $factureManager->toForm($facture);
        }
        ?>
    </section>
</main>
</body>
</html>