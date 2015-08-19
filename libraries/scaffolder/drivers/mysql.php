<?php

require_once("driver.php");
require_once("field.php");

class MysqlDriver extends Driver {

    public function getTables(){
        $response = array();
        $results = $this->db->query('show tables')->result_array();
        foreach($results as $result){
            foreach($result as $table){
                $response[] = $table;
            }
        }
        return $response;
    }

    public function getFields($table){        
        $results = $this->db->query("describe $table")->result_array();
        return $this->_parseFields($results);
    }

    private function _parseFields($results){
        $response = array();
        foreach($results as $result){
            $field = new Field();
            $field->setName($result["Field"]);
            $field->setType($result["Type"]);
            $field->setPk($result["Key"] == 'PRI');
            $response[] = $field;
        }
        return $response;
    }

}
