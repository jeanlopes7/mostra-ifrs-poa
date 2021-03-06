<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Usuario extends \Entity\Usuario implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setCpf($cpf)
    {
        $this->__load();
        return parent::setCpf($cpf);
    }

    public function getCpf()
    {
        $this->__load();
        return parent::getCpf();
    }

    public function setNome($nome)
    {
        $this->__load();
        return parent::setNome($nome);
    }

    public function getNome()
    {
        $this->__load();
        return parent::getNome();
    }

    public function setSenha($senha)
    {
        $this->__load();
        return parent::setSenha($senha);
    }

    public function getSenha()
    {
        $this->__load();
        return parent::getSenha();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function getIdUsuario()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["idUsuario"];
        }
        $this->__load();
        return parent::getIdUsuario();
    }

    public function getAutor()
    {
        $this->__load();
        return parent::getAutor();
    }

    public function setAutor(\Entity\Autor $autor)
    {
        $this->__load();
        return parent::setAutor($autor);
    }

    public function getOrientador()
    {
        $this->__load();
        return parent::getOrientador();
    }

    public function setOrientador(\Entity\Orientador $orientador)
    {
        $this->__load();
        return parent::setOrientador($orientador);
    }

    public function getAvaliador()
    {
        $this->__load();
        return parent::getAvaliador();
    }

    public function setAvaliador(\Entity\Avaliador $avaliador)
    {
        $this->__load();
        return parent::setAvaliador($avaliador);
    }

    public function setIdUsuario($idUsuario)
    {
        $this->__load();
        return parent::setIdUsuario($idUsuario);
    }

    public function getVoluntario()
    {
        $this->__load();
        return parent::getVoluntario();
    }

    public function getOrganizador()
    {
        $this->__load();
        return parent::getOrganizador();
    }

    public function getRevisor()
    {
        $this->__load();
        return parent::getRevisor();
    }

    public function getOuvinte()
    {
        $this->__load();
        return parent::getOuvinte();
    }

    public function setVoluntario(\Entity\Voluntario $voluntario)
    {
        $this->__load();
        return parent::setVoluntario($voluntario);
    }

    public function setOrganizador(\Entity\Organizador $organizador)
    {
        $this->__load();
        return parent::setOrganizador($organizador);
    }

    public function setRevisor(\Entity\Revisor $revisor)
    {
        $this->__load();
        return parent::setRevisor($revisor);
    }

    public function setOuvinte(\Entity\Ouvinte $ouvinte)
    {
        $this->__load();
        return parent::setOuvinte($ouvinte);
    }

    public function jsonSerialize()
    {
        $this->__load();
        return parent::jsonSerialize();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'cpf', 'nome', 'senha', 'email', 'idUsuario', 'voluntario', 'autor', 'orientador', 'avaliador', 'organizador', 'revisor', 'ouvinte');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}