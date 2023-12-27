<?php
require_once "vendor/autoload.php";
require "src/Route.php";
try {

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = $_SERVER['REQUEST_METHOD'];

    if(!isset($routes[$method])){
        throw new Exception("A rota não exite");
    }
    if(!array_key_exists($uri, $routes[$method])){
        var_dump($uri);
       throw new Exception("A rota não exite"); 
    }
    //$routes[$method][$uri];
}catch(Exception $e) {
    echo $e->getMessage();
}