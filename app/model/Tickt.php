<?php
namespace App\model;
use App\model\Model;

class Tickt extends Model {
    protected $table = "tickt";
    /**
     * Método para criar usuario
     * 
     * @param  &$DTO
     * @return bool
     */
    public function create( &$DTO) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param = $this->paramProcessing($DTO);
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("INSERT INTO tickt(user_id, event_id, id) VALUES(:user, :event, UUID_TO_BIN(UUID()))");
            //executa o sql e verifica se deu aldo de errado
            
            if($insert->execute($param)) {
                $id = $this->conect->lastInsertId();
                $DTO->setTicktId($id);
                return intval($id);
            } 
            
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    /**
     * Método para atualizar usuario
     *
     * @param  &$DTO
     * @return bool
     */
    public function update( &$DTO) {
         //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param = $this->paramProcessing($DTO);
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("UPDATE usuario SET name= :name, email= :email, password= :password WHERE user_id= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    /**
     * Método para deletar usuario
     *
     * @param  &$DTO
     * @return bool
     */
    public function delete( &$DTO) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param['id'] = $DTO->tickt_id();
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("DELETE FROM tickt WHERE tickt_id= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    protected function paramProcessing(&$DTO):array {
        try {
            $param = [
                'user' => $DTO->user_id(),
                'event' => $DTO->event_id(),
            ];
            return $param;
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
}