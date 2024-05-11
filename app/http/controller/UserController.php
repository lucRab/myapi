<?php
namespace App\http\controller;

require __DIR__."/../request/RequestUser.php";

use App\http\request\Request;
use App\http\controller\AuthController;
use App\model\User;
use App\DTO\UserDto;
use Exception;
use stdClass;
/**
 * Classe responsavel pelo controle do usuário
 */
class UserController {
    
    protected User $repository;
    protected UserDto $DTO;
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
            return $a;
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Método responsavel pela criação do usuário
     */
    public function store(stdClass $request) {
        try{
            $this->repository->transaction();
            Request::createRequest($request, $this->DTO);
            die("eh");
            $this->repository->create($DTO);
            $id = $DTO->user_id();
            if(gettype($id) == "string") throw new Exception($id, "2002");
            $param += ['iduser' => strval($id)];
            $token = AuthController::cadastroToken($param);
            $this->repository->commit();
            return json_encode($token);
        }catch(Exception $e){
           $this->repository->rollback();
            http_response_code(401);
            if($e->getCode() == "23000") return json_encode("Esse email já estar registrado");
            return json_encode($e->getMessage());
        }
    }
    /**
     * Método responsavel pela atualização dos dados do usuário
     */
    public function update(stdClass $request) {
        try {
            Request::updateRequest($request, $this->DTO);
            $this->repository->update($this->DTO);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Método resposavel pela deleção de usuário
     */
    public function destroy(stdClass $request) {
        try{
            $param = Request::destroyRequest($request);
            $this->repository->update($param);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
 
    public function login(stdClass $request) {
        try{
            $param = Request::loginRequest($request);
            $get = $this->repository->getLogin(['email' => $param['email']]);
            if(!password_verify($param['password'], $get['password'])) throw new Exception ('Senha incorreta');
            $token = AuthController::cadastroToken($get);

            return json_encode($token);
        }catch(Exception $e) {
            http_response_code(401);
            return json_encode($e->getMessage());
        }
    }
}