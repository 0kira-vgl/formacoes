<?php

class Usuario {

    private $nome;
    private $email;
    private $cpf;
    private $senha;

    public function __construct($nome, $email, $cpf, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function inserirBD() {
        // Lógica para inserir o usuário no banco de dados
        // Aqui você pode adicionar a lógica para inserir os dados no banco de dados
        // e retornar uma resposta adequada.
        echo "Usuário cadastrado com sucesso!";
    }
}
