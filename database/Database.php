<?php
namespace Database;
use src\Conexao;
use src\radical\tables;

class Database {
    public static $conect;
    public static tables $table;
    public static $tables;

    public static function start () {
        self::$conect = Conexao::conexao();
        self::$table = new tables();
    }
    public static function create ( string $table, array $column = null) {
        if (gettype(self::$conect) == "object") {
            $column = self::$table->column;
            if(is_null($column['id'])) die('Falta da coluna id');
            
            $quary = " CREATE TABLE ".$table." ( ".$column['id']['name'].' '.$column['id']['type'].' '.$column['id']['constraint'].',';
            $t = sizeof($column) - 1;
            for ($i = 0; $i < $t; $i++) { 
                $quary = $quary.' '.$column[$i]['name'].' '.$column[$i]['type'].' '.$column[$i]['constraint'];
                if($i != $t - 1 && $t > 1) {
                    $quary = $quary.',';
                }
            }
            $quary = $quary.')';
            self::$conect->exec($quary);
            return true;
        }
        return self::$conect;//retorna o erro caso haja.
    }


    public static function drop($nametable) {
        $conect = Conexao::conexao();
        if (gettype($conect) == "object") {
            $dropquary = "DROP TABLE ".$nametable;
            $conect->exec($dropquary);
        }
        return $conect;//retorna o erro caso haja.
    }
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
    
    public static function tables() {
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
