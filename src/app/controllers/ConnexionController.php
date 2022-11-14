<?php

namespace app\controllers;

require_once "assets/php/managers/UserManager.php";
require_once "assets/php/class/User.php";

use DatabaseManager;
use PDO;
use User;
use UserManager;

class ConnexionController extends DatabaseManager
{
    public static function loginIn(int $id, string $password){
        $db = self::getInstance();

        $sql = "SELECT * FROM sae_garage.user WHERE id = :id;";
        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $id, PDO::PARAM_INT);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $result = $prepare->fetchAll();
            if ($password !== $result[0]['password']) {
                render('connexion.php', 'Votre mot de passe est incorrect');
            }else{
                $_SESSION["isConnected"] = true;
                if($result[0]["role"] == UserManager::ADMINISTRATEUR){
                    $_SESSION["role"] = UserManager::ADMINISTRATEUR;
                    render("AccueilAdmin.php");
                }else{
                    if($result[0]["role"] == UserManager::MANAGER){
                        $_SESSION["role"] = UserManager::MANAGER;
                    }elseif ($result[0]["role"] == UserManager::EMPLOYE){
                        $_SESSION["role"] = UserManager::EMPLOYE;
                    }
                    render("connexion.php");
                }
            }
            exit(0);
        }
    }
}