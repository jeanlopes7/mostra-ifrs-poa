<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Classe de acesso a dados Autor_curso
 */
class Autor_curso_dao {
    
    /**
     * @access private
     */
    private $CI;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;
    
    const REPOSITORY = 'Entity\AutorCurso';
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }
    
    public function find_one_by($autor_id, $curso_id = null) {
        
        if (gettype($autor_id))

        try {
            
            if ($curso_id != null) {

                $dql = 'select autCur, aut, cur, usu from Entity\\AutorCurso autCur '
                      .' join autCur.curso cur '
                      .' join autCur.autor aut '
                      .' join aut.usuario usu where cur.idCurso = ?1 and usu.idUsuario = ?2';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $curso_id);
                $query->setParameter(2, $autor_id);

            }
            
            else {

                $sql = 'select autCur, aut from Entity\\AutorCurso autCur '
                      .' join autCur.autor aut '
                      .' join aut.usuario usu where usu.idUsuario = ?1 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $autor_id);
                
            }

                $autor_curso = $query->getOneOrNullResult();

                return $autor_curso;
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage());
        }
    }
    
    public function find_all_by($autor_id, $curso_id = null) {
    
        try {
            
            if ($curso_id != null) {
                
                $dql = 'select autCur, aut, cur, usu from Entity\\AutorCurso autCur '
                      .' join autCur.curso cur '
                      .' join autCur.autor aut '
                      .' join aut.usuario usu where cur.idCurso = ?1 and usu.idUsuario = ?2';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $curso_id);
                $query->setParameter(2, $autor_id);

            }
            
            else {
                
                $sql = 'select autCur, aut from Entity\\AutorCurso autCur '
                      .' join autCur.autor aut '
                      .' join aut.usuario usu where usu.idUsuario = ?1 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $autor_id);
            }

            $autor_curso = $query->getResult();
            return $autor_curso;
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage());
        }
    }
    
    
    /**
     * TODO: POSSIBLIDADE DE COLOCAR ESTE MÉTODO EM DAO PAI
     * 
     * Possivel saída
     * [
     *           1           => "2",
     *           "idUsuario" => 534
     *   ]
     * @param type $autor_id
     * @return type
     */
    private function get_max_seq($autor_id) {
        
        try {
            
            $query = $this->em->createQuery("select max(ac.seq), usu.idUsuario "
                    . "from Entity\AutorCurso ac join ac.autor aut join aut.usuario usu where usu.idUsuario = :autor_id ");
            $query->setParameter('autor_id', $autor_id);

            $max_seq = $query->getResult();
            
            $max_seq = $max_seq == null ? 0 : $max_seq;
            $max_seq = $max_seq[0] == null ? 0 : $max_seq[0];
            $max_seq = $max_seq[1] == null ? 0 : $max_seq[1];
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage());
        }
        
        
        
        
        return $max_seq;
    }
    
    /**
     * Cria um vínculo entre um autor e seu curso
     * @param Entity\AutorCurso $autor_curso
     * @return int o número da sequência de cursos
     */
    public function insert(Entity\AutorCurso $autor_curso) {
        
        try {
            
            //** verifica se autor e curso já está cadastrado ***
            $autor_curso_orig =  $this->find_one_by($autor_curso->getAutor()->getUsuario()->getIdUsuario(), 
                    $autor_curso->getCurso()->getIdCurso());
            
            if ($autor_curso_orig != null) {
                throw new Exception ("Entity autor_curso já existe - autor_curso_dao::insert ", 1);
            }
            // ************************************************
            
            
            // ** busca a sequência de cursos que o autor já possui
            $seq = $this->get_max_seq($autor_curso->getAutor()->getUsuario()->getIdUsuario());
            
            if ($seq == null) {
                $seq = 0;
            }
            $autor_curso->setSeq(++$seq);
            //**************************************************
            
            $autor_curso->setStatus(1);
            
            $this->em->persist($autor_curso);
            $this->em->flush();
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage());
        }
        
        return $autor_curso->getSeq();
    }
    
    /**
     * Atualiza a tabela de relação entre autores e seus respectivos cursos 
     * cadastrados
     * 
     * @param Entity\AutorCurso $autor_curso
     * @return int o número da sequência de inserções 
     */
    public function update(Entity\AutorCurso $autor_curso) {
        
        try {
            
            $autor_curso->setStatus(1);
            $this->em->persist($autor_curso);
            
        } catch (Exception $ex) {
            $this->CI->log->write_log('error', $ex->getMessage());
        }
        
        return $autor_curso->getSeq();
    }
}