<?php

namespace Entity;


/**
 * Class TrabalhoAutorCurso
 * @package Entity
 * @Entity
 * @Table(name="trabalho_autor_curso")
 */
class TrabalhoAutorCurso {

  //GAMBIARRA Alexdg
  public $fk_trabalho;
  public $fk_autor;
  public $fk_curso;

    /**
     * @var Trabalho
     * @Id
     * @ManyToOne(targetEntity="Trabalho")
     * @JoinColumn(name="fk_trabalho", referencedColumnName="id_trabalho")
     */
    private $trabalho;

    /**
     * @var Autor
     * @Id
     * @ManyToOne(targetEntity="Autor")
     * @JoinColumn(name="fk_autor", referencedColumnName="fk_usuario")
     */
    private $autor;

    /**
     * @var Curso
     * @ManyToOne(targetEntity="Curso")
     * @JoinColumn(name="fk_curso", referencedColumnName="id_curso", nullable=false)
     */
    private $curso;

    /**
     * @var integer
     * @Column(type="integer", name="seq", nullable=false)
     * 1=autor responsavel 2=segundo autor 3=terceiro autor
     */
    private $sequencia;


    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $email_trabalho;

    /**
     * @return Trabalho
     */
    public function getTrabalho()
    {
        return $this->trabalho;
    }

    /**
     * @param Trabalho $trabalho
     */
    public function setTrabalho($trabalho)
    {
        $this->trabalho = $trabalho;
    }

    /**
     * @return Autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param Autor $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param Curso $curso
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }

    /**
     * @return int
     */
    public function getSequencia()
    {
        return $this->sequencia;
    }

    /**
     * @param int $sequencia
     */
    public function setSequencia($sequencia)
    {
        $this->sequencia = $sequencia;
    }

    /**
     * @return string
     */
    public function getEmailTrabalho()
    {
        return $this->email_trabalho;
    }

    /**
     * @param string $email_trabalho
     */
    public function setEmailTrabalho($email_trabalho)
    {
        $this->email_trabalho = $email_trabalho;
    }
    
    /********************************************************
     * GAMBIARRA Alexdg
     ********************************************************/

    function getFk_trabalho() {
      return $this->fk_trabalho;
    }
     function getFk_autor() {
      return $this->fk_autor;
    }
     function getFk_curso() {
      return $this->fk_curso;
    }

    function setFk_trabalho($fk_trabalho) {
      $this->fk_trabalho = $fk_trabalho;
    }
     function setFk_autor($fk_autor) {
      $this->fk_autor = $fk_autor;
    }
     function setFk_curso($fk_curso) {
      $this->fk_curso = $fk_curso;
    }


}