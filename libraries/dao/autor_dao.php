<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * @property \Doctrine\ORM\EntityManager $em Database
 */
class Autor_dao {

    private $CI;
    private $em;
    
    const REPOSITORY = 'Entity\Autor';
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }
    
    /**
     * procura um autor pelo cpf
     * @param int $cpf
     * @return Entity\Autor
     */
    public function find_autor_by_cpf($cpf) {
        try {
            $dql = "select aut, usu from Entity\\Autor aut join aut.usuario usu where usu.cpf = ?1";
            
            $query = $this->em->createQuery($dql);
            $query->setParameter(1, $cpf);
            $autor = $query->getOneOrNullResult();
            return $autor;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - autor_dao::find_autor_by_cpf ');
        }
        return false;
    }
    
    public function find_one_by($autor_id) {
        try {
            
            $autor = $this->em->find(Autor_dao::REPOSITORY, $autor_id);
            
            return $autor;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - autor_dao::find_one_by ');
        }
    }
    

    /**
     * Insere um Autor no proxy do banco.
     * @param \Entity\Autor $autor
     * @param \Entity\Usuario $usuario
     * @param int $idCurso
     * @return int
     */
    public function insert(\Entity\Autor $autor) {

        try {

            $this->em->persist($autor);
            $this->em->flush();
            return true;
                    
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - autor_dao::insert ');
        }
        
        return false;

    }

    public function findAutoresByName($name) {

        try {
            
            $query = $this->em->createQuery("select aut, autCur, cur, cam, ins from Entity\Autor aut "
             ."join aut.autorCurso autCur "
             ."join autCur.curso cur "
             ."join cur.campus cam "
             ."join cam.instituicao ins "
             ."join aut.usuario usu with usu.nome like :name");
            $query->setParameter("name", "%" . $name. "%");

            $autores = $query->getResult();
            
            return $autores;

        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - autor_dao::findAutoresByName ');
        }

        return null;
    }
    
}