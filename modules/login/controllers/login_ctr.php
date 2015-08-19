<?php
if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}


/**
 * @property Login_vm $login_vm o viewmodel login
 * @property Usuario_bo $usuario_bo business object user
 */
class Login_ctr extends \MX_Controller {
        
    public function __construct()
    {
        parent::__construct();

        $this->load->library('bo/usuario_bo');
        
        
    }

    /**
     * Método que verifica se o usuário tem permissão para acessar a rota que está pedindo
     * Este método é executado <strong>sempre</strong> antes de cada action do controller
     */
    public function hook_logged()
    {
        $class = $this->router->class;
        $method = $this->router->method;

        $route = $class . "/" . $method;
        // verifica se tal usuário tem permissão para tal rota
        $permission = $this->usuario_bo->verify_permission_for_regra($route);


        // se não tem cai fora
        if (!$permission) {
            //show_error('N&atilde;o autorizado', 403);
            
            redirect('../login/login_ctr/erro_403');
            
        }
    }
    
    /**
     * @rota /login
     * @metodo post
     * 
     * Este método é responsável por <strong>logar</strong> o usuário no sistema
     * ou redirecionar ele para o home, caso não seja possível o login;
     */
    public function index()
    {
        
        $this->load->model('login_vm');
        
        // carrega a view model
        $this->login_vm->setCpf($this->input->post('cpf'));
        $this->login_vm->setPassword($this->input->post('password'));

        
        if (!$this->login_vm->validate())
        {
            $this->session->set_flashdata('erro', 'usuário ou senha inválidos');
            redirect(base_url().'./home/home_ctr');
        }

        // faz a autenticação        

        try {
            $user = $this->usuario_bo->auth_user($this->login_vm->getCpf(), $this->login_vm->getPassword());
        } catch (Exception $ex) {
            
            $this->session->set_flashdata('aviso', $ex->getMessage());
            redirect(base_url().'./home/home_ctr');
        }
        
        // define redirecionamentos de acordo com o resultado da autenticação
        if ($user != null && $user != false) {

            // variável com links internos do sistema (que o usuário só pode ver logado)
            $redirect = $this->input->post('redirect');
            if ($redirect) {
                //redirect(base_url().'./'.$redirect);
              redirect($redirect);
            } else {
                $this->session->set_flashdata('aviso', 'usuário autenticado com sucesso!');
                redirect(base_url() .'login/login_ctr/to_redirect/' . $user->getIdUsuario());
            }

        } else {
            $this->session->set_flashdata('aviso', 'usuário ou senha incorretos');
            redirect(base_url().'./home/home_ctr');
        }
            

        //$this->load->view('login.html.php');
    }
    
    // TODO: podia estar em um controller mais genérico
    /**
     * Esta action redireciona o usuário seja para a área dele ou para a área genérica
     * do usuário, de acordo com a circunstância
     * @param  [type] $idUsuario [description]
     * @return [type]            [description]
     */
    public function to_redirect($idUsuario) {
        
        $papeis = $this->usuario_bo->carregar_papeis($idUsuario);

        
        $moreThatOne = $this->usuario_bo->has_more_that_one_papel($papeis);

        if ($moreThatOne) {
            // TODO: colocar rota certa
            redirect(base_url().'./usuario/usuario_ctr/principal');
            
        } else {
            foreach ($papeis as $nomePapel => $papelPresente) {   
                if ($papelPresente) {
                    //redirect('../' . $nomePapel);
                    redirect(base_url().'./usuario/' . $nomePapel . '_ctr');
                }
            }
        }
    }

    public function erro_404()
    {
        $this->output->set_status_header(404);
        $this->load->view('../../../templates/erro_404.html.php');
    }

    public function erro_403()
    {
        //$this->output->set_status_header(403);
        $this->load->view('../../../templates/erro_403.html.php');
    }

    public function recuperar_senha() {

        $email = $this->input->post('email');

        if ($email == null) {

            $this->load->view('form_forgot_password.html.php');
        } else {

            try {

                $this->usuario_bo->enviarNovaSenha($email);
                $this->session->set_flashdata('sucesso', 'Sua senha foi alterada com sucesso! Verifique seu e-mail.');
                redirect(base_url().'./home/home_ctr');
                
            } catch (Exception $ex) {
                                
                $this->session->set_flashdata('erro', $ex->getMessage());
            }

            redirect(base_url().'./login/login_ctr/recuperar_senha');

        }
    }

    /**
     * @rota /logout
     * @metodo get, post (não chamar com ajax)
     * desloga o usuário do sistema
     */
    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('aviso', 'Usuário deslogado.');
        redirect(base_url().'./home/home_ctr');
    }

}
