<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Voluntario_bo {


	/**
     *
     * @access private
     */
    private $CI;

    /**
     * @access private
     * @var Usuario_bo
     */
    private $usuario_bo;
    
    /**
     * @access private
     * @var Usuario_dao
     */
    private $usuario_dao;

    /**
     * @access private
     * @var Voluntario_dao
     */
    private $voluntario_dao;

    /**
     * @access private
     * @var Curso_dao
     */
    private $curso_dao;


    /**
     * Entity Manager
     * @access private
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct() {

    	$this->CI =& get_instance();

    	$this->usuario_dao = $this->CI->load->library('dao/usuario_dao');
    	$this->voluntario_dao = $this->CI->load->library('dao/voluntario_dao');
        $this->usuario_bo = $this->CI->load->library('bo/usuario_bo');
        $this->curso_dao = $this->CI->load->library('dao/curso_dao');
    	$this->CI->load->helper('email');
        $this->em =& $this->CI->load->library('doctrine')->em;
    }

    public function fazerCadastroIncremental(\Entity\Voluntario $voluntario, $curso_id) {
    	$this->em->beginTransaction();
        
        try {
            
            $session_user = $this->usuario_bo->getUserSession();

            $usuario = $this->usuario_bo->findUserById($session_user['id']);
            
            $voluntario_orig = $this->voluntario_dao->findVoluntarioByCPF($usuario->getCpf());
            
            if ($voluntario_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este voluntário já existe.');
                throw new Exception("Este voluntário já existe", 2);
            }
            $voluntario->setUsuario($usuario);

            $this->_fazerCadastroVoluntarioAux($voluntario, $curso_id);

            $this->em->flush();
            $this->em->refresh($voluntario);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "voluntario");
            return $usuario->getIdUsuario();
            
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
        }
    }

    public function cadastrarVoluntario(Entity\Voluntario $voluntario, Entity\Usuario $usuario, $curso_id)
    {
    	$this->em->getConnection()->beginTransaction();

    	try {

            $voluntario_orig = $this->voluntario_dao->findVoluntarioByCPF($usuario->getCpf());
            
            if ($voluntario_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este voluntário já existe.');
                throw new Exception("Este voluntário já existe", 2);
            }

            // TODO: consultar CPF aqui, mover para um método abstrato no usuario_bo
            $senha = $usuario->getSenha(); $usuario->setSenha(md5($senha));
            // cadastra o usuário
            $this->usuario_dao->insert($usuario); $voluntario->setUsuario($usuario);

            $this->_fazerCadastroVoluntarioAux($voluntario, $curso_id);

            $this->em->flush();
            $this->em->refresh($usuario);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

    		sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "voluntario");
    		return $usuario->getIdUsuario();
    	} catch (Exception $ex) {
    		$this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
    	}

    	return false;
    }

    private function _fazerCadastroVoluntarioAux(\Entity\Voluntario $voluntario, $curso_id) {
    	

        $curso = $this->curso_dao->find_one_by($curso_id);
        $voluntario->setCurso($curso);
    	$voluntario->setStatus(STATUS_USUARIO_PENDENTE);
        $voluntario->setPresenca(false);
    	$this->voluntario_dao->insert($voluntario);



    	$this->em->getConnection()->commit();
    }

    public function isCurrentUserVoluntario() {

    	$user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        return $papeis['voluntario'] == true;
    }

}
