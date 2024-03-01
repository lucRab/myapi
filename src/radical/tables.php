<?php
namespace src\radical;

class tables
{
    public $column = [];
    public function id(string $name = 'id') {
        $this->column['id'] = ['name' => $name, 'type' => 'INT', 'constraint' => 'PRIMARY KEY AUTO_INCREMENT'];     
    }
    public function string(string $name, string $tamanho = '45', string $constraint = null) {
        array_push($this->column,['name' => $name, 'type' =>'VARCHAR('.$tamanho.')', 'constraint' => $constraint]);
    }
    public function int(string $name, string $tamanho = null, string $constraint = null) {
        if(!is_null($tamanho)) $tamanho = '('.$tamanho.')';
        array_push($this->column,['name' => $name, 'type' =>'INT'.$tamanho, 'constraint' => $constraint]);
    }
    public function decimal(string $name, string $tamanho = '10,2', string $constraint = null) {
        array_push($this->column,['name' => $name, 'type' =>'DECIMAL('.$tamanho.')', 'constraint' => $constraint]);
    }

    public function bool(string $name, string $constraint = null) {
        array_push($this->column,['name' => $name, 'type' =>'BOOLEAN', 'constraint' => $constraint]);
    }

    public function addcolumn(string $name, string $type,string $tamanho = null, string $constraint = null) {
        if(!is_null($tamanho)) $tamanho = '('.$tamanho.')';
        array_push($this->column,['name' => $name, 'type' =>$type.$tamanho, 'constraint' => $constraint]);
    }

    public function  foreignkey($column, $tablereferences, $columnreferences) {
        array_push($this->column, 'FOREIGN KEY ('.$column.') REFERENCES '.$tablereferences.' ('.$columnreferences.')');
    }
}
