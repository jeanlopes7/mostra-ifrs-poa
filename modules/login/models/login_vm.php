<?php


class Login_vm extends CI_Model {
    
    private $cpf = 0;
    private $password = '';
    
    function __construct() {
        parent::__construct();
    }

    public function validate() {

        if (strlen($this->getCpf()) < 14 )
            return false;
        if (strlen($this->getPassword()) < 2)
            return false;

        return true;
    }

    public function getCpf() {
        return $this->cpf;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setCpf( $cpf) {
        $this->cpf = $cpf;
    }
    
    public function setPassword($password) {
        $this->password = md5($password);
    }

}
