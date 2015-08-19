<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_vm extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    private $id_categoria = 0;
    private $nome = '';

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

    /**
     * @return int
     */
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    /**
     * @param int $id_categoria
     */
    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
}