<?php
class Administrador
{
  private $id;
  private $nome;
  private $cpf;
  private $senha;

  public function setID($id)
  {
    $this->id = $id;
  }
  public function getID()
  {
    return $this->id;
  }
  public function setNome($nome)
  {
    $this->nome = $nome;
  }
  public function getNome()
  {
    return $this->nome;
  }
  public function setCPF($cpf)
  {
    $this->cpf = $cpf;
  }
  public function getCPF()
  {
    return $this->cpf;
  }
  public function setSenha($senha)
  {
    $this->senha = $senha;
  }
  public function getSenha()
  {
    return $this->senha;
  }

  public function carregarAdministrador($cpf)
  {
    require_once 'ConexaoBD.php';
    $con = new Database();
    $conn = $con->getConnection();
    $sql = "SELECT * FROM administrador WHERE cpf = '" . $cpf . "'";
    $re = $conn->query($sql);
    $r = $re->fetch(PDO::FETCH_OBJ);
    if ($r != null) {
      $this->id = $r->idadministrador;
      $this->nome = $r->nome;
      $this->cpf = $r->cpf;
      $this->senha = $r->senha;
      return true;
    } else {
      return false;
    }
  }

  public function listaCadastrados()
  {
    require_once 'ConexaoBD.php';
    $con = new Database();
    $conn = $con->getConnection();
    $sql = "SELECT idadministrador, nome, cpf FROM administrador;";
    $re = $conn->query($sql);
    return $re;
  }
}
