<?php

namespace Entity;

/**
 * Trabalho
 * @Package="Trabalho"
 * @Entity
 * @Table(name="trabalho")
 */
class Trabalho
{
  //GAMBIARRA Alexdg.
  public $fk_area;
  public $fk_modalidade;
  public $fk_categoria;
  public $fk_sessao;
  
    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    private $nivel;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $titulo;

    /**
     * @var string
     * @Column(name="titulo_ordenar", type="string", nullable=true)
     */
    private $tituloOrdenar;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $palavra1;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $palavra2;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $palavra3;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $apoiadores;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $resumo;

    /**
     * @var string
     * @Column(type="string")
     */
    private $resumo2;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    private $status;

    /**
     * @var DateTime
     * @Column(type="datetime", nullable=true, name="data_cadastro")
     */
    private $dataCadastro;

    /**
     * @var DateTime
     * @Column(type="datetime", nullable=true, name="data_atualizacao")
     */
    private $dataAtualizacao;

    /**
     * @var string
     * @Column(name="ip_cadastro", nullable=true, type="string")
     */
    private $ipCadastro;

    /**
     * @var string
     * @Column(name="ip_atualizacao", nullable=true, type="string")
     */
    private $ipAtualizacao;

    /**
     * @var integer
     * @Column(name="seq_sessao", nullable=false, options={"default":0}, type="integer")
     * Sequencia do trabalho dentro da sessao
     */
    private $seqSessao;

    /**
     * @var float
     * @Column(type="float", nullable=true)
     * nota final do trabalho
     */
    private $nota;

    /**
     * @var integer
     * @Column(type="integer", nullable=true)
     */
    private $premiado;

    /**
     * @var integer
     * @ManyToOne(targetEntity="Area")
     * @JoinColumn(name="fk_area", referencedColumnName="id_area", nullable=false)
     */
    private $area;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_trabalho", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idTrabalho;

    /**
     * @var Sessao
     * @ManyToOne(targetEntity="Sessao")
     * @JoinColumn(name="fk_sessao", referencedColumnName="id_sessao")
     */
    private $sessao;

    /**
     * @var Modalidade
     * @ManyToOne(targetEntity="Modalidade")
     * @JoinColumn(name="fk_modalidade", referencedColumnName="id_modalidade", nullable=false)
     */
    private $modalidade;

    /**
     * @var Categoria
     * @ManyToOne(targetEntity="Categoria")
     * @JoinColumn(name="fk_categoria", referencedColumnName="id_categoria", nullable=false)
     */
    private $categoria;

    /**
     * @var string
     * @Column(type="string", nullable=false, length=1, options={"fixed"= true})
     */
    private $turno1;

    /**
     * @var string
     * @Column(type="string", nullable=false, length=1, options={"fixed"= true})
     */
    private $turno2;

    /**
     * @var string
     * @Column(type="string", nullable=false, length=1, options={"fixed"= true})
     */
    private $turno3;


    /**
     * Set nivel
     *
     * @param integer $nivel
     * @return Trabalho
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Trabalho
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
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
     * @return Trabalho
     */
    public function setTituloOrdenar($tituloOrdenar)
    {
        $this->tituloOrdenar = $tituloOrdenar;

        return $this;
    }

    /**
     * Get tituloOrdenar
     *
     * @return string 
     */
    public function getTituloOrdenar()
    {
        return $this->tituloOrdenar;
    }

    /**
     * Set palavra1
     *
     * @param string $palavra1
     * @return Trabalho
     */
    public function setPalavra1($palavra1)
    {
        $this->palavra1 = $palavra1;

        return $this;
    }

    /**
     * Get palavra1
     *
     * @return string 
     */
    public function getPalavra1()
    {
        return $this->palavra1;
    }

    /**
     * Set palavra2
     *
     * @param string $palavra2
     * @return Trabalho
     */
    public function setPalavra2($palavra2)
    {
        $this->palavra2 = $palavra2;

        return $this;
    }

    /**
     * Get palavra2
     *
     * @return string 
     */
    public function getPalavra2()
    {
        return $this->palavra2;
    }

    /**
     * Set palavra3
     *
     * @param string $palavra3
     * @return Trabalho
     */
    public function setPalavra3($palavra3)
    {
        $this->palavra3 = $palavra3;

        return $this;
    }

    /**
     * Get palavra3
     *
     * @return string 
     */
    public function getPalavra3()
    {
        return $this->palavra3;
    }

    /**
     * Set apoiadores
     *
     * @param string $apoiadores
     * @return Trabalho
     */
    public function setApoiadores($apoiadores)
    {
        $this->apoiadores = $apoiadores;

        return $this;
    }

    /**
     * Get apoiadores
     *
     * @return string 
     */
    public function getApoiadores()
    {
        return $this->apoiadores;
    }

    /**
     * Set resumo
     *
     * @param string $resumo
     * @return Trabalho
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;

        return $this;
    }

    /**
     * Get resumo
     *
     * @return string 
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * Set resumo2
     *
     * @param string $resumo2
     * @return Trabalho
     */
    public function setResumo2($resumo2)
    {
        $this->resumo2 = $resumo2;

        return $this;
    }

