<?php

if (!isset($_SESSION)) {
    session_start();
}


class UsuarioController {

    function inserir($nome, $email, $cpf, $senha) {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario(
            $nome,
            $email,
            $cpf,
            $senha
        );

        $r = $usuario->inserirBD();
        $_SESSION['usuario'] = serialize($usuario);
        
        return $r;
    }
}