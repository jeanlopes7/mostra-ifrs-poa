<<<<<<< HEAD
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voluntario_insc_incr_vm extends CI_Model {

	/**
	 * se o voluntário tem o turno da manhã
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $manha_disponivel;

	/**
	 * se o voluntário tem o turno da tarde
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $tarde_disponivel;

	/**
	 * se o voluntário tem o turno da noite
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $noite_disponivel;

    /**
     * o curso do voluntário
     * @var int
     */
    private $curso;

    /**
     * o telefone 1 do voluntário
     * @var string
     */
    private $telefone1;

    /**
     * o telefone 2 do voluntário
     * @var string
     */
    private $telefone2;

    /**
     * o telefone 3 do voluntário
     * @var string
     */
    private $telefone3;

    /**
     * observações
     * @var string
     */
    private $observacoes;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function populate()
	{
		$this->setManhaDisponivel($this->input->post('manha') !== false);
		$this->setTardeDisponivel($this->input->post('tarde') !== false);
		$this->setNoiteDisponivel($this->input->post('noite') !== false);
        $this->setTelefone1($this->input->post('telefone1'));
        $this->setTelefone2($this->input->post('telefone2'));
        $this->setTelefone3($this->input->post('telefone3'));
        $this->setCurso($this->input->post('curso'));
        $this->setObservacoes($this->input->post('observacoes'));
	}


    public function validate() {

        if (!$this->getManhaDisponivel() && !$this->getTardeDisponivel() && !$this->getNoiteDisponivel()) {
            throw new Exception('Por favor, preencha disponibilidade em pelo menos um dos turnos', 4);
        }

        /*
         * * Não funciona em versão menor que 5.5 e no PC local Win XP não existe XAMPP 5.5.
        if (empty($this->getTelefone1()) && empty($this->getTelefone2()) && empty($this->getTelefone3())) {
            throw new Exception("Por favor, preencha pelo menos um telefone", 4);
        }

       if (empty($this->getCurso())) {
            throw new Exception("por favor, preencha com algum curso", 4);
        }
         * */
        
    }//validate()

    public function loadVoluntario()
    {
        $voluntario = new \Entity\Voluntario();

        $voluntario->setManha($this->getManhaDisponivel());
        $voluntario->setTarde($this->getTardeDisponivel());
        $voluntario->setNoite($this->getNoiteDisponivel());
        $voluntario->setTelefone1($this->getTelefone1());
        $voluntario->setTelefone2($this->getTelefone2());
        $voluntario->setTelefone3($this->getTelefone3());
        $voluntario->setObservacoes($this->getObservacoes());

        return $voluntario;
    }



	/**
     * Gets the se o voluntário tem o turno da manhã
	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getManhaDisponivel()
    {
        return $this->manha_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da manhã
  	 * disponível para trabalhar.
     *
     * @param boolean $manha_disponivel the manha disponivel
     *
     * @return self
     */
    public function setManhaDisponivel($manha_disponivel)
    {
        $this->manha_disponivel = $manha_disponivel;

        return $this;
    }

    /**
     * Gets the se o voluntário tem o turno da tarde
 	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getTardeDisponivel()
    {
        return $this->tarde_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da tarde
 	 * disponível para trabalhar.
     *
     * @param boolean $tarde_disponivel the tarde disponivel
     *
     * @return self
     */
    public function setTardeDisponivel($tarde_disponivel)
    {
        $this->tarde_disponivel = $tarde_disponivel;

        return $this;
    }

    /**
     * Gets the se o voluntário tem o turno da noite
 	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getNoiteDisponivel()
    {
        return $this->noite_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da noite
	 * disponível para trabalhar.
     *
     * @param boolean $noite_disponivel the noite disponivel
     *
     * @return self
     */
    public function setNoiteDisponivel($noite_disponivel)
    {
        $this->noite_disponivel = $noite_disponivel;

        return $this;
    }


    /**
     * Gets the observações.
     *
     * @return string
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Sets the observações.
     *
     * @param string $observacoes the observacoes
     *
     * @return self
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Gets the o curso do voluntário.
     *
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Sets the o curso do voluntário.
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
     * Gets the o telefone 1 do voluntário.
     *
     * @return string
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Sets the o telefone 1 do voluntário.
     *
     * @param string $telefone1 the telefone1
     *
     * @return self
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Gets the o telefone 2 do voluntário.
     *
     * @return string
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Sets the o telefone 2 do voluntário.
     *
     * @param string $telefone2 the telefone2
     *
     * @return self
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Gets the o telefone 3 do voluntário.
     *
     * @return string
     */
    public function getTelefone3()
    {
        return $this->telefone3;
    }

    /**
     * Sets the o telefone 3 do voluntário.
     *
     * @param string $telefone3 the telefone3
     *
     * @return self
     */
    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;

        return $this;
    }
}

