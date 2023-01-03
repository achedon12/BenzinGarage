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
    public static function loginIn(int $id, string $password){
        $db = DatabaseManager::getInstance();
        $sql = "SELECT * FROM sae_garage.user WHERE id = :id;";
        $prepare = $db->prepare($sql);
        $prepare->bindParam(':id', $id, PDO::PARAM_INT);
        $prepare->execute();
        if ($prepare->rowCount() > 0) {
            $result = $prepare->fetchAll();
            if ($password !== $result[0]['password']) {
                render('connexion.php');
            }else{
                $_SESSION["isConnected"] = true;
                $_SESSION["employePlanning"] = 0;
                $_SESSION["id"] = $id;
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
        }else{
            render("connexion.php");

        }
        exit(0);
    }

    public function disconnect(){
        session_start();
        Auth::disconnect();
        render("connexion.php");
    }
}