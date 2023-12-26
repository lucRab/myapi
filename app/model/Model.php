<?php
namespace App\model;
use src\Conexao;
/**
 * Class Model pai para implementação dos outros models
 * @abstract
 * @api
 */
abstract class Model {
    protected $conect;
    
    public function __construct() {
        $this->conect = Conexao::conexao();
    }
    abstract function create(array $param);

    abstract function update(array $param);

    abstract function delete(array $param);
}