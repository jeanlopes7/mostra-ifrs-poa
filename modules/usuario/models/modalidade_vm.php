<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modalidade_vm extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    private $id_modalidade = 0;
    private $nome = '';

    /**
     * @return int
     */
    public function getIdModalidade()
    {
        return $this->id_modalidade;
    }

    /**
     * @param int $id_modalidade
     */
    public function setIdModalidade($id_modalidade)
    {
        $this->id_modalidade = $id_modalidade;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}