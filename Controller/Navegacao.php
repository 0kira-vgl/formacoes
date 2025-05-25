<?php

if (!isset($_SESSION)) {
    session_start();
}

switch ($_POST) {

    case isset($_POST[null]):
        include_once 'View/login.php';
        break;

    // Primeiro acesso
    case isset($_POST['btnPrimeiroAcesso']):
        include_once '../View/primeiroAcesso.php';
        break;

    case isset($_POST['btnCadastrar']):
        include_once 'UsuarioController.php';

        $uController = new UsuarioController();
        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $cpf = $_POST['txtCPF'];
        $senha = $_POST['txtSenha'];

        if ($uController->inserir($nome, $email, $cpf, $senha)) {
            include_once '../View/cadastroRealizado.php';
        } else {
            include_once '../View/cadastroNaoRealizado.php';
        }

        break;

    default:
        echo "Este seria a proxima pagina";
        # code...
        break;
}
