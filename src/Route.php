<?php
function load(string $controller, string $action, string $type) {
    try{

        if($type == "POST") $namespace = "App\\http\\controller\\{$controller}";
        if($type == "GET") $namespace = "src\\{$controller}";
        
        if(!class_exists($namespace))throw new Exception("A classe {$controller} não existe.");
        
        $instance = new $namespace();
        if(!method_exists($instance, $action)) throw new Exception("o método {$action} não existe na classe {$controller}.");
        
        $instance->$action();
    }catch(Exception $e) {
        echo $e->getMessage();
    }
}
$routes = [
    'GET' => [
        '/myapi/user' => load("LoadPages", "UserPage", "GET"),
    ],
    'POST' => [
        '/myapi/user' => load('UserController', 'index', "POST"),
    ]
];