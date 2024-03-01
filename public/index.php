<?php
require_once "../vendor/autoload.php";
require "../src/Route.php";
use src\Route;

 Route::route('/', 'GET', 'LoadPages:LoginPage');
 Route::route('/teste/{numeric}', 'GET','LoadPages:TestePage');
 Route::route('/teste/{alpha}', 'GET','LoadPages:TestePage');
 Route::route('/teste/{any}', 'GET','LoadPages:TestePage');
 Route::route('/user', 'GET', 'LoadPages:UserPage');
 Route::route('/user', 'POST', 'UserController:index');
 Route::route('/cadastro', 'GET', 'LoadPages:CadastroPage');
 Route::route('/cadastro', 'POST', 'UserController:store');
 Route::route('/login', 'POST', 'UserController:login');
 
 Route::route('/t', 'GET', 'UserController:index');
 Route::start();