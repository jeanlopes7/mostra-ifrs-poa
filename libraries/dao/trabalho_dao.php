<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Class Usuario Dao data access layer do usuário 
 */
class Trabalho_dao {
    
    /**
     * @access private
     */
    private $CI;
    const REPOSITORY = 'Entity\Trabalho';
    
    /**
     * @access private
     * @var \Doctrine\ORM\EntityManager $em Database
     */
    private $em;   
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
        
    }

    public function find_one_by($trabalho_id) {
        try {
            
            $trabalho = $this->em->getRepository(Trabalho_dao::REPOSITORY)
                    ->findOneBy(array('idTrabalho' => $trabalho_id));
            
            return $trabalho;
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage() . ' - trabalho_dao::find_one_by ');
        }
    }
 
}

