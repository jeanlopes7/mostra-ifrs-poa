<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * AvaliadorArea Model
 * @Entity
 * @Table(name="avaliador_area")
 */
class AvaliadorArea
{


    /**
     * @Id
     * @ManyToOne(targetEntity="Area")
     * @JoinColumn(name="fk_area", referencedColumnName="id_area")
     */
    private $area;

    /**
     * @Id
     * @ManyToOne(targetEntity="Avaliador")
     * @JoinColumn(name="fk_avaliador", referencedColumnName="fk_usuario")
     */
    private $avaliador;


    /**
     * Set fkArea
     *
     * @param integer $areas
     * @return AvaliadorArea
     */
    public function setArea(Area $area)
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
     * Set fkAvaliador
     *
     * @param integer $avaliador
     * @return AvaliadorArea
     */
    public function setAvaliador(Avaliador $avaliador)
    {
        $this->avaliador = $avaliador;
        return $this;
    }

    /**
     * Get fkAvaliador
     *
     * @return integer 
     */
    public function getAvaliador()
    {
        return $this->avaliador;
    }

    

}
