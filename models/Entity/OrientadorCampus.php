<?php

namespace Entity;

//Acho que não precisa isto (Alex).
//use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class OrientadorCampus
 * @package Entity
 * @Entity
 * @Table(name="orientador_campus")
 */
class OrientadorCampus {

    /**
     * @var integer
     * @Id
     * @ManyToOne(targetEntity="Orientador")
     * @JoinColumn(name="fk_orientador", referencedColumnName="fk_usuario")
     */
    private $orientador;
    
    /**
     * @Id
     * @ManyToOne(targetEntity="Campus")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus")
     */
    private $campus;
    
    /**
     * @var integer
     * @Column(type="integer", name="seq", nullable=false)
     */
    private $seq;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     * 1 = ok, 2 = deleted
     */
    private $status;

    /**
     * @return mixed
     */
    public function getOrientador()
    {
        return $this->orientador;
    }

    /**
     * @param mixed $orientador
     */
    public function setOrientador(Orientador $orientador)
    {
        $this->orientador = $orientador;
    }

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus(Campus $campus)
    {
        $this->campus = $campus;
    }
    
    /**
     * @return int
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param int $sequencia
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}