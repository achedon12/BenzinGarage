<?php

namespace app\controllers;

require_once "assets/php/managers/UserManager.php";
require_once "assets/php/class/User.php";
require_once "assets/php/database/DatabaseManager.php";

use app\users\Auth;
use DatabaseManager;
use PDO;
use UserManager;

class ConnexionController
{
    public static function loginIn(int $id, string $password): void{
        $db = DatabaseManager::getInstance();
        $sql = "SELECT * FROM sae_garage.user WHERE id = :id;";
        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $id);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $result = $prepare->fetchAll();
            if ($password !== $result[0]['password']) {
                $_SESSION['error'] = "Mot de passe ou Identifiant incorrect";
                render('/');
                return;
            }else{
                $_SESSION["isConnected"] = true;
                $_SESSION["employePlanning"] = 0;
                $_SESSION["id"] = $id;
                $_SESSION["facture"] = 0;
                $_SESSION["rdv"] = ["enable" => false, "employe" => 0, "radio" => "non", "date" => 0,"operationId"=>0,"listeOpe"=>[],"listeOpeHasBeenAdded" => []];
                if($result[0]["role"] == UserManager::ADMINISTRATEUR){
                    $_SESSION["role"] = UserManager::ADMINISTRATEUR;
                    render("AccueilAdmin.php");
                }else{
                    if($result[0]["role"] == UserManager::MANAGER){
                        $_SESSION["role"] = UserManager::MANAGER;
                    }elseif ($result[0]["role"] == UserManager::EMPLOYE){
                        $_SESSION["role"] = UserManager::EMPLOYE;
                    }
                    render("accueil.php");
                }
            }
        }else{
            $_SESSION['error'] = "Mot de passe ou Identifiant incorrect";
            render('/');
            return;
        }
        exit(0);
    }

    public function disconnect(): void
    {
        session_start();
        Auth::disconnect();
        render("connexion.php");
    }
}