/* End of file voluntario_insc_incr_vm.php */
/* Location: ./application/models/voluntario_insc_incr_vm.php */
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voluntario_insc_incr_vm extends CI_Model {

	/**
	 * se o voluntário tem o turno da manhã
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $manha_disponivel;

	/**
	 * se o voluntário tem o turno da tarde
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $tarde_disponivel;

	/**
	 * se o voluntário tem o turno da noite
	 * disponível para trabalhar
	 * @var boolean
	 */
	private $noite_disponivel;

    /**
     * o curso do voluntário
     * @var int
     */
    private $curso;

    /**
     * o telefone 1 do voluntário
     * @var string
     */
    private $telefone1;

    /**
     * o telefone 2 do voluntário
     * @var string
     */
    private $telefone2;

    /**
     * o telefone 3 do voluntário
     * @var string
     */
    private $telefone3;

    /**
     * observações
     * @var string
     */
    private $observacoes;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function populate()
	{
		$this->setManhaDisponivel($this->input->post('manha') !== false);
		$this->setTardeDisponivel($this->input->post('tarde') !== false);
		$this->setNoiteDisponivel($this->input->post('noite') !== false);
        $this->setTelefone1($this->input->post('telefone1'));
        $this->setTelefone2($this->input->post('telefone2'));
        $this->setTelefone3($this->input->post('telefone3'));
        $this->setCurso($this->input->post('curso'));
        $this->setObservacoes($this->input->post('observacoes'));
	}


    public function validate() {

        if (!$this->getManhaDisponivel() && !$this->getTardeDisponivel() && !$this->getNoiteDisponivel()) {
            throw new Exception('Por favor, preencha disponibilidade em pelo menos um dos turnos', 4);
        }

        if (empty($this->getTelefone1()) && empty($this->getTelefone2()) && empty($this->getTelefone3())) {
            throw new Exception("Por favor, preencha pelo menos um telefone", 4);
            
        }

        if (empty($this->getCurso())) {
            throw new Exception("por favor, preencha com algum curso", 4);
        }
    }

    public function loadVoluntario()
    {
        $voluntario = new \Entity\Voluntario();

        $voluntario->setManha($this->getManhaDisponivel());
        $voluntario->setTarde($this->getTardeDisponivel());
        $voluntario->setNoite($this->getNoiteDisponivel());
        $voluntario->setTelefone1($this->getTelefone1());
        $voluntario->setTelefone2($this->getTelefone2());
        $voluntario->setTelefone3($this->getTelefone3());
        $voluntario->setObservacoes($this->getObservacoes());

        return $voluntario;
    }



	/**
     * Gets the se o voluntário tem o turno da manhã
	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getManhaDisponivel()
    {
        return $this->manha_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da manhã
  	 * disponível para trabalhar.
     *
     * @param boolean $manha_disponivel the manha disponivel
     *
     * @return self
     */
    public function setManhaDisponivel($manha_disponivel)
    {
        $this->manha_disponivel = $manha_disponivel;

        return $this;
    }

    /**
     * Gets the se o voluntário tem o turno da tarde
 	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getTardeDisponivel()
    {
        return $this->tarde_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da tarde
 	 * disponível para trabalhar.
     *
     * @param boolean $tarde_disponivel the tarde disponivel
     *
     * @return self
     */
    public function setTardeDisponivel($tarde_disponivel)
    {
        $this->tarde_disponivel = $tarde_disponivel;

        return $this;
    }

    /**
     * Gets the se o voluntário tem o turno da noite
 	 * disponível para trabalhar.
     *
     * @return boolean
     */
    public function getNoiteDisponivel()
    {
        return $this->noite_disponivel;
    }

    /**
     * Sets the se o voluntário tem o turno da noite
	 * disponível para trabalhar.
     *
     * @param boolean $noite_disponivel the noite disponivel
     *
     * @return self
     */
    public function setNoiteDisponivel($noite_disponivel)
    {
        $this->noite_disponivel = $noite_disponivel;

        return $this;
    }


    /**
     * Gets the observações.
     *
     * @return string
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Sets the observações.
     *
     * @param string $observacoes the observacoes
     *
     * @return self
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Gets the o curso do voluntário.
     *
     * @return int
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Sets the o curso do voluntário.
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
     * Gets the o telefone 1 do voluntário.
     *
     * @return string
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Sets the o telefone 1 do voluntário.
     *
     * @param string $telefone1 the telefone1
     *
     * @return self
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Gets the o telefone 2 do voluntário.
     *
     * @return string
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Sets the o telefone 2 do voluntário.
     *
     * @param string $telefone2 the telefone2
     *
     * @return self
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Gets the o telefone 3 do voluntário.
     *
     * @return string
     */
    public function getTelefone3()
    {
        return $this->telefone3;
    }

    /**
     * Sets the o telefone 3 do voluntário.
     *
     * @param string $telefone3 the telefone3
     *
     * @return self
     */
    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;

        return $this;
    }
}

/* End of file voluntario_insc_incr_vm.php */
/* Location: ./application/models/voluntario_insc_incr_vm.php */
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
