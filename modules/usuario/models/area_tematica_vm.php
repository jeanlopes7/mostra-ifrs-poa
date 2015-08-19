<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_tematica_vm extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    private $id_area = 0;
    private $nome = '';

    /**
     * @return int
     */
    public function getIdArea()
    {
        return $this->id_area;
    }

    /**
     * @param int $id_area
     */
    public function setIdArea($id_area)
    {
        $this->id_area = $id_area;
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