<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller que expõe as actions da área padão do usuário
 *
 * @author jean
 */
class Usuario_ctr extends \MX_Controller {
    
    /**
     * @access private
     * @var Usuario_bo 
     */
    private $usuario_bo;


    const SECONDS = 1800;
    
    function __construct() {
        parent::__construct();
        $this->usuario_bo = $this->load->library('bo/usuario_bo');
        $this->load->helper('breadcrumb');

    }

    
    public function index() {

        $usuario = $this->usuario_bo->getUserSession();
        
        redirect(base_url() . 'login/login_ctr/to_redirect/' . $usuario['id']);
    }

    public function principal() {

        $this->load->view('../../../templates/header.html.php');
        $this->area_geral();
        $this->load->view('../../../templates/footer.html.php');
    }

    public function area_geral() {
        
        $user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        
        /**
         * Aqui seto os cabeçalhos do cache
         * Com isso defino que todas as requisições para a action index
         * feitas nos próximos 1800 segundos (30 minutos) não chegarão aqui
         * apenas repassarão as mesmas informações, EVITANDO ASSIM PERGUNTAS DESNECESSÁRIAS
         * AO SERVIDOR, E CONSEQUENTEMENTE AO BANCO! 
         */
        //$this->output->set_header("Cache-Control: private, max-age=" . Usuario_ctr::SECONDS);
        //$this->output->set_header("Expires: ".gmdate('r', time() + Usuario_ctr::SECONDS ));
        
        $mais_que_um_papel = $this->usuario_bo->has_more_that_one_papel($papeis);

        $vars = array('papeis' => $papeis, 
                      'mais_que_um_papel' => $mais_que_um_papel);

        
        $this->load->view('area_geral_usuario.html.php', $vars);
    
    }
    
    
}


