<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * @property \Doctrine\ORM\EntityManager $em Doctrine Entity Manager ORM();
 */
class Instituicao_dao
{

    private $CI;
    private $em;
    const REPOSITORY = 'Entity\Instituicao';

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('doctrine');
        $this->em = $this->CI->doctrine->em;
    }

    public function find_all()
    {
        try {

            //$instituicao_list = $this->em->getRepository(Instituicao_dao::REPOSITORY)->findAll();
            //return $instituicao_list;
                    
            //$query = $this->em->createQuery("select id_instituicao, nome, sigla, cidade, estado, site, tipo from Entity\Instituicao order by sigla ");
            $query = $this->em->createQuery("select inst from Entity\\Instituicao inst order by inst.sigla");
            $instituicao_list = $query->getResult();
            return $instituicao_list;

        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::find_all ');
        }
        return null;
    }

    public function find_all_by($instituicao_id)
    {
        try {
            $curso = $this->em->find(Instituicao_dao::REPOSITORY, $instituicao_id);
            return $curso;
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::find_all_by ');
        }
        return null;
    }
    
    public function find_one_by($instituicao_id) {
        try {
            
            $inst = $this->em->getRepository(Instituicao_dao::REPOSITORY)
                    ->findOneBy(array('idInstituicao' => $instituicao_id));
            
            return $inst;
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::find_one_by ');
        }
        
        
        return null;
    }

    public function insert(Entity\Instituicao $instituicao)
    {
        try {

            $this->em->persist($instituicao);
            $this->em->flush();

            return true;


        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::insert ');
        }
        return false;
    }

    public function update(Entity\Instituicao $instituicao)
    {
        try {
            $this->em->merge($instituicao);
            $this->em->flush();
            
        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::update ');
        }
    }

    public function delete($instituicao_id)
    {
        try {

            $curso = $this->find_one_by($instituicao_id);
            $this->em->remove($curso);
            $this->em->flush();

        } catch (Exception $ex) {

            $this->CI->log->write_log('error', $ex->getMessage() . ' - instituicao_dao::delete ');
        }
    }

}