<?php
namespace src;

class File {
    public static $dir = 'accets/img/';

    static public function file($file, $past = null) {
        $extencion = self::Extencion($file);
        $newName = uniqid().'.'.$extencion;
      
        if(!move_uploaded_file($file["tmp_name"],self::$dir.$past.'/'.$newName)) {
            mkdir(self::$dir.$past);
            move_uploaded_file($file["tmp_name"],self::$dir.$past.'/'.$newName);
        }
        $result = self::$dir.$past.'/'.$newName;
        return $result;
    }
    
    static public function extencion($file){
        $extencion = pathinfo($file['name'], PATHINFO_EXTENSION);
        return $extencion;
    }
}
