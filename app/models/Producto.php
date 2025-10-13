<?php

class Producto
{
    private $cod_prod;
    private $nom_prod;
    private $dscr_prod;
    private $cant_extra;
    private $tam_prod;
    private $cant_prod;
    private $precio;
    private $precio_tot;
    private $est;

    public function __construct($nom_prod, $dscr_prod, $cant_extra, $tam_prod, $cant_prod)
    {
        $this->nom_prod = $nom_prod;
        $this->dscr_prod = $dscr_prod;
        $this->cant_extra = $cant_extra;
        $this->tam_prod = $tam_prod;
        $this->cant_prod = $cant_prod;
    }

    public function getCod_prod()
    {
        return $this->cod_prod;
    }

    public function setCod_prod($cod_prod)
    {
        $this->cod_prod = $cod_prod;

        return $this;
    }

    public function getNom_prod()
    {
        return $this->nom_prod;
    }

    public function setNom_prod($nom_prod)
    {
        $this->nom_prod = $nom_prod;

        return $this;
    }

    public function getDscr_prod()
    {
        return $this->dscr_prod;
    }

    public function setDscr_prod($dscr_prod)
    {
        $this->dscr_prod = $dscr_prod;

        return $this;
    }

    public function getCant_extra()
    {
        return $this->cant_extra;
    }

    public function setCant_extra($cant_extra)
    {
        $this->cant_extra = $cant_extra;

        return $this;
    }

    public function getTam_prod()
    {
        return $this->tam_prod;
    }

    public function setTam_prod($tam_prod)
    {
        $this->tam_prod = $tam_prod;

        return $this;
    }

    public function getCant_prod()
    {
        return $this->cant_prod;
    }

    public function setCant_prod($cant_prod)
    {
        $this->cant_prod = $cant_prod;

        return $this;
    }
    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    public function getPrecio_tot()
    {
        return $this->precio_tot;
    }

    public function setPrecio_tot($precio_tot)
    {
        $this->precio_tot = $precio_tot;

        return $this;
    }

    public function getEst()
    {
        return $this->est;
    }

    public function setEst($est)
    {
        $this->est = $est;

        return $this;
    }
}
