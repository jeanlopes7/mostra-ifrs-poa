<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }
 
/**
 * Classe de acesso a dados da área do avaliador
 */
class Avaliador_area_dao {


    /**
     * Gerenciador do banco
     * @var EntityManager
     */
    private $em;

    const REPOSITORY = 'Entity\AvaliadorArea';
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }

    
    public function insert(Entity\AvaliadorArea $avaliadorArea) {
     
     try {
            
            $this->em->persist($avaliadorArea);
            $this->em->flush();

        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() .  ' - avaliador_area_dao::insert ');
        }   
        
    }
    
    public function update($model) {
        throw new Exception("Metodo nao implementado!", 3);

        try {
            
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - avaliador_area_dao::update ');
        }
    }
    
    public function delete($id) {
        throw new Exception("Metodo nao implementado!", 3);
        
        try {
            
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - avaliador_area_dao::delete ');
        }
    }
}

