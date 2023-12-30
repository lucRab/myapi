<?php
namespace App\http\controller;

require __DIR__."/../request/RequestUser.php";

use App\http\request\Request;
use App\http\controller\AuthController;
use App\model\User;
use Exception;
use stdClass;
/**
 * Classe responsavel pelo controle do usuário
 */
class UserController {
    
    protected User $repository;
   /**
    * Método construtor da classe
    */
    public function __construct(){
        $this->repository = new User();
    }
    /**
     * Método responsavel por listar todos os usuários
     */
    public function index() {
        try{
            $a = $this->repository->getAll();
            var_dump ($a);
        }catch(Exception $e) {
            var_dump($e->getMessage());
        }
    }
    /**
     * Método responsavel pela criação do usuário
     */
    public function store(stdClass $request) {
        try{
            $param = Request::createRequest($request);
            $id = $this->repository->create($param);
            $param += ['id' => $id];
            $token = AuthController::cadastroToken($param);

            return json_encode($token);
        }catch(Exception $e){
            http_response_code(401);
            return json_encode($e->getMessage());
        }
    }
    /**
     * Método responsavel pela atualização dos dados do usuário
     */
    public function update(stdClass $request) {
        try {
            $param = Request::updateRequest($request);
            $this->repository->update($param);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Método resposavel pela deleção de usuário
     */
    public function destroy(stdClass $request) {
        try{
            $param = Request::destroyResquest($request);
            $this->repository->update($param);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
}