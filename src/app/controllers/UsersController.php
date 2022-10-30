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

    public function utilisateurAdministrateur():void{
        render('UtilisateurAdministrateur.php');
    }

    public function adminAddClientPage():void{
        render('adminAddClient.php');
    }

    public function adminAddEmployePage():void{
        render('adminAddEmploye.php');
    }

}