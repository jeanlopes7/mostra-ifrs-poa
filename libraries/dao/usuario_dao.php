<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Class Usuario Dao data access layer do usuário 
 */
class Usuario_dao {
    
    /**
     * @access private
     */
    private $CI;
    const REPOSITORY = 'Entity\Usuario';
    
    /**
     * @access private
     * @var \Doctrine\ORM\EntityManager $em Database
     */
    private $em;   
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
        
    }

    public function findUserByEmail($email)
    {
        try {

            $user = $this->em->getRepository(Usuario_dao::REPOSITORY)
                    ->findOneBy(array('email' => $email));
            return $user;
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage()  . ' - usuario_dao::findUserByEmail ');
        }

        return false;
    }

    /**
     * procura por uma ocorrência de cpf 
     * @param int $cpf
     * @return \Entity\Usuario boolean false se não encontrado, ou a linha do banco caso encontre
     */
    public function find_user_by_cpf($cpf){
        //$result = $this->db->query('select * from usuario where cpf = ?', array($cpf));

        try {
            $user = $this->em->getRepository(Usuario_dao::REPOSITORY)
                    ->findOneBy(array('cpf' => $cpf));
            return $user;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage()  . ' - usuario_dao::find_user_by_cpf ');
        }

        return false;
    }
    
    /**
     * Carrega todas as regras do arquivo xml em formato de objeto de acordo
     * com o documento xml e guarda cache
     * se for o segundo acesso, recupera da cache
     * 
     * @return boolean
     * @return stdClass Objeto dinâmico com as regras carregadas
     * @deprecated since version esta versão
     */
    public function load_all_regras() {
        
        // TODO: adaptar para carregar da CACHE
        try {
            
            $regras_session = $this->CI->session->userdata('regras');
            if (isset($regras_session) && $regras_session != false) {
                
                return $regras_session;
            }
            else {
               $regras = simplexml_load_file('regras.xml'); 
               $std_class_regras = json_decode(json_encode($regras));
               $this->CI->session->set_userdata('regras', $std_class_regras);
            }
            
            
            return $std_class_regras;
        } catch (Exception $ex) {
            //eval(\Psy\sh());
            $this->CI->log->write_log('error', $ex->getMessage() . ' - usuario_dao::load_all_regras ');
        }

        return false;
    }
    
    
    /**
     * Carrega todas as regras da memória. 
     * 
     * @return array Array com as regras (actions)
     * @deprecated since version esta versão
     */
    public function load_logged_user_regras() {
        // TODO: implementar com cache!
        
        $user = $this->CI->session->userdata('user');
        
        if (!is_null($user))
        {
            return $user['regras'];
        }

        return array();
    }

    /**
     * Consulta o banco para saber quais são os papéis que o usuário tem
     * @param type $id_usuario o id do usuário no banco
     * @return array array com os papéis e seus valores (se papel existe 1 ou mais, se não 0)
     */
    public function loadUser($id_usuario) {
        
        try {

            $sql = <<<SQL
            select usu
            from Entity\Usuario usu
            where usu.idUsuario= :id
SQL;
            
            $query = $this->em->createQuery($sql);
            $query->setParameter("id", $id_usuario);
            $user = $query->getOneOrNullResult();
            
            return $user;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - usuario_dao::loadUser ');
        }

        return false;
    }
    
    public function find_one_by($usuario_id) {
        try {
            
            $usuario = $this->em->getRepository(Usuario_dao::REPOSITORY)
                    ->findOneBy(array('idUsuario' => $usuario_id));
            
            
            //$usuario = $this->em->find(Usuario_dao::REPOSITORY, $usuario_id);
            
            return $usuario;
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage() . ' - usuario_dao::find_one_by ');
        }
    }
    
    public function insert(Entity\Usuario $user) {

        try {

            $usu_orig = $this->find_user_by_cpf($user->getCpf());
            
            if ($usu_orig != null) {
                throw new Exception("Este usuário já está no sistema", 1);
            }

            $this->em->persist($user);
            $this->em->flush();
            return true;

        } catch(Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - usuario_dao::insert ');
        }
        
        return false;

    }
    
    public function update(\Entity\Usuario $usuario) {

        try {

            $this->em->merge($usuario);
            $this->em->flush();

        }catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage() . ' - usuario_dao::update ');
        }
        
    }
}

