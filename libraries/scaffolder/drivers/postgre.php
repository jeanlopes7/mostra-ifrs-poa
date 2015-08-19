<?php

require_once("driver.php");
require_once("field.php");

class PostgreDriver extends Driver {

    public function getTables(){
        $response = array();
        $results = $this->db->query($this->getTablesSQL())->result_array();
        foreach($results as $result){
            foreach($result as $table){
                $response[] = $table;
            }
        }
        return $response;
    }

    public function getFields($table){        
        $results = $this->db->query($this->getFieldsSQL($table))->result_array();
        $pk = $this->getPrimaryKey($table);
        return $this->_parseFields($results, $pk);
    }

    private function _parseFields($results, $pk){
        $response = array();
        foreach($results as $result){
            $field = new Field();
            $field->setName($result["field"]);
            $field->setType($result["type"]);
            $field->setPk($result["field"] == $pk["col"]);
            $response[] = $field;
        }
        return $response;
    }

    private function getPrimaryKey($table){
        $results = $this->db->query($this->getPrimaryKeySQL($table))->result_array();
        foreach ($results as $result){
            if($result["name"] == "${table}_pkey"){
                return $result;
            }
        }
        return $results[0];
    }

    private function getTablesSQL(){
        return "SELECT c.relname as name
                FROM pg_catalog.pg_class c
                JOIN pg_catalog.pg_roles r ON r.oid = c.relowner
                LEFT JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
                WHERE c.relkind = 'r'
                AND n.nspname <> 'pg_catalog'
                AND n.nspname !~ '^pg_toast'
                AND pg_catalog.pg_table_is_visible(c.oid)
                ORDER BY 1";
    }

    private function getFieldsSQL($table){
        return "SELECT a.attname as field,
                  pg_catalog.format_type(a.atttypid, a.atttypmod) as type,
                  a.attnotnull, a.attnum
                FROM pg_catalog.pg_attribute a
                INNER JOIN pg_catalog.pg_class c
                ON c.oid = a.attrelid
                WHERE c.relname = '$table' AND a.attnum > 0 AND NOT a.attisdropped
                ORDER BY a.attnum";
    }

    private function getPrimaryKeySQL($table){
        return "SELECT c.column_name as col, c.constraint_name as name
                FROM information_schema.constraint_column_usage c
                WHERE c.table_name = '$table'";
    }
}
