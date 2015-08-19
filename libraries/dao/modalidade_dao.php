<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); } 
 
/**
 * Classe de acesso a dados que controla a modalidade do trabalho
 */
class Modalidade_dao {
    
   
    private $CI;
    const REPOSITORY = 'Entity\Modalidade';
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager
     */
    private $em;
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }

    public function list_modalidades(){
        
        try {
            
            $modalidades = $this->em->getRepository('modalidade')->findAll();
            
            return $modalidades;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::list_modalidades ');
        }
        
        return false;
    }
    
    public function find_one_by($modalidade_id) {
        try {
            
            $modalidade = $this->em->getRepository(Modalidade_dao::REPOSITORY)
                    ->findOneBy($modalidade_id);
            
            return $modalidade;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::find_one_by ');
        }
        
        return null;
    }
    
    public function insert(\Entity\Modalidade $modalidade) {
        
        try {
            
            $this->em->persist($modalidade);
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::insert ');
        }
        
    }
    
    public function update(\Entity\Modalidade $modalidade) {
        
        try {
            $this->em->merge($modalidade);
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::update ');
        }
        
    }
    
    public function find_all_by($id) {
        try {
            
            $modalidade = $this->em->find('modalidade', $id);
            
            return $modalidade;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::find_all_by ' );
        }
        
        return false;
    }
    
    public function delete($id) {
     
        try {
            $modalidade = $this->find_by($id);
            $this->em->remove($modalidade);
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - modalidade_dao::delete ');
        }

    }
}

