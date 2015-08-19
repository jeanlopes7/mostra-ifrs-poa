<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

require_once "procedural/model/sql/ConnectionProperty.class.php";
require_once "procedural/model/sql/ConnectionFactory.class.php";
require_once "procedural/model/mysql/TrabalhoMySqlDAO.class.php";

/**
 * Classe controler do autor.
 */
class Autor_ctr extends MX_Controller {
    
    
    /**
     * @access private
     * @var Usuario_bo 
     */
    private $usuario_bo;
    
    /**
     * @access private
     * @var Autor_bo 
     */
    private $autor_bo;
    
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
     *
     * @var Curso_bo 
     */
    private $curso_bo;
    /**
     * @access private
     * @var Autor_inscricao_vm 
     */
    private $autor_inscricao_vm;
    
    function __construct() {
        parent::__construct();
        
        $this->autor_inscricao_vm = $this->load->model('autor_inscricao_vm');
        $this->usuario_bo = $this->load->library('bo/usuario_bo');
        $this->autor_bo = $this->load->library('bo/autor_bo');
        $this->instituicao_bo = $this->load->library('bo/instituicao_bo');
        $this->campus_bo = $this->load->library('bo/campus_bo');
        $this->curso_bo = $this->load->library('bo/curso_bo');
        $this->load->helper('string_func');
    }
    
    public function index() {

      $user = $this->usuario_bo->getUserSession();
      $id_usuario = $user['id'];

      //Passar a lista dos trabalhos que o usuario faz parte.
      $trabalho_dao = new TrabalhoMySqlDAO();
      $trabalhos = $trabalho_dao->queryTrabalhosByAutor($id_usuario);

      $data['trabalhos']= $trabalhos;
      
      $this->load->view('autor/area_autor.html.php', $data);
    }

    private function inscricao_falha() {

            $data['instituicao_list'] = $this->instituicao_bo->list_all();
            $data['autor'] = $this->autor_inscricao_vm;
            $data['cpf'] = $this->autor_inscricao_vm->getCpf();
            $data['is_registered'] = FALSE;
            redirect(base_url().'usuario/autor_ctr/inscricao/'. $data['cpf']);
    }

    /**
     * Realiza a inscrição
     * @return null
     */
    public function fazer_inscricao() {
        
        $data = $this->input->post();
        $this->autor_inscricao_vm->setCpf($data['cpf']);
        $this->autor_inscricao_vm->setNome($data['nome']);
        $this->autor_inscricao_vm->setEmail($data['email']);
        $this->autor_inscricao_vm->setSenha($data['senha']);
        
        $this->autor_inscricao_vm->setInstituicao($data['instituicao']);
        $this->autor_inscricao_vm->setCampus($data['campus']);
        $this->autor_inscricao_vm->setCurso($data['curso']);
        
        if (comparar_email_confirmacao($data)) {
            $this->session->set_flashdata('aviso', 'Os e-mails não conferem');
            $this->inscricao_falha();
        }

        if (comparar_senha_confirmacao($data)) {
            $this->session->set_flashdata('aviso', 'As senhas não conferem');
            $this->inscricao_falha();
            return;
        }
        
        $autor = $this->autor_inscricao_vm->load_autor();
        $usuario = $this->autor_inscricao_vm->load_user();
        
        if (array_key_exists('senha', $data))
        {
            
            $id_autor = $this->autor_bo->cadastrar_autor($autor, $usuario, 
                    $this->autor_inscricao_vm->getCurso());
            if ($id_autor){   
                $this->usuario_bo->setUserSession($id_autor);
                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/autor_ctr');
            }
            else {
                $this->session->set_flashdata('erro', 'Aconteceu algum erro. O usuário não foi cadastrado!');
                
            }
        }
        redirect(base_url().'usuario/autor_ctr/inscricao/'. $data['cpf']);
    }

    /**
     * redireciona para view de inscrição
     * @param null $cpf_param o cpf
     */
    public function inscricao($cpf_param = NULL) {
        $cpf = valida_cpf($cpf_param);
        $user_logged = $this->usuario_bo->getUserSession();
        if ($user_logged) {

            $isAutor = $this->autor_bo->isCurrentUserAutor();
            
            if ($isAutor) {
                $this->session->set_flashdata('aviso', 'Usuario já cadastrado como autor');
                redirect(base_url().'usuario/autor_ctr');
            }
            else {
                redirect(base_url().'usuario/autor_ctr/inscricao_incremental');
            }
        }
        else if($cpf != null) {
            if ($cpf == false)
            {
                $this->session->set_flashdata('erro', 'O CPF informado é inválido');
                redirect(base_url().'home/home_ctr');
            }
            else {
                $this->autor_inscricao_vm->setCpf($cpf);
                $data['autor'] = $this->autor_inscricao_vm;
                $data['is_registered'] = FALSE;
                $data['cpf'] = $this->autor_inscricao_vm->getCpf();
                $data['instituicao_list'] = $this->instituicao_bo->list_all();
                $this->load->view('autor/inscricao_autor.html.php', $data);
            }
        }
        else {
            $this->session->set_flashdata('erro', 'O link de inscrição não pode ser acessado sem informar o CPF');
            redirect(base_url().'home/home_ctr');
        }
        
    }
    
    
    /*renderiza form inscricao incremental*/
    
    public function inscricao_incremental()
    {
        if ($this->autor_bo->isCurrentUserAutor())
        {
            $this->session->set_flashdata('aviso', 'Usuario já cadastrado como autor');
            redirect( base_url() . './usuario/usuario_ctr');
        }
        
        if ($this->input->post() != false) {

            $curso_id = $this->input->post('curso');
            $id_autor = $this->autor_bo->fazerCadastroIncremental($curso_id);

            if ($id_autor) {

                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/autor_ctr');
            }

        } else {

            $data['is_registered'] = false;
            $data['instituicao_list'] = $this->instituicao_bo->list_all();

            $this->load->view('../views/autor/inscricao_incremental_autor.html.php', $data);
        }
        
    }

    public function find_autores_by_name($name) {

        $autores = $this->autor_bo->findAutoresByName($name);

        echo $autores;
    }
    
}