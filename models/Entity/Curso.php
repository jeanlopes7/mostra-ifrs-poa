<?php

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/**
 * Curso
 * @Entity
 * @Table(name="curso")
 */
class Curso implements JsonSerializable
{
    /**
     * @var string
     * @Column(type="string", length=100)
     */
    private $nome;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $nivel;

    /**
     * @Id
     * @Column(type="integer", nullable=false, name="id_curso")
     * @GeneratedValue(strategy="AUTO")
     */
    private $idCurso;

    /**
     * @OneToOne(targetEntity="Campus", inversedBy="curso")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus", nullable=false)
     **/
    private $campus;

    /**
     * @OneToMany(targetEntity="Autor", mappedBy="curso")
     */
    private $autores;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->autores = new ArrayCollection;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Curso
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
     * Set nivel
     *
     * @param integer $nivel
     * @return Curso
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
     * Get idCurso
     *
     * @return integer 
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     *
     * @param Campus $campus
     */
    public function setCampus(Campus $campus)
    {
        $this->campus = $campus;
    }

    /**
     * Get fkCampus
     *
     * @return Campus 
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * Add autor
     *
     * @param Autor $autor
     * @return Curso
     */
    public function addAutores(Autor $autor)
    {
        $this->autores[] = $autor;

        return $this;
    }

    /**
     * Remove autor
     *
     * @param Autor $autor
     */
    public function removeAutores(Autor $autor)
    {
        $this->autores->removeElement($autor);
    }

    /**
     * Get autor
     *
     * @return DoctrineCommonCollectionsCollection 
     */
    public function getAutores()
    {
        return $this->autores;
    }

    public function jsonSerialize() {
        
        return array(
            'id_curso' => $this->getIdCurso(),
            'campus' => $this->getCampus(),
            'nome' => $this->getNome(),
            'nivel' => $this->getNivel()
        );
    }

}
