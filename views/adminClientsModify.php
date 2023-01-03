<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";
require_once "assets/php/class/Client.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());

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
        if($clientManager->modifyClient($newClient,$_POST["id"])){
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
<nav>
    <img src="../../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin">Accueil</a></li>
        <li class="hover"><a href="/admin/clients">Clients</a></li>
        <li><a href="/admin/employes">Employés</a></li>
        <li><a href="/admin/tarification">Tarification</a></li>
        <li><a href="/admin/stock">Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>
<main>
    <form method="post" class="selecteur" onchange="submit()">
        <section>
            <label for="client-select">Choisir un client</label>
            <select id="client-select" name="select">
                <?php
                    if($_SESSION["userId"] === 0){
                        echo '<option value="false" disabled selected>--Client--</option>';
                    }
                    foreach($clientManager->getAllClients() as $people){
                        $name = $people->getName()." ".$people->getFirstName();
                        $code = $people->getId();
                        if($code == $_SESSION["userId"]){
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
    if($_SESSION["userId"] === 0){
        ?>
        <section class="choose">
            <?php if($_SESSION["errorClient"] === "none"){
                echo '<h1 class="errorCreate">Une erreur s\'est produite</h1>';
            }elseif($_SESSION["errorClient"] === "confirmDelete"){
                echo '<h1 class="errorCreate">Vous avez bien supprimé le client</h1>';
            }elseif ($_SESSION["modifyClient"] === "none"){
                echo '<h1>Une erreur s\'est produite lors de la modification d\'un client</h1>';
            }elseif($_SESSION["modifyClient"] === "confirmModify"){
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
                    <?php $vehicul = $userManager->getVehiculeByUserId("2         ") ?>
                    <label>
                        <input type="text" value="<?php echo $vehicul["noimmatriculation"]?>">
                    </label>
                    <label>
                        <input type="text" value="<?php echo $vehicul["noserie"]?>">
                    </label>
                    <label>
                        <input type="text" value="<?php echo $vehicul["datemiseencirculation"]?>">
                    </label>
                    <label>
                        <input type="text" value="<?php echo $vehicul["nummodele"]?>">
                    </label>

                </section>


                <section>
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