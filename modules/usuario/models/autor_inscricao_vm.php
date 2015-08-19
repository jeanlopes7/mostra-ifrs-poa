<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Autor_inscricao_vm extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    private $id = 0;
    private $cpf = 0;
    private $nome = '';
    private $email = '';
    private $senha = '';
    private $confirmar_senha = '';
    private $instituicao = 0;
    private $campus = 0;
    private $curso = 0;
    
    /**
     * Constrói uma nova Entity autor com base nos dados da view-model
     * @return \Entity\Autor
     */
    public function load_autor() {
        $autor = new \Entity\Autor;
        $autor->setUsuario($this->load_user());

        return $autor;
    }
    
    /**
     * Constroi uma nova Entity usuario com base nos dados da view-model
     * @return \Usuario
     */
    public function load_user() {
        $usuario = new Entity\Usuario;
        $usuario->setCpf($this->getCpf());
        $usuario->setEmail($this->getEmail());
        $usuario->setNome($this->getNome());
        $usuario->setSenha($this->getSenha());
        
        return $usuario;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param int $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
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

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getConfirmarSenha()
    {
        return $this->confirmar_senha;
    }

    /**
     * @param string $confirmar_senha
     */
    public function setConfirmarSenha($confirmar_senha)
    {
        $this->confirmar_senha = $confirmar_senha;
    }

    /**
     * @return int
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * @param int $instituicao
     */
    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;
    }

    /**
     * @return int
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param int $campus
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
    }

    /**
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param int $curso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
}

