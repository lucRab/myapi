<?php
namespace App\http\request;
use stdClass;
/**
 * Classe resposavel pelas requisições para o usuario
 */
class Request {
    /**
     * Métodos responsavel por definir a requisição na criação de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function createRequest(stdClass $param) {
        if(empty($param->name)) throw new \Exception("O campo nome deve ser preenchido!");
        if(empty($param->password)) throw new \Exception("O campo senha deve ser preenchido!");
        if(empty($email = $param->email)) throw new \Exception("O campo email deve ser preenchido!");

        if(strlen($param->name) < 3) throw new \Exception("O campo nome deve ter pelo menos 3 caracteres!");
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!");
        $result = ['name'=> $param->name, 'email'=> $param->email, 'password' => $param->password];
        return $result;
    }
}