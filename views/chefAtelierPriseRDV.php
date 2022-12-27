<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once("./assets/php/managers/TemplateManager.php");
require_once "./assets/php/managers/GarageManager.php";
require_once "./assets/php/managers/ClientManager.php";
require_once "assets/php/class/Piece.php ";
require_once "assets/php/managers/InterventionManager.php";
require_once "assets/php/managers/OperationManager.php";
require_once "assets/php/managers/CalendarManager.php";

$calendarManager = new CalendarManager();
$interventionManager= new InterventionManager(DatabaseManager::getInstance());
$userManager = new UserManager(DatabaseManager::getInstance());
$garageManager = new GarageManager(DatabaseManager::getInstance());
$clientsManager = new ClientManager(DatabaseManager::getInstance());
$operationManager = new OperationManager(DatabaseManager::getInstance());

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!Auth::isConnected()){
    render("connexion.php");
    return;
}

if(isset($_POST['selectClient'])){
    $Client = $clientsManager->getClientByID($_POST['selectClient']);
    $prenomClient=$Client->getFirstName();
    $nomClient= $Client->getName();
    $voiture= $clientsManager->getClientVehicle($Client->getId());
}else{
    $prenomClient=False ;
}
$operationPourUneOperation ='';
if (isset($_POST['typeIntervention'])){

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Chef d'atelier : Prise de rendez-vous</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="stylesheet" href="../assets/css/chefAtelierPriseRDV.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body>
<nav class="nav-bar">
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/chefatelier">Accueil</a></li>
        <li><a href="">Planning</a></li>
        <li class="hover"><a href="/chefAtelier/RDV">Prise de rendez-vous</a></li>
        <li><a href="/chefAtelier/stock">Stock</a></li>
        <li><a href="">Tarification</a></li>
        <li><a href="/chefAtelier/client">Clients</a></li>
        <li><a href="/disconnect">Deconnexion</a></li>
    </ul>
</nav>

<main>
    <form method="post" class="formRDV">
        <section class="InfoClient">
            <section class="CompteClient">
                <h2>Possède un compte client :</h2>
                <a href="#popInscription">Non</a>
                <a href="#popChoixClient">Oui</a>

            </section>
            <section class="NomPrenom">
                <h2>Prenom :<?php if(isset($prenomClient)) echo " ". $prenomClient."</h2>";
                else echo '';
                ?>
                <h2>Nom de famille :<?php if(isset($nomClient)) echo " ".$nomClient."</h2>" ;
                    else echo '';
                ?>
            </section>
            <section class="Date" style="display: flex">
                <h2>Date : </h2> <input type="datetime-local" name="dateRDV" required>
            </section>

            <section class="ValiderPrix">
                <input type="button" onclick="submit()" value="Ajouter le rendez-vous" name="ValiderRDV">
                <h2>58€</h2>
            </section>
        </section>

        <section class="infoIntervetion">

            <section class="interventionRDV">
                    <h2>Parre-Brise</h2>
            </section>



        </section>
        <section class="choixOperation">
            <form method="post" onchange="submit()">
                <?php

                $operations = $operationManager->getOperationList();
                $select = "<label for=\"typeIntervention\">Choisir une operation à faire</label>";
                $select .= "<select name='typeIntervention' id='typeIntervention' class='typeIntervention' onchange='submit()'>";
                $select .= "<option disabled selected value='0'>-- Choisir une intervention --</option>";
                foreach($operations as $operation => $value){
                    $select .= '<option id="' . $operation . '">' . $operation . '</option>';
                }
                $select .= "</select>";
                echo $select;
                ?>
            </form>
        </section>


        <section id="popChoixClient">
            <section id="intoPopUpRDV">
                <h2>Choix du client</h2>
                <form method="post" id="formInscriptionClient" onchange="submit()">
                    <select id="client-select" name="selectClient">
                        <?php
                        if($_SESSION["userId"] === 0){
                            echo '<option value="false" disabled selected>--Client--</option>';
                        }
                        foreach($clientsManager->getAllClients() as $people){
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
                </form>
                <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>

            </section>

        </section>


        <section id="popInscription">
            <section id="intoPopUpRDV">
                <h2>Inscription d'un client</h2>
                <form method="post" id="formInscriptionClient">
                    <label for="NomClient"> Nom du client
                        <input type="text" name="NomClient" placeholder="Nom" required>
                    </label>
                    <label for="PrenomClient"> Prenom du client
                        <input type="text" name="PrenomClient" placeholder="Prenom" required>
                    </label>
                    <label for="adresseClient"> Adresse du client
                        <input type="text" name="adresseClient" placeholder="adresse" required>
                    </label>
                    <label for="codePostalClient"> code postal du client
                        <input type="text" name="codePostalClient" placeholder="Code Postal" required>
                    </label>
                    <label for="telClient"> Téléphone du client
                        <input type="text" name="telClient" placeholder="Téléphone" required>
                    </label>
                    <label for="mailClient"> Adresse e-mail du client
                        <input type="text" name="mailClient" placeholder="Mail" required>
                    </label>
                    <input type="button" class="validerIntervention" name="ValiderInscriptionClient" onclick="submit()" value ="Valider l'inscription du client">

                </form>
                <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>

            </section>

        </section>
    </form>
</main>
</body>
</html>

