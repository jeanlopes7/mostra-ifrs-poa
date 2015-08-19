<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaliador_dao {

	private $CI;

	/**
	 * Entity Manager
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;



	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->library('doctrine');
		$this->em = $this->CI->doctrine->em;

	}

	public function findAvaliadorByCPF($cpf)
	{
		try {
			
			$dql = "select ava, usu from Entity\\Avaliador ava join ava.usuario usu where usu.cpf = ?1";

			$query = $this->em->createQuery($dql);
			$query->setParameter(1, $cpf);

			$avaliador = $query->getOneOrNullResult();

			return $avaliador;

		} catch (Exception $ex) {
			
			$this->CI->log->write_log('error', $ex->getMessage() . ' - avaliador_dao::findAvaliadorByCPF ');
		}

		return null;
	}

	public function insert(\Entity\Avaliador $avaliador)
	{
		try {

			$this->em->persist($avaliador);
			$this->em->flush();
			return true;

		} catch (Exception $ex) {
			
			$this->CI->log->write_log('error', $ex->getMessage() . ' - avaliador_dao::insert ');
		}

		return false;
	}

}

/* End of file avaliador_dao.php */
/* Location: ./application/models/avaliador_dao.php */