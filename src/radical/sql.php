<?php
namespace src\radical;

class sql
{
    public $value;
    public $param;
    public $p_value;
    public $p_column;
    public $column;
    public function where(string $value1, string $condision, $value2) {
        if(is_int($value2)) {
            $this->param = " WHERE ".$value1." ".$condision." ".$value2;
            $this->p_value = null;
        }
        if(is_string($value2)) {
            $this->param = " WHERE ".$value1." ".$condision." :value";
            $this->p_value = ['value' => $value2];
        }
    }
    public function values(array $value) {
        $key = array_keys($value);
        for ($i=0; $i < sizeof($key); $i++) { 
            $this->p_column = $this->p_column.':'.$key[$i];
            if(!$i == sizeof($key) && sizeof($key) > 1) {
                $this->values = $this->p_column.', ';
            }
        }
        $this->value = $value;
    }

    public function column(string $columns) {
        $this->column = $columns;
    }
}
