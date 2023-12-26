<?php
namespace src;
use PDO;
class Conexao {
    static $conn;
    static public function conexao() {
        if (!isset(self::$conn)) {
            try {
              self::$conn = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', '');
              self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(\PDOException $e) {
              self::$conn = $e->getMessage();
            }
        }  
        return self::$conn;
    }
}

