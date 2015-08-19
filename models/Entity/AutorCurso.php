<?php

namespace Entity;


/**
 * Class AutorCurso
 * @package Entity
 * @Entity
 * @Table(name="autor_curso")
 */
class AutorCurso {


    /**
     * @var integer
     * @Id
     * @ManyToOne(targetEntity="Autor")
     * @JoinColumn(name="fk_autor", referencedColumnName="fk_usuario")
     */
    private $autor;

    /**
     * @var integer
     * @Id
     * @ManyToOne(targetEntity="Curso")
     * @JoinColumn(name="fk_curso", referencedColumnName="id_curso")
     */
    private $curso;

    /**
     * @var integer
     * @Column
     */
    private $seq;

    /**
     * @var integer
     * @Column
     */
    private $status;

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param Autor $autor
     */
    public function setAutor(Autor $autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param Curso $curso
     */
    public function setCurso(Curso $curso)
    {
        $this->curso = $curso;
    }

    /**
     * @return mixed
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param mixed $seq
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}