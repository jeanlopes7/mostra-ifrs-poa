<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Avaliador_vm extends CI_Model {

    /**
     * o cadastro de pessoa física
     * @access private
     * @var string
     */
    private $cpf;

    /**
     * o nome do avaliador
     * @access private
     * @var string
     */
    private $nome;

    /**
     * o e-mail do avaliador
     * @access private
     * @var string
     */
    private $email;

    /**
     * a senha do avaliador
     * @access private
     * @var string
     */
    private $senha;

    /**
     * tipo de avaliador: docente, técnico administrativo ou estudante de pós graduação
     * @access private
     * @var int
     */
    private $tipoServidor;

    /**
     * campus do avaliador
     * @access private
     * @var int
     */
    private $campus;

    /**
     * tipo de formação acadêmica: 1- superior, 2 - especialização, 3 - mestrado, 4 - doutorado
     * @access private
     * @var int
     */
    private $formacao;

    /**
     * área temática que deseja ser avaliador
     * @access private
     * @var int
     */
    private $areaTematica;

    /**
     * status da comissão avaliadora sob a inscrição do avaliador: pendente, aceito ou recusado
     * @var int
     */
    private $status;

    public function __construct() {
        parent::__construct();
    }

    public function populate() {

        $this->set_cpf($this->input->post('cpf'));
        $this->set_email($this->input->post('email'));
        $this->set_nome($this->input->post('nome'));
        $this->set_senha($this->input->post('senha'));
        $this->set_campus($this->input->post('campus'));
        $this->set_formacao($this->input->post('formacao'));
        $this->set_areaTematica($this->input->post('area_tematica'));
        $this->set_tipoServidor($this->input->post('tipo_servidor'));
    }

    public function validate() {

        // TODO: melhorar essa validação
        if (strlen($this->get_cpf()) < 11) {
            error_log('problema cpf');
            error_log(json_encode($this->get_cpf()));
            return false;
        }
        if (strlen($this->get_nome()) < 4) {
            error_log('problema nome');
            return false;
        }
        if (strlen($this->get_email()) < 5) {
            error_log('problema email');
            return false;
        }
        if (strlen($this->get_senha()) < 3) {
            error_log('problema senha');
            return false;
        }
<<<<<<< HEAD
        /*
         * Não funciona em versão menor que 5.5 e no PC local Win XP não existe XAMPP 5.5.
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        if (empty($this->get_tipoServidor())) {
            error_log('problema tipoAvaliador');
            return false;
        }
        if (empty($this->get_areaTematica())) {
            error_log('problema area');
            return false;
        }

        if (empty($this->get_campus())) {
            error_log('problema campus');
            return false;
        }

<<<<<<< HEAD
*/
=======
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e

        return true;
    }

    public function loadUsuario() {
        
        $usuario = new \Entity\Usuario();
        
        $usuario->setCpf($this->get_cpf());
        $usuario->setEmail($this->get_email());
        $usuario->setNome($this->get_nome());
        $usuario->setSenha($this->get_senha());

        return $usuario;
    }

    public function loadAvaliador() {
        
        $avaliador = new \Entity\Avaliador();
        
        $avaliador->setTipoServidor($this->get_tipoServidor());
        $avaliador->setFormacao($this->get_formacao());

        return $avaliador;
    }
    
    public function get_campus() {
        return $this->campus;
    }

    public function get_formacao() {
        return $this->formacao;
    }

    public function set_campus($campus) {
        $this->campus = $campus;
        return $this;
    }

    public function set_formacao($formacao) {
        $this->formacao = $formacao;
        return $this;
    }

        
    public function get_cpf() {
        return $this->cpf;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_senha() {
        return $this->senha;
    }

    public function get_tipoServidor() {
        return $this->tipoServidor;
    }

    public function get_areaTematica() {
        return $this->areaTematica;
    }

    public function get_status() {
        return $this->status;
    }

    public function set_cpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function set_nome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function set_email($email) {
        $this->email = $email;
        return $this;
    }

    public function set_senha($senha) {
        $this->senha = $senha;
        return $this;
    }

    public function set_tipoServidor($tipoServidor) {
        $this->tipoServidor = $tipoServidor;
        return $this;
    }

    public function set_areaTematica($areaTematica) {
        $this->areaTematica = $areaTematica;
        return $this;
    }

    public function set_status($status) {
        $this->status = $status;
        return $this;
    }

}

/* End of file avaliador_vm.php */
<<<<<<< HEAD
/* Location: ./application/models/avaliador_vm.php */
=======
/* Location: ./application/models/avaliador_vm.php */
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
