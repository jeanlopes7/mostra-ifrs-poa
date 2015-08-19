<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voluntario_ctr extends MX_Controller {


	/**
	 * business object voluntario
	 * @access private
	 * @var Voluntario_bo
	 */
	private $voluntario_bo;

	/**
	 * business object usuario
	 * @access private
	 * @var Usuario_bo
	 */
	private $usuario_bo;


	/**
	 * ViewModel de inscrição do ouvinte
	 * @access private
	 * @var Voluntario_inscricao_vm
	 */
	private $voluntario_inscricao_vm;

	/**
	 * ViewModel de inscrição 
	 * incremental de voluntario
	 * @access private
	 * @var Voluntario_insc_incr_vm
	 */
	private $voluntario_insc_incr_vm;
	
	public function __construct()
	{
		parent::__construct();
		$this->voluntario_bo = $this->load->library('bo/voluntario_bo');
		$this->usuario_bo = $this->load->library('bo/usuario_bo');
		$this->instituicao_bo = $this->load->library('bo/instituicao_bo');

		$this->voluntario_inscricao_vm = $this->load->model('voluntario_inscricao_vm');
		$this->voluntario_insc_incr_vm = $this->load->model('voluntario_insc_incr_vm');

		$this->load->helper('string_func');
	}

	public function index()
	{
		$this->load->view('voluntario/area_voluntario.html.php');
	}

	/**
	 * Carrega o view de inscrição
	 * @param  string $cpf_param cadastro de pessoa física do voluntario
	 * @return void 
	 */
	public function inscricao($cpf_param = null) {

		$cpf = valida_cpf($cpf_param);
		$user_logged = $this->usuario_bo->getUserSession();
        if ($user_logged) {

            $isVoluntario = $this->voluntario_bo->isCurrentUserVoluntario();
            
            if ($isVoluntario) {
                $this->session->set_flashdata('aviso', 'Usuario já cadastrado como voluntario');
                redirect(base_url().'usuario/voluntario_ctr');
            }
            else {
                redirect(base_url().'usuario/voluntario_ctr/inscricao_incremental');
            }
        }
        else if($cpf != null) {
            if ($cpf == false)
            {
                $this->session->set_flashdata('erro', 'O CPF informado é inválido');
                redirect(base_url().'home/home_ctr');
            }
            else {
                $this->voluntario_inscricao_vm->setCpf($cpf);
                $data['voluntario'] = $this->voluntario_inscricao_vm;
                $data['is_registered'] = FALSE;
                $data['cpf'] = $this->voluntario_inscricao_vm->getCpf();
                $data['instituicao_list'] = $this->instituicao_bo->list_all();
                $this->load->view('voluntario/inscricao_voluntario.html.php', $data);
            }
        }
        else {
            $this->session->set_flashdata('erro', 'O link de inscrição não pode ser acessado sem informar o CPF');
            redirect(base_url().'home/home_ctr');
        }

	}

	private function inscricao_falha() {

            $data['instituicao_list'] = $this->instituicao_bo->list_all();
            if ($this->voluntario_inscricao_vm) {
                $data['voluntario'] = $this->voluntario_inscricao_vm;
                $data['cpf'] = $this->voluntario_inscricao_vm->getCpf();
            }
            if ($this->voluntario_insc_incr_vm) {
                $data['voluntario'] = $this->voluntario_insc_incr_vm;
            }
            
            $data['is_registered'] = FALSE;
            redirect(base_url().'usuario/voluntario_ctr/inscricao/'. $data['cpf']);
            return;
    }

	public function fazer_inscricao() {

		$this->voluntario_inscricao_vm->populate();

		try {

			$this->voluntario_inscricao_vm->validate();

            $voluntario = $this->voluntario_inscricao_vm->loadVoluntario();
            $usuario = $this->voluntario_inscricao_vm->loadUsuario();

            $curso_id = $this->voluntario_inscricao_vm->getCurso();

            $voluntario_id = $this->voluntario_bo->cadastrarVoluntario($voluntario, $usuario, $curso_id);
			
		} catch (Exception $ex) {
			$this->session->set_flashdata('erro', $ex->getMessage());
            $this->inscricao_falha();
		}
		

		if ($voluntario_id){
            $this->usuario_bo->setUserSession($voluntario_id);
            $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
            redirect(base_url() . './usuario/voluntario_ctr');
        }
        else {
            $this->session->set_flashdata('erro', 'Aconteceu algum erro. O usuário não foi cadastrado!');
        }
	}


	public function inscricao_incremental()
	{
		if ($this->voluntario_bo->isCurrentUserVoluntario())
		{
            $this->session->set_flashdata('aviso', 'Usuario já cadastrado como voluntário');
            redirect( base_url() . './usuario/usuario_ctr');
        }

        if ($this->input->post() != false) {

            $this->voluntario_insc_incr_vm->populate();

        	try {

        		$this->voluntario_insc_incr_vm->validate();

                $curso_id = $this->voluntario_insc_incr_vm->getCurso();
                $voluntario = $this->voluntario_insc_incr_vm->loadVoluntario();
            
                $id_voluntario = $this->voluntario_bo->fazerCadastroIncremental($voluntario, $curso_id);
        		
        	} catch (Exception $ex) {
        		
        		$this->session->set_flashdata('erro', $ex->getMessage());
            	$this->inscricao_falha();
        	}
        	

        	if ($id_voluntario) {
                
                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/voluntario_ctr');
            }

        } else {
        	
        	$data['is_registered'] = false;
        	$data['instituicao_list'] = $this->instituicao_bo->list_all();

        	$this->load->view('../views/voluntario/inscricao_incremental_voluntario.html.php', $data);
        }
	}


}

/* End of file voluntario_ctr.php */
/* Location: ./application/controllers/voluntario_ctr.php */