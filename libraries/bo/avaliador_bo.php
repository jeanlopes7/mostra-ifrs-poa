<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

class Avaliador_bo {


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
     * @var Campus_dao
     */
    private $campus_dao;

    /**
     * @access private
     * @var Avaliador_dao
     */
    private $avaliador_dao;

    /**
     * @access private
     * @var AvaliadorArea_dao
     */
    private $avaliador_area_dao;

    /**
     * @access private
     * @var AreaTematica_dao
     */
    private $area_tematica_dao;

    /**
     * Entity Manager
     * @access private
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct() {

    	$this->CI =& get_instance();

    	$this->usuario_dao = $this->CI->load->library('dao/usuario_dao');
    	$this->campus_dao = $this->CI->load->library('dao/campus_dao');
    	$this->avaliador_area_dao = $this->CI->load->library('dao/avaliador_area_dao');
    	$this->area_tematica_dao = $this->CI->load->library('dao/area_tematica_dao');
        $this->avaliador_dao = $this->CI->load->library('dao/avaliador_dao');
        $this->usuario_bo = $this->CI->load->library('bo/usuario_bo');
    	$this->CI->load->helper('email');
        $this->em =& $this->CI->load->library('doctrine')->em;
    }

    public function fazerCadastroIncremental(\Entity\Avaliador $avaliador, $campus_id, $area_id) {
    	$this->em->beginTransaction();
        try {

            $session_user = $this->usuario_bo->getUserSession();

            $usuario = $this->usuario_bo->findUserById($session_user['id']);
            
            $avaliador_orig = $this->avaliador_dao->findAvaliadorByCPF($usuario->getCpf());
            
            if ($avaliador_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este avaliador já existe.');
                throw new Exception("Este avaliador já existe", 2);
            }

            $avaliador->setUsuario($usuario);
            $this->fazerCadastroAvaliadorAux($avaliador, $campus_id, $area_id);

            $this->em->flush();
            $this->em->refresh($usuario);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "avaliador");
            return $usuario->getIdUsuario();
            
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
        }
    }

    public function cadastrar_avaliador(\Entity\Avaliador $avaliador, \Entity\Usuario $usuario, $campus_id, $area_id)
    {
    	$this->em->getConnection()->beginTransaction();

    	try {

    		$avaliador_orig = $this->avaliador_dao->findAvaliadorByCPF($usuario->getCpf());
            
            if ($avaliador_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este avaliador já existe.');
                throw new Exception("Este avaliador já existe", 2);
            }

            // TODO: consultar CPF aqui, mover para um método abstrato no usuario_bo
            $senha = $usuario->getSenha(); $usuario->setSenha(md5($senha));
            // cadastra o usuário
            $this->usuario_dao->insert($usuario); $avaliador->setUsuario($usuario);

            $this->fazerCadastroAvaliadorAux($avaliador, $campus_id, $area_id);

            $this->em->flush();
            $this->em->refresh($usuario);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());

    		sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "avaliador");
    		return $usuario->getIdUsuario();
    	} catch (Exception $ex) {
    		$this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
    	}

    	return false;
    }

    private function fazerCadastroAvaliadorAux(\Entity\Avaliador $avaliador, $campus_id, $area_id) {

    	
    	$campus = $this->campus_dao->find_one_by($campus_id);
    	$avaliador->setCampus($campus);
    	$avaliador->setStatus(STATUS_USUARIO_PENDENTE);
    	$this->avaliador_dao->insert($avaliador);

    	$area = $this->area_tematica_dao->findOneById($area_id);

    	$avaliadorArea = new \Entity\AvaliadorArea();
    	$avaliadorArea->setArea($area);
    	$avaliadorArea->setAvaliador($avaliador);

    	$this->avaliador_area_dao->insert($avaliadorArea);

    	$this->em->getConnection()->commit();
    }

    public function isCurrentUserAvaliador() {

    	$user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        return $papeis['avaliador'] == true;
    }

}