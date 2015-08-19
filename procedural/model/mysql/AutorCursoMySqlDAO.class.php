<?php

/**
 * Classe de operação da tabela 'autor_curso'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class AutorCursoMySqlDAO {

    protected $table = 'autor_curso';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna AutorCursoMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE fk_curso = :fk_curso";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_curso', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadAutorCurso($id, $curso) {
        $sql= "SELECT count(*) as count FROM `$this->table` WHERE fk_autor = :fk_autor  AND fk_curso = :fk_curso";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_autor', $id);
        $stmt->bindParam(':fk_curso', $curso);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Obtem todos o registros das Tabelas
     */
    public function queryAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Exclui um registro da tabela
     * @parametro autorCurso chave primária
     */
    public function deleteVinculo($id, $curso) {
        $sql = "DELETE FROM $this->table WHERE fk_autor = :fk_autor AND fk_curso = :fk_curso";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_autor', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fk_curso', $curso, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id = null, $curso = null) {
        
    }

    public function insert(AutorCurso $AutorCurso) {
        $sql = "INSERT INTO `$this->table`(`fk_autor`, `fk_curso`, `seq`, `status`)"
                . " VALUES (:fk_autor,:fk_curso,:seq,:status)";
        $fkAutor = $AutorCurso->getFkAutor();
        $fkCurso = $AutorCurso->getFkCurso();
        $seq = $AutorCurso->getSeq();
        $status = $AutorCurso->getStatus();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_autor', $fkAutor);
        $stmt->bindParam(':fk_curso', $fkCurso);
        $stmt->bindParam(':seq', $seq);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro AutorCursoMySql autorCurso
     */
    public function update(AutorCurso $AutorCurso) {
        $sql = "UPDATE $this->table SET seq = :seq, status = :status WHERE fk_curso = :id";
        $id = $AutorCurso->getFkCurso();


        $seq = $AutorCurso->getSeq();
        $status = $AutorCurso->getStatus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':seq', $seq);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

   
    public function load2($id_autor, $id_curso) {
        $sql = "SELECT u.*, c.nome as nome_curso, c.nivel as nivel_curso FROM autor a "
                . "INNER JOIN autor_curso ac ON ac.fk_autor = a.fk_usuario "
                . "INNER JOIN curso c ON c.id_curso = ac.fk_curso "
                . "INNER JOIN usuario u ON u.id_usuario = a.fk_usuario "
                . "WHERE fk_usuario = :fk_usuario AND c.id_curso = :id_curso ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id_autor, PDO::PARAM_INT);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadAllCursosAutor($id_autor) {
        $sql = "SELECT u.*, ac.fk_curso, c.nome as nome_curso, c.nivel as nivel_curso FROM autor a "
                . "INNER JOIN autor_curso ac ON ac.fk_autor = a.fk_usuario "
                . "INNER JOIN curso c ON c.id_curso = ac.fk_curso "
                . "INNER JOIN usuario u ON u.id_usuario = a.fk_usuario "
                . "WHERE fk_usuario = :fk_usuario ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id_autor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
