<?php
namespace src;
/**
 * Classe responsavevel por registar as views a serem rederizadas
 */
class LoadPages {
    /**
     * Método para registrar a view de login
     *
     * @return void
     */
    public function LoginPage() {
        return Plates::view('login');
    }
    /**
     * Método para registar a view dos usuarios
     *
     * @return void
     */
    public function UserPage() {
       return Plates::view('user');
    }
}