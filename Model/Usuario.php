<?php

class Usuario
{



    public function __construct(
        private ?int $id,
        private string $nome,
        private string $email,
        private string $cpf,
        private string $dataNascimento,
        private string $senha,
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->dataNascimento = $dataNascimento;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function inserirBD()
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = new Database()->getConnection();
            $sql = "INSERT INTO usuario (nome, email, cpf, dataNascimento, senha)
                VALUES (:nome, :email, :cpf, :dataNascimento, :senha)";
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':dataNascimento', $this->dataNascimento);
            $stmt->bindValue(':senha', $this->senha); // Idealmente, a senha deve estar criptografada

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

    public function carregarUsuario(string $cpf)
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = new Database()->getConnection();
            $sql = "SELECT * FROM usuario WHERE cpf = :cpf";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $this->id = $usuario['idusuario'];
                $this->nome = $usuario['nome'];
                $this->email = $usuario['email'];
                $this->cpf = $usuario['cpf'];
                $this->dataNascimento = $usuario['dataNascimento'];
                $this->senha = $usuario['senha'];
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo "Erro ao carregar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function atualizarDB(int $id)
    {
        require_once 'ConexaoBD.php';

        try {
            $conn = new Database()->getConnection();
            $sql = "UPDATE usuario SET nome = :nome, email = :email, cpf = :cpf, dataNascimento = :dataNascimento, senha = :senha
                    WHERE idusuario = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':cpf', $this->cpf);
            $stmt->bindValue(':dataNascimento', $this->dataNascimento);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }
}