    /**
     * Get resumo2
     *
     * @return string 
     */
    public function getResumo2()
    {
        return $this->resumo2;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Trabalho
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dataCadastro
     *
     * @param DateTime $dataCadastro
     * @return Trabalho
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return DateTime 
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set dataAtualizacao
     *
     * @param DateTime $dataAtualizacao
     * @return Trabalho
     */
    public function setDataAtualizacao($dataAtualizacao)
    {
        $this->dataAtualizacao = $dataAtualizacao;

        return $this;
    }

    /**
     * Get dataAtualizacao
     *
     * @return DateTime 
     */
    public function getDataAtualizacao()
    {
        return $this->dataAtualizacao;
    }

    /**
     * Set ipCadastro
     *
     * @param string $ipCadastro
     * @return Trabalho
     */
    public function setIpCadastro($ipCadastro)
    {
        $this->ipCadastro = $ipCadastro;

        return $this;
    }

    /**
     * Get ipCadastro
     *
     * @return string 
     */
    public function getIpCadastro()
    {
        return $this->ipCadastro;
    }

    /**
     * Set ipAtualizacao
     *
     * @param string $ipAtualizacao
     * @return Trabalho
     */
    public function setIpAtualizacao($ipAtualizacao)
    {
        $this->ipAtualizacao = $ipAtualizacao;

        return $this;
    }

    /**
     * Get ipAtualizacao
     *
     * @return string 
     */
    public function getIpAtualizacao()
    {
        return $this->ipAtualizacao;
    }

    /**
     * Set seqSessao
     *
     * @param integer $seqSessao
     * @return Trabalho
     */
    public function setSeqSessao($seqSessao)
    {
        $this->seqSessao = $seqSessao;

        return $this;
    }

    /**
     * Get seqSessao
     *
     * @return integer 
     */
    public function getSeqSessao()
    {
        return $this->seqSessao;
    }

    /**
     * Set nota
     *
     * @param float $nota
     * @return Trabalho
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return float 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set premiado
     *
     * @param integer $premiado
     * @return Trabalho
     */
    public function setPremiado($premiado)
    {
        $this->premiado = $premiado;

        return $this;
    }

    /**
     * Get premiado
     *
     * @return integer 
     */
    public function getPremiado()
    {
        return $this->premiado;
    }

    /**
     * Set fkArea
     *
     * @param integer $area
     * @return Trabalho
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get fkArea
     *
     * @return integer 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Get idTrabalho
     *
     * @return integer 
     */
    public function getIdTrabalho()
    {
        return $this->idTrabalho;
    }

    /**
     * Set idTrabalho
     *
     * @param integer $id_trabalho
     * @return Trabalho
     */
    public function setIdTrabalho(integer $id_trabalho)
    {
        $this->idTrabalho = $id_trabalho;

        return $this;
    }

    /**
     * Set fkSessao
     *
     * @param Sessao $sessao
     * @return Trabalho
     */
    public function setSessao(Sessao $sessao = null)
    {
        $this->sessao = $sessao;

        return $this;
    }

    /**
     * Get fkSessao
     *
     * @return Sessao 
     */
    public function getSessao()
    {
        return $this->sessao;
    }

    /**
     * Set modalidade
     *
     * @param Modalidade $modalidade
     * @return Trabalho
     */
    public function setModalidade(Modalidade $modalidade = null)
    {
        $this->modalidade = $modalidade;

        return $this;
    }

    /**
     * Get fkModalidade
     *
     * @return Modalidade 
     */
    public function getModalidade()
    {
        return $this->modalidade;
    }

    /**
     * Set categoria
     *
     * @param Categoria $categoria
     * @return Trabalho
     */
    public function setCategoria(Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get fkCategoria
     *
     * @return Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @return string
     */
    public function getTurno1()
    {
        return $this->turno1;
    }

    /**
     * @param string $turno1
     */
    public function setTurno1($turno1)
    {
        $this->turno1 = $turno1;
    }

    /**
     * @return string
     */
    public function getTurno2()
    {
        return $this->turno2;
    }

    /**
     * @param string $turno2
     */
    public function setTurno2($turno2)
    {
        $this->turno2 = $turno2;
    }

    /**
     * @return string
     */
    public function getTurno3()
    {
        return $this->turno3;
    }

    /**
     * @param string $turno3
     */
    public function setTurno3($turno3)
    {
        $this->turno3 = $turno3;
    }
    
    
    /********************************************************
     * GAMBIARRA Alexdg
     ********************************************************/
    
    
    /**
     * @return integer
     */
    public function getFkArea()
    {
        return $this->fk_area;
    }
    
    /**
     * @return integer
     */
    public function getFkCategoria()
    {
        return $this->fk_categoria;
    }
    
    /**
     * @return integer
     */
    public function getFkModalidade()
    {
        return $this->fk_modalidade;
    }

    /**
     * @return integer
     */
    public function getFkSessao()
    {
        return $this->fk_sessao;
    }
    
}
