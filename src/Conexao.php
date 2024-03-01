<?php
namespace src;
use Dotenv\Dotenv;
use PDO;
/**
 * CLasse resposavel pela conexão com o banco de dados
 * @version ${1:1.0.0
 */
class Conexao {
    static $conn;//variavel de conexão
    static private function loadEnv() {
      $dotenv = Dotenv::createImmutable(dirname(__FILE__,2));
      $dotenv->load();
  }
 /**
  * Método responsavel em abrir a conexão com o banco de dados
  *
  * @return PDO our Exeption
  */
    static public function conexao() {
      self::loadEnv();
      //verifica se a conão já foi feita
        if (!isset(self::$conn)) {
            try {
              //abri conexão com o banco
              self::$conn = new PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
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