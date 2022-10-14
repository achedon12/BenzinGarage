<?php

namespace app\controllers;

class DefaultController
{
    public function index(): void {
        render('connexion.php');
    }
}