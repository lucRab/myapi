<?php
namespace App\http\request;
/**
 * Classe resposavel pelas requisições para o usuario
 */
class Request {

    static function createRequest() {
        // $name = $_POST['name'];
        // $password = $_POST['password'];
        // $email = $_POST['email'];

        $param = ['name'=> "Teste Request", 'email'=> "Testeemail", 'password' => "12212"];
        return $param;
    }
}