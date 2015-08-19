<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 */
class Log
{
    /**
     * @var string
     */
    private $tabela;

    /**
     * @var string
     */
    private $acao;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var integer
     */
    private $idLog;

    /**
     * @var \Usuario
     */
    private $fkUsuario;


    /**
     * Set tabela
     *
     * @param string $tabela
     * @return Log
     */
    public function setTabela($tabela)
    {
        $this->tabela = $tabela;

        return $this;
    }

    /**
     * Get tabela
     *
     * @return string 
     */
    public function getTabela()
    {
        return $this->tabela;
    }

    /**
     * Set acao
     *
     * @param string $acao
     * @return Log
     */
    public function setAcao($acao)
    {
        $this->acao = $acao;

        return $this;
    }

    /**
     * Get acao
     *
     * @return string 
     */
    public function getAcao()
    {
        return $this->acao;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Log
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Get idLog
     *
     * @return integer 
     */
    public function getIdLog()
    {
        return $this->idLog;
    }

    /**
     * Set fkUsuario
     *
     * @param \Usuario $fkUsuario
     * @return Log
     */
    public function setFkUsuario(\Usuario $fkUsuario = null)
    {
        $this->fkUsuario = $fkUsuario;

        return $this;
    }

    /**
     * Get fkUsuario
     *
     * @return \Usuario 
     */
    public function getFkUsuario()
    {
        return $this->fkUsuario;
    }
}
