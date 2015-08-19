<?php
/**
 * Classe de operação da tabela 'trabalho_autor_curso'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class TrabalhoAutorCursoMySqlDAO  {
  protected $table = 'trabalho_autor_curso';
  /**
   * Implementa o dominio chave primária na seleção de único registro
   *
   * @parametro String $id primary key
   * @retorna TrabalhoAutorCursoMySql 
   */
  public function load($id_trabalho, $id_autor) {
    $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :fk_trabalho AND fk_autor = :fk_autor";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':fk_autor', $id_autor, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }

  public function loadAutor($id) {
    $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :id";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
   * @parametro trabalhoAutorCurso chave primária
   */
  public function delete($id_trabalho, $id_autor) {
    //Pega a seq deste trabalho_autor_curso
    $trab_aut_cur = $this->load($id_trabalho, $id_autor);
    $seq = $trab_aut_cur->seq;

    //Diminui de 1 todos os trabalho_autor_curso que tem seq maior.
    $sql = "UPDATE $this->table SET seq = seq - 1 WHERE "
            . "fk_trabalho = :fk_trabalho AND seq > :seq";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':seq', $seq, PDO::PARAM_INT);
    $stmt->execute();

    $sql = "DELETE FROM $this->table WHERE fk_trabalho = :fk_trabalho AND fk_autor = :fk_autor";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':fk_autor', $id_autor, PDO::PARAM_INT);
    return $stmt->execute();
  }
  /** ok 2015
   * Insere um registro na tabela
   *
   * @parametro TrabalhoAutorCursoMySql trabalhoAutorCurso
   */
  public function insert(\Entity\TrabalhoAutorCurso $TrabalhoAutorCurso) {
    $sql = "INSERT INTO $this->table (fk_trabalho, fk_autor, fk_curso, seq, email_trabalho) VALUES ( :fkTrabalho, :fkAutor, :fkCurso,  :seq,  :emailTrabalho)";

    $fkTrabalho = $TrabalhoAutorCurso->getFk_trabalho();
    $fkAutor = $TrabalhoAutorCurso->getFk_autor();
    $fkCurso = $TrabalhoAutorCurso->getFk_curso();
    $seq = $TrabalhoAutorCurso->getSequencia();
    $emailTrabalho = $TrabalhoAutorCurso->getEmailTrabalho();

    $stmt = ConnectionFactory::prepare($sql);

    $stmt->bindParam(':fkTrabalho', $fkTrabalho);
    $stmt->bindParam(':fkAutor', $fkAutor);
    $stmt->bindParam(':fkCurso', $fkCurso);
    $stmt->bindParam(':seq', $seq);
    $stmt->bindParam(':emailTrabalho', $emailTrabalho);
    return $stmt->execute();
  }
  /**
   * atualiza um registro da tabela
   *
   * @parametro TrabalhoAutorCursoMySql trabalhoAutorCurso
   */
  public function update(TrabalhoAutorCurso $TrabalhoAutorCurso) {
    $sql = "UPDATE $this->table SET fk_curso = :fk_curso, seq = :seq, email_trabalho = :email_trabalho WHERE fk_autor = :id";
    $id = $TrabalhoAutorCurso->getFkAutor();


    $fkCurso = $TrabalhoAutorCurso->getFkCurso();
    $seq = $TrabalhoAutorCurso->getSeq();
    $emailTrabalho = $TrabalhoAutorCurso->getEmailTrabalho();

    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':id', $id);


    $stmt->bindParam(':fkCurso', $fkCurso);
    $stmt->bindParam(':seq', $seq);
    $stmt->bindParam(':emailTrabalho', $emailTrabalho);

    return $stmt->execute();
  }
  /**
   * Obtem todos os Autor_Curso do trabalho.
   */
  public function queryAllOrderBySeq($id_trabalho) {
    $sql = "SELECT fk_trabalho, fk_autor, fk_curso, seq, email_trabalho FROM $this->table where fk_trabalho = :fk_trabalho ORDER BY seq";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  /**
   * Obtem o max seq desse trabalho_auto_curso.
   */
  public function queryMaxSeq($id_trabalho) {
    $sql = "SELECT max(seq) as max_seq FROM $this->table where fk_trabalho = :fk_trabalho ";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $result_0 = $result[0];
    return $result_0->max_seq;
  }

}