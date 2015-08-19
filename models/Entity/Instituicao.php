<?php

namespace Entity;
use JsonSerializable;

/**
 * Instituicao
 * @Entity
 * @Table(name="instituicao")
 *
 */
class Instituicao implements JsonSerializable
{
    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var string
     * @Column(type="string")
     */
    private $sigla;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $cidade;

    /**
     * @var string
     * @Column(type="string")
     */
    private $estado;

    /**
     * @var string
     * @Column(type="string")
     */
    private $site;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $tipo;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_instituicao", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idInstituicao;

    /**
     * @OneToMany(targetEntity="Campus", mappedBy="instituicao")
     **/
    private $campus;

    /**
     * Set nome
     *
     * @param string $nome
     * @return Instituicao
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
     * Set sigla
     *
     * @param string $sigla
     * @return Instituicao
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string 
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     * @return Instituicao
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Instituicao
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return Instituicao
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Instituicao
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get idInstituicao
     *
     * @return integer 
     */
    public function getIdInstituicao()
    {
        return $this->idInstituicao;
    }

    public function jsonSerialize() {
        
        return array(
            "id_instituicao" => $this->getIdInstituicao(),
            "nome" => $this->getNome(),
            "sigla" => $this->getSigla(),
            "cidade" => $this->getCidade(),
            "estado" => $this->getEstado(), 
            "site" => $this->getSite(), 
            "tipo" => $this->getTipo()
        );
    }
}
