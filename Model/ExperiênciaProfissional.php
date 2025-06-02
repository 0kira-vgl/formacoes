<?php

class ExperienciaProfissional
{
  public function __construct(
    private ?int $id,
    private string $idusuario,
    private string $inicio,
    private string $fim,
    private string $empresa,
    private string $descricao,
  ) {
    $this->id = $id;
    $this->idusuario = $idusuario;
    $this->inicio = $inicio;
    $this->fim = $fim;
    $this->empresa = $empresa;
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

  public function getEmpresa()
  {
    return $this->empresa;
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
      $sql = "INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao)
                VALUES (:inicio, :fim, :empresa, :descricao)";
      $stmt = $conn->prepare($sql);

      $stmt->bindValue(':inicio', $this->inicio);
      $stmt->bindValue(':fim', $this->fim);
      $stmt->bindValue(':empresa', $this->empresa);
      $stmt->bindValue(':descricao', $this->descricao);

      if ($stmt->execute()) {
        $this->id = $conn->lastInsertId(); // Atualiza o ID com o valor gerado no banco
        return true;
      }

      return false;
    } catch (PDOException $e) {
      echo "Erro ao inserir Experiência Profissional: " . $e->getMessage();
      return false;
    }
  }

  public function excluirBD($id)
  {
    require_once 'ConexaoBD.php';

    try {
      $conn = new Database()::getInstance()->getConnection();
      $sql = "DELETE FROM experienciaprofissional WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Erro ao excluir Experiência Profissional: " . $e->getMessage();
      return false;
    }
  }

  public function listaExperiencias(int $idusuario)
  {
    require_once 'ConexaoBD.php';

    try {
      $conn = new Database()::getInstance()->getConnection();
      $sql = "SELECT * FROM experienciaprofissional WHERE idusuario = :idusuario ORDER BY inicio DESC";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':idusuario', $idusuario, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Erro ao listar Experiências Profissionais: " . $e->getMessage();
      return [];
    }
  }
}
