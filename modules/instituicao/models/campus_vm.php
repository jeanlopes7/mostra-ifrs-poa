<?php

class Campus_vm extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
    }

    private $id_campus;
    private $nome;
    private $cidade;
    private $fk_instituicao;

    /**
     * Populate model based on POST method
     **/
    public function populate()
    {
        $this->id_campus = $this->input->post('id_campus');
        $this->nome = $this->input->post('nome');
        $this->cidade = $this->input->post('cidade');
        $this->fk_instituicao = $this->input->post('instituicao');
    }

    /**
     * Validates fields that can not be blank
     **/
    public function validate()
    {
        if ($this->nome == '') return false;
        if ($this->cidade == '') return false;
        if ($this->fk_instituicao == 0) return false;
        return true;
    }

    /**
     * @return mixed
     */
    public function getIdCampus()
    {
        return $this->id_campus;
    }

    /**
     * @param mixed $id_campus
     */
    public function setIdCampus($id_campus)
    {
        $this->id_campus = $id_campus;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getInstituicao()
    {
        return $this->fk_instituicao;
    }

    /**
     * @param mixed $fk_instituicao
     */
    public function setInstituicao($fk_instituicao)
    {
        $this->fk_instituicao = $fk_instituicao;
    }
}
