<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouvinte_insc_incr_vm extends CI_Model {

	/**
	 * tipo de ouvinte
	 * @var int
	 */
	private $tipo_ouvinte;

	/**
	 * instituicao do ouvinte;
	 * @var int
	 */
	private $instituicao;

	/**
	 * campus do ouvinte;
	 * @var int
	 */
	private $campus;

	/**
	 * curso do ouvinte
	 * @var int
	 */
	private $curso;

	/**
	 * empresa do ouvinte
	 * @var string
	 */
	private $empresa;

	/**
	 * ???
	 * @var string
	 */
	private $outro;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string_func');		
	}

	public function populate()
	{
		$this->setTipoOuvinte($this->input->post('tipo_ouvinte'));
		$this->setCurso($this->input->post('curso'));
		$this->setEmpresa($this->input->post('empresa'));
		$this->setOutro($this->input->post('outro'));
	}

	public function validate() {

		$tipo_ouvinte = $this->getTipoOuvinte();
		if ($tipo_ouvinte < 1 || $tipo_ouvinte > 3) {
			throw new Exception('Tipo de ouvinte inválido', 4);
		}
		

		return true;
	}

	public function loadOuvinte()
	{
		$ouvinte = new \Entity\Ouvinte();
		$ouvinte->setTipoOuvinte($this->getTipoOuvinte());
		$ouvinte->setEmpresa($this->getEmpresa());
		$ouvinte->setOutro($this->getOutro());

		return $ouvinte;
	}


    /**
     * Gets the tipo de ouvinte.
     *
     * @return int
     */
    public function getTipoOuvinte()
    {
        return $this->tipo_ouvinte;
    }

    /**
     * Sets the tipo de ouvinte.
     *
     * @param int $tipo_ouvinte the tipo ouvinte
     *
     * @return self
     */
    public function setTipoOuvinte($tipo_ouvinte)
    {
        $this->tipo_ouvinte = $tipo_ouvinte;

        return $this;
    }

    /**
     * Gets the instituicao do ouvinte;.
     *
     * @return int
     */
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Sets the instituicao do ouvinte;.
     *
     * @param int $instituicao the instituicao
     *
     * @return self
     */
    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * Gets the campus do ouvinte;.
     *
     * @return int
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * Sets the campus do ouvinte;.
     *
     * @param int $campus the campus
     *
     * @return self
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;

        return $this;
    }

    /**
     * Gets the curso do ouvinte.
     *
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Sets the curso do ouvinte.
     *
     * @param int $curso the curso
     *
     * @return self
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Gets the empresa do ouvinte.
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Sets the empresa do ouvinte.
     *
     * @param string $empresa the empresa
     *
     * @return self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Gets the ???.
     *
     * @return string
     */
    public function getOutro()
    {
        return $this->outro;
    }

    /**
     * Sets the ???.
     *
     * @param string $outro the outro
     *
     * @return self
     */
    public function setOutro($outro)
    {
        $this->outro = $outro;

        return $this;
    }
}

/* End of file ouvinte_insc_incr_vm.php */
/* Location: ./application/models/ouvinte_insc_incr_vm.php */