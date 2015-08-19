<?php
/**
* Classe de operação da tabela 'trabalho_orientador_campus'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class TrabalhoOrientadorCampus{
      
    private $fkTrabalho;
    private $fkOrientador;
    private $fkCampus;
    private $seq;
    private $emailTrabalho;

      
    public function getFkTrabalho(){
        return $this->fkTrabalho;
    }

    public function getFkOrientador(){
        return $this->fkOrientador;
    }

    public function getFkCampus(){
        return $this->fkCampus;
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

    public function setFkOrientador($fkOrientador){
        $this->fkOrientador = $fkOrientador;
    }

    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }

    public function setSeq($seq){
        $this->seq = $seq;
    }

    public function setEmailTrabalho($emailTrabalho){
        $this->emailTrabalho = $emailTrabalho;
    }


}
