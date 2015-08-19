<?php

namespace Entity;


/**
 * Class AvaliadorSessao
 * @package Entity
 * @Entity
 * @Table(name="avaliador_sessao")
 */
class AvaliadorSessao {


    /**
     * @Id
     * @ManyToOne(targetEntity="Avaliador")
     * @JoinColumn(name="fk_avaliador", referencedColumnName="fk_usuario")
     */
    private $avaliador;

    /**
     * @Id
     * @ManyToOne(targetEntity="Sessao")
     * @JoinColumn(name="fk_sessao", referencedColumnName="id_sessao")
     */
    private $sessao;

    /**
     * @var integer
     * @Column(type="integer", name="seq", nullable=false)
     */
    private $sequencia;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     * 1 = ok, 2 = deleted
     */
    private $status;

    /**
     * @return mixed
     */
    public function getSessao()
    {
        return $this->sessao;
    }

    /**
     * @param mixed $sessao
     */
    public function setSessao($sessao)
    {
        $this->sessao = $sessao;
    }

    /**
     * @return mixed
     */
    public function getAvaliador()
    {
        return $this->avaliador;
    }

    /**
     * @param mixed $avaliador
     */
    public function setAvaliador($avaliador)
    {
        $this->avaliador = $avaliador;
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