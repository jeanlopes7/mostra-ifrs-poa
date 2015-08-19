<?php

if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }


/**
 * User: jean
 * Date: 29/04/15
 * Time: 16:04
 */


/**
 * Class Usuario_bo usuário business object
 *  OBS.: Esta classe está muito grande, pois o sistema de permissões é implementado aqui.
 *  O sistema de permissões deveria ser implementado em biblioteca separada e controlado pela bo (eu acho)
 */
class Usuario_bo {

    /**
     *
     * @access private 
     */
    private $CI;
    /**
     * @var \Usuario_dao $usuario_dao usuario dao
     * @access private
     */
    private $usuario_dao;

    const USERSESSION = 'user';

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('dao/usuario_dao');
        $this->usuario_dao =& $this->CI->usuario_dao;
        $this->CI->load->helper('string_func');
        $this->CI->load->helper('email');
    }



    
    /**
     * seta o usuário na sessão
     * @param integer $usuario_id o id do usuário no banco
     */
    public function setUserSession($usuario_id) {
        
        $regras = $this->definir_regras($usuario_id);
        $this->CI->session->set_userdata(Usuario_bo::USERSESSION, array('id' => $usuario_id, 'regras' => $regras));
    }

    /**
     * Retorna null se a sessão com o usuário não tiver sido iniciada
     * ou objeto de sessão usuário:
     * 
     * @return array seguinte formato: array('id' => $usuario_id, 'regras' => $regras)
     */
    public function getUserSession()
    {
        if ($user = $this->CI->session->userdata(Usuario_bo::USERSESSION))
        {
            return $user;
        }

        return null;
    }

    public function enviarNovaSenha($email)
    {

        $novaSenha = gerarNovaSenha();
        $usuario = $this->usuario_dao->findUserByEmail($email);
        if ($usuario == null) {
            throw new Exception('Usuário não encontrado.', 3);
        }

        $usuario->setSenha(md5($novaSenha));
        $this->usuario_dao->update($usuario);

        $result = sendPasswordEmail($novaSenha, $email);
    }

    /**
     * Autentica um usuário no sistema
     * @param string $cpf o cpf do usuário
     * @param strnig $password a senha do usuário
     * @return boolean true se o usuário está autenticado, false se a senha
     * está incorreta ou nulo se o usuário não existe no sistema
     * @throws InvalidArgumentException se o cpf estiver inválido
     */
    public function auth_user($cpf, $password) {

        //TODO: possibilidade de fazer um sleep caso muitas tentativas para o mesmo cpf

        $cpf_validado = valida_cpf($cpf);
        if ($cpf_validado != false) {
            $user = $this->usuario_dao->find_user_by_cpf($cpf_validado);

            //TODO: testar se objeto está nulo
            if ($user == null) {
              throw new Exception("Este usuário não existe no sistema!");
            }

            if ($user->getSenha() == $password)
            {
                // proteger senha
                $user->setSenha("");
                $this->setUserSession($user->getIdUsuario());
                return $user;
            }

            else
            {
                return false;
            }
        }
        else {
            throw new InvalidArgumentException("CPF Inválido!");
        }
    }

    // ##################################### MÉTODOS DO SISTEMA DE PERMISSÕES ###########################
    
    public function redefinirUserRegras($usuario_id = null) {
        
        $this->CI->session->unset_userdata(Usuario_bo::USERSESSION);
        if ($usuario_id == null) {
            $user = $this->getUserSession();
            $this->setUserSession($user['id']);
        }
        else
            $this->setUserSession($usuario_id);
    } 
    
    
    /**
     * Retorna um array com os papeis no seguinte formato:
     * 
     * ["autor"=> 1, "orientador" => 0, "voluntario" => 1, etc...]
     * 
     * @param int $id_usuario
     * @return array
     */
    public function carregar_papeis($id_usuario) {

        $user = $this->usuario_dao->loadUser($id_usuario);
        
        if ($user != null) {
            $user_papeis = array(
                "voluntario" => $user->getVoluntario() != null,
                "ouvinte" => $user->getOuvinte() != null,
                "autor" => $user->getAutor() != null,
                "orientador" => $user->getOrientador() != null,
                "avaliador" => $user->getAvaliador() != null,
                "revisor" => $user->getRevisor() != null,
                "organizador" => $user->getOrganizador() != null);

            //var_dump($user_papeis); die;
            //$this->log->write_log('error', json_encode($user_papeis));        

            return $user_papeis;
        }

//        var_dump($user_papeis); die;
        
//$this->CI->log->write_log('info', json_encode($user_papeis));
//$this->log->write_log('error', json_encode($user_papeis));        

        return null;
    }

    /**
     * Define a lista de regras de negócio que o usuário pode acessar no sistema
     * @param int $id_usuario o id do usuário no banco
     * @return array array com as regras do usuário
     */
    public function definir_regras($id_usuario) {

        if ($id_usuario == null) {
            throw new InvalidArgumentException("O id do usuario nao pode ser null - usuario_bo::definir_regras");
        }
        // papéis
        $user_papeis = $this->carregar_papeis($id_usuario);
        $all_regras = $this->usuario_dao->load_all_regras();

        $regras_finais_do_usuario = array();
        // percorre os papéis que o usuário tem (que vieram do banco)
        foreach ($user_papeis as $user_papel_nome => $user_papel_presente) { 
            if ($user_papel_presente > 0) {
                $regras_finais_do_usuario = $this->identificar_regras_do_usuario($id_usuario ,$regras_finais_do_usuario, $all_regras, $user_papel_nome);
            }
        }

        return $regras_finais_do_usuario;
    }
    
    /**
     * Percorre toda lista de regras do sistema que tem permissões envolvidas para
     * vincular o usuário com elas
     * @param int $user_id id do usuário no banco
     * @param array $regras_finais_do_usuario array com as regras do usuário para serem preenchidas
     * @param stdClass $all_regras objeto dinâmico com todas as regras do sistema
     * @param string $user_papel o nome do papel do usuário
     * @return array array com as regras do usuário
     */
    private function identificar_regras_do_usuario($user_id, $regras_finais_do_usuario, $all_regras, $user_papel_nome) {
        // percorre todas as regras do documento xml
        
        foreach ($all_regras->regras_dos_papeis->regra_do_papel as $regra_do_papel) {
            $regras_finais_do_usuario = $this->percorrer_papeis_para_regra($regras_finais_do_usuario, $user_papel_nome, $regra_do_papel);
        }
        
        foreach ($all_regras->regras_dos_usuarios->regra_do_usuario as $regra_do_usuario) { 
            $regras_finais_do_usuario = $this->percorrer_papeis_para_user_regra($regras_finais_do_usuario, $user_id, $regra_do_usuario);
        }
        
        return $regras_finais_do_usuario;
    }
    
    /**
     * Percorre cada papel da regra da lista para saber se o papel passado como
     * argumento corresponde ao papel existente na regra da lista
     * @param type $regras_finais_do_usuario
     * @param type $user_papel
     * @param type $regra
     * @return type
     */
    private function percorrer_papeis_para_regra($regras_finais_do_usuario, $user_papel_nome, $regra) {
        //eval(\Psy\sh());
        // percorre todos os papéis que podem executar uma dada regra

        // se tem um papel apenas, o atributo é string
        if (gettype($regra->papeis->papel) == "string") {

            if ($regra->papeis->papel == $user_papel_nome) {
                $regras_finais_do_usuario[$regra->id] = $regra->action;
            }

        } else {
            // se tem mais de um papel, o atributo é um array ¬¬"
            foreach ($regra->papeis->papel as $papel) {
                if ($papel == $user_papel_nome) {
                    $regras_finais_do_usuario[$regra->id] = $regra->action;
                }
            }

        }
        
        return $regras_finais_do_usuario;
    }
    
    /**
     * 
     * @param type $regras_finais_do_usuario array a ser preenchido com as regras do usuário 
     * corrente
     * @param type $id o id do usuário no banco
     * @return type array array com as regras do usuário corrente
     */
    private function percorrer_papeis_para_user_regra($regras_finais_do_usuario, $id, $regra_do_usuario) {

        if (gettype($regra_do_usuario->user_ids->user_id) == "string") {

            // porque 1 == "1" no php... ¬¬"
            if ($regra_do_usuario->user_ids->user_id == $id)

                $regras_finais_do_usuario[$regra->id] = $regra->action;
        }else {

            foreach ($regra_do_usuario->user_ids->user_id as $user_id) {
                if (strcmp($id, $user_id) == 0) {
                    $regras_finais_do_usuario[$regra_do_usuario->id] = $regras_finais_do_usuario->action;
                }
                
            }
        }
        
        return $regras_finais_do_usuario;
    }

    /**
     * Verifica se o usuário na sessão tem permissão para acessar determinada regra
     * de negócio
     * @param string $action regra, nome da action do controller, ou rota
     * @param array $regras_finais_do_usuario
     * @return boolean true se tem permissão, false se não tem
     */
    public function verify_permission_for_regra($action) {

        // carrega todas as regras do usuário da cache
        $regras = $this->usuario_dao->load_logged_user_regras();

        // NESTE CASO USUÁRIO ESTÁ LOGADO
        // se a action for igual a alguma da lista de regras (actions) do usuário, retorna true
        if ($regras != null) {
            foreach ($regras as $user_regra)
            {
                if ($user_regra == $action) {
                    return true;
                }
            }
        }

        //eval(\Psy\sh());
        
        $all_regras = $this->usuario_dao->load_all_regras();

        // se ele achar retorna false (não tem permissão)

        // NESTE CASO O USUÁRIO ESTÁ DESLOGADO
        // se a action estiver em alguma regra dos papeis
        foreach ($all_regras->regras_dos_papeis->regra_do_papel as $regra_do_papel) {

            if($regra_do_papel->action == $action) {
                return false;
            }

        }

        // se ele não achar retorna true pq essa regra não precisa de permissão
        return true;

    }

    public function has_more_that_one_papel(array $papeis) {

        $count = -1;
        
        foreach ($papeis as $um_papel) {
            if ($um_papel) {
                $count++;
            }
        }
        
        return $count;
        
    }

    // ############################### FIM MÉTODOS SISTEMA DE PERMISSÕES ##################################
    
    public function atualizar_usuario (Entity\Usuario $usuario) {
        $this->em->getConnection()->beginTransaction();
        try {

            $user = $this->usuario_dao->find_user_by_cpf($usuario->getCpf());
            $usuario->setIdUsuario($user->getIdUsuario());
            $this->usuario_dao->update($usuario);
            
            $this->em->getConnection()->commit();
            return true;
        } catch (Exception $ex) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
        }
        
        return false;
    }

    /**
     * retorna o usuário pelo id dele no banco
     * @param  int $id o id do usuário no banco
     * @return \Entity\Usuario     O objeto usuário
     */
    public function findUserById($id_usuario)
    {
        $usuario = $this->usuario_dao->find_one_by($id_usuario);

        return $usuario;
    }

    public function find_user_by($cpf) {

        $user = $this->usuario_dao->find_user_by_cpf($cpf);
        
        return $user;
    }
    
    
}
