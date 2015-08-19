<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property Categoria_dao $categoria_dao
 * @property Modalidade_dao $modalidade_dao
 * @property Area_tematica_dao $area_tematica_dao
 * @property Categoria_dto $categoria_dto
 * @property Modalidade_dto $modalidade_dto 
 * @property Area_tematica_dto $area_tematica_dto 
 */
class Organizador extends \MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('dao/categoria_dao');
        $this->load->library('dao/modalidade_dao');
        $this->load->library('dao/area_tematica_dao');
        $this->load->model('categoria_dto');
        $this->load->model('modalidade_dto');
        $this->load->model('area_tematica_dto');
        $this->load->helper('breadcrumb');
    }
    
    public function index() {
        
        $this->load->view('area_organizador.html.php');
        
    }
    
    public function categoria() {
        
        $data['categories_list'] = $this->categoria_dao->list_categires();
        $this->load->view('categoria.html.php', $data);
        
    }
    
    public function inserir_categoria() {
        
        $model = $this->input->post();
        
        if ($model) {
            $id = $this->categoria_dao->insert($model);
            if ($id != false) 
                $this->session->set_flashdata('sucesso', 'Categoria cadastrada com sucesso!');
            else
                $this->session->set_flashdata('erro', 'A categoria não pode ser cadastrada.');
            redirect('../organizador/categoria');
        }
        else
            $this->load->view('cadastrar_categoria.html.php');
    }

    public function delete_categoria() {
        $id = $this->input->get('id');
        $this->categoria_dao->delete($id);
    }
    
    public function modalidade() {
        $data['modalidade_list'] = $this->modalidade_dao->list_modalidades();
        $this->load->view('modalidade.html.php', $data);
    }
    
    public function inserir_modalidade() {
        $model = $this->input->post();
        
        if ($model) {
            $id = $this->modalidade_dao->insert($model);
            if ($id != false) 
                $this->session->set_flashdata('sucesso', 'Modalidade cadastrada com sucesso!');
            else
                $this->session->set_flashdata('erro', 'A modalidade não pode ser cadastrada.');
            redirect('../organizador/modalidade');
        }
        else
            $this->load->view('cadastrar_modalidade.html.php');
    }
    
    public function delete_modalidade() {
        $id = $this->input->get('id');
        $this->modalidade_dao->delete($id);
    }

    public function area_tematica() { 
        $data['area_tematica_list'] = $this->area_tematica_dao->list_areas_tematicas();
        $this->load->view('area_tematica.html.php', $data);
    }
    
    public function inserir_area_tematica() {
        $model = $this->input->post();
        
        if ($model) {
            $id = $this->area_tematica_dao->insert($model);
            if ($id != false) 
                $this->session->set_flashdata('sucesso', 'Área Temática cadastrada com sucesso!');
            else
                $this->session->set_flashdata('erro', 'A Área Temática não pode ser cadastrada.');
            redirect('../organizador/area_tematica');
        }
        else
            $this->load->view('cadastrar_area_tematica.html.php');
    }
    
    public function delete_area_tematica() {
        
        $id = $this->input->get('id');
        $this->area_tematica_dao->delete($id);
    }
    
    
}

