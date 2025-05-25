<?php
// Arquivo de conexão com o banco de dados

class Database
{
  private static $instance = null;
  private $conn;

  private function __construct()
  {
    $host = getenv('MYSQL_HOST') ?: 'localhost';
    $db   = getenv('MYSQL_DATABASE') ?: 'formacoes_db';
    $user = getenv('MYSQL_USER') ?: 'formacoes_user';
    $pass = getenv('MYSQL_PASSWORD') ?: 'formacoes_pass';

    try {
      $this->conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Erro na conexão: " . $e->getMessage();
    }
  }

  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }
}
