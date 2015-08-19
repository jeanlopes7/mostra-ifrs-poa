<?php

/**
 * @property Campus_dao $campus_dao Object DAO Campus
 * @property Campus_vm $campus_vm Data transfer object Model
 * @property Instituicao_dao $instituicao_dao Object DAO Instituicao
 */
class Campus_ctr extends MX_Controller
{
    /**
     *
     * @var Campus_bo 
     */
    private $campus_bo;

    /**
     * 
     * @var Instituicao_bo
     */
    private $instituicao_bo;
    
    function __construct() {
        parent::__construct();
        $this->campus_bo = $this->load->library('bo/campus_bo');
        $this->instituicao_bo = $this->load->library('bo/instituicao_bo');
        $this->load->model('campus_vm');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Create new Campus
     **/
    public function create()
    {
        //eval(\Psy\sh());

        $campusVm = $this->campus_vm;
        $this->saveOrUpdate($campusVm);
    }

    /**
     * Edit Campus
     * @param $id o id do campus
     */
    public function edit($id)
    {
        $this->saveOrUpdate(($_POST) ? $this->campus_vm : $this->campus_dao->find($id));
    }

    /**
     * Delete Campus
     **/
    public function delete($id)
    {
        $response = null;
        if ($_POST && isset($_POST['agree']) && $_POST['agree'] == 'Yes') {
            $this->campus_dao->delete($id);
            redirect('instituicao/campus');
            return;
        } else {
            if ($_POST) {
                redirect('campus');
                return;
            }
            $object = $this->campus_dao->find($id);
        }
        $this->load->view('/campus/delete_campus.html.php', array(
                'response' => $response,
                'object' => $object,
                'title' => 'Campus',
                'heading' => 'Delete',
            )
        );
    }

    /**
     * List objects of Campus
     **/
    public function index()
    {

        $data = array(
            'objects' => $this->campus_dao->findAll(),
            'title' => 'Campus',
            'heading' => 'List'
        );
        $this->load->view('/campus/list_campus.html.php', $data);
    }

    /**
     * Save object Campus
     **/
    private function saveOrUpdate(Campus_vm $campusVm)
    {
        $msg = null;
        if ($this->input->post()) {

            $campusVm->populate();

            if ($campusVm->validate()) {

                $instituicao = $this->instituicao_bo->findOneBy($campusVm->getInstituicao());

                $campus = new Entity\Campus();

                $campus->setCidade($campusVm->getCidade());
                $campus->setInstituicao($instituicao);
                $campus->setNome($campusVm->getNome());

                if ($campusVm->getIdCampus())
                    $this->campus_bo->updateCampus($campus);
                else
                    $this->campus_bo->createCampus($campus);

                if ($this->input->is_ajax_request()) {

                    echo json_encode($campus);
                    return;

                } else {

                    redirect('instituicao/campus');
                    return;
                }
                
            } else {
                $msg = 'Por favor, preencha todos os campos requeridos';
            }
        }

        eval(\Psy\sh());
        $instituicao_list = array_map(function ($d) {
            return $d->getNome();
        }, $this->instituicao_bo->list_all());

        array_unshift($instituicao_list, 'Selecione...');

        $this->load->view('campus/save_campus.html.php', array(
                'title' => 'Campus',
                'heading' => ($campusVm->getIdCampus()) ? 'Edit' : 'New',
                'campusVm' => $campusVm,
                'msg' => $msg,
                'instituicao_list' => $instituicao_list
            )
        );
    }


    public function get_campus_list($id_instituicao = NULL) {
        if ($id_instituicao != NULL) {
            $campus_list = $this->campus_bo->find_all_campus_by($id_instituicao);
            
            echo json_encode($campus_list);
        }
    }

}