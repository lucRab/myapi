<?php
namespace App\DTO;
/**
 * Classe DTO para segurança de dados
 * @version ${1:1.0.0
 */
class DTO {
    /**
     * Variavel que guardarar todos os dados
     *
     * @var array
     */
    public array $DTO;
    /**
     * Método pela criação do DTO
     *  Todos os argumentos são salvos na variavel $DTO
     * @param mixed ...$args
     * @return void
     */
    public function created(...$args) {
        $this->DTO = $args;
    }
}