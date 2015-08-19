<?php

$fields = '';
foreach($vars['table_fields'] as $field){
    $field_name = $field->getName();
	$fields .= "    var \$$field_name;\n";
}

$fill = '';
foreach($vars['table_fields'] as $field){
    $field_name = $field->getName();
	$fill .= "        \$this->$field_name = \$this->input->post('$field_name');\n";
}
$validate = '';
foreach($vars['table_fields'] as $field){
    if(!$field->isPk()){
        $field_name = $field->getName();
	    $validate .= "        if(\$this->$field_name == '') return false;\n";
    }
}
$model_template = "<?php
/**
* Model that represents ${vars['model']} at database
**/
class ${vars['model_name']} extends Model{
	/**
	* Model Fields	
	**/
$fields
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
$fill
	}
    /**
    * Validates fields that can not be blank
    **/
	public function validate(){
$validate
        return true;
	}
    /**
    * Persist object
    **/
	public function save(){
        if(\$this->id){
            return \$this->db->update('${vars['table']}', \$this, array('id' => \$this->id));
        } else {
    		return \$this->db->insert('${vars['table']}', \$this);
        }
	}
	/**
    * Delete object
    **/
	public function delete(\$id){
		return \$this->db->delete('${vars['table']}', array('id' => \$id));
	}
	/**
    * Return all objects
    **/
	public function all(){
		return \$this->db->get('${vars['table']}')->result();
	}
    /**
    * Return object that has \$id
    **/
    public function getById(\$id){
		return \$this->db->get_where('${vars['table']}', array('id' => \$id))->row();
	}
	/**
    * Return object filtered by \$where
    * \$where must be an array
    **/
	public function getBy(\$where){
		return \$this->db->get_where('${vars['table']}', \$where)->result();
	}
}

";
