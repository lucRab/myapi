<?php
namespace App\http\controller;
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class AuthController {
    static private function loadEnv() {
        $dotenv = Dotenv::createImmutable(dirname(__FILE__,4));
        $dotenv->load();
    }

    static public function cadastroToken(array $data) {
        self::loadEnv();
        $payload = [
            'exp' => time() + 1000,
            'iat' => time(),
            'name' => $data['name'],
            'id' => $data['iduser'],
        ];

        
        $encode = JWT::encode($payload, $_ENV['KEY'],'HS256');
        return $encode;
    }

}
