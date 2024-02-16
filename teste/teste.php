<?php
$array = [
    'a' => []];

array_push($array['a'], 'q');
var_dump($array);

try {
    
} catch (\Throwable $th) {
    //throw $th;
}