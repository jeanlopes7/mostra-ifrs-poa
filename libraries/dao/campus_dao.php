<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }


/**
 * @property \Doctrine\ORM\EntityManager $em Database
 */
class Campus_dao {
    
    private $CI;
    private $em;
    const REPOSITORY = 'Entity\Campus';
    
    function __construct() {

        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em = $this->CI->doctrine->em;
    }
    
    public function findAllByInstituicao($id) {

        try {
            
            $campus_list = $this->em->getRepository('Entity\Campus')->findBy(array('instituicao' => $id));
            
            return $campus_list;
        } catch (Exception $ex) {
            
            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::findAllByInstituicao ');
        }
        return false;
    }

    public function findAll() {

        try {
            $campus_list = $this->em->getRepository('Entity\Campus')->findAll();
            return $campus_list;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao:findAll ');
        }
        return null;
    }
    
    public function find_one_by($campus_id) {
        try {
            $campus = $this->em->getRepository(Campus_dao::REPOSITORY)
                    ->findOneBy(array('idCampus' => $campus_id));
            return $campus;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::find_one_by ');
        }   
        return null;
    }
    
    public function find_all_by($campus_id) {
        
        try {
            $all_campus = $this->em->find('Entity\Campus', $campus_id);
            
            return $all_campus;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::find_all_by ');
        }
        return null;
    }

    public function insert(Entity\Campus $campus)
    {

        try {
            

            $instituicao = $this->em->find('Entity\Instituicao', 
                    $campus->getInstituicao()->getIdInstituicao());

            if ($instituicao != null) {
                $campus->setInstituicao($instituicao);
            }
            
            $this->em->persist($campus);
            $this->em->flush();

            return $campus->getIdCampus();
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::insert ');
        }
    }

    public function update(Entity\Campus $campus)
    {
        try {
            $this->em->merge($campus);
            $this->em->flush();

        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::update ');
        }
    }

    public function delete($id)
    {
        try {
            $campus = $this->em->find('Entity\Campus', $id);
            
            if ($campus != null) {
                $this->em->remove($campus);
                $this->em->flush();
            }
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - campus_dao::delete ');
        }

    }
}

