<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }
 
/**
 * Classe de acesso a dados da entidade categoria
 */
class Categoria_dao {
    private $CI;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;
    const REPOSITORY = 'Entity\Categoria';
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        
        $this->em =& $this->CI->doctrine->em;
    }

    public function list_categories(){
        
        try {
            $categories = $this->em->getRepository('categoria')->findAll();
            
            return $categories;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::list_categories ');
        }
        
        return false;
    }
    
    public function find_one_by($categoria_id) {
        
        try {
            
            $categoria = $this->em->getRepository(Categoria_dao::REPOSITORY)
                    ->findOneBy(array('id_categoria' => $categoria_id));
            return $categoria;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::find_one_by ');
        }
        return null;
    }
    
    public function insert(Entity\Categoria $categoria) {
        
        try {
            
            $this->em->persist($categoria);
            
            return true;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::insert ');
        }
        
        return false;
    }
    
    public function update(Entity\Categoria $categoria) {
        
        try {
            $this->em->merge($categoria);
            
            return true;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::update ');
        }
        
        return false;
    }
    
    public function find_by($id) {
        
        try {
            $categoria = $this->em->find('categoria', $id);
            
            return $categoria;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::find_by ');
        }
        
        return false;
    }
    
    public function delete($id) {
        
        try {
            
            $categoria = $this->find_by($id);
            
            $this->em->remove($categoria);
            
            return true;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - categoria_dao::delete ');
        }
        
        return false;
    }
}

