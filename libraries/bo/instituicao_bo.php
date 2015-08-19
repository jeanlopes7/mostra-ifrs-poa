<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of instituicao_bo
 *
 * @author jean
 */
class Instituicao_bo {
    
    /**
     *
     * @var Instituicao_dao
     */
    private $instituicao_dao;
    
    public function __construct() {
        $this->CI =& get_instance();
        
        $this->instituicao_dao = $this->CI->load->library('dao/instituicao_dao');
    }
    
    public function list_all() {
        
        $inst_list = $this->instituicao_dao->find_all();
        
        return $inst_list;
    }
    
    public function findAllBy($instituicao_id) {
        
        $instituicao = $this->instituicao_dao->find_all_by($instituicao_id);

        return $instituicao;
    }
    
    public function findOneBy($instituicao_id) {
        
        $instituicao = $this->instituicao_dao->find_one_by($instituicao_id);

        return $instituicao;
    }
    
    public function insert(Entity\Instituicao $instituicao) {

        $this->instituicao_dao->insert($instituicao);
    }
   
    public function update(Entity\Instituicao $instituicao) {
        
        $this->instituicao_dao->update($instituicao);
    }
    
    public function delete($instituicao_id) {
        
        $this->instituicao_dao->delete($instituicao_id);
    }
}
