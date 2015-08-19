<?php

/**
 * @property Curso_dao $curso_dao DAO Object Curso
 * @property Curso_dto $curso_dto Data transfer object curso
 */
class Curso_ctr extends MX_Controller
{
    /**
     *
     * @var Curso_bo 
     */
    private $curso_bo;

    /**
     * 
     * @var Curso_vm
     */
    private $cursoVm;
    
    function __construct() {
        parent::__construct();
        $this->curso_bo = $this->load->library('bo/curso_bo');
        $this->cursoVm = $this->load->model('curso_vm');
        
    }


    public function get_curso_list($id_campus = NULL) {
        if ($id_campus != NULL) {
            $curso_list = $this->curso_bo->find_all_by_campus($id_campus);
            echo json_encode($curso_list);
        }
    }
    
    public function create() {
        $data = $this->input->post();
        if ($data) {

            $this->cursoVm->setNivel($data['nivel']);
            $this->cursoVm->setNome($data['nome']);
            $this->cursoVm->setCampus($data['campus']);

            $curso = $this->cursoVm->loadCurso();

            $id = $this->curso_bo->createCurso($curso, $this->cursoVm->getCampus());
            $this->cursoVm->id_curso = $id;

            echo json_encode($this->cursoVm);
        }
        else {
            $data['curso'] = $this->cursoVm;
            $this->load->view('editar_curso.html.php', $data);
        }
    }
    
    public function index($page = NULL) {
       
        $data['curso_list'] = $this->curso_dao->findAll();
        
        $this->load->library('pagination');
        $config['total_rows'] = 200;
        $config['per_page'] = 20; 
        $config['base_url'] = base_url() . '/curso/index';
        $this->pagination->initialize($config);
        $this->load->view('curso.html.php', $data);
    }
    
    public function update($id = NULL) {
        $data = $this->input->post();
        
        if ($data) {
            $this->cursoVm->id_curso = $data['id_curso'];
            $this->cursoVm->nome = $data['nome'];
            $this->cursoVm->nivel = $data['nivel'];
            $this->cursoVm->fk_campus = $data['campus'];
            
            $this->curso_dao->update($this->cursoVm);
            
        }
        else {
           $data['curso'] = $this->curso_dao->find($id)[0];
           $this->load->view('edit.html.php', $data);
        }
    }
    
    public function delete($id) {
        $this->curso_dao->delete($id);        
    }
}