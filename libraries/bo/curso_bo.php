<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of curso_bo
 *
 * @author jean
 */
class Curso_bo {
    
    /**
     *
     * @var Curso_dao 
     */
    private $curso_dao;

    /**
     * campus data access layer
     * @var Campus_dao
     */
    private $campus_dao;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->curso_dao = $this->CI->load->library('dao/curso_dao');
        $this->campus_dao = $this->CI->load->library('dao/campus_dao');
    }
    
    public function find_all_by_campus($campus_id) {
        $campus_list = $this->curso_dao->findAllByCampus($campus_id);
        
        return $campus_list;
    }

    public function createCurso(Entity\Curso $curso, $id_campus)
    {

        $campus = $this->campus_dao->find_one_by($id_campus);
        if (!$campus)
        {
            $this->CI->log->write_log('errr', 'Curso_bo->createCurso - nao foi '
                .'possivel encontrar o campus referente ao id ' . $id_campus);
            return false;
        }

        $curso->setCampus($campus);
        $id = $this->curso_dao->insert($curso);

        return $id;
    }

    public function updateCurso(Entity\Curso $curso)
    {
        $this->curso_dao->update($curso);
    }

    public function deleteCurso($idCurso) {

        $this->curso_dao->delete($idCurso);
    }
}
