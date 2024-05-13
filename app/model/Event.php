<?php
namespace App\model;
use App\model\Model;
use Exception;

class Event extends Model {

    protected $table = "event";
    /**
     * Método para criar usuario
     * 
     * @param array $param
     * @return bool
     */
    public function create(&$DTO) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param = $this->paramProcessing($DTO);
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("INSERT INTO event(name, description, status, vagas, preco, date) VALUES(:name, :description, :status, :vagas, :preco, :date)");
            //executa o sql e verifica se deu aldo de errado
            
            if($insert->execute($param)) {
                $id = $this->conect->lastInsertId();
                $DTO->setEventId($id);
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
    public function update(&$DTO) {
         //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param = $this->paramProcessing($DTO);
            $param['id'] = $DTO->event_id();
            //perarando o sql a ser executadousa
            $insert = $this->conect->prepare("UPDATE event SET name= :name, description= :description, status= :status, date= :date,
             vaga= :vaga, preco= :preco WHERE event_id= :id");
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
    public function delete(&$DTO) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            $param['id'] = $DTO->event_id();
            //perarando o sql a ser executado
            $insert = $this->conect->prepare("DELETE FROM event WHERE event_id= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
        }
        return $this->conect;//retorna o erro caso haja.
    }

    public function desativateEvent($param, &$DTO) {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
            //perarando o sql a ser executadousa
            $insert = $this->conect->prepare("UPDATE event SET status= 'DESATIVADO' WHERE event_id= :id");
            //executa o sql e verifica se deu aldo de errado
            if($insert->execute($param)) return true;
            throw new Exception("[ATENÇÃO]Erro de execução", 30);
            }
            return $this->conect;//retorna o erro caso haja.
        
    }
    
    protected function paramProcessing(&$DTO):array {
        try {
            $param = [
                'name' => $DTO->name(),
                'description' => $DTO->description(),
                'status' => $DTO->status(),
                'date' => $DTO->date(),
                'preco' => $DTO->preco(),
                'vaga' => $DTO->vaga()
            ];
            return $param;
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }

}