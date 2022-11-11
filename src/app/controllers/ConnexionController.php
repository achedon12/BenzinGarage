<?php

namespace app\controllers;

use DatabaseManager;
use User;
use UserManager;

require_once ("assets/php/database/DatabaseManager.php");

class ConnexionController extends DatabaseManager
{
    public static function loginIn(int $id, string $password): ?user {
        $db = self::getInstance();
        $userManager = new UserManager($db);
        foreach($userManager->getAllAdministrators() as $administrator){
            if($administrator->getId() === $id && $administrator->getPasswordNotHashed() === $password){ return $administrator; }

        }
        foreach($userManager->getAllEmployees() as $employee){
            if($employee->getId() === $id && $employee->getPasswordNotHashed() === $password){ return $employee; }

        }
        foreach($userManager->getAllManager() as $manager) {
            if ($manager->getId() === $id && $manager->getPasswordNotHashed() === $password) {
                return $manager;
            }
        }

        return null;
    }
}