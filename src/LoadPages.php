<?php
namespace src;
/**
 * Classe responsavevel por registar as views a serem rederizadas
 */
class LoadPages {
    /**
     * Método para registrar a view de login
     */
    public function LoginPage() {
        return Plates::view('login');
    }
    /**
     * Método para registar a view dos usuarios
     */
    public function UserPage() {
       return Plates::view('user');
    }
    /**
     * Método para registrar a view de cadastro
     */
    public function CadastroPage() {
        return Plates::view('cadastro');
    }
}