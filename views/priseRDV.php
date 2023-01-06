<?php

use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";
require_once "./assets/php/managers/TemplateManager.php";
require_once "./assets/php/managers/GarageManager.php";
require_once "./assets/php/managers/ClientManager.php";
require_once "assets/php/class/Piece.php ";
require_once "assets/php/managers/InterventionManager.php";
require_once "assets/php/managers/OperationManager.php";
require_once "assets/php/managers/CalendarManager.php";
require_once "assets/php/class/Modele.php";
require_once "assets/php/managers/ModeleManager.php";


$modeleManager = new ModeleManager(DatabaseManager::getInstance());
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

if(isset($_POST["selectClient"])){
    $_SESSION["rdv"]["enable"] = true;
    $_SESSION["rdv"]["idClient"] = $_POST["selectClient"];
    $_SESSION["rdv"]["theIdClient"] = $_POST["selectClient"];
}

if (isset($_POST["typeIntervention"])){
    $_SESSION["rdv"]["typeIntervention"] = $_POST["typeIntervention"];
    $operationPourUneOperation[]=$operationManager->getOperationById($_POST["typeIntervention"]);
}
if(isset($_POST["ValiderInscriptionClient"])){
    $clientsManager->createClient($_POST["NomClient"],$_POST["PrenomClient"],$_POST["adresseClient"],$_POST["codePostalClient"],$_POST["villeClient"],$_POST["telClient"],$_POST["mailClient"]);
    $client = $clientsManager->getClientByFirstnameAndName($_POST["PrenomClient"],$_POST["NomClient"])[0];
    $clientsManager->createVehicule($_POST["noimma"],$_POST["noserie"],$_POST["dateService"] ,$_POST["numModel"],$client["codeclient"]);
}

if(isset($_POST["selectEmploye"])){
    $_SESSION["rdv"]["employe"] = $_POST["selectEmploye"];
}

if(isset($_POST["radio1"])){
    $_SESSION["rdv"]["radio"] = $_POST["radio1"];
}
if(isset($_POST["radio2"])){
    $_SESSION["rdv"]["radio"] = $_POST["radio2"];
}

if(isset($_POST["ValiderRDV"])){
    $date = explode("T",$_POST["dateRDV"]);
    $interventionManager->createIntervention($date[0],$date[1],$_COOKIE["operationForOneInervention"],$_POST["km_actuel"],$_SESSION["rdv"]["radio"],"Planifiee",$_POST["selectEmploye"],$_POST["noimmatriculation"],$clientsManager->getClientByID($_SESSION["rdv"]["theIdClient"])->id);
}


if(isset($_POST["km_actuel"])){
    $_SESSION["rdv"]["kms"] = $_POST["km_actuel"];
}

if(isset($_POST["dateRDV"])){
    $_SESSION["rdv"]["date"] = $_POST["dateRDV"];
}

