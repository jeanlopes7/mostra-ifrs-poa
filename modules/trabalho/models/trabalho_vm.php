<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Trabalho_vm extends CI_Model {

    /**
     * @var integer
     */
    private $idTrabalho;

    /**
     * @var integer
     */
    private $area;

    /**
     * @var Modalidade
     */
    private $modalidade;

    /**
     * @var Categoria
     */
    private $categoria;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $tituloOrdenar;

    /**
     * @var string
     */
    private $resumo;

    /**
     * @var string
     */
    private $resumo2;

    /**
     * @var string
     */
    private $palavra1;

    /**
     * @var string
     */
    private $palavra2;

    /**
     * @var string
     */
    private $palavra3;

    /**
     * @var string
     */
    private $apoiadores;

    /**
     * @var integer
     */
    private $nivel;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var Sessao
     */
    private $sessao;

    /**
     * @var integer
     * Sequencia do trabalho dentro da sessao
     */
    private $seqSessao;

    /**
     * @var float
     * nota final do trabalho
     */
    private $nota;

    /**
     * @var integer
     */
    private $premiado;


    /**
     * @var string
     */
    private $turno1;

    /**
     * @var string
     */
    private $turno2;

    /**
     * @var string
     */
    private $turno3;
    

    function __construct() {
        parent::__construct();
    }

    public function populate() {

        $this->setIdTrabalho($this->input->post('id_trabalho'));
        $this->setTitulo($this->input->post('ctitulo'));
        $this->setResumo($this->input->post('cnome'));
        $this->setPalavra1($this->input->post('palavra1'));
        
    }

    public function validate() {
        
    }
    
    /**
     * Constrói uma nova Entity Trabalho com base nos dados da view-model
     * @return \Entity\Trabalho
     */
    public function load_orientador() {
        $trabalho = new \Entity\Trabalho;
        $trabalho->setTitulo($this->getTitulo());
        
        return $trabalho;
    }

    /**
     * Get idTrabalho
     *
     * @return integer 
     */
    public function getIdTrabalho() {
        return $this->idTrabalho;
    }

    /**
     * Set idTrabalho
     *
     * @param integer $id_trabalho
     */
    public function setIdTrabalho(integer $id_trabalho)  {
        $this->idTrabalho = $id_trabalho;
    }


    /**
     * Set fkArea
     *
     * @param integer $area
     */
    public function setArea($area)   {
        $this->area = $area;
    }

    /**
     * Get fkArea
     *
     * @return integer 
     */
    public function getArea() {
        return $this->area;
    }

    /**
     * Set modalidade
     *
     * @param Modalidade $modalidade
     */
    public function setModalidade(Modalidade $modalidade = null)  {
        $this->modalidade = $modalidade;
    }

    /**
     * Get fkModalidade
     *
     * @return Modalidade 
     */
    public function getModalidade()  {
        return $this->modalidade;
    }

    /**
     * Set categoria
     *
     * @param Categoria $categoria
     */
    public function setCategoria(Categoria $categoria = null)  {
        $this->categoria = $categoria;
    }

    /**
     * Get fkCategoria
     *
     * @return Categoria 
     */
    public function getCategoria()  {
        return $this->categoria;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)  {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set tituloOrdenar
     *
     * @param string $tituloOrdenar
     */
    public function setTituloOrdenar($tituloOrdenar)  {
        $this->tituloOrdenar = $tituloOrdenar;
    }

    /**
     * Get tituloOrdenar
     *
     * @return string 
     */
    public function getTituloOrdenar() {
        return $this->tituloOrdenar;
    }

    /**
     * Set resumo
     *
     * @param string $resumo
     */
    public function setResumo($resumo)  {
        $this->resumo = $resumo;
    }

    /**
     * Get resumo
     *
     * @return string 
     */
    public function getResumo()   {
        return $this->resumo;
    }
    
    /**
     * Set resumo2
     *
     * @param string $resumo2
     */
    public function setResumo2($resumo2)  {
        $this->resumo2 = $resumo2;
    }

    /**
     * Get resumo2
     *
     * @return string 
     */
    public function getResumo2()  {
        return $this->resumo2;
    }
    
    /**
     * Set palavra1
     *
     * @param string $palavra1
     * @return Trabalho
     */
    public function setPalavra1($palavra1)  {
        $this->palavra1 = $palavra1;
    }

    /**
     * Get palavra1
     *
     * @return string 
     */
    public function getPalavra1() {
        return $this->palavra1;
    }

    /**
     * Set palavra2
     *
     * @param string $palavra2
     */
    public function setPalavra2($palavra2)  {
        $this->palavra2 = $palavra2;
    }

    /**
     * Get palavra2
     *
     * @return string 
     */
    public function getPalavra2()  {
        return $this->palavra2;
    }

    /**
     * Set palavra3
     *
     * @param string $palavra3
     */
    public function setPalavra3($palavra3)   {
        $this->palavra3 = $palavra3;
    }

    /**
     * Get palavra3
     *
     * @return string 
     */
    public function getPalavra3()  {
        return $this->palavra3;
    }

    /**
     * Set apoiadores
     *
     * @param string $apoiadores
     */
    public function setApoiadores($apoiadores)  {
        $this->apoiadores = $apoiadores;
    }

    /**
     * Get apoiadores
     *
     * @return string 
     */
    public function getApoiadores()  {
        return $this->apoiadores;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)  {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()  {
        return $this->status;
    }

    /**
     * Set nivel
     *
     * @param integer $nivel
     */
    public function setNivel($nivel)  {
        $this->nivel = $nivel;
    }

    /**
     * Get nivel
     *
     * @return integer 
     */
    public function getNivel()  {
        return $this->nivel;
    }

    /**
     * Set seqSessao
     *
     * @param integer $seqSessao
     */
    public function setSeqSessao($seqSessao)   {
        $this->seqSessao = $seqSessao;
    }

    /**
     * Get seqSessao
     *
     * @return integer 
     */
    public function getSeqSessao()  {
        return $this->seqSessao;
    }

    /**
     * Set nota
     *
     * @param float $nota
     */
    public function setNota($nota)   {
        $this->nota = $nota;
    }

    /**
     * Get nota
     *
     * @return float 
     */
    public function getNota()   {
        return $this->nota;
    }

    /**
     * Set premiado
     *
     * @param integer $premiado
    */
    public function setPremiado($premiado)   {
        $this->premiado = $premiado;
    }

    /**
     * Get premiado
     *
     * @return integer 
     */
    public function getPremiado()   {
        return $this->premiado;
    }

    /**
     * Set fkSessao
     *
     * @param Sessao $sessao
     */
    public function setSessao(Sessao $sessao = null)  {
        $this->sessao = $sessao;
    }

    /**
     * Get fkSessao
     *
     * @return Sessao 
     */
    public function getSessao()   {
        return $this->sessao;
    }

    /**
     * @return string
     */
    public function getTurno1()   {
        return $this->turno1;
    }

    /**
     * @param string $turno1
     */
    public function setTurno1($turno1)  {
        $this->turno1 = $turno1;
    }

    /**
     * @return string
     */
    public function getTurno2()  {
        return $this->turno2;
    }

    /**
     * @param string $turno2
     */
    public function setTurno2($turno2) {
        $this->turno2 = $turno2;
    }

    /**
     * @return string
     */
    public function getTurno3() {
        return $this->turno3;
    }

    /**
     * @param string $turno3
     */
    public function setTurno3($turno3)  {
        $this->turno3 = $turno3;
    }
    
}
