<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Class Autor_bo autor business object
 *
 * @author jean
 */
class Autor_bo {
    
    /**
     *
     * @access private
     */
    private $CI;
    
    /**
     * @access private
     * @var Usuario_dao
     */
    private $usuario_dao;
    
    /**
     * @access private
     * @var Curso_dao 
     */
    private $curso_dao;
    
    /**
     * @access private
     * @var Autor_dao 
     */
    private $autor_dao;
    
    /**
     *
     * @var Autor_curso_dao 
     */
    private $autor_curso_dao;
    
    /**
     *
     * @var Usuario_bo
     */
    private $usuario_bo;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;

    /**
     * email object
     * @access private
     * @var CI_Email
     */
    private $email;
    
    public function __construct() {
        
        $this->CI =& get_instance();
        
        $this->CI->load->library('dao/usuario_dao');
        $this->usuario_dao =& $this->CI->usuario_dao;
        $this->CI->load->library('dao/autor_dao');
        $this->autor_dao =& $this->CI->autor_dao;
        $this->CI->load->library('dao/curso_dao');
        $this->curso_dao =& $this->CI->curso_dao;
        $this->CI->load->library('dao/autor_curso_dao');
        $this->autor_curso_dao =& $this->CI->autor_curso_dao;
        $this->CI->load->library('bo/usuario_bo');
        $this->usuario_bo =& $this->CI->usuario_bo;
        $this->CI->load->helper('email');
        
        $this->em =& $this->CI->load->library('doctrine')->em;
    }
    
    
    public function cadastrar_autor(\Entity\Autor $autor, \Entity\Usuario $usuario, $curso_id) {
        
        $this->em->getConnection()->beginTransaction();
        try {
            $autor_orig = $this->autor_dao->find_autor_by_cpf($usuario->getCpf());
            
            if ($autor_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este autor já existe.');
                throw new Exception("Este autor já existe", 2); 
            }
            
            // TODO: consultar CPF aqui, mover para um método abstrato no usuario_bo
            $senha = $usuario->getSenha(); $usuario->setSenha(md5($senha));

            $this->usuario_dao->insert($usuario); $autor->setUsuario($usuario);
            
            $this->fazerCadastroAutorAux($autor, $curso_id);

            $this->em->flush();
            $this->em->refresh($autor);
            
            $this->usuario_bo->redefinirUserRegras($usuario->getIdUsuario());
            
            sendEmailAfterRecordUser($usuario->getCpf(), $usuario->getNome(), $usuario->getEmail(), "autor");
            
            return $usuario->getIdUsuario();
        } catch (Exception $ex) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
            
        }
        
        return false;
            
    }
    
    public function atualizar_autor(Entity\Usuario $usuario) {
        
        $this->usuario_bo->atualizar_usuario($usuario);
    }
    
    public function find_autor_by($cpf) {
        $autor = $this->autor_dao->find_autor_by_cpf($cpf);
        
        return $autor;
    }

    public function findAutoresByName($name) {

        if (strlen($name) < 4) {            
            return false;
        }

        $autores = $this->autor_dao->findAutoresByName($name);


        $autores_pre_encode = array();
        foreach ($autores as $autor) {

            $this->em->refresh($autor);

            $autor->getUsuario()->setCpf(null);
            $autor->getUsuario()->setSenha(null);

            $curso = $autor->getAutorCurso()->get(0)->getCurso();
            
            $user = new stdClass();

            $user->usuario = $autor;
            $user->curso = $curso;
            $autores_pre_encode[] = $user;
            

        } 

        return json_encode($autores_pre_encode);
    }

    /**
     * adiciona o usuário já cadastrado ao papel de autor
     * @param  int $curso_id o id do curso no banco
     * @return void
     */
    public function fazerCadastroIncremental($curso_id)
    {
        $this->em->beginTransaction();
        try {
            
            $session_user = $this->usuario_bo->getUserSession();

            $user = $this->usuario_bo->findUserById($session_user['id']);
            
            $autor_orig = $this->autor_dao->find_autor_by_cpf($user->getCpf());
            
            if ($autor_orig != NULL) {
                $this->CI->session->set_flashdata('erro', 'Este autor já existe.');
                throw new Exception("Este autor já existe", 2); 
            }

            $autor = new Entity\Autor();
            $autor->setUsuario($user);

            $this->fazerCadastroAutorAux($autor, $curso_id);


            $this->em->flush();
            $this->em->refresh($user);
            
            $this->usuario_bo->redefinirUserRegras($user->getIdUsuario());

            sendEmailAfterRecordUser($user->getCpf(), $user->getNome(), $user->getEmail(), "autor");
            return $user->getIdUsuario();
            
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->CI->log->write_log('error', $ex->getMessage());
        }
    }

    private function fazerCadastroAutorAux(Entity\Autor $autor, $curso_id) {
            
            $this->autor_dao->insert($autor);
            $curso = $this->curso_dao->find_one_by($curso_id);
            
            
            $autor_curso = new \Entity\AutorCurso();
            $autor_curso->setAutor($autor);
            $autor_curso->setCurso($curso);
            
            
            $this->autor_curso_dao->insert($autor_curso);
        
            $this->em->getConnection()->commit();
    }

    /**
     * Verifica se o usuário logado no sistema é autor
     * @return boolean true se é autor, false se não é
     */
    public function isCurrentUserAutor()
    {
        $user = $this->usuario_bo->getUserSession();
        $papeis = $this->usuario_bo->carregar_papeis($user['id']);
        return $papeis['autor'] == true;
    }

    public function getNivelDoCursoDoAutor($id_autor) {

        throw new Exception("Funcao nao implementada", 3);
        
    }
}
