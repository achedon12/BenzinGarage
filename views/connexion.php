<?php

use app\controllers\ConnexionController;
use app\users\Auth;

require_once "assets/php/database/DatabaseManager.php";
require_once "assets/php/managers/UserManager.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(Auth::isConnected()){
    switch($_SESSION["role"]){
        case UserManager::MANAGER:
        case UserManager::EMPLOYE:
            render("accueil.php");
            exit(0);
        case UserManager::ADMINISTRATEUR:
            render("AccueilAdmin.php");
            exit(0);
    }
}


if(isset($_POST["id-connexion"]) && isset($_POST["password-connexion"])){
    ConnexionController::loginIn($_POST["id-connexion"],$_POST["password-connexion"]);
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>connexion</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/connexion.css">
        <link rel="shortcut icon" href="../assets/img/logo.png">
    </head>
    <body>
        <section>
            <article>
                <img src="../assets/img/connexion.png" alt="user">
            </article>
            <article>
                <h1>Connexion Utilisateur</h1>
                <form method="post" action="/login">
                    <article>
                        <img src="../assets/img/mail.png" alt="mail">
                        <input type="text" name="id-connexion" placeholder="ID">
                    </article>
                    <article>
                        <img src="../assets/img/password.png" alt="">
                        <input type="password" name="password-connexion" placeholder="PASSWORD">
                    </article>
                    <input type="submit" value="Login" class="input-login">
                </form>
                <a href="#" class="password-forgot">Mot de passe oublié</a>
            </article>
        </section>
    </body>
</html>