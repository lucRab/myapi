<?php
namespace src;

class Slug
{
    public static function created(string $name) {
        $slug = $name;
        if(str_contains($name, ' ')) $slug = str_replace(' ','-' , $name);
        $rand = self::random_str_generator(7);
        $slug = strtolower($slug).$rand;
        return $slug;
    }
    static function random_str_generator ($len_of_gen_str){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-";
        $var_size = strlen($chars);
        for( $x = 0; $x < $len_of_gen_str; $x++ ) {
            $random_str= $chars[ rand( 0, $var_size - 1 ) ];    
        }
        return $random_str;
    }
}
