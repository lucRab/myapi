<?php
namespace App\http\controller;
require_once("../../../vendor/autoload.php");

use App\http\request\Request;
use App\model\User;
/**
 * Classe responsavel pelo controle do usuário
 */
class UserController {
    
    protected User $repository;
   /**
    *Método construtor da classe
    */
    public function __construct(){
        $this->repository = new User();
    }
    /**
     * Método responsavel por listar todos os usuários
     *
     * @return bool;
     */
    public function index() {
        return $this->repository->getAll();
    }
    /**
     * Método responsavel pela criação do usuário
     *
     * @return void
     */
    public function store() {
        $param = Request::createRequest();
        $this->repository->create($param);
    }
    /**
     * Método responsavel pela atualização dos dados do usuário
     *
     * @return void
     */
    public function update() {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $param = ['name'=> $name, 'email'=> $email, 'password' => $password, 'id' => $id];
        $this->repository->update($param);
    }
    /**
     * Método resposavel pela deleção de usuário
     *
     * @return void
     */
    public function destroy() {
        $id = $_POST['id'];

        $param = ['id' => $id];
        $this->repository->update($param);
    }
}