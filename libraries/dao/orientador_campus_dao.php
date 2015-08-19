<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Classe de acesso a dados Orientador_campus
 */
class Orientador_campus_dao {
    
    /**
     * @access private
     */
    private $CI;
    
    /**
     * @access private
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;
    
    const REPOSITORY = 'Entity\OrientadorCampus';
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em =& $this->CI->doctrine->em;
    }
    
    public function find_one_by($orientador_id, $campus_id = null) {
        try {

            if ($campus_id != null) {
            
                $dql = 'select oriCam, cam, ori, usu from Entity\\OrientadorCampus oriCam '.
                       ' join oriCam.campus cam ' .
                       ' join oriCam.orientador ori  ' .
                       ' join ori.usuario usu where cam.idCampus = ?1 and usu.idUsuario = ?2 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $campus_id);
                $query->setParameter(2, $orientador_id);
            }
            
            else {
                
                $dql = 'select oriCam, ori, usu from Entity\\OrientadorCampus oriCam ' .
                       ' join oriCam.orientador ori  ' .
                       ' join ori.usuario usu where usu.idUsuario = ?1 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $orientador_id);
            }

            $orientador_campus = $query->getOneOrNullResult();

            return $orientador_campus;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_campus_dao::find_one_by ');
        }
    }
    
    public function find_all_by($orientador_id, $campus_id = null) {
    
        try {
            
            if ($campus_id != null) {

                $dql = 'select oriCam, cam, ori, usu from Entity\\OrientadorCampus oriCam '.
                       ' join oriCam.campus cam ' .
                       ' join oriCam.orientador ori  ' .
                       ' join ori.usuario usu where cam.idCampus = ?1 and usu.idUsuario = ?2 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $campus_id);
                $query->setParameter(2, $orientador_id);
                $orientador_campus = $query->getResult();

                return $orientador_campus;
            }
            
            else {

                $dql = 'select oriCam, ori, usu from Entity\\OrientadorCampus oriCam ' .
                       ' join oriCam.orientador ori  ' .
                       ' join ori.usuario usu where usu.idUsuario = ?1 ';

                $query = $this->em->createQuery($dql);
                $query->setParameter(1, $orientador_id);
                $orientador_campus = $query->getResult();

                return $orientador_campus;
            }
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_campus_dao::find_all_by ');
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
     * @param type $orientador_id
     * @return type
     */
    private function get_max_seq($orientador_id) {
        
        try {
            
            $query = $this->em->createQuery("select max(oc.seq), usu.idUsuario "
                    . "from Entity\OrientadorCampus oc join oc.orientador ori join ori.usuario usu where usu.idUsuario = :orientador_id ");
            $query->setParameter('orientador_id', $orientador_id);

            $max_seq = $query->getResult();
            
            $max_seq = $max_seq == null ? 0 : $max_seq;
            $max_seq = $max_seq[0] == null ? 0 : $max_seq[0];
            $max_seq = $max_seq[1] == null ? 0 : $max_seq[1];
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_campus_dao::get_max_seq ');
        }
        return $max_seq;
    }
    
    /**
     * Cria um vínculo entre um orientador e seu campus
     * @param Entity\OrientadorCampus $orientador_campus
     * @return int o número da sequência de campi
     */
    public function insert(Entity\OrientadorCampus $orientador_campus) {
        
        try {
            
            //** verifica se orientador e campus já está cadastrado ***
            $orientador_campus_orig =  $this->find_one_by($orientador_campus->getOrientador()->getUsuario()->getIdUsuario(), 
                    $orientador_campus->getCampus()->getIdCampus());
            
            if ($orientador_campus_orig != null) {
                throw new Exception ("Entity já existe", 1);
            }
            // ************************************************
            
            
            // ** busca a sequência de cursos que o autor já possui
            $seq = $this->get_max_seq($orientador_campus->getOrientador()->getUsuario()->getIdUsuario());
            
            if ($seq == null) {
                $seq = 0;
            }
            $orientador_campus->setSeq(++$seq);
            //**************************************************
            
            $orientador_campus->setStatus(1);
            
            $this->em->persist($orientador_campus);
            $this->em->flush();
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_campus_dao::insert ');
        }
        
        return $orientador_campus->getSeq();
    }
    
    /**
     * Atualiza a tabela de relação entre orientadores e seus respectivos campi 
     * cadastrados
     * 
     * @param Entity\OrientadorCampus $orientador_campus
     * @return int o número da sequência de inserções 
     */
    public function update(Entity\OrientadorCampus $orientador_campus) {
        
        try {
            
            $orientador_campus->setStatus(1);
            $this->em->persist($orientador_campus);
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - orientador_campus_dao::update ');
        }
        
        return $orientador_campus->getSeq();
    }
}