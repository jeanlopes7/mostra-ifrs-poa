<?php

namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Area Model
 * @Entity
 * @Table(name="area")
 */
class Area
{
    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_area", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idArea=0;

    /**
     * @var AvaliadorArea
     * @OneToMany(targetEntity="AvaliadorArea", mappedBy="area")
     */
    private $avaliadorArea;


    /**
     * Set nome
     *
     * @param string $nome
     * @return Area
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
     * Get idArea
     *
     * @return integer 
     */
    public function getIdArea()
    {
        return $this->idArea;
    }

    public function setAvaliadorArea(AvaliadorArea $avaliadorArea) {
        $this->avaliadorArea = $avaliadorArea;
    }

    public function getAvaliadorArea() {
        return $this->avaliadorArea;
    }
}
