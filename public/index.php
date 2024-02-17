<?php
require_once "../vendor/autoload.php";
require "../src/Route.php";
use src\Route;

 Route::route('/', 'GET', 'LoadPages:LoginPage');
 Route::route('/teste/{numeric}', 'GET','LoadPages:TestePage');
 Route::route('/teste/{alpha}', 'GET','LoadPages:TestePage');
 Route::route('/teste/{any}', 'GET','LoadPages:TestePage');
 Route::route('/user', 'GET', 'LoadPages:UserPage');
 Route::route('/user', 'POST', 'UserController:index');
 Route::route('/cadastro', 'GET', 'LoadPages:CadastroPage');
 Route::route('/cadastro', 'POST', 'UserController:store');
 Route::route('/login', 'POST', 'UserController:login');
 try {
    $method = $_SERVER['REQUEST_METHOD'];
    
    $routeFoud = Route::verificate($method);
    $params = null;
    if(isset($routeFoud))$params = Route::routeParam($routeFoud);
    
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $routes = Route::allroutes($method);

    if(!isset(Route::$routes[$method])){
        throw new Exception("A metodo não exite");
    }
    
    $key  = Route::getKeyRoute($uri, $method, $routeFoud);
    if(!array_key_exists($key, $routes)){
        throw new Exception("A rota não exite"); 
    }
    if(isset($params)) {
        $controller = fn() => Route::load(Route::$routes[$method][$key]['action'][0],Route::$routes[$method][$key]['action'][1], $method, $params);
    }else{
        $controller = fn() => Route::load(Route::$routes[$method][$key]['action'][0],Route::$routes[$method][$key]['action'][1], $method);
    }
    $controller();
 }catch(Exception $e) {
     echo $e->getMessage();
 }