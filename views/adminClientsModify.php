<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/class/Client.php";
require_once "assets/php/managers/GarageManager.php";
require_once "assets/php/managers/TemplateManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());
$garaManager = new GarageManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
    $_SESSION["userId"] = 0;
    $_SESSION["errorClient"] = 0;
    $_SESSION["modifyClient"] = 0;
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["select"]) && $_POST["select"] !== "--Client--"){
    $_SESSION["userId"] = $_POST["select"];
}

if(isset($_POST["modify"])){
    if(empty($_POST["firstname"]) || empty($_POST["name"]) || empty($_POST["adresse"]) || empty($_POST["codepostal"]) || empty($_POST["city"]) || empty($_POST["mail"]) || empty($_POST["telephone"])) {
        $_SESSION["modifyClient"] = "none";
    }else{
        $newClient = new Client($_POST["id"],$_POST["name"],$_POST["firstname"],$_POST["adresse"],$_POST["codepostal"],$_POST["city"],$_POST["telephone"],$_POST["mail"],date("Y-n-d"));

        $newVehicule = new Vehicle($_POST["NoIm"],$_POST["NoSer"],$_POST["DateCir"],$_POST["NumDe"],$_POST['id']);
        if($clientManager->modifyClient($newClient,$_POST["id"]) && $garaManager->modifyVehicule($newVehicule,$newClient->getId())){
            $_SESSION["userId"] = 0;
            $_SESSION["modifyClient"] = "confirmModify";
        }else{
            $_SESSION["modifyClient"] = "none";
        }
    }
}

if(isset($_POST["delete"])){
    if($clientManager->deleteClient($_POST["id"])){
        $_SESSION["userId"] = 0;
        $_SESSION["errorClient"] = "confirmDelete";
    }else{
        $_SESSION["errorClient"] = "none";
    }
}

if(isset($_POST["filtreNom"])){
    $_SESSION['cocher']=$_POST["filtreNom"];
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../../assets/css/adminClientsEmployesModify.css">
    <title>Administrateur | Clients - modifier</title>
    <link rel="shortcut icon" href="../../assets/img/logo.png">
</head>
<body>
<?php
TemplateManager::getAdminNavBar("clientsFar");
?>
<main>
    <form method="post" class="selecteur" onchange="submit()">
        <section>
            <h1>Choisir un client</h1>
            <form method="post" onchange="submit()">
                <label for="filtreNom"> Trier par ordre alphabétique
                    <?php
                    if(isset($_SESSION['cocher']) && $_SESSION["cocher"]==="yes") {

                        echo '<input type = "checkbox" name = "filtreNom" value = "no"> On';

                    }elseif(isset($_SESSION['cocher']) && $_SESSION["cocher"]==="no"){
                        echo '<input type = "checkbox" name = "filtreNom" value = "yes"> Off';

                    }else{
                        echo '<input type = "checkbox" name = "filtreNom" value = "yes"> Off';
                    }
                    ?>
                </label>
            </form>
            <section id="client-select" style="    gap: 10px;    display: flex;    flex-direction: column; overflow-x: auto ; height: 100em; width: 300px">
                <?php
                if(isset($_SESSION['cocher']) && $_SESSION['cocher']==="yes"){

                    foreach($clientManager->getAllClientOrderByName() as $people){
                        $name = $people->getName()." ".$people->getFirstName();
                        $code = $people->getId();
                        if($code == $_SESSION["userId"]){
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }else{
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit"  name="select" class="buttonSelectClient" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }
                    }
                }elseif(isset($_SESSION['cocher']) && $_SESSION['cocher']==="no"){

                    foreach($clientManager->getAllClients() as $people){
                        $name = $people->getName()." ".$people->getFirstName();
                        $code = $people->getId();
                        if($code == $_SESSION["userId"]){
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit"  name="select" class="buttonSelectClient" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }else{
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit"  name="select" class="buttonSelectClient" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }
                    }
                }else{
                    foreach($clientManager->getAllClients() as $people){
                        $name = $people->getName()." ".$people->getFirstName();
                        $code = $people->getId();
                        if($code == $_SESSION["userId"]){
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit"  name="select" class="buttonSelectClient" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }else{
                            ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit"  name="select" class="buttonSelectClient" value='<?php echo $code ?>'><h2><?php echo ucwords(strtolower($name)) ?></h2></input></section><?php
                        }
                    }
                }
                ?>
            </section>
        </section>
    </form>
    <?php
    if($_SESSION["managerId"] === 0){
        ?>
        <section class="choose">
            <?php if($_SESSION["errorEmploye"] === "none"){
                echo '<h1 class="errorCreate">Une erreur s\'est produite</h1>';
            }elseif($_SESSION["errorEmploye"] === "confirmDelete"){
                echo '<h1 class="errorCreate">Vous avez bien supprimé l\'employé</h1>';
            }elseif ($_SESSION["modifyEmploye"] === "none"){
                echo '<h1>Une erreur s\'est produite lors de la modification d\'un client</h1>';
            }elseif($_SESSION["modifyEmploye"] === "confirmModify"){
                echo '<h1 class="errorCreate">Vous avez bien modifié le client</h1>';
            }
            ?>
            <h1>Veuillez séléctionner un client pour commencer l'opération</h1>
        </section>
        <?php
    }else{
            $user = $clientManager->getClientByID($_SESSION["userId"]);
            if($user != null){
        ?>
            <form class='informations' method='post'>
                <h2 style ="width: 100%; text-align: center">Client : n° <?php echo $user->getId()?></h2>
                <section>
                    <input type="text" name="name" id="name" value="<?php echo $user->getName()?>">
                    <input type="text" name="id" hidden id="id" value="<?php echo $user->getId()?>">
                    <input type="text" name="firstname" id="firstname" value='<?php echo $user->getFirstName()?>'>
                    <input type="text" name="adresse" id="adresse" value='<?php echo $user->getAdresse()?>'>
                    <input type="text" name="mail" id="mail" value='<?php echo $user->getEmail()?>'>
                    <input type="text" name="codepostal" id="codepostal" value='<?php echo $user->getCodePostal()?>'>
                    <input type="text" name="city" id="city" value='<?php echo $user->getCity()?>'>
                    <input type="tel" name="telephone" id="telephone" value='<?php echo $user->getTelephoneNumber()?>'>
                </section>

                <section class="vehicule">
                    <?php $vehicul = $userManager->getVehiculeByUserId($user->getId());
                    ?>
                    <label> Plaque d'immatricualtion
                        <input type="text" name="NoIm" value="<?php echo $vehicul->getNumberPlate()?>">
                    </label> <br>
                    <label> NoSerie
                        <input type="text" name="NoSer" value="<?php echo $vehicul->getNumeroSerie()?>">
                    </label><br>
                    <label> Date mise en service
                        <input type="text" name="DateCir" value="<?php echo $vehicul->getDateMiseEnCirculation()?>">
                    </label><br>
                    <label> Num de modèle
                        <input type="text" name="NumDe" value="<?php echo $vehicul->getNumerModele()?>">
                    </label><br>

                </section>


                <section class="validateButtonClient">
                    <input type="submit" value="Modifier le client" id="modify" class="tier" name="modify">
                    <input type="submit" value="Supprimer le client" id="del" class="tier" name="delete">
                    <input type="reset" value="Réinitialiser les informations" class="tier">
                </section>
            </form>
        <?php
        }
    }
    ?>
</main>
</body>
</html>
<?php
$_SESSION["errorClient"] = 0;
?>