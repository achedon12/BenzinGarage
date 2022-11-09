<?php

namespace app\controllers;

use DatabaseManager;

class ConnexionController extends DatabaseManager
{
    public function loginIn() {
        $db = $this->getInstance();
        //TODO: faire la connexion
    }
}