
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voluntario_inscricao_vm extends CI_Model {

	/**
	 * cadastro de pessoa física do ouvinte
	 * @var string
	 */
	private $cpf;

	/**
	 * nome do ouvinte
	 * @var string
	 */
	private $nome;

	/**
	 * senha do ouvinte
	 * @var string
	 */
	private $senha;

	/**
	 * email do ouvinte
	 * @var string
	 */
	private $email;

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
     * telefone 1
     * @var string
     */
    private $telefone1;

    /**
     * telefone 2
     * @var string
     */
    private $telefone2;

    /**
     * telefone 3
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
		$this->load->helper('string_func');
		
	}

	public function populate()
	{
		$this->setCpf($this->input->post('cpf'));
		$this->setNome($this->input->post('nome'));
		$this->setEmail($this->input->post('email'));
		$this->setSenha($this->input->post('senha'));
		$this->setManhaDisponivel($this->input->post('manha') !== false);
		$this->setTardeDisponivel($this->input->post('tarde') !== false);
		$this->setNoiteDisponivel($this->input->post('noite') !== false);
        $this->setTelefone1($this->input->post('telefone1'));
        $this->setTelefone2($this->input->post('telefone2'));
        $this->setTelefone3($this->input->post('telefone3'));
        $this->setCurso($this->input->post('curso'));
        $this->setObservacoes($this->input->post('observacoes'));
	}

	public function validate()
	{
		$cpf = valida_cpf($this->getCpf());
		if (!$cpf) {
			throw new Exception('CPF inválido.', 4);
		}
		$this->setCpf($cpf);
		if (strlen($this->getNome()) < 4) {
			throw new Exception('Nome inválido', 4);
		}

		$data = $this->input->post();
		if (strlen($this->getEmail()) < 4 || comparar_email_confirmacao($data)) {
			throw new Exception('Email inválido', 4);
		}
		if (strlen($this->getSenha()) < 3 || comparar_senha_confirmacao($data)) {
			throw new Exception('Senha inválida', 4);
		}

<<<<<<< HEAD
=======
        //eval(\Psy\sh());
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        if (!$this->getManhaDisponivel() && !$this->getTardeDisponivel() && !$this->getNoiteDisponivel()) {
            throw new Exception('Por favor, preencha disponibilidade em pelo menos um dos turnos', 4);
        }

<<<<<<< HEAD
        /*
         * * Não funciona em versão menor que 5.5 e no PC local Win XP não existe XAMPP 5.5.
        if (empty($this->getTelefone1()) && empty($this->getTelefone2()) && empty($this->getTelefone3())) {
            throw new Exception("Por favor, preencha pelo menos um telefone", 4);
=======
        if (empty($this->getTelefone1()) && empty($this->getTelefone2()) && empty($this->getTelefone3())) {
            throw new Exception("Por favor, preencha pelo menos um telefone", 4);
            
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
        }

        if (empty($this->getCurso())) {
            throw new Exception("por favor, preencha com algum curso", 4);
        }
<<<<<<< HEAD
         *
         */
        
	}//validate()
=======
	}
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e

     /**
     * Constroi uma nova Entity usuario com base nos dados da view-model
     * @return \Usuario
     */
    public function loadUsuario() {
        $usuario = new Entity\Usuario;
        $usuario->setCpf($this->getCpf());
        $usuario->setEmail($this->getEmail());
        $usuario->setNome($this->getNome());
        $usuario->setSenha($this->getSenha());
        
        return $usuario;
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
     * Gets the cadastro de pessoa física do ouvinte.
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Sets the cadastro de pessoa física do ouvinte.
     *
     * @param string $cpf the cpf
     *
     * @return self
     */
    public function  setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Gets the nome do ouvinte.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the nome do ouvinte.
     *
     * @param string $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the senha do ouvinte.
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the senha do ouvinte.
     *
     * @param string $senha the senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Gets the email do ouvinte.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email do ouvinte.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * Gets the value of telefone1.
     *
     * @return mixed
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * Sets the value of telefone1.
     *
     * @param mixed $telefone1 the telefone1
     *
     * @return self
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Gets the value of telefone2.
     *
     * @return mixed
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Sets the value of telefone2.
     *
     * @param mixed $telefone2 the telefone2
     *
     * @return self
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Gets the value of telefone3.
     *
     * @return mixed
     */
    public function getTelefone3()
    {
        return $this->telefone3;
    }

    /**
     * Sets the value of telefone3.
     *
     * @param mixed $telefone3 the telefone3
     *
     * @return self
     */
    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;

        return $this;
    }

    /**
     * Gets the value of observacoes.
     *
     * @return mixed
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Sets the value of observacoes.
     *
     * @param mixed $observacoes the observacoes
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
}

/* End of file voluntario_inscricao_vm.php */
<<<<<<< HEAD
/* Location: ./application/models/voluntario_inscricao_vm.php */
=======
/* Location: ./application/models/voluntario_inscricao_vm.php */
>>>>>>> f9b405479b0aa4f88530d1c9535f52b197308e2e
