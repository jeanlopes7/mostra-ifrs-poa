<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of campus_bo
 *
 * @author jean
 */
class Campus_bo {
    
    /**
     *
     * @var Campus_dao 
     */
    private $campus_dao;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->campus_dao = $this->CI->load->library('dao/campus_dao');
        
        
    }
    
    public function find_all_campus_by ($instituicao_id){
        $inst_list = $this->campus_dao->findAllByInstituicao($instituicao_id);
        
        return $inst_list;        
    }

    public function createCampus(Entity\Campus $campus) {

        $this->campus_dao->insert($campus);
    }

    public function updateCampus(Entity\Campus $campus) {

        $this->campus_dao->update($campus);
    }

    public function deleteCampus($idCampus) {

        $this->campus_dao->delete($idCampus);
    }

}
