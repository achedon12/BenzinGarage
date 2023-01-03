<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "assets/php/managers/TemplateManager.php";
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

if(isset($_POST["select"]) && $_POST["select"] !== "--Employé--"){
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
    <link rel="stylesheet" href="../assets/css/accueil.css">
    <link rel="stylesheet" href="../assets/css/adminInterventionPlanning.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
    <title>Planning</title>
</head>
<body>
<?php
TemplateManager::getDefaultNavBar("planning");
?>
<main>
    <section class="interventionWindow">
        <form class="dateChoose" method="post">
            <h1 class="choosenDate" style="margin-top: 1%"><?php echo 'Semaine du '.$calendarManager->convertDate($_SESSION["weekPlanning"][0]).' au '.$calendarManager->convertDate($_SESSION["weekPlanning"][4]);?></h1>
        </form>
        <section class="planing">
            <?php
            $calendarManager->displayTable($_SESSION["id"],$_SESSION["weekPlanning"],false);
            ?>
        </section>
        <?php $calendarManager->displayPopup(false); ?>
    </section>
</main>
</body>
<script src="../assets/js/planning.js"></script>
</html>