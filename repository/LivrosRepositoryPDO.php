<?php

require "Conexao.php";

class LivrosRepositoryPDO{

    private $conexao;

    public function __construct(){
            $this->conexao = Conexao::criar();
    }

    public function listarTodos(): array{
        $livrosLista = array();

        $sql = "SELECT * FROM livros";
        $livros = $this->conexao->query($sql);
        if (!$livros) return false;

        while ($livro = $livros->fetchObject()) {
            array_push($livrosLista, $livro);
        }
        return $livrosLista;
    }

    public function salvar($livro): bool{
        $sql = "INSERT INTO livros (titulo, capa, descricao, nota, arquivo)
        VALUES (:titulo, :capa, :descricao, :nota, :arquivo)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':titulo', $livro->titulo, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $livro->descricao, PDO::PARAM_STR);
        $stmt->bindValue(':nota', $livro->nota, PDO::PARAM_STR);
        $stmt->bindValue(':capa', $livro->capa, PDO::PARAM_STR);
        $stmt->bindValue(':arquivo', $livro->arquivo, PDO::PARAM_STR);


        return $stmt->execute();

    }

    public function favoritar(int $id){
        $sql = "UPDATE livros SET favorito = NOT favorito WHERE id=:id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        }else{
            return "erro";
        }
    }

    public function delete(int $id){
        $sql = "DELETE FROM livros WHERE id=:id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        }else{
            return "erro";
        }
    }

}
