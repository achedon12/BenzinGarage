<?php

use app\controllers\UsersController;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [UsersController::class, 'index']);

SimpleRouter::post('/login', [UsersController::class, 'loginPage']);
SimpleRouter::get('/accueil/employe', [UsersController::class, 'accueilPage']);
SimpleRouter::get('/accueil/admin', [UsersController::class, 'accueilAdministrateurPage']);
SimpleRouter::get('/admin/utilisateur', [UsersController::class, 'utilisateurAdministrateur']);
SimpleRouter::get('/admin/addClient', [UsersController::class, 'adminAddClientPage']);
SimpleRouter::get('/admin/addEmploye', [UsersController::class, 'adminAddEmployePage']);
SimpleRouter::get('/admin/interventionPlanning', [UsersController::class, 'adminInterventionPlanning']);
SimpleRouter::get('/admin/editClient', [UsersController::class, 'editClientPage']);
SimpleRouter::get('/stock', [UsersController::class, 'stockPage']);
SimpleRouter::get('/admin/removeClient', [UsersController::class, 'adminRemoveClient']);
/*SimpleRouter::get('/admin/removeClient', [UsersController::class, 'adminRemoveClient']);
*/
SimpleRouter::get('/admin/removeEmploye', [UsersController::class, 'adminRemoveEmploye']);
SimpleRouter::get('/admin/editEmploye', [UsersController::class, 'adminModifyEmploye']);

