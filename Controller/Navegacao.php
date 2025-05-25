<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    switch ($_POST) {
        
        case isset($_POST[null]):
            include_once 'View/login.php';
            break;

            case isset($_POST['btnPrimeiroAcesso']):
            echo "Primeiro Acesso";
            include_once '../View/primeiroAcesso.php';
            break;

            case isset($_POST['btnCadastrar']):
                include_once 'UsuarioController.php';
                print_r($_POST);
                $uController = new UsuarioController();
                $nome = $_POST['txtNome'];
                $email = $_POST['txtEmail'];
                $cpf = $_POST['txtCPF'];
                $senha = $_POST['txtSenha'];
                $uController->inserir($nome, $email, $cpf, $senha);
                break;
        
        default:
            
                # code...
                break;
        }

        