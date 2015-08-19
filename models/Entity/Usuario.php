<?php

namespace Entity;
use JsonSerializable;

/**
 * Usuario Model
 * @Entity
 * @Table(name="usuario")
 */
class Usuario implements JsonSerializable
{
    /**
     * @var string
     * @Column(type="string")
     */
    private $cpf;

    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var string
     * @Column(type="string")
     */
    private $senha;

    /**
     * @var string
     * @Column(type="string")
     */
    private $email;

    /**
     * @Id
     * @var integer
     * @Column(type="integer", name="id_usuario", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    private $idUsuario;
    
    /**
     * @var Voluntario
     * @OneToOne(targetEntity="Voluntario", mappedBy="usuario")
     **/
    private $voluntario;

    /**
     * @var Autor
     * @OneToOne(targetEntity="Autor", mappedBy="usuario")
     */
    private $autor;

    
    /**
     * @OneToOne(targetEntity="Orientador", mappedBy="usuario")
     **/
    private $orientador;

    /**
     * @var Avaliador
     * @OneToOne(targetEntity="Avaliador", mappedBy="usuario")
     */
    private $avaliador;


    /**
     * @OneToOne(targetEntity="Organizador", mappedBy="usuario")
     **/
    private $organizador;

    /**
     * @OneToOne(targetEntity="Revisor", mappedBy="usuario")
     **/
    private $revisor;

    /**
     * @OneToOne(targetEntity="Ouvinte", mappedBy="usuario")
     **/
    private $ouvinte;

    /**
     * Set cpf
     *
     * @param string $cpf
     * @return Usuario
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @return Autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    
    public function setAutor(Autor $autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return Orientador
     */
    public function getOrientador()
    {
        return $this->orientador;
    }

    public function setOrientador(Orientador $orientador)
    {
        $this->orientador = $orientador;
    }

    /**
     * @return Avaliador
     */
    public function getAvaliador()
    {
        return $this->avaliador;
    }

    
    public function setAvaliador(Avaliador $avaliador)
    {
        $this->avaliador = $avaliador;
    }

    /**
     * @param int $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    
    /**
     * 
     * @return Voluntario
     */
    public function getVoluntario() {
        return $this->voluntario;
    }

    /**
     * 
     * @return Organizador
     */
    public function getOrganizador() {
        return $this->organizador;
    }

    /**
     * 
     * @return Revisor
     */
    public function getRevisor() {
        return $this->revisor;
    }

    /**
     * 
     * @return Ouvinte
     */
    public function getOuvinte() {
        return $this->ouvinte;
    }

    public function setVoluntario(Voluntario $voluntario) {
        $this->voluntario = $voluntario;
        return $this;
    }

    public function setOrganizador(Organizador $organizador) {
        $this->organizador = $organizador;
        return $this;
    }

    public function setRevisor(Revisor $revisor) {
        $this->revisor = $revisor;
        return $this;
    }

    public function setOuvinte(Ouvinte $ouvinte) {
        $this->ouvinte = $ouvinte;
        return $this;
    }

    
    public function jsonSerialize() {
        return array ("id_usuario" => $this->getIdUsuario(),
                      "cpf" => $this->getCpf(),
                      "nome" => $this->getNome(),
                      "senha" => $this->getSenha(),
                      "email" => $this->getEmail());
                      
    }

}
