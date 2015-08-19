<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class Orientador_bo orientador business object
 *
 * @orientador Alex
 */
class Orientador_bo {
    
    /**
     *
     * @access private
     */
    private $CI;
    
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
     * @var Orientador_dao 
     */
    private $orientador_dao;
    
    /**
     *
     * @var Orientador_campus_dao 
     */
    private $orientador_campus_dao;
    
    /**
     *
     * @var Usuario_bo
     */
    private $usuario_bo;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;
    
    public function __construct() {
        
        $this->CI =& get_instance();
        
        $this->CI->load->library('dao/usuario_dao');
        $this->usuario_dao =& $this->CI->usuario_dao;
        $this->CI->load->library('dao/orientador_dao');
        $this->orientador_dao =& $this->CI->orientador_dao;
        $this->CI->load->library('dao/campus_dao');
        $this->campus_dao =& $this->CI->campus_dao;
        $this->CI->load->library('dao/orientador_campus_dao');
        $this->orientador_campus_dao =& $this->CI->orientador_campus_dao;
        $this->CI->load->library('bo/usuario_bo');
        $this->usuario_bo =& $this->CI->usuario_bo;
        $this->CI->load->helper('email');
        
        $this->em =& $this->CI->load->library('doctrine')->em;
    }
    
    public function cadastrar_orientador(\Entity\Orientador $orientador, \Entity\Usuario $usuario, $campus_id) {
        
        $this->em->getConnection()->beginTransaction();
        try {
            $orientador_orig = $this->orientador_dao->find_orientador_by_cpf($usuario->getCpf());
            
            if ($orientador_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este orientador já existe.');
                throw new Exception("Este orientador já existe", 2); 
            }
            
            // TODO: consultar CPF aqui, mover para um método abstrato no usuario_bo
            $senha = $usuario->getSenha();
            $usuario->setSenha(md5($senha));

            $this->usuario_dao->insert($usuario);
            $orientador->setUsuario($usuario);
            
            $this->fazerCadastroOrientadorAux($orientador, $campus_id);

            $this->em->flush();
            $this->em->refresh($orientador);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());
            
            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "orientador");
            
            return $usuario->getIdUsuario();
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage());
            $this->em->getConnection()->rollBack();
            
        }
        
        return false;
            
    }
    
    public function atualizar_orientador(Entity\Usuario $usuario) {
        
        $this->usuario_bo->atualizar_usuario($usuario);
    }
    
    public function find_orientador_by($cpf) {
        $orientador = $this->orientador_dao->find_orientador_by_cpf($cpf);
        
        return $orientador;
    }

    /**
     * adiciona o usuário já cadastrado ao papel de orientador
     * @param  int $campus_id o id do campus no banco
     * @param  int tipo_servidor 1 - Docente, 2 - Técnico administrativo
     * @return void
     */
    public function fazerCadastroIncremental($campus_id, $tipoServidor)
    {
        $this->em->beginTransaction();
        try {
            
            $session_user = $this->usuario_bo->getUserSession();

            $user = $this->usuario_bo->findUserById($session_user['id']);
            $orientador_orig = $this->orientador_dao->find_orientador_by_cpf($user->getCpf());
            
            if ($orientador_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este orientador já existe.');
                throw new Exception("Este orientador já existe", 2); 
            }

            $orientador = new Entity\Orientador();
            $orientador->setUsuario($user);
            $orientador->setTipoServidor($tipoServidor);

            $this->fazerCadastroOrientadorAux($orientador, $campus_id);

            $this->em->flush();
            $this->em->refresh($user);
            
            $this->usuario_bo->redefinirUserRegras($user->getIdUsuario());
            sendEmailAfterRecordUser($user->getCpf(), $user->getNome(), $user->getEmail(), "orientador");
            return $user->getIdUsuario();
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage());
            $this->em->getConnection()->rollBack();
        }

    }

    private function fazerCadastroOrientadorAux(Entity\Orientador $orientador, $campus_id) {
            
            $orientador->setStatus(STATUS_USUARIO_PENDENTE);
            $this->orientador_dao->insert($orientador);
            $campus = $this->campus_dao->find_one_by($campus_id);
            
            $orientador_campus = new \Entity\OrientadorCampus();
            $orientador_campus->setOrientador($orientador);
            $orientador_campus->setCampus($campus);
            
            $this->orientador_campus_dao->insert($orientador_campus);
        
            $this->em->getConnection()->commit();
    }

    /**
     * Verifica se o usuário logado no sistema é orientador
     * @return boolean true se é orientador, false se não é
     */
    public function isCurrentUserOrientador()
    {
        $user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        return $papeis['orientador'] == true;
    }

    public function findOrientadoresByName($name) {

        if (strlen($name) < 4) {
            return false;
        }

        $orientadores = $this->orientador_dao->findOrientadoresByName($name);

        $orientadores_pre_encode = array();
        foreach ($orientadores as $orientador) {
            
            $this->em->refresh($orientador);

            $orientador->getUsuario()->setCpf(null);
            $orientador->getUsuario()->setSenha(null);

            $campus = $orientador->getOrientadorCampus()->get(0)->getCampus();

            $user = new stdClass();

            $user->usuario = $orientador;
            $user->campus = $campus;

            $orientadores_pre_encode[] = $user;

        }

        return json_encode($orientadores_pre_encode);
    }
}