if(isset($_COOKIE["operationForOneInervention"])){
    $_SESSION["rdv"]["listeOpe"] = $_COOKIE["operationForOneInervention"];
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php if($_SESSION["role"] === UserManager::MANAGER){echo "Chef d'atelier ";}else{echo"Employé ";} ?> : Prise de rendez-vous</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/chefAtelierClient.css">
    <link rel="stylesheet" href="../assets/css/chefAtelierPriseRDV.css">
    <link rel="shortcut icon" href="../assets/img/logo.png">
</head>
<body onload="init()">
<?php
TemplateManager::getDefaultNavBar("rdv");
?>
<main>
    <form method="post" class="formRDV" onchange="return false">
        <section class="InfoClient">
            <section class="CompteClient">
                <h2>Possède un compte client :</h2>
                <a href="#popInscription">Non</a>
                <a href="#popChoixClient">Oui</a>
            </section>
            <section class="NomPrenom">
                <h2>Prenom : <?php if(isset($_SESSION["rdv"]["idClient"])){ echo $clientsManager->getClientByID($_SESSION["rdv"]["idClient"])->getFirstName();} echo " ";?></h2>

                <h2>Nom de famille : <?php if(isset($_SESSION["rdv"]["idClient"])){ echo $clientsManager->getClientByID($_SESSION["rdv"]["idClient"])->getName();} echo " ";?></h2>

                <h2>Code Client : <?php if(isset($_SESSION["rdv"]["idClient"])){ echo $clientsManager->getClientByID($_SESSION["rdv"]["idClient"])->getId();} echo " ";?></h2>
            </section>
            <section class="Date" style="display: flex">
                <h2>Date : </h2> <input type="datetime-local" name="dateRDV" required value="<?php if(isset($_SESSION["rdv"]["date"])){ echo $_SESSION["rdv"]["date"];} ?>">
            </section>
            <section class="infoSupp">
                <section class="infoVehicule" style="display: flex; flex-direction: column">
                    <h4>No d'immatriculation : </h4> <input type="text" name="noimmatriculation" value="<?php if(isset($_SESSION['rdv']["idClient"])){echo $clientsManager->getClientVehicle($_SESSION["rdv"]["idClient"])->getNumberPlate();}?>" required placeholder="XX-000-XX" pattern="[A-Z]{2}-[0-9]{3}-[A-Z]{2}" >
                    <h4>Kilométrage du vehicule :</h4> <input type="text" name="km_actuel" required value="<?php if(isset($_SESSION["rdv"]["kms"])){ echo $_SESSION["rdv"]["kms"];}else echo ""  ?>">
                </section>
                <section class="Employe" id="employe">
                    <h4>Employé chargée de l'intervention</h4>

                    <?php
                    if(isset($_SESSION["rdv"]["date"]) && $_SESSION["rdv"]["date"] == 0){
                        echo '<select id="employe-select" name="selectEmploye" disabled>';
                    }else{
                        echo '<select id="employe-select" name="selectEmploye" >';
                    }
                    if ($_SESSION["rdv"]["employe"] === 0) {
                        echo '<option value="false" disabled selected>--Employé--</option>';
                    }
                    if($_SESSION["rdv"]["date"] === 0){
                        foreach($userManager->getAllEmployees() as $people){
                            $name  = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["rdv"]["employe"]){
                                ?><option value='<?php echo $code ?>' selected><?php echo $name ?></option><?php
                            }else{
                                ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                            }
                        }
                    }else{

                        $explode = explode("T",$_SESSION["rdv"]["date"])[1] ?? "00:00:00";
                        foreach($userManager->getAvailableEmployes($explode) as $people){
                            $name  = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            if($code == $_SESSION["rdv"]["employe"]){
                                ?><option value='<?php echo $code ?>' selected><?php echo $name ?></option><?php
                            }else{
                                ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
                            }
                        }

                    }
                    ?>
                    </select>
                    <section class="devis">
                        <h4>Devis fait :</h4>
                        <?php
                        if($_SESSION["rdv"]["radio"] == "oui"){
                            ?>
                            <input type="radio" id="DevisNon" name="radio1" value="non"><label for="DevisNon">Non</label>
                            <input type="radio" id="DevisOui" name="radio2" value="oui" checked><label for="DevisOui">Oui</label>
                            <?php
                        }else{
                            ?>
                            <input type="radio" id="DevisNon" name="radio1" value="non" checked><label for="DevisNon">Non</label>
                            <input type="radio" id="DevisOui" name="radio2" value="oui"><label for="DevisOui">Oui</label>
                            <?php
                        }
                        ?>
                    </section>
                </section>
            </section>
            <section class="ValiderPrix">
                <input type="submit" value="Ajouter le rendez-vous" name="ValiderRDV">
                <section style="display: flex"><h2 id="prixIntervention">0</h2><h2>€</h2></section>
            </section>
        </section>

        <section class="infoIntervetion" id="interventionRDV">
        </section>

        <section class="choixOperation">
            <label for="operations">Choisir une opération</label>
            <select name="operationSelect" id="operations" onchange="rafraichir(this.value)" >
                <option value="-1" selected disabled>Choisissez une operation...</option>

            </select>
        </section>

        <section id="popChoixClient">
            <section id="intoPopUpRDV">
                <h2>Choix du client</h2>
                <form method="post" id="formInscriptionClient" >
                    <select id="client-select" name="selectClient" onchange="submit()">
                        <?php
                        echo '<option value="false" disabled selected>--Client--</option>';
                        foreach($clientsManager->getAllClients() as $people){
                            $name = $people->getName()." ".$people->getFirstName();
                            $code = $people->getId();
                            ?><option value='<?php echo $code ?>'><?php echo $name ?></option><?php
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
                <form method="post" id="formInscriptionClient" >
                    <section class="ClientInfo">
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
                        <label for="villeClient">Ville du client
                            <input type="text" name="villeClient" placeholder="Ville" required>
                        </label>
                        <label for="telClient"> Téléphone du client
                            <input type="text" name="telClient" placeholder="Téléphone" required>
                        </label>
                        <label for="mailClient"> Adresse e-mail du client
                            <input type="text" name="mailClient" placeholder="Mail" required>
                        </label>
                    </section>
                    <section class="infoVehicule">
                        <label for="noimma"> Numéro d'immatriculation
                            <input type="text" name="noimma" placeholder="Plaque d'immatriculation" required>
                        </label>
                        <label for="noserie"> Numéro de série
                            <input type="text" name="noserie" placeholder="No de série" required>
                        </label>
                        <label for="dateService"> date de mise en service
                            <input type="date" name="dateService"  required>
                        </label>
                        <label for="numModel"> Numéro de modele
                            <input list="Modeles" id="myClient" name="numModel" required/>
                            <datalist id="Modeles">
                                <?php
                                $res = $modeleManager->getAllModele();
                                foreach ($res as $modele){
                                    echo '<option value="'.$modele->getNummodele().'" class="listeClientHorizontal">'.$modele->getModele().'</option>';
                                }
                                ?>
                            </datalist>
                        </label>
                    </section>
                    <input type="submit" class="validerIntervention" name="ValiderInscriptionClient" value ="Valider l'inscription du client">
                </form>
                <a href="#" class="close"><img src="../assets/img/not%20done.png" alt=""></a>
            </section>
        </section>
    </form>
</main>
</body>
<script src="/assets/js/chefAtelierRDV.js"></script>
</html>

