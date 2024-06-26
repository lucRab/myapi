<?php
namespace App\http\request;
use stdClass;
use App\DTO\UserDto;
/**
 * Classe resposavel pelas requisições para o usuario
 */
class Request {
    /**
     * Métodos responsavel por definir a requisição na criação de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return void
     */
    static function createRequest(stdClass $param, &$DTO):void {
        if(empty($param->name)) throw new \Exception("O campo nome deve ser preenchido!", 2);
        if(empty($param->password)) throw new \Exception("O campo senha deve ser preenchido!", 2);
        if(empty($param->email)) throw new \Exception("O campo email deve ser preenchido!", 2);

        if(strlen($param->name) < 3) throw new \Exception("O campo nome deve ter pelo menos 3 caracteres!", 2);
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!", 2);

        $DTO = new UserDto(name: $param->name, email: $param->email, password: $param->password);
    }
    /**
     * Métodos responsavel por definir a requisição na atualização de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return void
     */
    static function updateRequest(stdClass $param, &$DTO):void {

        if(strlen($param->name) < 3) throw new \Exception("O campo nome deve ter pelo menos 3 caracteres!", 2);
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!", 2);

        
        $DTO = new UserDto(name: $param->name, email: $param->email, password: $param->password);
        $DTO->setUserID((int) $param->id);
    }
    /**
     * Métodos responsavel por definir a requisição na deleção de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function destroyRequest(stdClass $param ) {
        $result = [ 'id' => $param->id];
        return $result;
    }

    static function loginRequest(stdClass $param) {
        if(empty($param->password)) throw new \Exception("O campo senha deve ser preenchido!", 2);
        if(empty($param->email)) throw new \Exception("O campo email deve ser preenchido!", 2);
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!", 2);

        $result = ['email'=> $param->email, 'password' =>$param->password];
        return $result;
    }
}