<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voluntario_dao {

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

	public function findVoluntarioByCPF($cpf) {

		try {

			$dql = "select vol, usu from Entity\\Voluntario vol join vol.usuario usu where usu.cpf = ?1";

			$query = $this->em->createQuery($dql);
			$query->setParameter(1, $cpf);

			$voluntario = $query->getOneOrNullResult();

			return $voluntario;
			
		} catch (Exception $ex) {

			$this->CI->log->write_log('error', $ex->getMessage() . ' - voluntario_dao::findVoluntarioByCPF ');
		}

		return null;
	}

	public function insert(\Entity\Voluntario $voluntario)
	{
		try {

			$this->em->persist($voluntario);
			$this->em->flush();

			return true;
			
		} catch (Exception $ex) {

			$this->CI->log->write_log('error', $ex->getMessage() . ' - voluntario_dao::insert ');
		}

		return false;
	}

}

/* End of file ouvinte_dao.php */
/* Location: ./application/models/ouvinte_dao.php */