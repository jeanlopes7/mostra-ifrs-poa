<?php

class Field {

    var $name;

    var $type;

    var $pk = false;

    function getName(){
        return $this->name;
    }

    function setName($name){
        $this->name = $name;
    }

    function getType(){
        return $this->type;
    }

    function setType($type){
        $this->type = $type;
    }

    function isPk(){
        return $this->pk;
    }

    function setPk($pk){
        $this->pk= $pk;
    }

}
