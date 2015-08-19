<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouvinte_bo {

	/**
	 * Entity Manager
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;

	/**
     * @access private
     * @var Usuario_bo
     */
    private $usuario_bo;
    
    /**
     * objeto de acesso a dados do usuário
     * @access private
     * @var Ouvinte_dao
     */
    private $ouvinte_dao;

    /**
     * objeto de acesso a dados da instituição
     * @var Instituicao_dao
     */
    private $instituicao_dao;

    /**
     * @access private
     * @var Campus_dao
     */
    private $campus_dao;

    /**
     * objeto de acesso a dados do curso
     * 
     * @var Curso_dao
     */
    private $curso_dao;

	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->usuario_bo = $this->CI->load->library('bo/usuario_bo');
		$this->usuario_dao = $this->CI->load->library('dao/usuario_dao');
		$this->instituicao_dao = $this->CI->load->library('dao/instituicao_dao');
		$this->campus_dao = $this->CI->load->library('dao/campus_dao');
		$this->curso_dao = $this->CI->load->library('dao/curso_dao');
        $this->ouvinte_dao = $this->CI->load->library('dao/ouvinte_dao');

		$this->CI->load->helper('email');

		$this->em = $this->CI->load->library('doctrine')->em;
	}

	public function fazerCadastroIncremental(\Entity\Ouvinte $ouvinte, $instituicao_id, $campus_id, $curso_id)
	{
		$this->em->beginTransaction();
        try {
            
            $session_user = $this->usuario_bo->getUserSession();

            $usuario = $this->usuario_bo->findUserById($session_user['id']);
            
            $ouvinte_orig = $this->ouvinte_dao->findOuvinteByCPF($usuario->getCpf());
            
            if ($ouvinte_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este ouvinte já existe.');
                throw new Exception("Este ouvinte já existe", 2);
            }
            $ouvinte->setUsuario($usuario);
            $this->_fazerCadastroOuvinteAux($ouvinte, $instituicao_id, $campus_id, $curso_id);

            $this->em->flush();
            $this->em->refresh($usuario);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "ouvinte");
            return $usuario->getIdUsuario();
            
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
        }
	}

	public function cadastrarOuvinte(\Entity\Ouvinte $ouvinte, \Entity\Usuario $usuario, $instituicao_id, $campus_id, $curso_id) {

		$this->em->getConnection()->beginTransaction();

    	try {

    		$ouvinte_orig = $this->ouvinte_dao->findOuvinteByCPF($usuario->getCpf());
            
            if ($ouvinte_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este ouvinte já existe.');
                throw new Exception("Este ouvinte já existe", 2);
            }

            // TODO: consultar CPF aqui, mover para um método abstrato no usuario_bo
            $senha = $usuario->getSenha(); $usuario->setSenha(md5($senha));
            // cadastra o usuário
            $this->usuario_dao->insert($usuario); $ouvinte->setUsuario($usuario);

            $this->_fazerCadastroOuvinteAux($ouvinte, $instituicao_id, $campus_id, $curso_id);

            $this->em->flush();
            $this->em->refresh($usuario);

            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "ouvinte");
        	return $usuario->getIdUsuario();
    	} catch (Exception $ex) {
    		$this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
    	}

    	return false;

	}

	private function _fazerCadastroOuvinteAux(\Entity\Ouvinte $ouvinte, $instituicao_id, $campus_id, $curso_id) 
	{
		$instituicao = $this->instituicao_dao->find_one_by($instituicao_id);
		$campus = $this->campus_dao->find_one_by($campus_id);
		$curso = $this->curso_dao->find_one_by($curso_id);

		$ouvinte->setInstituicao($instituicao);
		$ouvinte->setCampus($campus);
		$ouvinte->setCurso($curso);
		$ouvinte->setStatus(STATUS_USUARIO_PENDENTE);


		$this->ouvinte_dao->insert($ouvinte);

		$this->em->getConnection()->commit();
	}	


	public function isCurrrentUserOuvinte() {

		$user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        return $papeis['ouvinte'] == true;
	}
}

/* End of file ouvinte_bo.php */
/* Location: ./application/models/ouvinte_bo.php */
