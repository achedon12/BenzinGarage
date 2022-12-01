<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/ClientManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$clientManager = new ClientManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

$_SESSION["userId"] = 0;

if(isset($_POST["select"]) && $_POST["select"] !== "--Client--"){
    $_SESSION["userId"] = $_POST["select"];
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
                    foreach($userManager->getAllClients() as $people){
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
                <h1>Veuillez séléctionner un client pour commencer l'opération</h1>
            </section>
        <?php
        }else{
                $user = $clientManager->getClient($_SESSION["userId"]);
                if($user != null){
            ?>
                <form class='informations' method='post'>
                    <section>
                        <input type="text" name="name" id="name" value="<?php echo $user->getName() ?>">
                        <input type="text" name="firstname" id="firstname" value='<?php echo $user->getFirstName()?>'>
                        <input type="text" name="adresse" id="adresse" value='<?php echo $user->getAdresse()?>'>
                        <input type="text" name="codepostal" id="codepostal" value='<?php echo $user->getCodePostal()?>'>
                        <input type="text" name="city" id="city" value='<?php echo $user->getCity()?>'>
                        <input type="tel" name="telephone" id="telephone" value='<?php echo $user->getTelephoneNumber()?>'>
                    </section>
                    <section>
                        <input type="submit" value="Modifier le client" id="modify" class="tier">
                        <input type="submit" value="Supprimer le client" id="del" class="tier">
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