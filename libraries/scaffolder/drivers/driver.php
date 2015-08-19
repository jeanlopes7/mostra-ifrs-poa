<?php

require_once(BASEPATH . 'database/DB.php');

abstract class Driver {

    var $db;

    /**
    * Constructor set DB instance
    **/
	function __construct(){
		$this->db = DB();

	}
    /**
    * Every driver must have getTables method, 
    * which has to return tables of current database
    **/
    public function getTables(){
        
    }
    /**
    * Every driver must have getFields method
    * which has to return fields of a table
    **/
    public function getFields($table){
        
    }
    /**
    * Driver instance factory
    * Try to return driver based on config/database.php values
    * Eg.:
    * If $db['default']['dbdriver'] == 'mysql'
    *   require file mysql.php
    * and return instance of class MysqlDriver
    **/
    public static function getDriver(){
        require_once(APPPATH.'config/database.php');
        $db = DB();
        //var_dump($db->dbdriver); die;
        //$driver = $db['default']['dbdriver'];
        $driver = $db->dbdriver;
        require($driver . ".php");
        $driver_class = ucfirst($driver) . "Driver";
        return new $driver_class();
    }

}
