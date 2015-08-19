<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }
 
/**
 * Classe de acesso a dados da área temática
 */
class Area_tematica_dao {


    /**
     * Gerenciador do banco
     * @var EntityManager
     */
    private $em;

    const REPOSITORY = 'Entity\Area';
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }

    public function list_areas_tematicas(){
        throw new Exception("Metodo nao implementado!", 3);
        try {

            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - area_tematica_dao::list_areas_tematicas ');
        }
    }

    public function findOneById($area_id) {

        try {
            
            $area = $this->em->find(Area_tematica_dao::REPOSITORY, $area_id);
            
            return $area;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - area_tematica_dao::findOneById ');
        }
    }
    
    public function insert($model) {
     throw new Exception("Metodo nao implementado!", 3);
     try {
            
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - area_tematica_dao::insert ');
        }   
        
    }
    
    public function update($model) {
        throw new Exception("Metodo nao implementado!", 3);
        try {
            
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - area_tematica_dao::update ');
        }
    }
    
    public function delete($id) {
        throw new Exception("Metodo nao implementado!", 3);
        try {
            
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - area_tematica_dao::delete ');
        }
    }
}

