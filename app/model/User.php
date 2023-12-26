<?php
namespace App\model;
require_once("../../vendor/autoload.php");
use App\model\Model;
/**
 * Class Model responsavel pelas requisições da tavela usuario
 * @version ${1:1.0.0
 */
class User extends Model{
    /**
     * Método para criar usuario
     * 
     * @param array $param
     * @return bool
     */
    public function create(array $param) {
       $insert = $this->conect->prepare("INSERT INTO usuario(name, email, password) VALUES(:name, :email, :password)");
       if($insert->execute($param)) return true;
        return false;
    }
    /**
     * Método para atualizar usuario
     *
     * @param array $param
     * @return bool
     */
    public function update(array $param) {
        $insert = $this->conect->prepare("UPDATE usuario SET name= :name, email= :email, password= :password WHERE iduser= :id");
        if($insert->execute($param)) return true;
         return false;
    }
    /**
     * Método para deletar usuario
     *
     * @param array $param
     * @return bool
     */
    public function delete(array $param) {
        $insert = $this->conect->prepare("DELETE FROM usuario WHERE iduser= :id");
        if($insert->execute($param)) return true;
         return false;
    }
}

$a = new User();

$b = $a->delete(['id' => 1]);
var_dump($b);