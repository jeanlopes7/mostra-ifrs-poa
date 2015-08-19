<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouvinte_dao {

	private $CI;

	/**
	 * Entity Manager
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('doctrine');
		$this->em = $this->CI->doctrine->em;
	}

	public function findOuvinteByCPF($cpf) {

		try {

			$dql = "select ouv, usu from Entity\\Ouvinte ouv join ouv.usuario usu where usu.cpf = ?1";

			$query = $this->em->createQuery($dql);
			$query->setParameter(1, $cpf);

			$ouvinte = $query->getOneOrNullResult();

			return $ouvinte;
			
		} catch (Exception $ex) {

			$this->CI->log->write_log('error', $ex->getMessage() . ' - ouvinte_dao::findOuvinteByCPF ');
		}

		return null;
	}

	public function insert(\Entity\Ouvinte $ouvinte)
	{
		try {

			$this->em->persist($ouvinte);
			$this->em->flush();

			return true;
			
		} catch (Exception $ex) {

			$this->CI->log->write_log('error', $ex->getMessage() . ' - ouvinte_dao::insert ');
		}

		return false;
	}

}

/* End of file ouvinte_dao.php */
/* Location: ./application/models/ouvinte_dao.php */