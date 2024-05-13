<?php
namespace App\DTO;
use App\DTO\DTO;
class EventDTO extends DTO{
    private $event_id;//Indetificador Geral da Tabela event
    public function __construct(
        string $name,//coluna name
        string $description,//coluna description
        string $date,//coluna date
        string $status,//coluna status
        int $vagas,//coluna vagas
        float $preco//coluna preco
    ){
        $this->created(name: $name, description: $description, status: $status, date: $date, vagas: $vagas, preco: $preco);
    }

    public function setEventId(int $id) {
        $this->event_id = $id;
    }

    public function setName(string $name) {
        $this->DTO['name'] = $name;
    }

    public function setDescription(string $description) {
        $this->DTO['description'] = $description;
    }
    public function setStatus(string $status) {
        $this->DTO['status'] = $status;
    }
    public function setDate(string $date) {
        $this->DTO['date'] = $date;
    }
    public function setVagas(int $vagas) {
        $this->DTO['vagas'] = $vagas;
    }
    
    public function setPreco(string $preco) {
        $this->DTO['preco'] = $preco;
    }

    public function eventID() {
        return $this->event_id;
    }
    public function name():string {
        return $this->DTO['name'];
    }

    public function description():string {
        return $this->DTO['description'];
    }

    public function status():string {
        return $this->DTO['status'];
    }

    public function date():string {
        return $this->DTO['date'];
    }

    public function vagas():int {
        return $this->DTO['vagas'];
    }
    
    public function preco():float {
        return $this->DTO['preco'];
    }
}