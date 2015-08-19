<?php
/**
* Model that represents Instituicao at database
**/
class Instituicao_vm extends CI_Model{
	/**
	* Model Fields	
	**/
    private $id_instituicao;
    var $nome;
    var $sigla;
    var $cidade;
    var $estado;
    var $site;
    var $tipo;

	/**
	* Default Constructor
	**/
	public function __construct(){
		parent::__construct();
	}
    /**
    * Populate model based on POST method
    **/
    public function populate(){
        $this->id_instituicao = $this->input->post('id_instituicao');
        $this->nome = $this->input->post('nome');
        $this->sigla = $this->input->post('sigla');
        $this->cidade = $this->input->post('cidade');
        $this->estado = $this->input->post('estado');
        $this->site = $this->input->post('site');
        $this->tipo = $this->input->post('tipo');

	}
    /**
    * Validates fields that can not be blank
    **/
	public function validate(){
        if($this->nome == '') return false;
        if($this->sigla == '') return false;
        if($this->cidade == '') return false;
        if($this->estado == '') return false;
        if($this->site == '') return false;
        if($this->tipo == '') return false;

        return true;
	}

    /**
     * @return mixed
     */
    public function getIdInstituicao()
    {
        return $this->id_instituicao;
    }

    /**
     * @param mixed $id_instituicao
     */
    public function setIdInstituicao($id_instituicao)
    {
        $this->id_instituicao = $id_instituicao;
    }

    /**
     * @return mixed
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param mixed $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
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

}

