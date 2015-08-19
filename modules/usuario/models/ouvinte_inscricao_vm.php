<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ouvinte_inscricao_vm extends CI_Model {

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

	public function populate () {

		$this->setCpf($this->input->post('cpf'));
		$this->setNome($this->input->post('nome'));
		$this->setEmail($this->input->post('email'));
		$this->setSenha($this->input->post('senha'));
		$this->setTipoOuvinte($this->input->post('tipo_ouvinte'));
		$this->setInstituicao($this->input->post('instituicao'));
		$this->setCampus($this->input->post('campus'));
		$this->setCurso($this->input->post('curso'));
		$this->setEmpresa($this->input->post('empresa'));
		$this->setOutro($this->input->post('outro'));
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
		
		$tipo_ouvinte = $this->getTipoOuvinte();
		if ($tipo_ouvinte < 1 || $tipo_ouvinte > 4) {
			throw new Exception('Tipo de ouvinte inválido', 4);
		}
		

		return true;

	}

	public function loadUsuario()
	{
		$usuario = new \Entity\Usuario();

		$usuario->setCpf($this->getCpf());
		$usuario->setEmail($this->getEmail());
		$usuario->setNome($this->getNome());
		$usuario->setSenha($this->getSenha());

		return $usuario;
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
     * Gets the value of cpf.
     *
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Sets the value of cpf.
     *
     * @param mixed $cpf the cpf
     *
     * @return self
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of tipo_ouvinte.
     *
     * @return mixed
     */
    public function getTipoOuvinte()
    {
        return $this->tipo_ouvinte;
    }

    /**
     * Sets the value of tipo_ouvinte.
     *
     * @param mixed $tipo_ouvinte the tipo ouvinte
     *
     * @return self
     */
    public function setTipoOuvinte($tipo_ouvinte)
    {
        $this->tipo_ouvinte = $tipo_ouvinte;

        return $this;
    }



    /**
     * Gets the value of curso.
     *
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Sets the value of curso.
     *
     * @param mixed $curso the curso
     *
     * @return self
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Gets the value of empresa.
     *
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Sets the value of empresa.
     *
     * @param mixed $empresa the empresa
     *
     * @return self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Gets the value of outro.
     *
     * @return mixed
     */
    public function getOutro()
    {
        return $this->outro;
    }

    /**
     * Sets the value of outro.
     *
     * @param mixed $outro the outro
     *
     * @return self
     */
    public function setOutro($outro)
    {
        $this->outro = $outro;

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
}

/* End of file ouvinte_inscricao_vm.php */
/* Location: ./application/models/ouvinte_inscricao_vm.php */