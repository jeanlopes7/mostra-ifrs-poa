<?php

$model_template = "<?php
/**
* Model that represents Cidade at database
**/
class ModelCidade extends Model{
	/**
	* Model Fields	
	**/
    var \$id;
	var \$nome;
	var \$alias;
	var \$estado_id;
	/**
	* Default Constructor
	**/
	public function __construct(){
		parent::__construct();
	}
    /**
    * Populate model based on POST method
    **/
    public function populate(){
        \$this->id = \$this->input->post('id');
		\$this->nome = \$this->input->post('nome');
		\$this->alias = \$this->input->post('alias');
		\$this->estado_id = \$this->input->post('estado_id');
	}
    /**
    * Validates fields that can not be blank
    **/
	public function validate(){
		if(\$this->nome == '') return false;
		if(\$this->alias == '') return false;
		if(\$this->estado_id == '') return false;
		return true;
	}
    /**
    * Persist object
    **/
	public function save(){
        if(\$this->id){
            return \$this->db->update('cidade', \$this, array('id' => \$this->id));
        } else {
    		return \$this->db->insert('cidade', \$this);
        }
	}
	/**
    * Delete object
    **/
	public function delete(\$id){
		return \$this->db->delete('cidade', array('id' => \$id));
	}
	/**
    * Return all objects
    **/
	public function all(){
		return \$this->db->get('cidade')->result();
	}
    /**
    * Return object that has \$id
    **/
    public function getById(\$id){
		return \$this->db->get_where('cidade', array('id' => \$id))->row();
	}
	/**
    * Return object filtered by \$where
    * \$where must be an array
    **/
	public function getBy(\$where){
		return \$this->db->get_where('cidade', \$where)->result();
	}
}
";
