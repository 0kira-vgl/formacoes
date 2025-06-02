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

    //--Atualizar--//
    case isset($_POST["btnAtualizar"]):
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if (
            $uController->atualizar(
                $_POST["txtID"],
                $_POST["txtNome"],
                $_POST["txtCPF"],
                $_POST["txtEmail"],
                date("Y-m-d", strtotime($_POST["txtData"]))
            )
        ) {
            include_once "../View/atualizacaoinserida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    case isset($_POST["btnLogin"]):
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
            include_once "../View/principal.php";
        } else {
            include_once "../View/cadastroNaoRealizado.php";
        }
        break;

    //--Adicionar Formacao--//
    case isset($_POST["btnAddFormacao"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if (
            $fController->inserir(
                date("Y-m-d", strtotime($_POST["txtInicioFA"])),
                date("Y-m-d", strtotime($_POST["txtFimFA"])),
                $_POST["txtDescFA"],
                unserialize($_SESSION["Usuario"])->getID()
            ) != false
        ) {
            include_once "../View/cadastroRealizado.php";
        } else {
            include_once "../View/cadastroNaoRealizado.php";
        }
        break;

    //--Excluir Formacao--//
    case isset($_POST["btnExcluirFA"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if ($fController->remover($_POST["id"]) == true) {
            include_once "../View/informacaoExcluida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    //--Adicionar Experiencia Profissional--//
    case isset($_POST["btnAddEP"]):
        require_once "../Controller/ExperienciaProfissionalController.php";
        include_once "../Model/Usuario.php";
        $epController = new ExperienciaProfissionalController();
        if (
            $epController->inserir(
                date("Y-m-d", strtotime($_POST["txtInicioEP"])),
                date("Y-m-d", strtotime($_POST["txtFimEP"])),
                $_POST["txtEmpEP"],
                $_POST["txtDescEP"],
                unserialize($_SESSION["Usuario"])->getID()
            ) != false
        ) {
            include_once "../View/informacaoInserida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    //--Excluir Experiencia Profissional--//
    case isset($_POST["btnExcluirEP"]):
        require_once "../Controller/ExperienciaProfissionalController.php";
        include_once "../Model/Usuario.php";
        $epController = new ExperienciaProfissionalController();
        if ($epController->remover($_POST["idEP"]) == true) {
            include_once "../View/informacaoExcluida.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    default:
        include_once '../View/principal.php';

        # code...
        break;
}
