<?php
namespace App\DTO;
use App\DTO\DTO;
class UserDto extends DTO {

    private int $user_id;//Indentificação Geral da Tabela user
    public function __construct(   
        string $name,//coluna name
        string $email,//coluna email
        string  $password,//coluna password
    ){
        $this->created(name:$name, email:$email, password:$password);
    }

    public function setUserID(int $id) {
        $this->user_id = $id;
    }

    public function setName(string $name) {
        $this->DTO['name'] = $name;
    }

    public function setEmail(string $email) {
        $this->DTO['email'] = $email;
    }

    public function setPassword($password) {
        $this->DTO['password'] = $password;
    }

    public function get(string $property): mixed {
        return $this->{$property};
    }
    public function name():string {
        return $this->DTO['name'];
    }

    public function email():string {
        return $this->DTO['email'];
    }

    public function password():string {
        return $this->DTO['password'];
    }

    public function userId():int {
        return $this->user_id;
    }
}