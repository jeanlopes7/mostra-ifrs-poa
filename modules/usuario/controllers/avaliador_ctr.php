<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaliador_ctr extends MX_Controller {


	/**
     * @access private
     * @var Usuario_bo 
     */
    private $usuario_bo;

    /**
     * business object avaliador
     * @var Avaliador_bo
     */
    private $avaliador_bo;

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
     * viewModel do avaliador
     * @var Avaliador_vm
     */
    private $avaliador_vm;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string_func');
		$this->instituicao_bo = $this->load->library('bo/instituicao_bo');
        $this->campus_bo = $this->load->library('bo/campus_bo');
        $this->curso_bo = $this->load->library('bo/curso_bo');
        $this->usuario_bo = $this->load->library('bo/usuario_bo');
        $this->avaliador_bo = $this->load->library('bo/avaliador_bo');
        $this->avaliador_vm = $this->load->model('avaliador_vm');
        $this->load->helper('string_func');
	}

	private function inscricao_falha() {

            $data['instituicao_list'] = $this->instituicao_bo->list_all();
            $data['avaliador'] = $this->avaliador_vm;
            $data['cpf'] = $this->avaliador_vm->get_cpf();
            $data['is_registered'] = FALSE;
<<<<<<< HEAD
            redirect(base_url().'usuario/avaliador_ctr/inscricao/'. $data['cpf']);
=======
            redirect(base_url().'usuario/voluntario_ctr/inscricao/'. $data['cpf']);
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
            return;
    }

	public function index()
	{
		$this->load->view('avaliador/area_avaliador.html.php');
	}

	public function inscricao($cpf_param = null)
	{
		$cpf = valida_cpf($cpf_param);
        $user_logged = $this->usuario_bo->getUserSession();
        if ($user_logged) {

            $isAvaliador = $this->avaliador_bo->isCurrentUserAvaliador();
            
            if ($isAvaliador) {
                $this->session->set_flashdata('aviso', 'Usuario já cadastrado como avaliador');
                redirect(base_url().'usuario/avaliador_ctr');
            }
            else {
                redirect(base_url().'usuario/avaliador_ctr/inscricao_incremental');
            }
        }
        else if($cpf != null) {
            if ($cpf == false)
            {
                $this->session->set_flashdata('erro', 'O CPF informado é inválido');
                redirect(base_url().'home/home_ctr');
            }
            else {
                $this->avaliador_vm->set_cpf($cpf);
                $data['avaliador'] = $this->avaliador_vm;
                $data['is_registered'] = FALSE;
                $data['cpf'] = $this->avaliador_vm->get_cpf();
                $data['instituicao_list'] = $this->instituicao_bo->list_all();
                $this->load->view('avaliador/inscricao_avaliador.html.php', $data);
            }
        }
        else {
            $this->session->set_flashdata('erro', 'O link de inscrição não pode ser acessado sem informar o CPF');
            redirect(base_url().'home/home_ctr');
        }

	}

	public function fazer_inscricao()
	{
		$data = $this->input->post();
		$this->avaliador_vm->populate();

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

        if (!$this->avaliador_vm->validate()) {
        	$this->session->set_flashdata('erro', 'Os dados não foram preenchidos corretamente');
            $this->inscricao_falha();
            return;	
        }

        $avaliador = $this->avaliador_vm->loadAvaliador();
        $usuario = $this->avaliador_vm->loadUsuario();

        $campus_id = $this->avaliador_vm->get_campus();
        $area_id = $this->avaliador_vm->get_areaTematica();

        $id_avaliador = $this->avaliador_bo->cadastrar_avaliador($avaliador, $usuario, $campus_id, $area_id);
        
        if ($id_avaliador){   
            $this->usuario_bo->setUserSession($id_avaliador);
            $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
            redirect(base_url() . './usuario/avaliador_ctr');
        }
        else {
            $this->session->set_flashdata('erro', 'Aconteceu algum erro. O usuário não foi cadastrado!');
        }


	}

	public function inscricao_incremental()
	{
		if ($this->avaliador_bo->isCurrentUserAvaliador())
        {
            $this->session->set_flashdata('aviso', 'Usuario já cadastrado como avaliador');
            redirect( base_url() . './usuario/usuario_ctr');
        }
        
        if ($this->input->post() != false) {

        	$campus_id = $this->input->post('campus');
        	$area_id = $this->input->post('area_tematica');

        	$this->avaliador_vm->set_tipoServidor($this->input->post('tipo_servidor'));
        	$this->avaliador_vm->set_formacao($this->input->post('formacao'));
            $avaliador = $this->avaliador_vm->loadAvaliador();

            $id_avaliador = $this->avaliador_bo->fazerCadastroIncremental($avaliador, $campus_id, $area_id);

            if ($id_avaliador) {
                
                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/avaliador_ctr');
            }

        } else {

            $data['is_registered'] = false;
            $data['instituicao_list'] = $this->instituicao_bo->list_all();

            $this->load->view('../views/avaliador/inscricao_incremental_avaliador.html.php', $data);
        }
	}

}

/* End of file avaliador_ctr.php */
/* Location: ./application/controllers/avaliador_ctr.php */