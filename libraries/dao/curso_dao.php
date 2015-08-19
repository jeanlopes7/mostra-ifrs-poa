<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');  }

/**
 * @property \Doctrine\ORM\EntityManager $em Doctrine Entity Manager ORM
 */
class Curso_dao {
    
    private $CI;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;
    const REPOSITORY = 'Entity\Curso';
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em = $this->CI->doctrine->em;
    }
    
    public function findAllByCampus($id) {
        
        try {
            
            $cursos = $this->em->getRepository(Curso_dao::REPOSITORY)
                    ->findBy(array('campus' => $id));
        
            return $cursos;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::findAllByCampus ');
        }
        
        return false;
    }

    public function findAll() {

        try {
            $cursos = $this->em->getRepository(Curso_dao::REPOSITORY)->findAll();
            return $cursos;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::findAll ');
        }
        
        return false;
        
    }
    
    public function find_one_by($curso_id) {
        
        try {
            $curso = $this->em->getRepository(Curso_dao::REPOSITORY)
                    ->findOneBy(array('idCurso' => $curso_id));
            return $curso;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::find_one_by ');
        }
        
        return false;
    }
    
    public function insert(\Entity\Curso $curso) {
        
        try {
            
            $this->em->persist($curso);
            $this->em->flush();
            return $curso->getIdCurso();
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::insert ');
        }
        
        return false;
    }
    
    public function update($curso_model) {
        
        try {
           $this->em->merge($curso_model);
           $this->em->flush();    
           return true;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::update ');
        }
        
        return false;
    }
    
    public function delete($id) {
        
        try {
            
            $curso = $this->find_one_by($id);
            if ($curso) {
                $this->em->remove($curso);
                $this->em->flush();
            }
            
            return true;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - curso_dao::delete ');
        }
        
        return false;
    }
}