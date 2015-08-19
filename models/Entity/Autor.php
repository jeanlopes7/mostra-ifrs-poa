<?php

namespace Entity;
use JsonSerializable;

/**
 * Autor Model
 * * @Entity
 * @Table(name="autor")
 */
class Autor implements JsonSerializable
{
    /**
     * @Id
     * @OneToOne(targetEntity="Usuario", inversedBy="autor")
     * @JoinColumn(name="fk_usuario", referencedColumnName="id_usuario")
     **/
    protected $usuario;

    /**
     * @OneToMany(targetEntity="AutorCurso", mappedBy="autor")
     */
    
    protected $autorCurso;

    /**
     * Set fkUsuario
     *
     * @param Usuario $usuario
     * @return Autor
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get fkUsuario
     *
     * @return EntityUsuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getAutorCurso() {
        return $this->autorCurso;
    }

    public function setAutorCurso(AutorCurso $autorCurso) {
        $this->autorCurso = $autorCurso;
    }

    public function jsonSerialize() {
        
        return $this->getUsuario();
    }


    

}
