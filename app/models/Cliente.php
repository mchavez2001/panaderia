<?php

class Cliente{
    private $id_cliente;
    private $dni;
    private $nom_cliente;
    private $apell_cliente;
    private $telef;
    private $direccion;
    private $sector;

    public function __construct($dni, $nom_cliente, $apell_cliente, $telef, $direccion, $sector)
    {
        $this->dni = $dni;
        $this->nom_cliente = $nom_cliente;
        $this->apell_cliente = $apell_cliente;
        $this->telef = $telef;
        $this->direccion = $direccion;
        $this->sector = $sector;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNom_cliente()
    {
        return $this->nom_cliente;
    }

    public function setNom_cliente($nom_cliente)
    {
        $this->nom_cliente = $nom_cliente;

        return $this;
    }

    public function getApell_cliente()
    {
        return $this->apell_cliente;
    }

    public function setApell_cliente($apell_cliente)
    {
        $this->apell_cliente = $apell_cliente;

        return $this;
    }

    public function getTelef()
    {
        return $this->telef;
    }

    public function setTelef($telef)
    {
        $this->telef = $telef;

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of sector
     */ 
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set the value of sector
     *
     * @return  self
     */ 
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }
}