<?php
require_once "../vendor/autoload.php";
require "../src/Route.php";
use src\Route;

 Route::route('/', 'GET', 'LoadPages', 'LoginPage');
 Route::route('/user', 'GET', 'LoadPages', 'UserPage');
 Route::route('/user', 'POST', 'UserController','index');
 Route::route('/cadastro', 'POST', 'UserController', 'store');

try {

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = $_SERVER['REQUEST_METHOD'];

    if(!isset(Route::$routes[$method])){
        throw new Exception("A metodo não exite");
    }
    if(!array_key_exists($uri, Route::$routes[$method])){
        var_dump($uri, $method);
       throw new Exception("A rota não exite"); 
    }
    $controller = Route::$routes[$method][$uri];
   $controller(); 
}catch(Exception $e) {
    echo $e->getMessage();
}