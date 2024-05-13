<?php 
require "../app/DTO/DTO.php";
require "../vendor/autoload.php";

use App\DTO\DTO;
use App\DTO\UserDto;
use App\model\User;
//TESTE UNITARIO
#---------------------------------------------------------------------------------------------------------------------------------------------------------#
//                              CLASSES DOS TESTES
/**
 * CLASSE DE TESTE DO USUARIO
 * @test
 * @version ${1:1.0.0
 */
class TesteUser {
    
    private UserDto $dto;

    public function  __construct() {
        $dto = new UserDto('Lucas', 'email', 'senha');
    }
    /**
     * Função para testar o model User
     * Todas as funções do CRUD model serão acionadas para teste=
     * #1 Usuario será criado
     * #1 Usuario será atualizado
     * #1 Usuario será deletado
     * @return void
     */
    public function modelUserCRUDTeste(User $user, &$dto):void {
        var_dump($dto);
        $this->Usercreate($user, $dto);
        var_dump($dto);
        // $this->UserUpdate();
        // $this->UserDelete();
    }
    private function Usercreate(User $user, &$dto):void {
        $user->create($dto);
    }
    private function UserUpdate():void {    
        $result = $this->user->update($this->dto);
        var_dump($result);
    }
    private function UserDelete():void {
        $result = $this->user->delete($this->dto);
    }
}
#-------------------------------------------------------------------------------------------------------------------------------------------------#
$testeuser = new TesteUser();

$dto = new UserDto('Lucas', 'e@gmail', 'senha');
$user = new User();
$testeuser->modelUserCRUDTeste($user, $dto);