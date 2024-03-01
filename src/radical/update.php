<?php 
namespace src\radical;

class update extends sql {
    public function values(array $value) {
        $key = array_keys($value);
        for ($i=0; $i < sizeof($key); $i++) { 
            $this->p_column = $this->p_column.$key[$i].' = :'.$key[$i];
            if(!$i == sizeof($key) && sizeof($key) > 1) {
                $this->values = $this->p_column.', ';
            }
        }
        $this->value = $value;
    }

}