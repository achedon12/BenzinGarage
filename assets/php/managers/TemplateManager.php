<?php

require_once "assets/php/managers/UserManager.php";

class TemplateManager{

    public static function getDefaultNavBar(string $page, string $role = UserManager::EMPLOYE): void
    {
        switch ($page){
            case "accueil":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li class="hover"><a href="/accueil/user" >Accueil</a></li>
                                <li><a href="/planning">Planning</a></li>
                                <li><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li><a href="/stock">Stock</a></li>
                                <li><a href="/tarification">Tarifs</a></li>
                                <li><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
            case "planning":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li><a href="/accueil/user" >Accueil</a></li>
                                <li class="hover"><a href="/planning">Planning</a></li>
                                <li><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li><a href="/stock">Stock</a></li>
                                <li><a href="/tarification">Tarifs</a></li>
                                <li><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
            case "rdv":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li><a href="/accueil/user">Accueil</a></li>
                                <li><a href="/planning">Planning</a></li>
                                <li class="hover"><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li><a href="/stock">Stock</a></li>
                                <li><a href="/tarification">Tarifs</a></li>
                                <li><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
            case "stock":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li><a href="/accueil/user">Accueil</a></li>
                                <li><a href="/planning">Planning</a></li>
                                <li><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li class="hover"><a href="/stock">Stock</a></li>
                                <li><a href="/tarification">Tarifs</a></li>
                                <li><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
            case "tarifs":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li><a href="/accueil/user">Accueil</a></li>
                                <li><a href="/planning">Planning</a></li>
                                <li><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li><a href="/stock">Stock</a></li>
                                <li class="hover"><a href="/tarification">Tarifs</a></li>
                                <li><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
            case "clients":
                $navBar = '<nav class="nav-bar">
                            <img src="../assets/img/logo.png" alt="logo">
                            <ul>
                                <li><a href="/accueil/user">Accueil</a></li>
                                <li><a href="/planning">Planning</a></li>
                                <li><a href="/prise-rdv">Prise de rendez-vous</a></li>
                                <li><a href="/stock">Stock</a></li>
                                <li><a href="/tarification">Tarifs</a></li>
                                <li class="hover"><a href="/clients">Clients</a></li>
                                <li><a href="/disconnect">Deconnexion</a></li>
                            </ul>
                        </nav>';
                break;
        }
        echo $navBar;
    }

    public static function getAdminNavBar(string $page){
        switch ($page){

        }
    }
}