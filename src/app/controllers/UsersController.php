<?php

namespace app\controllers;

class UsersController{

    public function loginPage(): void {
        render('connexion.php');
    }
    public function accueilPage(): void {
        render('accueil.php');
    }

    public function accueilAdministrateurPage(): void {
        render('accueilAdmin.php');
    }

}