<?php

namespace Entity;
use JsonSerializable;
/**
 * Organizador
 * @Entity
 * @Table(name="organizador")
 */
class Organizador implements JsonSerializable
{
    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="organizador")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    private $usuario;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    private $nivel;

    /**
     * @var integer
     * @Column(type="integer", nullable=false, options={"default": 0})
     */
    private $status;


    /**
     * Set nivel
     *
     * @param integer $nivel
     * @return Organizador
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
     * Set status
     *
     * @param integer $status
     * @return Organizador
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
     * Set usuario
     *
     * @param Usuario $usuario
     * @return Organizador
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function jsonSerialize() {
        return array("usuario" => $this->getUsuario(),
                     "nivel" => $this->getNivel(),
                     "status" => $this->getStatus());
    }

}
