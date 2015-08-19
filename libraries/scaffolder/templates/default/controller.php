<?php

$controller_template = "<?php
/**
* CRUD Controller for ${vars['controller_name']}
**/
class ${vars['controller_name']} extends Controller{
	/**
	* Default Constructor
	**/
	public function __construct(){
		parent::__construct();
		\$this->load->model('${vars['model']}', '', true);
        \$this->load->helper(array('form', 'url'));
	}
	/**
	* Create new ${vars['model_name']}
	**/
	public function create(){
        \$object = \$this->${vars['model']};
		\$this->save(\$object);
	}
	/**
	* Edit ${vars['model_name']}
	**/
	public function edit(\$id){
        \$this->save((\$_POST) ? \$this->${vars['model']} : \$this->${vars['model']}->getById(\$id));
	}
	/**
	* Delete ${vars['model_name']}
	**/
	public function delete(\$id){
        \$response = null;
        if(\$_POST && isset(\$_POST['agree']) && \$_POST['agree'] == 'Yes'){
		    \$response = \$this->${vars['model']}->delete(\$id);
            redirect('${vars['controller']}');
            return;
        } else {
            if(\$_POST){
                redirect('${vars['controller']}');
                return;
            }
            \$object = \$this->${vars['model']}->getById(\$id);
        }
		\$this->load->view('${vars['controller']}/delete', array(
            'response' => \$response, 
            'object' => \$object,
            'title' => '${vars['model_name']}',
			'heading' => 'Delete',
            )
        );
	}
	/**
	* List objects of ${vars['model_name']}
	**/
	public function index(){
		\$data = array(
			'objects' => \$this->${vars['model']}->all(),
			'title' => '${vars['model_name']}',
			'heading' => 'List',
		);
		\$this->load->view('${vars['controller']}/list', \$data);
	}
	/**
    * Save object ${vars['model_name']}
    **/
    private function save(\$object){
        \$msg = null;
		if(\$_POST){
            \$object->populate();
            if(\$object->validate()){
                \$object->save();
                redirect('${vars['controller']}');
                return;
            } else {
                \$msg = 'Please fill in all required fields';
            }
		}
        \$this->load->view('${vars['controller']}/save', array(
            'title' => '${vars['model_name']}',
			'heading' => (\$object->id) ? 'Edit' : 'New',
            'object' => \$object,
            'msg' => \$msg
            )
        );
    }

}

";
