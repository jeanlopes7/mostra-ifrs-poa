<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouvinte_ctr extends MX_Controller {


	/**
	 * business object ouvinte
	 * @access private
	 * @var Ouvinte_bo
	 */
	private $ouvinte_bo;

	/**
	 * business object usuario
	 * @access private
	 * @var Usuario_bo
	 */
	private $usuario_bo;

	/**
	 * business object instituicao_bo
	 * @access private
	 * @var Instituicao_bo
	 */
	private $instituicao_bo;


	/**
	 * ViewModel de inscrição do ouvinte
	 * @access private
	 * @var Ouvinte_inscricao_vm
	 */
	private $ouvinte_inscricao_vm;

	/**
	 * ViewModel de inscrição 
	 * incremental de ouvinte
	 * @access private
	 * @var Ouvinte_insc_incr_vm
	 */
	private $ouvinte_insc_incr_vm;
	
	public function __construct()
	{
		parent::__construct();
		$this->ouvinte_bo = $this->load->library('bo/ouvinte_bo');
		$this->usuario_bo = $this->load->library('bo/usuario_bo');
		$this->instituicao_bo = $this->load->library('bo/instituicao_bo');

		$this->ouvinte_inscricao_vm = $this->load->model('ouvinte_inscricao_vm');
		$this->ouvinte_insc_incr_vm = $this->load->model('ouvinte_insc_incr_vm');

		$this->load->helper('string_func');
	}

	public function index()
	{
		$this->load->view('ouvinte/area_ouvinte.html.php');
	}

	/**
	 * Carrega o view de inscrição
	 * @param  string $cpf_param cadastro de pessoa física do ouvinte
	 * @return void 
	 */
	public function inscricao($cpf_param = null) {

		$cpf = valida_cpf($cpf_param);
		$user_logged = $this->usuario_bo->getUserSession();
        if ($user_logged) {

            $isOuvinte = $this->ouvinte_bo->isCurrentUserOuvinte();
            
            if ($isOuvinte) {
                $this->session->set_flashdata('aviso', 'Usuario já cadastrado como ouvinte');
                redirect(base_url().'usuario/ouvinte_ctr');
            }
            else {
                redirect(base_url().'usuario/ouvinte_ctr/inscricao_incremental');
            }
        }
        else if($cpf != null) {
            if ($cpf == false)
            {
                $this->session->set_flashdata('erro', 'O CPF informado é inválido');
                redirect(base_url().'home/home_ctr');
            }
            else {
                $this->ouvinte_inscricao_vm->setCpf($cpf);
                $data['ouvinte'] = $this->ouvinte_inscricao_vm;
                $data['is_registered'] = FALSE;
                $data['cpf'] = $this->ouvinte_inscricao_vm->getCpf();
                $data['instituicao_list'] = $this->instituicao_bo->list_all();
                $this->load->view('ouvinte/inscricao_ouvinte.html.php', $data);
            }
        }
        else {
            $this->session->set_flashdata('erro', 'O link de inscrição não pode ser acessado sem informar o CPF');
            redirect(base_url().'home/home_ctr');
        }

	}

	private function inscricao_falha() {

            $data['instituicao_list'] = $this->instituicao_bo->list_all();
            if ($this->ouvinte_inscricao_vm) {
            	$data['ouvinte'] = $this->ouvinte_inscricao_vm;
            	$data['cpf'] = $this->ouvinte_inscricao_vm->getCpf();
            }
            if ($this->ouvinte_insc_incr_vm) {
				$data['ouvinte'] = $this->ouvinte_insc_incr_vm;            	
            }
            $data['is_registered'] = FALSE;
            redirect(base_url().'usuario/ouvinte_ctr/inscricao/'. $data['cpf']);
            return;
    }

	public function fazer_inscricao() {

		$this->ouvinte_inscricao_vm->populate();

		try {
			$this->ouvinte_inscricao_vm->validate();

			$ouvinte = $this->ouvinte_inscricao_vm->loadOuvinte();
			$usuario = $this->ouvinte_inscricao_vm->loadUsuario();

			$instituicao_id = $this->ouvinte_inscricao_vm->getInstituicao();
			$campus_id = $this->ouvinte_inscricao_vm->getCampus();
			$curso_id = $this->ouvinte_inscricao_vm->getCurso();

			$id_ouvinte = $this->ouvinte_bo->cadastrarOuvinte($ouvinte, $usuario, $instituicao_id, $campus_id, $curso_id);
			
		} catch (Exception $ex) {
			$this->session->set_flashdata('erro', $ex->getMessage());
            $this->inscricao_falha();
		}

		if ($id_ouvinte){   
            $this->usuario_bo->setUserSession($id_ouvinte);
            $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
            redirect(base_url() . './usuario/ouvinte_ctr');
        }
        else {
            $this->session->set_flashdata('erro', 'Aconteceu algum erro. O usuário não foi cadastrado!');
        }
	}


	public function inscricao_incremental()
	{
		if ($this->ouvinte_bo->isCurrrentUserOuvinte())
		{
            $this->session->set_flashdata('aviso', 'Usuario já cadastrado como ouvinte');
            redirect( base_url() . './usuario/usuario_ctr');
        }

        if ($this->input->post() != false) {

        	$this->ouvinte_insc_incr_vm->populate();

        	try {

        		$this->ouvinte_insc_incr_vm->validate();

        		$instituicao_id = $this->ouvinte_insc_incr_vm->getInstituicao();
        		$campus_id = $this->ouvinte_insc_incr_vm->getCampus();
        		$curso_id = $this->ouvinte_insc_incr_vm->getCurso();

        		$ouvinte = $this->ouvinte_insc_incr_vm->loadOuvinte();

        		$id_ouvinte = $this->ouvinte_bo->fazerCadastroIncremental($ouvinte, $instituicao_id, $campus_id, $curso_id);
        		
        	} catch (Exception $ex) {
        		
        		$this->session->set_flashdata('erro', $ex->getMessage());
            	$this->inscricao_falha();
        	}
        	

        	if ($id_ouvinte) {
                
                $this->session->set_flashdata('sucesso', 'Dados cadastrados com sucesso!');
                redirect(base_url() . './usuario/ouvinte_ctr');
            }

        } else {
        	
        	$data['is_registered'] = false;
        	$data['instituicao_list'] = $this->instituicao_bo->list_all();

        	$this->load->view('../views/ouvinte/inscricao_incremental_ouvinte.html.php', $data);
        }
	}


}

/* End of file ouvinte_ctr.php */
/* Location: ./application/controllers/ouvinte_ctr.php */