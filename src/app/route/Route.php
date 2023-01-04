<?php

use app\controllers\ConnexionController;
use app\controllers\UsersController;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [UsersController::class, 'index']);

SimpleRouter::post('/login', [UsersController::class, 'loginPage']);
SimpleRouter::get('/login', [UsersController::class, 'loginPage']);
SimpleRouter::get('/accueil/user', [UsersController::class, 'accueilPage']);
SimpleRouter::get('/accueil/admin', [UsersController::class, 'accueilAdministrateurPage']);
SimpleRouter::get('/admin/utilisateur', [UsersController::class, 'utilisateurAdministrateur']);
SimpleRouter::get('/admin/addClient', [UsersController::class, 'adminAddClientPage']);
SimpleRouter::get('/admin/addEmploye', [UsersController::class, 'adminAddEmployePage']);
SimpleRouter::get('/admin/interventionPlanning', [UsersController::class, 'adminInterventionPlanning']);
SimpleRouter::post('/admin/interventionPlanning', [UsersController::class, 'adminInterventionPlanning']);
SimpleRouter::get('/admin/editClient', [UsersController::class, 'editClientPage']);


SimpleRouter::get('/admin/removeClient', [UsersController::class, 'adminRemoveClient']);
SimpleRouter::get('/admin/removeEmploye', [UsersController::class, 'adminRemoveEmploye']);
SimpleRouter::get('/admin/editEmploye', [UsersController::class, 'adminModifyEmploye']);

/* Deconnection */
SimpleRouter::get('/disconnect',[ConnexionController::class,'disconnect']);

SimpleRouter::get('/admin/clients',[UsersController::class,'adminClients']);
SimpleRouter::get('/admin/clients/modify',[UsersController::class,'adminClientsModify']);
SimpleRouter::post('/admin/clients/modify',[UsersController::class,'adminClientsModify']);
SimpleRouter::get('/admin/clients/delete',[UsersController::class,'adminClientsModify']);
SimpleRouter::get('/admin/clients/create',[UsersController::class,'adminClientsCreate']);
SimpleRouter::post('/admin/clients/create',[UsersController::class,'adminClientsCreate']);
SimpleRouter::get('/admin/employes',[UsersController::class,'adminEmployes']);
SimpleRouter::get('/admin/employes/modify',[UsersController::class,'adminEmployesModify']);
SimpleRouter::post('/admin/employes/modify',[UsersController::class,'adminEmployesModify']);
SimpleRouter::get('/admin/employes/delete',[UsersController::class,'adminEmployesModify']);
SimpleRouter::get('/admin/employes/create',[UsersController::class,'adminEmployesCreate']);
SimpleRouter::post('/admin/employes/create',[UsersController::class,'adminEmployesCreate']);
SimpleRouter::get('/admin/stock',[UsersController::class,'adminStock']);
SimpleRouter::post('/admin/stock',[UsersController::class,'adminStock']);
SimpleRouter::get('/admin/tarification',[UsersController::class,'adminTarification']);
SimpleRouter::post('/admin/tarification',[UsersController::class,'adminTarification']);


SimpleRouter::get('/planning', [UsersController::class, 'planning']);
SimpleRouter::post('/planning', [UsersController::class, 'planning']);
SimpleRouter::get('/stock', [UsersController::class, 'stock']);
SimpleRouter::post('/stock', [UsersController::class, 'stock']);
SimpleRouter::get('/clients', [UsersController::class, 'clients']);
SimpleRouter::post('/clients', [UsersController::class, 'clients']);
SimpleRouter::get('/prise-rdv', [UsersController::class, 'priseRDV']);
SimpleRouter::post('/prise-rdv', [UsersController::class, 'priseRDV']);
SimpleRouter::get('/tarification', [UsersController::class, 'tarification']);
SimpleRouter::post('/tarification', [UsersController::class, 'tarification']);


