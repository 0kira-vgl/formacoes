<?php

if (!isset($_SESSION)) {
    session_start();
}


class UsuarioController
{

    function inserir($nome, $email, $cpf, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario(
            null,
            $nome,
            $email,
            $cpf,
            null,
            $senha,
        );

        $r = $usuario->inserirBD();
        $_SESSION['usuario'] = serialize($usuario);

        return $r;
    }

    public function atualizar($id, $nome, $cpf, $email, $dataNascimento)
    {
        require_once '../Model/Usuario.php';
        // Recupera o usuário da sessão para manter a senha
        $usuarioAtual = unserialize($_SESSION['Usuario']);
        $usuario = new Usuario(
            $id,
            $nome,
            $email,
            $cpf,
            $dataNascimento,
            $usuarioAtual ? $usuarioAtual->getSenha() : ''
        );
        $r = $usuario->atualizarDB($id);
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }

    public function login($cpf, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario(null, '', '', $cpf, null, '');
        $usuario->carregarUsuario($cpf);
        $verSenha = $usuario->getSenha();
        if ($senha == $verSenha) {
            $_SESSION['Usuario'] = serialize($usuario);
            return true;
        } else {
            return false;
        }
    }

    public function gerarLista()
    {
        require_once '../Model/Usuario.php';
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT idusuario, nome FROM usuario;";
        $stmt = $con->query($sql);
        return $stmt;
    }
}
