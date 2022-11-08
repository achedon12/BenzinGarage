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

    public function adminInterventionPlanning():void{
        render('adminInterventionPlanning.php');
    }

    public function editClientPage(){
        render('adminModifyClient.php');
    }

    public function stockPage(){
        render('stock.php');
    }

    public function adminRemoveClient(){
        render('adminRemoveClient.php');
    }

}