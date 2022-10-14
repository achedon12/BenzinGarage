<?php

use app\controllers\DefaultController;
use app\controllers\UsersController;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [DefaultController::class, 'index']);

SimpleRouter::get('/login-in', [UsersController::class, 'loginPage']);
SimpleRouter::get('/accueil/employe', [UsersController::class, 'accueilPage']);
SimpleRouter::get('/accueil/admin', [UsersController::class, 'accueilAdministrateurPage']);

