<?php

if (!function_exists('post')) {
    function post($var) {
        return $_POST[$var];
    }
}

if (!function_exists('check_mdp')) {
    function check_mdp($mdp)
    {
        $majuscule = preg_match('@[A-Z]@', $mdp);
        $minuscule = preg_match('@[a-z]@', $mdp);
        $chiffre = preg_match('@[0-9]@', $mdp);

        if(!$majuscule || !$minuscule || !$chiffre || strlen($mdp) < 8)
        {
            return false;
        } else return true;
    }
}