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
class TrabalhoAutorCurso{
      
    private $fkTrabalho;
    private $fkAutor;
    private $fkCurso;
    private $seq;
    private $emailTrabalho;

      
    public function getFkTrabalho(){
        return $this->fkTrabalho;
    }
    public function getFkAutor(){
        return $this->fkAutor;
    }
    public function getFkCurso(){
        return $this->fkCurso;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function getEmailTrabalho(){
        return $this->emailTrabalho;
    }
    public function setFkTrabalho($fkTrabalho){
        $this->fkTrabalho = $fkTrabalho;
    }
    public function setFkAutor($fkAutor){
        $this->fkAutor = $fkAutor;
    }
    public function setFkCurso($fkCurso){
        $this->fkCurso = $fkCurso;
    }
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function setEmailTrabalho($emailTrabalho){
        $this->emailTrabalho = $emailTrabalho;
    }

}
