<?php

namespace Entity;


/**
 * Modalidade Model
 * @Entity
 * @Table(name="modalidade")
 */
class Modalidade
{
    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_modalidade", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idModalidade=0;

    /**
     * Set nome
     *
     * @param string $nome
     * @return Modalidade
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
     * Get idModalidade
     *
     * @return integer 
     */
    public function getIdModalidade()
    {
        return $this->idModalidade;
    }
}
