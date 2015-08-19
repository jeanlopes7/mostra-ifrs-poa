<?php
/**
* Classe de operação da tabela 'trabalho'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Trabalho2{
      
    private $idTrabalho;
    private $fkArea;
    private $fkCategoria;
    private $fkModalidade;
    private $nivel;
    private $titulo;
    private $tituloOrdenar;
    private $palavra1;
    private $palavra2;
    private $palavra3;
    
    private $apoiadores;
    private $resumo;
    private $resumo2;
    private $status;
    private $dataCadastro;
    private $dataAtualizacao;
    private $ipCadastro;
    private $ipAtualizacao;
    private $fkSessao;
    private $seqSessao;
    private $nota;
    private $premiado;
    
    private $turno1;
    private $turno2;
    private $turno3;

    public function getIdTrabalho(){
        return $this->idTrabalho;
    }

    public function getFkArea(){
        return $this->fkArea;
    }

    public function getFkCategoria(){
        return $this->fkCategoria;
    }

    public function getFkModalidade(){
        return $this->fkModalidade;
    }

    public function getNivel(){
        return $this->nivel;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getTituloOrdenar(){
        return $this->tituloOrdenar;
    }

    public function getPalavra1(){
        return $this->palavra1;
    }

    public function getPalavra2(){
        return $this->palavra2;
    }

    public function getPalavra3(){
        return $this->palavra3;
    }
    
    public function getApoiadores(){
        return $this->apoiadores;
    }

    public function getResumo(){
        return $this->resumo;
    }

    public function getResumo2(){
        return $this->resumo2;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function getDataAtualizacao(){
        return $this->dataAtualizacao;
    }

    public function getIpCadastro(){
        return $this->ipCadastro;
    }

    public function getIpAtualizacao(){
        return $this->ipAtualizacao;
    }

    public function getFkSessao(){
        return $this->fkSessao;
    }

    public function getSeqSessao(){
        return $this->seqSessao;
    }

    public function getNota(){
        return $this->nota;
    }

    public function getPremiado(){
        return $this->premiado;
    }

    public function getTurno1(){
        return $this->turno1;
    }

    public function getTurno2(){
        return $this->turno2;
    }
    
    public function getTurno3(){
        return $this->turno3;
    }

    public function setIdTrabalho($idTrabalho){
        $this->idTrabalho = $idTrabalho;
    }

    public function setFkArea($fkArea){
        $this->fkArea = $fkArea;
    }

    public function setFkCategoria($fkCategoria){
        $this->fkCategoria = $fkCategoria;
    }

    public function setFkModalidade($fkModalidade){
        $this->fkModalidade = $fkModalidade;
    }

    public function setNivel($nivel){
        $this->nivel = $nivel;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setTituloOrdenar($tituloOrdenar){
        $this->tituloOrdenar = $tituloOrdenar;
    }

    public function setPalavra1($palavra1){
        $this->palavra1 = $palavra1;
    }

    public function setPalavra2($palavra2){
        $this->palavra2 = $palavra2;
    }

    public function setPalavra3($palavra3){
        $this->palavra3 = $palavra3;
    }

    public function setApoiadores($apoiadores){
        $this->apoiadores = $apoiadores;
    }

    public function setResumo($resumo){
        $this->resumo = $resumo;
    }

    public function setResumo2($resumo2){
        $this->resumo2 = $resumo2;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setDataCadastro($dataCadastro){
        $this->dataCadastro = $dataCadastro;
    }

    public function setDataAtualizacao($dataAtualizacao){
        $this->dataAtualizacao = $dataAtualizacao;
    }

    public function setIpCadastro($ipCadastro){
        $this->ipCadastro = $ipCadastro;
    }

    public function setIpAtualizacao($ipAtualizacao){
        $this->ipAtualizacao = $ipAtualizacao;
    }

    public function setFkSessao($fkSessao){
        $this->fkSessao = $fkSessao;
    }

    public function setSeqSessao($seqSessao){
        $this->seqSessao = $seqSessao;
    }

    public function setNota($nota){
        $this->nota = $nota;
    }

    public function setPremiado($premiado){
        $this->premiado = $premiado;
    }

    public function setTurno1($turno){
        $this->turno1 = $turno;
    }

    public function setTurno2($turno){
        $this->turno2 = $turno;
    }

    public function setTurno3($turno){
        $this->turno3 = $turno;
    }

}
