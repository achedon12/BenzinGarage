<?php

class TemplateManager{

    public static function getDefaultNavBar(string $page){
        $navBar = match ($page) {
            "accueil" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li class="hover"><a href="#" >Accueil</a></li>
                                    <li><a href="#">Planning</a></li>
                                    <li><a href="#">Prise de rendez-vous</a></li>
                                    <li><a href="#">Stock</a></li>
                                    <li><a href="#">Tarifs</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
            "planning" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li><a href="#" >Accueil</a></li>
                                    <li class="hover"><a href="#">Planning</a></li>
                                    <li><a href="#">Prise de rendez-vous</a></li>
                                    <li><a href="#">Stock</a></li>
                                    <li><a href="#">Tarifs</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
            "rdv" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li><a href="#" >Accueil</a></li>
                                    <li><a href="#">Planning</a></li>
                                    <li class="hover"><a href="#">Prise de rendez-vous</a></li>
                                    <li><a href="#">Stock</a></li>
                                    <li><a href="#">Tarifs</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
            "stock" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li><a href="#" >Accueil</a></li>
                                    <li><a href="#">Planning</a></li>
                                    <li><a href="#">Prise de rendez-vous</a></li>
                                    <li class="hover"><a href="#">Stock</a></li>
                                    <li><a href="#">Tarifs</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
            "tarifs" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li><a href="#" >Accueil</a></li>
                                    <li><a href="#">Planning</a></li>
                                    <li><a href="#">Prise de rendez-vous</a></li>
                                    <li><a href="#">Stock</a></li>
                                    <li class="hover"><a href="#">Tarifs</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
            "clients" => '<nav class="nav-bar">
                                <img src="../assets/img/logo.png" alt="logo">
                                <ul>
                                    <li><a href="#" >Accueil</a></li>
                                    <li><a href="#">Planning</a></li>
                                    <li><a href="#">Prise de rendez-vous</a></li>
                                    <li><a href="#">Stock</a></li>
                                    <li><a href="#">Tarifs</a></li>
                                    <li class="hover"><a href="#">Clients</a></li>
                                    <li><a href="#">Deconnexion</a></li>
                                </ul>
                            </nav>',
        };
        echo $navBar;
    }

    public static function getAdminNavBar(){

    }
}