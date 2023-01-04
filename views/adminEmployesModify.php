<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/TemplateManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
    $_SESSION["errorEmploye"] = 0;
    $_SESSION["managerId"] = 0;
    $_SESSION["modifyEmploye"] = 0;
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST["select"]) && $_POST["select"] !== "--Employé--"){
    $_SESSION["managerId"] = $_POST["select"];
}

if(isset($_POST["delete"])){
    if($userManager->deleteUser($_POST["id"])){
        $_SESSION["managerId"] = 0;
        $_SESSION["errorEmploye"] = "confirmDelete";
    }else{
        $_SESSION["errorEmploye"] = "none";
    }
}

if(isset($_POST["modify"])){
    if(empty($_POST["firstname"]) || empty($_POST["name"]) || empty($_POST["password"])) {
        $_SESSION["modifyEmploye"] = "none";
    }else{
        $newClient = new User($_POST["id"],$_POST["name"],$_POST["password"],$_POST["firstname"],$_POST["role-select"]);
        if($userManager->modifyUser($newClient,$_POST["id"])){
            $_SESSION["userId"] = 0;
            $_SESSION["modifyEmploye"] = "confirmModify";
        }else{
            $_SESSION["modifyEmploye"] = "none";
        }
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
    TemplateManager::getAdminNavBar("employesFar");
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
                <section id="client-select" style="gap: 10px;    display: flex;    flex-direction: column; overflow-x: auto ; height: 100em; width: 300px">
                    <?php
                    if(isset($_POST["filtreNom"]) && $_POST["filtreNom"]==="yes"){
                        foreach($userManager->getAllEmployeOrderByName() as $people){
                            $name = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["userId"]){
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
                            }else{
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
                            }
                        }
                    }elseif(isset($_SESSION['cocher']) && $_SESSION['cocher']==="no"){
                        foreach($userManager->getAllEmployees() as $people){
                            $name = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["userId"]){
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
                            }else{
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
                            }
                        }
                    }else{
                        foreach($userManager->getAllEmployees() as $people){
                            $name = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["userId"]){
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
                            }else{
                                ?><section style="display: flex;flex-direction: row;align-items: center;gap: 10px"><input type="submit" class="buttonSelectClient" name="select" value='<?php echo $code ?>'><h2><?php echo $name ?></h2></input></section><?php
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
                        <h1>Veuillez séléctionner un employé pour commencer l'opération</h1>
                    </section>
                    <?php
                }else{
                        $user = $userManager->getUser($_SESSION["managerId"]);
                        if($user != null){
                    ?>
                    <form class="informations" method="post">
                        <h2 style ="width: 100%; text-align: center">Employé : n° <?php echo $user->getId()?></h2>
                        <section class="admin" style="width: 100%">
                            <input type="text" name="name" id="name" value='<?php echo $user->getName()?>'>
                            <input type="text" name="password" id="password" value='<?php echo $user->getHashedPassword()?>'>
                            <input type="text" name="id" hidden id="id" value='<?php echo $user->getId()?>'>
                            <input type="text" name="firstname" id="firstname" value='<?php echo $user->getFirstName()?>'>
                            <select id="role-select" name="role-select">
                                <?php
                                foreach($userManager->getRoles() as $role){
                                    if($user->getRole() === $role){
                                        ?><option value='<?php echo $role ?>' selected><?php echo $role ?></option><?php
                                    }else{
                                        ?><option value='<?php echo $role ?>'><?php echo $role ?></option><?php
                                    }
                                }
                                ?>
                            </select>
                        </section>
                        <section></section>
                        <section>
                            <input type="submit" value="Modifier l'employé" id="modify" class="tier" name="modify">
                            <input type="submit" value="Supprimer l'employé" id="del" class="tier" name="delete">
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
$_SESSION["errorEmploye"] = 0;
?>