<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/CalendarManager.php";
require_once "assets/php/managers/TemplateManager.php";

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
<?php
TemplateManager::getAdminNavBar("planning");
?>
<main>
    <section class="interventionWindow">
        <form method="post" class="selecteur" onchange="submit()">
            <section class="choixPlanning">
                <form method="post" onchange="submit()">
                    <input list="Employe" id="myClient" name="select" placeholder="Nom employé"/>
                </form>
                <datalist id="Employe">
                    <?php
                    foreach ($userManager->getAllEmployees() as $employee){
                        $nameEmploye = $employee->getName();
                        $codeEmploye = $employee->getId();
                        $FirstNameEmplo = $employee->getFirstName();
                        $nom=$nameEmploye.' '.$FirstNameEmplo;
                        if ($codeEmploye == $_SESSION["codeEmploye"]) {
                            echo '<option value="' . $codeEmploye . '" selected>' . $nom . '</option>';
                        }else{
                            echo '<option value="' . $codeEmploye . '">' . $nom . '</option>';
                        }
                    }

                    ?>
                </datalist>
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
            <h1 class="choosenDate"><?php echo 'Semaine du '.$calendarManager->convertDate($_SESSION["weekPlanning"][0]).' au '.$calendarManager->convertDate($_SESSION["weekPlanning"][6]);?></h1>
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