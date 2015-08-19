<?php

namespace Entity;
use JsonSerializable;

/**
 * Orientador Model
 * @Entity
 * @Table(name="orientador")
 */
class Orientador implements JsonSerializable
{
    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="orientador")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    protected $usuario;

    /**
     * @OneToMany(targetEntity="OrientadorCampus", mappedBy="orientador")
     */
    protected $orientadorCampus;
    

    /**
     * @var integer
     * @Column(type="integer", name="tipo_servidor")
     */
    private $tipoServidor;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $status;


    /**
     * Set fkUsuario
     *
     * @param Usuario $usuario
     * @return Orientador
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

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

    public function setOrientadorCampus(OrientadorCampus $orientadorCampus)
    {
        $this->orientadorCampus = $orientadorCampus;
    }

    public function getOrientadorCampus() {

        return $this->orientadorCampus;
    }

    /**
     * Set tipoServidor
     *
     * @param integer $tipoServidor
     * @return Orientador
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
     * Set status
     *
     * @param integer $status
     * @return Orientador
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

    public function jsonSerialize() {
        
        return array("usuario" => $this->getUsuario(),
                     "tipo_servidor" => $this->getTipoServidor(),
                     "status" => $this->getStatus());
    }

}
