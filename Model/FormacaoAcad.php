<?php

class FormacaoAcad
{
  function __construct(
    private ?int $id,
    private int $idusuario,
    private string $inicio,
    private string $fim,
    private string $descricao,
  ) {
    $this->id = $id;
    $this->idusuario = $idusuario;
    $this->inicio = $inicio;
    $this->fim = $fim;
    $this->descricao = $descricao;
  }

  public function getID()
  {
    return $this->id;
  }
  public function getIdUsuario()
  {
    return $this->idusuario;
  }
  public function getInicio()
  {
    return $this->inicio;
  }
  public function getFim()
  {
    return $this->fim;
  }
  public function getDescricao()
  {
    return $this->descricao;
  }

  public function inserirBD()
  {
    require_once 'ConexaoBD.php';

    try {
      $conn = new Database()::getInstance()->getConnection();
      $sql = "INSERT INTO formacaoAcademica (idusuario, inicio, fim, descricao)
                VALUES (:idusuario, :inicio, :fim, :descricao)";
      $stmt = $conn->prepare($sql);

      $stmt->bindValue(':idusuario', $this->idusuario);
      $stmt->bindValue(':inicio', $this->inicio);
      $stmt->bindValue(':fim', $this->fim);
      $stmt->bindValue(':descricao', $this->descricao);

      if ($stmt->execute()) {
        $this->id = $conn->lastInsertId(); // Atualiza o ID com o valor gerado no banco
        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "Erro ao inserir usuário: " . $e->getMessage();
      return false;
    }
  }

  public function excluirBD(int $id)
  {
    require_once 'ConexaoBD.php';

    try {
      $conn = new Database()::getInstance()->getConnection();
      $sql = "DELETE FROM formacaoAcademica WHERE idformacaoAcademica = :id";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Erro ao excluir formação acadêmica: " . $e->getMessage();
      return false;
    }
  }

  public function listaFormacoes(int $idusuario)
  {
    require_once 'ConexaoBD.php';

    try {
      $conn = new Database()::getInstance()->getConnection();
      $sql = "SELECT * FROM formacaoAcademica WHERE idusuario = :idusuario";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':idusuario', $idusuario, PDO::PARAM_INT);
      $stmt->execute();

      $formacoes = [];

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $formacoes[] = new FormacaoAcad(
          $row['idformacaoAcademica'],
          $row['idusuario'],
          $row['inicio'],
          $row['fim'],
          $row['descricao']
        );
      }

      if ($formacoes) {
        return $formacoes[0];
      }

      return null;
    } catch (PDOException $e) {
      echo "Erro ao listar formações acadêmicas: " . $e->getMessage();
      return null;
    }
  }
}
