<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

require_once "procedural/model/sql/ConnectionProperty.class.php";
require_once "procedural/model/sql/ConnectionFactory.class.php";
require_once "procedural/model/mysql/TrabalhoMySqlDAO.class.php";

/**
 * Classe controler do orientador.
 */
class Orientador_ctr extends MX_Controller {
    
    
    /**
     * @access private
     * @var Usuario_bo 
     */
    private $usuario_bo;
    
    /**
     * @access private
     * @var Orientador_bo 
     */
    private $orientador_bo;
    
    /**
     *
     * @var Instituicao_bo 
     */
    private $instituicao_bo;
    
    /**
     *
     * @var Campus_bo 
     */
    private $campus_bo;
    
    /**
     * @access private
     * @var Orientador_inscricao_vm 
     */
    private $orientador_inscricao_vm;
    
    function __construct() {
        parent::__construct();
        
        $this->orientador_inscricao_vm = $this->load->model('orientador_inscricao_vm');
        $this->usuario_bo = $this->load->library('bo/usuario_bo');
        $this->orientador_bo = $this->load->library('bo/orientador_bo');
        $this->instituicao_bo = $this->load->library('bo/instituicao_bo');
        $this->campus_bo = $this->load->library('bo/campus_bo');
        $this->load->helper('string_func');
    }
    
    public function index() {

      $user = $this->usuario_bo->getUserSession();
      $id_usuario = $user['id'];

      //Passar a lista dos trabalhos que o usuario faz parte.
      $trabalho_dao = new TrabalhoMySqlDAO();
      $trabalhos = $trabalho_dao->queryTrabalhosByOrientador($id_usuario);

      $data['trabalhos']= $trabalhos;
      
      $this->load->view('orientador/area_orientador.html.php', $data);
    }

    private function inscricao_falha() {

            $data['instituicao_list'] = $this->instituicao_bo->list_all();
            $data['orientador'] = $this->orientador_inscricao_vm;
            $data['cpf'] = $this->orientador_inscricao_vm->getCpf();
            $data['is_registered'] = FALSE;
            $this->load->view('orientador/inscricao_orientador.html.php', $data);
            return;
    }

    /**
     * Realiza a inscrição
     * @return null
     */
    public function fazer_inscricao() {
        
        $data = $this->input->post();
        $this->orientador_inscricao_vm->setCpf($data['cpf']);
        $this->orientador_inscricao_vm->setNome($data['nome']);
        $this->orientador_inscricao_vm->setEmail($data['email']);
        $this->orientador_inscricao_vm->setSenha($data['senha']);
        
        $this->orientador_inscricao_vm->setInstituicao($data['instituicao']);
        $this->orientador_inscricao_vm->setCampus($data['campus']);
        
        $this->orientador_inscricao_vm->setTipoServidor($data['tipo_servidor']);
        
        // TODO: refatorar!! Validações sempre no ViewModel

        if (comparar_email_confirmacao($data)) {
            $this->session->set_flashdata('aviso', 'Os e-mails não conferem');
            $this->inscricao_falha();
            return;
        }


        if (comparar_senha_confirmacao($data)) {
            $this->session->set_flashdata('aviso', 'As senhas não conferem');
            $this->inscricao_falha();
            return;
        }
        
        $orientador = $this->orientador_inscricao_vm->load_orientador();
        $usuario = $this->orientador_inscricao_vm->load_user();
        
        if (array_key_exists('senha', $data))
        {
            
            $id_orientador = $this->orientador_bo->cadastrar_orientador($orientador, $usuario, 
                    $this->orientador_inscricao_vm->getCampus());
            if ($id_orientador){   
                $this->usuario_bo->setUserSession($id_orientador);
                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/orientador_ctr');
            }
            else {
                $this->session->set_flashdata('erro', 'Aconteceu algum erro. O usuário não foi cadastrado!');
                
            }
        }
        
        redirect('../usuario/orientador_ctr/inscricao/' . $data['cpf']);
    }

    /**
     * redireciona para view de inscrição
     * @param null $cpf_param o cpf
     */
    public function inscricao($cpf_param = NULL) {
        $cpf = valida_cpf($cpf_param);
        $user_logged = $this->session->userdata('user');
        if ($user_logged) {

            $isOrientador = $this->orientador_bo->isCurrentUserOrientador();
            
            if ($isOrientador) {
                $this->session->set_flashdata('aviso', 'Usuario já cadastrado como orientador');
                redirect(base_url().'usuario/orientador_ctr');
            }
            else {
                redirect(base_url().'usuario/orientador_ctr/inscricao_incremental');
            }
        }
        else if($cpf != null) {
            if ($cpf == false)
            {
                $this->session->set_flashdata('erro', 'O CPF informado é inválido');
                redirect(base_url().'home/home_ctr');
            }
            else {
                $this->orientador_inscricao_vm->setCpf($cpf);
                $data['orientador'] = $this->orientador_inscricao_vm;
                $data['cpf'] = $this->orientador_inscricao_vm->getCpf();
                $data['is_registered'] = FALSE;
            }
        }
        else {
            $this->session->set_flashdata('erro', 'O link de inscrição não pode ser acessado sem informar o CPF');
            redirect(base_url().'home/home_ctr');
        }
        $data['instituicao_list'] = $this->instituicao_bo->list_all();
        
        $this->load->view('orientador/inscricao_orientador.html.php', $data);
    }
    
    public function inscricao_incremental() {
        if ($this->orientador_bo->isCurrentUserOrientador())
        {
            $this->session->set_flashdata('aviso', 'Usuario já cadastrado como orientador');
            redirect( base_url() . './usuario/usuario_ctr');
        }
        
        if ($this->input->post() != false) {

            $campus_id = $this->input->post('campus');
            $tipoServidor = $this->input->post('tipo_servidor');
            $id_orientador = $this->orientador_bo->fazerCadastroIncremental($campus_id, $tipoServidor);

            if ($id_orientador) {

                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/orientador_ctr');
            }

        } else {

            $data['is_registered'] = false;
            $data['instituicao_list'] = $this->instituicao_bo->list_all();

            $this->load->view('orientador/inscricao_incremental_orientador.html.php', $data);
        }
        
    }

    public function find_orientadores_by_name($name) {
        $orientadores = $this->orientador_bo->findOrientadoresByName($name);

        echo $orientadores;
    }
    
}