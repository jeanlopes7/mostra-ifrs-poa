<?php

namespace Entity;

/**
 * Sessao Model
 * @Entity
 * @Table(name="sessao")
 */
class Sessao
{
    /**
     * @var integer
     * @Column(type="integer")
     */
    private $numero;

    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $sala;

    /**
     * @var string
     * @Column(type="string", name="nome_sala")
     */
    private $nomeSala;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $andar;

    /**
     * @var string
     * @Column(type="string", name="nome_andar")
     */
    private $nomeAndar;

    /**
     * @var DateTime
     * @Column(type="date", name="data")
     */
    private $data;

    /**
     * @var DateTime
     * @Column(type="time", name="hora_ini")
     */
    private $horaIni;

    /**
     * @var DateTime
     * @Column(type="time", name="hora_fim")
     */
    private $horaFim;

    /**
     * @var integer
     * @Column(type="integer", name="status")
     */
    private $status;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_sessao", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idSessao;

    /**
     * @var Modalidade
     * @ManyToOne(targetEntity="Modalidade")
     * @JoinColumn(name="fk_modalidade", referencedColumnName="id_modalidade", nullable=false)
     */
    private $modalidade;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fkAvaliador = new DoctrineCommonCollectionsArrayCollection();
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Sessao
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Sessao
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
     * Set sala
     *
     * @param integer $sala
     * @return Sessao
     */
    public function setSala($sala)
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * Get sala
     *
     * @return integer 
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set nomeSala
     *
     * @param string $nomeSala
     * @return Sessao
     */
    public function setNomeSala($nomeSala)
    {
        $this->nomeSala = $nomeSala;

        return $this;
    }

    /**
     * Get nomeSala
     *
     * @return string 
     */
    public function getNomeSala()
    {
        return $this->nomeSala;
    }

    /**
     * Set andar
     *
     * @param integer $andar
     * @return Sessao
     */
    public function setAndar($andar)
    {
        $this->andar = $andar;

        return $this;
    }

    /**
     * Get andar
     *
     * @return integer 
     */
    public function getAndar()
    {
        return $this->andar;
    }

    /**
     * Set nomeAndar
     *
     * @param string $nomeAndar
     * @return Sessao
     */
    public function setNomeAndar($nomeAndar)
    {
        $this->nomeAndar = $nomeAndar;

        return $this;
    }

    /**
     * Get nomeAndar
     *
     * @return string 
     */
    public function getNomeAndar()
    {
        return $this->nomeAndar;
    }

    /**
     * Set data
     *
     * @param DateTime $data
     * @return Sessao
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set horaIni
     *
     * @param DateTime $horaIni
     * @return Sessao
     */
    public function setHoraIni($horaIni)
    {
        $this->horaIni = $horaIni;

        return $this;
    }

    /**
     * Get horaIni
     *
     * @return DateTime 
     */
    public function getHoraIni()
    {
        return $this->horaIni;
    }

    /**
     * Set horaFim
     *
     * @param DateTime $horaFim
     * @return Sessao
     */
    public function setHoraFim($horaFim)
    {
        $this->horaFim = $horaFim;

        return $this;
    }

    /**
     * Get horaFim
     *
     * @return DateTime 
     */
    public function getHoraFim()
    {
        return $this->horaFim;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Sessao
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
     * Get idSessao
     *
     * @return integer 
     */
    public function getIdSessao()
    {
        return $this->idSessao;
    }

    /**
     * Set fkModalidade
     *
     * @param Modalidade $fkModalidade
     * @return Sessao
     */
    public function setModalidade(Modalidade $fkModalidade = null)
    {
        $this->modalidade = $fkModalidade;

        return $this;
    }

    /**
     * Get fkModalidade
     *
     * @return Modalidade 
     */
    public function getModalidade()
    {
        return $this->modalidade;
    }

    /**
     * Add fkAvaliador
     *
     * @param Avaliador $fkAvaliador
     * @return Sessao
     */
    public function addAvaliador(Avaliador $fkAvaliador)
    {
        $this->avaliador[] = $fkAvaliador;

        return $this;
    }

    /**
     * Remove fkAvaliador
     *
     * @param Avaliador $fkAvaliador
     */
    public function removeAvaliador(Avaliador $fkAvaliador)
    {
        $this->avaliador->removeElement($fkAvaliador);
    }

    /**
     * Get fkAvaliador
     *
     * @return DoctrineCommonCollectionsCollection 
     */
    public function getAvaliador()
    {
        return $this->avaliador;
    }
}
