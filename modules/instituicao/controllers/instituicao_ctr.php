<?php

/**
 * @property Instituicao_dao $instituicao_dao Object DAO instituição
 * @property Instituicao_vm $instituicao_dto Object Model Instituição
 */

class Instituicao_ctr extends MX_Controller {
    
    
    /**
     * @access private
     * @var Instituicao_bo 
     */
    private $instituicaoBo;
    
    function __construct() {

        parent::__construct();
        $this->instituicaoBo = $this->load->library('bo/instituicao_bo');
        $this->load->model('instituicao_vm');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Create new Instituicao
     **/
    public function create()
    {

        //eval(\Psy\sh());

        $instituicaoVm = $this->instituicao_vm;
        $this->saveOrUpdate($instituicaoVm);
    }

    /**
     * Edit Instituicao
     **/
    public function edit($id)
    {
        $this->saveOrUpdate(($this->input->post()) ? $this->instituicao_vm : $this->instituicao_dao->find($id));
    }

    /**
     * Delete Instituicao
     * @param $id o id
     */
    public function delete($id)
    {
        $response = null;
        if ($_POST && isset($_POST['agree']) && $_POST['agree'] == 'Yes') {
            $this->instituicao_dao->delete($id);
            redirect('instituicao');
            return;
        } else {
            if ($_POST) {
                redirect('instituicao');
                return;
            }
            $object = $this->instituicao_dao->find($id);

        }
        $this->load->view('/instituicao/delete_instituicao.html.php', array(
                'response' => $response,
                'object' => $object,
                'title' => 'Instituicao',
                'heading' => 'Delete',
            )
        );

    }

    /**
     * List objects of Instituicao
     **/
    public function index()
    {
        $data = array(
            'objects' => $this->instituicaoBo->list_all(),
            'title' => 'Instituição',
            'heading' => 'Lista de',
        );

        $this->load->view('/instituicao/list_instituicao.html.php', $data);
    }

    /**
     * Save instituicaoVm Instituicao
     **/
    private function saveOrUpdate(Instituicao_vm $instituicaoVm)
    {
        
        $msg = null;
        if ($this->input->post()) {
            
            $instituicaoVm->populate();

            if ($instituicaoVm->validate()) {

                $instituicao = new Entity\Instituicao();

                $instituicao->setCidade($instituicaoVm->getCidade());
                $instituicao->setEstado($instituicaoVm->getEstado());
                $instituicao->setNome($instituicaoVm->getNome());
                $instituicao->setSigla($instituicaoVm->getSigla());
                $instituicao->setSite($instituicaoVm->getSite());
                $instituicao->setTipo($instituicaoVm->getTipo());

                if ($instituicaoVm->getIdInstituicao()) {
                    $this->instituicaoBo->update($instituicao);
                } else {
                    $this->instituicaoBo->insert($instituicao);
                }

                if ($this->input->is_ajax_request()) {

                    echo json_encode($instituicao);
                    return;

                } else {
                    
                    redirect(base_url() . 'instituicao/instituicao_ctr');
                    return;
                }

            } else {
                $msg = 'Por favor, preencha todos os campos';
            }
        }

        $this->load->view('/instituicao/instituicao_ctr/save_instituicao.html.php', array(
                'title' => 'Instituicao',
                'heading' => ($instituicaoVm->getIdInstituicao()) ? 'Edit' : 'New',
                'instituicaoVm' => $instituicaoVm,
                'msg' => $msg
            )
        );
    }
}