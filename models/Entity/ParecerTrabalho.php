<?php

namespace Entity;

/**
 * ParecerTrabalho
 * @Package="Entity"
 * @Entity
 * @Table(name="parecer_trabalho")
 */
class ParecerTrabalho
{
    /**
     * @var DateTime
     * @Column(type="datetime", nullable=false)
     */
    private $datahora;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    private $status;

    /**
     * @var integer
     * @Column(type="integer", nullable=false, name="status_introducao")
     */
    private $statusIntroducao;

    /**
     * @var integer
     * @Column(type="integer", nullable=false, name="status_objetivos")
     */
    private $statusObjetivos;

    /**
     * @var integer
     * @Column(type="integer", nullable=false, name="status_metodologia")
     */
    private $statusMetodologia;

    /**
     * @var integer
     * @Column(type="integer", nullable=false, name="status_resultados")
     */
    private $statusResultados;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $observacoes;

    /**
     * @var string
     * @Column(name="observacoes_internas", nullable=true, type="string")
     */
    private $observacoesInternas;

    /**
     * @var integer
     * @Column(type="integer", nullable=true, name="autor_ciente")
     */
    private $autorCiente;

    /**
     * @var string
     * @Column(name="obs_introducao", type="string", nullable=true)
     */
    private $obsIntroducao;

    /**
     * @var string
     * @Column(name="obs_objetivos", type="string", nullable=true)
     */
    private $obsObjetivos;

    /**
     * @var string
     * @Column(name="obs_metodologia", type="string", nullable=true)
     */
    private $obsMetodologia;

    /**
     * @var string
     * @Column(name="obs_resultados", type="string", nullable=true)
     */
    private $obsResultados;

    /**
     * @var integer
     * @Id
     * @Column(name="seq", type="integer", nullable=false)
     */
    private $sequencia;

    /**
     * @var Trabalho
     * @Id
     * @ManyToOne(targetEntity="Trabalho")
     * @JoinColumn(name="fk_trabalho", referencedColumnName="id_trabalho")
     */
    private $trabalho;

    /**
     * @var Revisor
     * @Id
     * @ManyToOne(targetEntity="Revisor")
     * @JoinColumn(name="fk_revisor", referencedColumnName="fk_usuario")
     */
    private $revisor;


    /**
     * Set datahora
     *
     * @param DateTime $datahora
     * @return ParecerTrabalho
     */
    public function setDatahora($datahora)
    {
        $this->datahora = $datahora;

        return $this;
    }

