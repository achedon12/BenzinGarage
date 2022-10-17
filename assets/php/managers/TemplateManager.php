<?php

class TemplateManager{

    public static function getDefaultNavBar(){
        echo '<nav>
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
        </nav>';
    }

    public static function getAdminNavBar(){

    }
}