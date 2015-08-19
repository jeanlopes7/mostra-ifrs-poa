<?php


namespace Entity;
use JsonSerializable;

/**
 * Ouvinte
 * @Entity
 * @Table(name="ouvinte")
 */
class Ouvinte implements JsonSerializable
{

    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="ouvinte")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    private $usuario;

    /**
     * @ManyToOne(targetEntity="Instituicao", inversedBy="campus")
     * @JoinColumn(name="fk_instituicao", referencedColumnName="id_instituicao")
     **/
    private $instituicao;

    /**
     * @var Campus
     * @ManyToOne(targetEntity="Campus")
     * @JoinColumn(name="fk_campus", referencedColumnName="id_campus")
     */
    private $campus;

    /**
     * @var Curso
     * @ManyToOne(targetEntity="Curso")
     * @JoinColumn(name="fk_curso", referencedColumnName="id_curso")
     */
    private $curso;

    /**
     * @var integer
     * @Column(name="tipo_ouvinte", nullable=false, type="integer", options={"default": 4})
     */
    private $tipoOuvinte;

    /**
     * @var string
     * @Column(nullable=true, type="string")
     */
    private $outro;

    /**
     * @var string
     * @Column(nullable=true, type="string")
     */
    private $empresa;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $status;

    public function setStatus($status) {

        $this->status = $status;
        return $this;
    }

    public function getStatus() {

        return $this->status;
    }

    /**
     * Set tipoOuvinte
     *
     * @param integer $tipoOuvinte
     * @return Ouvinte
     */
    public function setTipoOuvinte($tipoOuvinte)
    {
        $this->tipoOuvinte = $tipoOuvinte;

        return $this;
    }

    /**
     * Get tipoOuvinte
     *
     * @return integer 
     */
    public function getTipoOuvinte()
    {
        return $this->tipoOuvinte;
    }

    /**
     * Set outro
     *
     * @param string $outro
     * @return Ouvinte
     */
    public function setOutro($outro)
    {
        $this->outro = $outro;

        return $this;
    }

    /**
     * Get outro
     *
     * @return string 
     */
    public function getOutro()
    {
        return $this->outro;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Ouvinte
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set fkUsuario
     *
     * @param Usuario $usuario
     * @return Ouvinte
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

    /**
     * Set fkInstituicao
     *
     * @param Instituicao $instituicao
     * @return Ouvinte
     */
    public function setInstituicao(Instituicao $instituicao = null)
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * Get fkInstituicao
     *
     * @return Instituicao 
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Set fkCurso
     *
     * @param Curso $curso
     * @return Ouvinte
     */
    public function setCurso(Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get fkCurso
     *
     * @return Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set fkCampus
     *
     * @param Campus $campus
     * @return Ouvinte
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
                     "instituicao" => $this->getInstituicao(),
                     "campus" => $this->getCampus(),
                     "curso" => $this->getCurso(),
                     "tipo_ouvinte" => $this->getTipoOuvinte(),
                     "outro" => $this->getOutro(),
                     "empresa" => $this->getEmpresa());
    }

}
