<?php
namespace App\model;
use src\Conexao;
use src\radical\get;
use src\radical\sql;
use src\radical\update;
/**
 * Class Model pai para implementação dos outros models
 * @abstract
 * @api
 */
abstract class Model {
    protected $conect;
    protected $table;
    public get $get;
    public sql $sql;
    public update $update;
    
    public function __construct() {
        $this->conect = Conexao::conexao();
        $this->get = new get($this->table);
        $this->sql = new sql();
        $this->update = new update();
    }
    abstract function create(array $param);

    abstract function update(array $param);

    abstract function delete(array $param);

    public function get() {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
           $quary = "SELECT ".$this->get->column." FROM ".$this->table.$this->get->param;
           $get = $this->conect->prepare($quary);
           if($this->get->p_value != null) {
                $get->execute($this->get->p_value);
           }else {
               $get->execute();
           }
           $result = $get->fetchAll();
           return $result;
        }
        return $this->conect;//retorna o erro caso haja.
    }

    public function destroy() {
        //verifica  se não algum erro na conexão.
        if(gettype($this->conect) == "object") {
           $quary = "DELETE FROM ".$this->table.$this->sql->param;
            $delete = $this->conect->prepare($quary);
            if($this->get->p_value != null) {
                 $delete->execute($this->get->p_value);
            }else {
                $delete->execute();
            }
            $result = $delete->fetchAll();
            return $result;
        }
        return $this->conect;//retorna o erro caso haja.
    }
    public function insert() {
        if(gettype($this->conect) == "object") {
            $quary = "INSERT INTO ".$this->table." (".$this->sql->column.') VALUES ('.$this->sql->p_column.')';
            $insert = $this->conect->prepare($quary);
            $insert->execute($this->sql->value);
        }
        return $this->conect;//retorna o erro caso haja.
    }

    public function updates() {
        if(gettype($this->conect) == "object") {
            $quary = "UPDATE ".$this->table." SET ".$this->update->p_column.' WHERE '.$this->update->param;
            $update = $this->conect->prepare($quary);
            $update->execute($this->update->value);
        }
        return $this->conect;//retorna o erro caso haja.
    }
    public function transaction() {
        if(gettype($this->conect) == "object") {
           $this->conect->beginTransaction();
        }
        return $this->conect;//retorna o erro caso haja.
    }
    public function commit() {
        if(gettype($this->conect) == "object") {
           $this->conect->commit();
        }
        return $this->conect;//retorna o erro caso haja.
    }
    public function rollback() {
        if(gettype($this->conect) == "object") {
           $this->conect->rollback();
        }
        return $this->conect;//retorna o erro caso haja.
    }
}