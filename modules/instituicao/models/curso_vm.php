<?php

class Curso_vm extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    var $id_curso;
    var $nome;
    var $nivel;
    var $fk_campus;

    public function loadCurso() {
        $curso = new Entity\Curso();

        $curso->setNivel($this->getNivel());
        $curso->setNome($this->getNome());

        return $curso;
    }

    /**
     * @return mixed
     */
    public function getIdCurso()
    {
        return $this->id_curso;
    }

    /**
     * @param mixed $id_curso
     */
    public function setIdCurso($id_curso)
    {
        $this->id_curso = $id_curso;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->fk_campus;
    }

    /**
     * @param mixed $fk_campus
     */
    public function setCampus($fk_campus)
    {
        $this->fk_campus = $fk_campus;
    }
}