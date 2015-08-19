<?php

namespace Entity;
use JsonSerializable;
/**
 * Revisor Model
 * @Entity
 * @Table(name="revisor")
 */
class Revisor implements JsonSerializable
{
    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="revisor")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    private $usuario;

    /**
     * @ManyToOne(targetEntity="Campus")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus", nullable=false)
     */
    private $campus;


    /**
     * Set fkUsuario
     *
     * @param Usuario $usuario
     * @return Revisor
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get Usuario
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
     * @param Campus $campus
     * @return Revisor
     */
    public function setCampus(Campus $campus = null)
    {
        $this->campus = $campus;

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

    public function jsonSerialize() {
        
        return array("usuario" => $this->getUsuario(),
                     "campus" => $this->getCampus());
    }

}
