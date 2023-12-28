<?php
namespace src;
use PDO;
/**
 * CLasse resposavel pela conexão com o banco de dados
 * @version ${1:1.0.0
 */
class Conexao {
    static $conn;//variavel de conexão
 /**
  * Método responsavel em abrir a conexão com o banco de dados
  *
  * @return PDO our Exeption
  */
    static public function conexao() {
      //verifica se a conão já foi feita
        if (!isset(self::$conn)) {
            try {
              //abri conexão com o banco
              self::$conn = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', '');
              self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(\PDOException $e) {
              //caso haja algum erro na conexão, armazena na a mensagem de erro na variavel
              self::$conn = $e->getMessage();
            }
        }
        //retorna a variavel com a conexão ou com erro
        return self::$conn;
    }
}