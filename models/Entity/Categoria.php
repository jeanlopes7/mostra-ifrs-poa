<?php


namespace Entity;

/**
 * Categoria
 * @Pakage="Entity"
 * @Entity
 * @Table(name="categoria")
 */
class Categoria
{
    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $nome;

    /**
     * @var integer
     * @Id
     * @Column(type="integer", name="id_categoria", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idCategoria=0;


    /**
     * Set nome
     *
     * @param string $nome
     * @return Categoria
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
     * Get idCategoria
     *
     * @return integer 
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
}
