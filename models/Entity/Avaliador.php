<?php

namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/**
 * Avaliador Model
 * @Entity
 * @Table(name="avaliador")
 */
class Avaliador implements JsonSerializable
{
    /**
     * @var integer
     * @Column(type="integer", name="tipo_servidor")
     */
    private $tipoServidor;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $formacao;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $status;

    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="avaliador")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    private $usuario;

    /**
     * @var Campus
     * @ManyToOne(targetEntity="Campus")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus", nullable=false)
     */
    private $campus;

    /**
     * @var DoctrineCommonCollectionsCollection
     * @OneToMany(targetEntity="Sessao", mappedBy="avaliador")
     */
    private $sessoes;

    /**
     * @var AvaliadorArea
     * @OneToMany(targetEntity="AvaliadorArea", mappedBy="areas")
     */
    private $avaliadorArea;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessoes = new ArrayCollection();
        $this->avaliadorArea = new ArrayCollection();
    }

    /**
     * Set tipoServidor
     *
     * @param integer $tipoServidor
     * @return Avaliador
     */
    public function setTipoServidor($tipoServidor)
    {
        $this->tipoServidor = $tipoServidor;

        return $this;
    }

    /**
     * Get tipoServidor
     *
     * @return integer 
     */
    public function getTipoServidor()
    {
        return $this->tipoServidor;
    }

    /**
     * Set formacao
     *
     * @param integer $formacao
     * @return Avaliador
     */
    public function setFormacao($formacao)
    {
        $this->formacao = $formacao;

        return $this;
    }

    /**
     * Get formacao
     *
     * @return integer 
     */
    public function getFormacao()
    {
        return $this->formacao;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Avaliador
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
     * Set fkUsuario
     *
     * @param Usuario $fkUsuario
     * @return Avaliador
     */
    public function setUsuario(Usuario $fkUsuario)
    {
        $this->usuario = $fkUsuario;

        return $this;
    }

    /**
     * Get fkUsuario
     *
     * @return Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fkCampus
     *
     * @param Campus $fkCampus
     * @return Avaliador
     */
    public function setCampus(Campus $fkCampus = null)
    {
        $this->campus = $fkCampus;

        return $this;
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
     * Add fkSessao
     *
     * @param Sessao $fkSessao
     * @return Avaliador
     */
    public function addSessoes(Sessao $fkSessao)
    {
        $this->sessoes[] = $fkSessao;

        return $this;
    }

    /**
     * Remove fkSessao
     *
     * @param Sessao $fkSessao
     */
    public function removeSessoes(Sessao $fkSessao)
    {
        $this->sessoes->removeElement($fkSessao);
    }

    /**
     * Get fkSessao
     *
     * @return DoctrineCommonCollectionsCollection 
     */
    public function getsessoes()
    {
        return $this->sessoes;
    }

    public function setAvaliadorArea(AvaliadorArea $avaliadorArea) {
        $this->avaliadorArea = $avaliadorArea;
    }

    public function getAvaliadorArea() {
        return $this->avaliadorArea;
    }

    public function jsonSerialize() {
        
        return array("usuario" => $this->getUsuario(),
                     "campus" => $this->getCampus(),
                     "tipo_servidor" => $this->getTipoServidor(),
                     "formacao" => $this->getFormacao(),
                     "status" => $this->getStatus());
    }

}
