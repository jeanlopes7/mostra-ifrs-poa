<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Controller que é acessado por padrão no index do sistema
 */
class Home_ctr extends \MX_Controller {
    
    /**
     *
     * @var Usuario_bo 
     */
    private $usuario_bo;
    
    function __construct() {
        parent::__construct();
        $this->usuario_bo = $this->load->library('bo/usuario_bo');
        
    }

    /*
    public function scaffold()
    {
        $this->load->library('scaffold');
        $this->scaffold->generate();
    }
    
    */
   

    public function index() {

        //$user_logged = $this->session->userdata('user');
        $user_logged = $this->usuario_bo->getUserSession();
        
        if ($user_logged != null) {
            redirect(base_url().'./usuario/usuario_ctr');
        }
        else {
            $this->load->view('home.html.php');
        }
      
       
    }

    public function verificar_cpf($cpf) {
        $valid_cpf = valida_cpf($cpf);
        
        //eval(Psy\sh());
        
        if (!$valid_cpf) {
            echo 'invalid';
        }
        else {
            $user = $this->usuario_bo->find_user_by($cpf);

            if ($user != null && $user != false) 
            {
                echo 'true';
            }
            else {
                echo 'false';
            }
        }
    }

    
}