<?php

namespace Entity;
use JsonSerializable;

/**
 * Voluntario
 * @Entity
 * @Table(name="voluntario")
 */
class Voluntario implements JsonSerializable
{
    
    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="voluntario")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    private $usuario;
    
     /**
     * @OneToOne(targetEntity="Curso", inversedBy="voluntario")
<<<<<<< HEAD
     * @JoinColumn(name="fk_curso", referencedColumnName="id_curso")
=======
     * @JoinColumn(name="fk_curso", referencedColumnName="id_curso", nullable=false)
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
     **/
    private $curso;
    
    // , nullable=false,
    // 0 = pendente, 1 = aceito, 2 = removido
    /**
     * @var integer
     * @Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     * @Column(type="string", length = 200, nullable=true)
     */
    private $observacoes;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=false)
     */
    private $manha;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=false)
     */
    private $tarde;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=false)
     */
    private $noite;

    /**
     * @var string
     * @Column(type="string", length=12)
     */
    private $telefone1;

    /**
     * @var string
     * @Column(type="string", length=12, nullable=true)
     */
    private $telefone2;

    /**
     * @var string
     * @Column(type="string", length=12, nullable=true)
     */
    private $telefone3;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $presenca;



    /**
     * Set status
     *
     * @param integer $status
     * @return Voluntario
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
     * Set observacoes
     *
     * @param string $observacoes
     * @return Voluntario
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
     * Set manha
     *
     * @param string $manha
     * @return Voluntario
     */
    public function setManha($manha)
    {
        $this->manha = $manha;

        return $this;
    }

    /**
     * Get manha
     *
     * @return string 
     */
    public function getManha()
    {
        return $this->manha;
    }

    /**
     * Set tarde
     *
     * @param string $tarde
     * @return Voluntario
     */
    public function setTarde($tarde)
    {
        $this->tarde = $tarde;

        return $this;
    }

    /**
     * Get tarde
     *
     * @return string 
     */
    public function getTarde()
    {
        return $this->tarde;
    }

    /**
     * Set noite
     *
     * @param string $noite
     * @return Voluntario
     */
    public function setNoite($noite)
    {
        $this->noite = $noite;

        return $this;
    }

    /**
     * Get noite
     *
     * @return string 
     */
    public function getNoite()
    {
        return $this->noite;
    }

    /**
     * Set telefone1
     *
     * @param string $telefone1
     * @return Voluntario
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Get telefone1
     *
     * @return string 
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Set telefone2
     *
     * @param string $telefone2
     * @return Voluntario
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Get telefone2
     *
     * @return string 
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Set telefone3
     *
     * @param string $telefone3
     * @return Voluntario
     */
    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;

        return $this;
    }

    /**
     * Get telefone3
     *
     * @return string 
     */
    public function getTelefone3()
    {
        return $this->telefone3;
    }

    /**
     * Set presenca
     *
     * @param integer $presenca
     * @return Voluntario
     */
    public function setPresenca($presenca)
    {
        $this->presenca = $presenca;

        return $this;
    }

    /**
     * Get presenca
     *
     * @return integer 
     */
    public function getPresenca()
    {
        return $this->presenca;
    }


    /**
     * @return Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param Curso $curso
     */
    public function setCurso(Curso $curso)
    {
        $this->curso = $curso;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function jsonSerialize() {
        
        return array("usuario" => $this->getUsuario(),
                    "curso" => $this->getCurso(),
                    "observacoes" => $this->getObservacoes(),
                    "manha" => $this->getManha(),
                    "tarde" => $this->getTarde(),
                    "noite" => $this->getNoite(),
                    "telefone1" => $this->getTelefone1(),
                    "telefone2" => $this->getTelefone2(),
                    "telefone3" => $this->getTelefone3(),
                    "presenca" => $this->getPresenca(),
                    "status" => $this->getStatus());
    }

}
