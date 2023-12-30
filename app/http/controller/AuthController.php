<?php
namespace App\http\controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class AuthController {

    static public function cadastroToken(array $data) {
        $payload = [
            'exp' => time() + 1000,
            'iat' => time(),
            'name' => $data['name'],
            'id' => $data['iduser'],
        ];

        
        $encode = JWT::encode($payload,strval(getenv('KEY')),'HS256');
        return $encode;
    }

}
