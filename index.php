<?php

use Pecee\SimpleRouter\SimpleRouter;

include __DIR__ . './vendor/autoload.php';
include __DIR__ . './functions/route_function.php';
include __DIR__ . './src/app/route/Route.php';

spl_autoload_register(function (string $classname): void {
    $explode = explode('\\', $classname);
    if ($explode[0] === 'app') {
        $classname = "./src/" . str_replace("\\", "/", $classname) . ".php";
        require_once($classname);
    }
});


SimpleRouter::start();