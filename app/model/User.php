<?php
namespace App\model;
use App\model\Model;
use Exception;
/**
 * Class Model responsavel pelas requisições da tavela usuario
 * @version ${2:2.0.0
 */
class User extends Model{
    protected $table = "usuario";
    /**
     * Método para criar usuario
     * 
     * @param array $param
     * @return bool
     */
    public function create(array $param) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("INSERT INTO usuario(name, email, password) VALUES(:name, :email, :password)");
            //executa o sql e verifica se deu aldo de errado
            
            if($insert->execute($param)) {
                $id = $this->conect->lastInsertId();
                return intval($id);
            } 
            
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    /**
     * Método para atualizar usuario
     *
     * @param array $param
     * @return bool
     */
    public function update(array $param) {
         //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("UPDATE usuario SET name= :name, email= :email, password= :password WHERE iduser= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    /**
     * Método para deletar usuario
     *
     * @param array $param
     * @return bool
     */
    public function delete(array $param) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("DELETE FROM usuario WHERE iduser= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }

    public function getLogin(array $param) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            //Execução da query sql
            $get = $this->conect->prepare("SELECT * FROM usuario WHERE email= :email");
            $get->execute($param);
            //verifica e trata o resultado da query
            if($result = $get->fetch()) return $result;//retorna o resultado da query
            throw new Exception("Email incorreto");//retorna falso caso haja algum erro
        }
        return $this->conect;//retorna o erro caso haja.
    }
}