    /**
     * Get datahora
     *
     * @return DateTime 
     */
    public function getDatahora()
    {
        return $this->datahora;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ParecerTrabalho
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
     * Set statusIntroducao
     *
     * @param integer $statusIntroducao
     * @return ParecerTrabalho
     */
    public function setStatusIntroducao($statusIntroducao)
    {
        $this->statusIntroducao = $statusIntroducao;

        return $this;
    }

    /**
     * Get statusIntroducao
     *
     * @return integer 
     */
    public function getStatusIntroducao()
    {
        return $this->statusIntroducao;
    }

    /**
     * Set statusObjetivos
     *
     * @param integer $statusObjetivos
     * @return ParecerTrabalho
     */
    public function setStatusObjetivos($statusObjetivos)
    {
        $this->statusObjetivos = $statusObjetivos;

        return $this;
    }

    /**
     * Get statusObjetivos
     *
     * @return integer 
     */
    public function getStatusObjetivos()
    {
        return $this->statusObjetivos;
    }

    /**
     * Set statusMetodologia
     *
     * @param integer $statusMetodologia
     * @return ParecerTrabalho
     */
    public function setStatusMetodologia($statusMetodologia)
    {
        $this->statusMetodologia = $statusMetodologia;

        return $this;
    }

    /**
     * Get statusMetodologia
     *
     * @return integer 
     */
    public function getStatusMetodologia()
    {
        return $this->statusMetodologia;
    }

    /**
     * Set statusResultados
     *
     * @param integer $statusResultados
     * @return ParecerTrabalho
     */
    public function setStatusResultados($statusResultados)
    {
        $this->statusResultados = $statusResultados;

        return $this;
    }

    /**
     * Get statusResultados
     *
     * @return integer 
     */
    public function getStatusResultados()
    {
        return $this->statusResultados;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return ParecerTrabalho
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string 
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set observacoesInternas
     *
     * @param string $observacoesInternas
     * @return ParecerTrabalho
     */
    public function setObservacoesInternas($observacoesInternas)
    {
        $this->observacoesInternas = $observacoesInternas;

        return $this;
    }

    /**
     * Get observacoesInternas
     *
     * @return string 
     */
    public function getObservacoesInternas()
    {
        return $this->observacoesInternas;
    }

    /**
     * Set autorCiente
     *
     * @param integer $autorCiente
     * @return ParecerTrabalho
     */
    public function setAutorCiente($autorCiente)
    {
        $this->autorCiente = $autorCiente;

        return $this;
    }

    /**
     * Get autorCiente
     *
     * @return integer 
     */
    public function getAutorCiente()
    {
        return $this->autorCiente;
    }

    /**
     * Set obsIntroducao
     *
     * @param string $obsIntroducao
     * @return ParecerTrabalho
     */
    public function setObsIntroducao($obsIntroducao)
    {
        $this->obsIntroducao = $obsIntroducao;

        return $this;
    }

    /**
     * Get obsIntroducao
     *
     * @return string 
     */
    public function getObsIntroducao()
    {
        return $this->obsIntroducao;
    }

    /**
     * Set obsObjetivos
     *
     * @param string $obsObjetivos
     * @return ParecerTrabalho
     */
    public function setObsObjetivos($obsObjetivos)
    {
        $this->obsObjetivos = $obsObjetivos;

        return $this;
    }

    /**
     * Get obsObjetivos
     *
     * @return string 
     */
    public function getObsObjetivos()
    {
        return $this->obsObjetivos;
    }

    /**
     * Set obsMetodologia
     *
     * @param string $obsMetodologia
     * @return ParecerTrabalho
     */
    public function setObsMetodologia($obsMetodologia)
    {
        $this->obsMetodologia = $obsMetodologia;

        return $this;
    }

    /**
     * Get obsMetodologia
     *
     * @return string 
     */
    public function getObsMetodologia()
    {
        return $this->obsMetodologia;
    }

    /**
     * Set obsResultados
     *
     * @param string $obsResultados
     * @return ParecerTrabalho
     */
    public function setObsResultados($obsResultados)
    {
        $this->obsResultados = $obsResultados;

        return $this;
    }

    /**
     * Get obsResultados
     *
     * @return string 
     */
    public function getObsResultados()
    {
        return $this->obsResultados;
    }

    /**
     * Set seq
     *
     * @param integer $seq
     * @return ParecerTrabalho
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;

        return $this;
    }

    /**
     * Get seq
     *
     * @return integer 
     */
    public function getSeq()
    {
        return $this->sequencia;
    }

    /**
     * Set fkTrabalho
     *
     * @param Trabalho $fkTrabalho
     * @return ParecerTrabalho
     */
    public function setFkTrabalho(Trabalho $fkTrabalho)
    {
        $this->trabalho = $fkTrabalho;

        return $this;
    }

    /**
     * Get fkTrabalho
     *
     * @return Trabalho 
     */
    public function getTrabalho()
    {
        return $this->trabalho;
    }

    /**
     * Set revisor
     *
     * @param Revisor $revisor
     * @return ParecerTrabalho
     */
    public function setFkRevisor(Revisor $revisor = null)
    {
        $this->revisor = $revisor;

        return $this;
    }

    /**
     * Get fkRevisor
     *
     * @return Revisor 
     */
    public function getRevisor()
    {
        return $this->revisor;
    }
}
