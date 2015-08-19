<?php

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
/**
 * Campus
 * @Entity
 * @Table(name="campus")
 */
class Campus implements JsonSerializable
{
    /**
     * @Column(type="string", nullable=false)
     */
    private $nome;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $cidade;

    /**
     * @Id
     * @Column(type="integer", nullable=false, name="id_campus")
     * @GeneratedValue(strategy="AUTO")
     */
    private $idCampus;

    /**
     * @ManyToOne(targetEntity="Instituicao", inversedBy="campus")
     * @JoinColumn(name="fk_instituicao", referencedColumnName="id_instituicao", nullable=false)
     **/
    private $instituicao;

    /**
     * @OneToMany(targetEntity="Curso", mappedBy="curso")
     */
    private $cursos;

        /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursos = new ArrayCollection;
        $this->fkOrientador = new ArrayCollection;
        $this->orientadores = new ArrayCollection;
    }

    
    public function get_cursos() {
        return $this->cursos;
    }

    public function set_cursos($cursos) {
        $this->cursos = $cursos;
        return $this;
    }
    
    /**
     * Set nome
     *
     * @param string $nome
     * @return Campus
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     * @return Campus
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Get idCampus
     *
     * @return integer 
     */
    public function getIdCampus()
    {
        return $this->idCampus;
    }

    /**
     * Set fkInstituicao
     *
     * @param Instituicao $instituicao
     * @return Campus
     */
    public function setInstituicao(Instituicao $instituicao = null)
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * Get fkInstituicao
     *
     * @return Instituicao 
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Add fkOrientador
     *
     * @param Orientador $orientador
     * @return Campus
     */
    public function addOrientador(Orientador $orientador)
    {
        $this->orientador[] = $orientador;

        return $this;
    }

    /**
     * Remove orientador
     *
     * @param Orientador $orientador
     */
    public function removeOrientador(Orientador $orientador)
    {
        $this->orientador->removeElement($orientador);
    }

    /**
     * Get fkOrientador
     *
     * @return DoctrineCommonCollectionsCollection 
     */
    public function getOrientador()
    {
        return $this->orientador;
    }

    /**
     * Adiciona uma instituição à lista
     * @param Instituicao $instituicao
     */
    public function addInstituicao(Instituicao $instituicao) {

        $this->instituicao[] = $instituicao;
    }

    /**
     * @return mixed
     */
    public function getOrientadores()
    {
        return $this->orientadores;
    }

    /**
     * @param mixed $orientadores
     */
    public function setOrientadores($orientadores)
    {
        $this->orientadores = $orientadores;
    }

    public function jsonSerialize() {
        
        return array(
            'id_campus' => $this->idCampus,
            'instituicao' => $this->getInstituicao(),
            'nome' => $this->nome,
            'cidade' => $this->cidade
        );
    }

}
