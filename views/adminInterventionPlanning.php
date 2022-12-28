<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/CalendarManager.php";

$userManager = new UserManager(DatabaseManager::getInstance());
$calendarManager = new CalendarManager();

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

$_SESSION["weekPlanning"] = $calendarManager->getWeek();

if(isset($_POST["nextWeek"])){
    unset($_SESSION["weekPlanning"]);
    $_SESSION["weekPlanning"] = $calendarManager->nextWeek();
}elseif (isset($_POST["beforeWeek"])){
    unset($_SESSION["weekPlanning"]);
    $_SESSION["weekPlanning"] = $calendarManager->beforeWeek();
}elseif(isset($_POST["select"]) && $_POST["select"] !== "--Employé--"){
    $_SESSION["employePlanning"] = $_POST["select"];
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
        <link rel="stylesheet" href="../assets/css/adminInterventionPlanning.css">
        <link rel="shortcut icon" href="../assets/img/logo.png">
        <title>Planning</title>
    </head>
    <body>
        <nav>
            <img src="../assets/img/logo.png" alt="logo">
            <ul>
                <li><a href="/accueil/admin">Accueil</a></li>
                <li><a href="/admin/clients">Clients</a></li>
                <li><a href="/admin/employes">Employés</a></li>
                <li><a href="/admin/tarification">Tarification</a></li>
                <li><a href="/admin/stock">Stock</a></li>
                <li class="hover"><a href="/admin/interventionPlanning">Intervention</a></li>
                <li><a href="/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
    <main>
        <section class="interventionWindow">
            <form method="post" class="selecteur" onchange="submit()">
                <section class="choixPlanning">
                    <label for="employe-select">Choisir un employé</label>
                    <select id="employe-select" name="select">
                        <?php
                        if ($_SESSION["employePlanning"] === 0) {
                            echo '<option value="false" disabled selected>--Employé--</option>';
                        }
                        foreach($userManager->getAllUser() as $people){
                            $name  = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["employePlanning"]){
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
                if($_SESSION["employePlanning"] !== 0) {
                    $user = $userManager->getUser($_SESSION["employePlanning"]);
                    if($user !== null) {
                        echo '<section class="choose"><h1>Emploi du temps de ' . $user->getFirstName() . ' ' . $user->getName() . '</h1></section>';
                    }
                }

            ?>
            <form class="dateChoose" method="post">
                <input type="submit" name="beforeWeek" value="<">
                <h1 class="choosenDate"><?php echo 'Semaine du '.$calendarManager->convertDate($_SESSION["weekPlanning"][0]).' au '.$calendarManager->convertDate($_SESSION["weekPlanning"][4]);?></h1>
                <input type="submit" name="nextWeek" value=">">
            </form>
            <section class="planing">
                <?php
                    if($_SESSION["employePlanning"] === 0){
                        ?>
                        <section class="choose">
                            <h1>Veuillez séléctionner un client pour commencer l'opération</h1>
                        </section>
                    <?php
                    }else{
                       $calendarManager->displayTable($_SESSION["employePlanning"],$_SESSION["weekPlanning"]);
                    }
                ?>

            </section>
            <?php $calendarManager->displayPopup(); ?>
        </section>
    </main>
    </body>
    <script src="../assets/js/intervention.js"></script>
</html>