<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scaffold {

    /**
    * Default constructor
    **/
    public function __construct(){

    }
    /**
	 * Run Scaffolder
	 *
	 * @access	private
	 * @return	void
	 */	
	public function generate(){		
		require_once(APPPATH . 'libraries/scaffolder/scaffolder'.EXT);
        $this->_showHeader();
        if(array_key_exists('table', $_POST) && trim($_POST['table']) != ""){
            $table = $_POST['table'];
            $fields = $this->_getFields($table);
		    $scaffolder = new Scaffolder();
    		$scaffolder->generate($table, $fields);
            $this->_showFooter();
        } else {
            $this->_showTables();
        }
	}
    /**
    * Load database driver to query for results
    **/
    private function _getDriver(){
        require_once(APPPATH . 'libraries/scaffolder/drivers/driver'.EXT);
        return Driver::getDriver();
    }
    /**
    * Return fields of a $table
    **/
    private function _getFields($table){
        $driver = $this->_getDriver();
        return $driver->getFields($table);
    }
    /**
    * Return tables of configured database
    **/
    private function _getTables(){
        $driver = $this->_getDriver();
        return $driver->getTables();
    }
    /**
    * Default view that shows form to user select
    **/
    private function _showTables(){
        $tables = $this->_getTables();
        $this->_showForm($tables);
    }
    /**
    * Parse array of database $tables into dropdown options
    **/
    private function _tablesAsOptions($tables){
        $options = array('' => 'Select');
        foreach($tables as $table){
            $options[$table] = $table;
        }
        return $options;
    }
    /**
    * Show form to user select table
    **/
    private function _showForm($tables){
        $CI =& get_instance();
        $CI->load->helper('form');
        echo form_open($CI->uri->uri_string(), array("method" => "post"));
        echo form_label('Table: ', 'table');
        echo form_dropdown('table', $this->_tablesAsOptions($tables), array(), 'id="table"');
        echo form_submit('', 'Submit');
        echo form_close();
    }
    /**
    * HTML page header
    */
    private function _showHeader(){
        $CI =& get_instance();
        $CI->load->helper('html');
        echo heading('Scaffolder');
    }
    /**
    * HTML page footer
    */
    private function _showFooter(){
        $CI =& get_instance();
        $CI->load->helper('url');
        echo anchor($CI->uri->uri_string(), "Generate New Scaffold");
    }
}
