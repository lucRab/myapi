<?php
namespace src;
use Exception;
/**
 * Classe responsavel pela criação das rotas;
 */
class Route {
    //variavel que armazenarar as rotas
    public static $routes = [
        'GET'  => [],
        'POST' => [],
    ];
    /**
     * Método responsavel pelo registro de rotas
     *
     * @param string $route - rota registrada.
     * @param string $method - método da rota [GET/POST].
     * @param string $class - Classe onde essa rota irá direcionar.
     * @param string $action - Função da classe que a rota irá acionar.
     * @return void
     */
    public static function route(string $route, string $method, string $class, string $action) {
        //Para rotas do tipo GET
        if($method == 'GET') self::$routes['GET'] += [$route => fn() => self::load($class, $action, $method)];
        //Para rotas do tipo POST
        if($method == 'POST') self::$routes['POST'] += [$route => fn() => self::load($class, $action, $method)];
        
    }
    /**
     * Método para redenrizar a rota
     *
     * @param string $class - Classe onde essa rota irá direcionar.
     * @param string $action - Função da classe que a rota irá acionar.
     * @param string $type - método da rota [GET/POST].
     * @return void
     */
    public static function load(string $class, string $action, string $type) {
        try{
            if($type == "POST") $namespace = "App\\http\\controller\\{$class}";
            if($type == "GET") $namespace = "src\\{$class}";
            
            if(!class_exists($namespace))throw new Exception("A classe {$class} não existe.");
            
            $instance = new $namespace();
            if(!method_exists($instance, $action)) throw new Exception("o método {$action} não existe na classe {$class}.");
            
            echo $instance->$action((object) $_REQUEST);
        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}