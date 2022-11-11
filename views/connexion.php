<?php

use app\controllers\ConnexionController;

session_start();

if(isset($_POST["id-connexion"]) && isset($_POST["password-connexion"])){
    if(($user = ConnexionController::loginIn($_POST["id-connexion"],$_POST["password-connexion"])) != null){
        if($user->getRole() === UserManager::ADMINISTRATEUR){
            $_POST["isConnected"] = true;
            $_POST["role"] = UserManager::ADMINISTRATEUR;
            render("AccueilAdmin.php");
        }else{
            if($user->getRole() === UserManager::MANAGER){
                $_POST["role"] = UserManager::MANAGER;
            }elseif ($user->getRole() === UserManager::EMPLOYE){
                $_POST["role"] = UserManager::EMPLOYE;
            }
            render("accueil.php");
        }
    }
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