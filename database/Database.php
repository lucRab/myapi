<?php
namespace Database;
use src\Conexao;
use src\radical\tables;
/**
 * Classe para manipular o banco de dados
 */
class Database {
    /**
     * Variavel de conexão com o banco de dados
     * @var  \PDO
     */
    public static $conect;
    public static $tables;
    /**
     * Método para iniciar a conexão com o banco de dados
     *  - Esse metodo deve ser acionado antes de qualquer outro método
     * @return void
     */
    public static function start () {
        self::$conect = Conexao::conexao();
    }
    /**
     * Método responsavel pela criação da tabela
     *
     * @param string $tablename : nome da tabela
     * @param tables $table : variavel do tipo tabela que irá definir a tabela
     */
    public static function create ( string $tablename ,tables $table) {
        //verifica a conexão do banco de dados
        if (gettype(self::$conect) == "object") {
            $column = $table->column;
            if(array_key_exists('id',$column)){//verifica se a tabela há um id
                $quary = " CREATE TABLE ".$tablename." ( ".$column['id']['name'].' '.$column['id']['type'].' '.$column['id']['constraint'].',';
                $t = sizeof($column) - 1;
            } else {
                $quary = "CREATE TABLE ".$tablename." (";
                $t = sizeof($column);
            } 

            for ($i = 0; $i < $t; $i++) { //monta a quary com todas as columnas a serem criadas
                $quary = $quary.' '.$column[$i]['name'].' '.$column[$i]['type'].' '.$column[$i]['constraint'];
                if($i != $t - 1 && $t > 1) {
                    $quary = $quary.',';
                }
            }
            $quary = $quary.')';
            //executa a quary
            //var_dump($quary);
            self::$conect->exec($quary);
            return true;
        }
        return self::$conect;//retorna o erro caso haja.
    }
    /**
     * Método responsavel pelo drop de uma tabela
     *
     * @param string $nametable : nome da tabela
     */
    public static function drop (string $nametable) {
        $conect = Conexao::conexao();
        if (gettype($conect) == "object") {
            $dropquary = "DROP TABLE ".$nametable;
            $conect->exec($dropquary);
        }
        return $conect;//retorna o erro caso haja.
    }
    /**
     * Método que dropa todas as tabelas do banco de dados
     * - [ATENÇÃO] Esse metodo apaga todos as tabelas do banco de dados
     */
    public static function dropAll() {
        $conect = Conexao::conexao();
        if (gettype($conect) == "object") {
            self::tables();
            $dropquary = "DROP TABLE ";
            $t = sizeof(self::$tables);
            for ($i=0; $i < $t; $i++) { 
                $conect->exec($dropquary.self::$tables[$i]['name']);
            }
        }
        return $conect;//retorna o erro caso haja.
    }
    /**
     * Método que reseta todas as tabelas do banco de dados
     * - [ATENÇÃO] Esse metodo apaga todos os dados de todas as tabelas do banco de dados
     */
    public static function refresh() {
        $conect = Conexao::conexao();
        if (gettype($conect) == "object") {
            self::tables();
            $dropquary = "DROP TABLE ";
            $t = sizeof(self::$tables);
            for ($i=0; $i < $t; $i++) { 
                $conect->exec($dropquary.self::$tables[$i]['name']);
            }
            for ($i=0; $i < $t; $i++) {
                $conect->exec(self::$tables[0]['quary']);
            }
            return true;
        }
        return $conect;//retorna o erro caso haja.
    }
    
    private static function tables() {
        $conect = Conexao::conexao();
        if (gettype($conect) == "object") {
            $get = $conect->prepare("SHOW TABLES");
            $get->execute();
            $result = $get->fetchAll();
            $t = sizeof($result);
            for ($i=0; $i < $t; $i++) { 
                self::$tables[$i] = ['name' => $result[$i]["Tables_in_mydb"]];
                $tabela = $result[$i]["Tables_in_mydb"];
                $column = $conect->prepare('DESCRIBE '.$tabela);
                $column->execute();
                $r = $column->fetchAll();
                $a = sizeof($r);
                for ($ix=0; $ix < $a; $ix++) {
                    if($r[$ix]['Key'] && $r[$ix]['Key'] == 'PRI')  {
                        self::$tables[$i]['quary'] = 'CREATE TABLE '.$tabela." (".$r[$ix]['Field'].' '.$r[$ix]['Type'].' PRIMARY KEY '.$r[$ix]['Extra'].',';
                    }else{
                        $key = null;
                        $null = null;
                        if($r[$ix]['Key'] == 'UNI') $key = 'UNIQUE';
                        if($r[$ix]['Null'] == 'NO') $null = 'NOT NULL';
                        self::$tables[$i]['quary'] = self::$tables[$i]['quary']. ' '.$r[$ix]['Field'].' '.$r[$ix]['Type'].' '.$key.' '.$null.' '.$r[$ix]['Extra']; 
                        if($ix != $a - 1 && $a > 1) {
                            self::$tables[$i]['quary'] = self::$tables[$i]['quary'].',';
                        }
                    }
                }
                self::$tables[$i]['quary'] = self::$tables[$i]['quary'].')';   
            }
        }
        return $conect;//retorna o erro caso haja.
    }
}
