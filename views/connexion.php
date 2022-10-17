<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
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
                <form action="" method="post">
                    <article>
                        <img src="../assets/img/mail.png" alt="mail">
                        <input type="email" name="email-connexion" placeholder="EMAIL">
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