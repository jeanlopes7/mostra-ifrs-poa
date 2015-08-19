<?php

namespace Entity;

/**
 * TrabalhoOrientadorCampus
 * @Package="Entity"
 * @Table(name="trabalho_orientador_campus")
 * @Entity
 */
class TrabalhoOrientadorCampus {
  
  //GAMBIARRA Alexdg
  public $fk_trabalho;
  public $fk_orientador;
  public $fk_campus;

    /**
     * @var integer
     * @Column(name="seq", type="integer", nullable=false)
     */
    private $sequencia;

    /**
     * @var string
     * @Column(name="email_trabalho", nullable=false, type="string")
     */
    private $emailTrabalho;

    /**
     * @var Trabalho
     * @Id
     * @ManyToOne(targetEntity="Trabalho")
     * @JoinColumn(name="fk_trabalho", referencedColumnName="id_trabalho")
     */
    private $trabalho;

    /**
     * @Id
     * @ManyToOne(targetEntity="Orientador")
     * @JoinColumn(name="fk_orientador", referencedColumnName="fk_usuario")
     */
    private $orientador;

    /**
     * @var Campus
     * @Id
     * @ManyToOne(targetEntity="Campus")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus")
     */
    private $campus;

    /**
     * Set emailTrabalho
     *
     * @param string $emailTrabalho
     * @return TrabalhoOrientadorCampus
     */
    public function setEmailTrabalho($emailTrabalho)
    {
        $this->emailTrabalho = $emailTrabalho;

        return $this;
    }

    /**
     * Get emailTrabalho
     *
     * @return string 
     */
    public function getEmailTrabalho()
    {
        return $this->emailTrabalho;
    }

    /**
     * @return int
     */
    public function getSequencia()
    {
        return $this->sequencia;
    }

    /**
     * @param int $sequencia
     */
    public function setSequencia($sequencia)
    {
        $this->sequencia = $sequencia;
    }

    /**
     * @return Trabalho
     */
    public function getTrabalho()
    {
        return $this->trabalho;
    }

    /**
     * @param Trabalho $trabalho
     */
    public function setTrabalho($trabalho)
    {
        $this->trabalho = $trabalho;
    }

    /**
     * @return OrientadorCampus
     */
    public function getOrientador()
    {
        return $this->orientador;
    }

    /**
     * @param OrientadorCampus $orientador
     */
    public function setOrientador($orientador)
    {
        $this->orientador = $orientador;
    }

    /**
     * @return Campus
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param Campus $campus
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
    }

    /********************************************************
     * GAMBIARRA Alexdg
     ********************************************************/

    function getFk_trabalho() {
      return $this->fk_trabalho;
    }
     function getFk_orientador() {
      return $this->fk_orientador;
    }
     function getFk_campus() {
      return $this->fk_campus;
    }

    function setFk_trabalho($fk_trabalho) {
      $this->fk_trabalho = $fk_trabalho;
    }
     function setFk_orientador($fk_orientador) {
      $this->fk_orientador = $fk_orientador;
    }
     function setFk_campus($fk_campus) {
      $this->fk_campus = $fk_campus;
    }

    
}
