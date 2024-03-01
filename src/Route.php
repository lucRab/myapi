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
    public static function route(string $route, string $method, string $action) {
        $action = explode(':',$action);
        //Para rotas do tipo GET
        if($method == 'GET') array_push(self::$routes['GET'], ['route' => $route, 'action' => $action]);
        //self::$routes['GET'] += [$route => fn() => self::load($class, $action, $method)];
        //Para rotas do tipo POST
        if($method == 'POST') array_push(self::$routes['POST'], ['route' => $route, 'action' => $action]);
        //self::$routes['POST'] += [$route => fn() => self::load($class, $action, $method)];
        
    }
    /**
     * Método para redenrizar a rota
     *
     * @param string $class - Classe onde essa rota irá direcionar.
     * @param string $action - Função da classe que a rota irá acionar.
     * @param string $type - método da rota [GET/POST].
     * @return void
     */
    public static function load(string $class, string $action,string $type, array $param = null ) {
        try{
            $namespace = "App\\http\\controller\\{$class}";
            if($class == "LoadPages") $namespace = "src\\{$class}";
            
            if(!class_exists($namespace))throw new Exception("A classe {$class} não existe.");
            
            $instance = new $namespace();
            if(!method_exists($instance, $action)) throw new Exception("o método {$action} não existe na classe {$class}.");
            if(empty($param)) {
                $instance->$action((object) $_REQUEST);
            }else {
                $instance->$action((object) $_REQUEST, ...$param);
            }     
        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function verificate($method) {
        $routeFoud = null;
        foreach (self::allroutes($method) as $rout) {
            if(str_contains($rout, '{numeric}')) {
                $rout = str_replace('{numeric}','[0-9]+' , $rout);
            }
            if(str_contains($rout, '{alpha}')) {
                $rout = str_replace('{alpha}', '[a-z]+', $rout);
            }
            if(str_contains($rout, '{any}')) {
                $rout = str_replace('{any}', '[a-z0-9\-]+', $rout);
            }
            $pattern = str_replace('/','\/',ltrim($rout, '/'));
            if(preg_match("/^$pattern$/",trim($_SERVER['REQUEST_URI'],'/'))) {
               $routeFoud = $rout;
            }   
        }
        if(!str_contains($routeFoud,'[a-z0-9\-]+')) {
            $routeFoud = null;
        }
        return $routeFoud;
    }

    public static function allroutes($method) {
        $routes = [];
        if($method == "GET") {
            foreach (self::$routes['GET'] as $key => $value) {
                array_push($routes, $value['route']);        
            }
        }
        if($method == "POST") {
            foreach (self::$routes['POST'] as $key => $value) {
                array_push($routes, $value['route']); 
            }
        }
        return $routes;
    }

    public static function getKeyRoute(string $route, string $method, string $foud = null) {
        if(isset($foud)) {
            if(str_contains($foud, '[0-9]+')){
                $route = str_replace('[0-9]+', '{numeric}', $foud);
            }
            if(str_contains($foud, '[a-z]+')){
                $route = str_replace('[a-z]+', '{apha}', $foud);
            }
            if(str_contains($foud, '[a-z0-9\-]+')){
                $route = str_replace('[a-z0-9\-]+', '{any}', $foud);
            }
        }
        $result = null;
        foreach (self::$routes[$method] as $key => $value) {
            if($value['route'] == $route){
                $result = $key;
                break;
            }
        }
        return $result;
    }

    public static function routeParam($routeFoud) {
        if(isset($routeFoud)) {
            $params = [];
            $explodUri = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
            $explodRoute = explode('/', ltrim($routeFoud, '/'));
            $arrayDiff = array_diff($explodUri, $explodRoute);
            foreach ($arrayDiff as $index => $uri) {
                $params[$explodUri[$index - 1]] = is_numeric($uri) ? (int)$uri : $uri;
            }
            return $params;
        }
    }

    public static function start() {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            
            $routeFoud = self::verificate($method);
            $params = null;
            if(isset($routeFoud))$params = self::routeParam($routeFoud);
            
            $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
            $routes = self::allroutes($method);
        
            if(!isset(self::$routes[$method])){
                throw new Exception("A metodo não exite");
            }
            
            $key  = self::getKeyRoute($uri, $method, $routeFoud);
            if(!array_key_exists($key, $routes)){
                throw new Exception("A rota não exite"); 
            }
            if(isset($params)) {
                $controller = fn() => self::load(self::$routes[$method][$key]['action'][0],self::$routes[$method][$key]['action'][1], $method, $params);
            }else{
                $controller = fn() => self::load(self::$routes[$method][$key]['action'][0],self::$routes[$method][$key]['action'][1], $method);
            }
            $controller();
         }catch(Exception $e) {
             echo $e->getMessage();
         }
    }
}