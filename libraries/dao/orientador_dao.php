<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * @property \Doctrine\ORM\EntityManager $em Database
 */
class Orientador_dao {

    private $CI;
    private $em;
    
    const REPOSITORY = 'Entity\Orientador';
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }

    public function findOrientadoresByName($name) {

        try {
            
            $query = $this->em->createQuery("select ori, oriCam, cam, ins from Entity\Orientador ori "
                    ."join ori.orientadorCampus oriCam "
                    ."join oriCam.campus cam "
                    ."join cam.instituicao ins "
                    ."join ori.usuario usu with usu.nome like :name");
            $query->setParameter("name", "%" . $name. "%");

            $orientadores = $query->getResult();
        
            return $orientadores;

        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_dao::findOrientadoresByName ');
        }

        return null;
    }
    
    /**
     * procura um orientador pelo cpf
     * @param int $cpf
     * @return Entity\Autor
     */
    public function find_orientador_by_cpf($cpf) {
        try {
            $sql = "select ori, usu from Entity\\Orientador ori join ori.usuario usu where usu.cpf = ?1";
            
            $query = $this->em->createQuery($sql);
            $query->setParameter(1, $cpf);
            $orientador = $query->getOneOrNullResult();
            return $orientador;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_dao::find_orientador_by_cpf ');
        }
        return false;
    }
    
    public function find_one_by($orientador_id) {
        try {
            
            $orientador = $this->em->find(Autor_dao::REPOSITORY, $orientador_id);
            
            return $orientador;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_dao::find_one_by ');
        }
    }
    
    public function find_all_by($orientador_id) {
        try {
            
            $orientadores = $this->em->getRepository(Orientador_dao::REPOSITORY)
                    ->findBy(array('fk_orientador', $orientador_id));
            
            return $orientadores;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_dao::find_all_by ');
        }
    }

    /**
     * Insere um Orientador no banco e salva as alterações.
     * @param \Entity\Orientador $orientador
     * @param \Entity\Usuario $usuario
     * @param int $idCampus
     * @return int
     */
    public function insert(\Entity\Orientador $orientador) {

        try {

            $this->em->persist($orientador);
            $this->em->flush();
            return true;
                    
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_dao::insert ');
        }
        
        return false;

    }


    
}