<?php
class Servicio{
    private $cod_servicio;
    private $cod_categoria;
    private $cod_subcategoria;
    private $nom_servicio;
    private $dscr;
    private $tipo_gasto;
    private $proovedor;

    public function __construct($cod_categoria, $cod_subcategoria, $nom_servicio, $dscr, $tipo_gasto, $proovedor) {
        $this->cod_categoria = $cod_categoria;
        $this->cod_subcategoria = $cod_subcategoria;
        $this->nom_servicio = $nom_servicio;
        $this->dscr = $dscr;
        $this->tipo_gasto = $tipo_gasto;
        $this->proovedor = $proovedor;
    }

    public function getCod_servicio()
    {
        return $this->cod_servicio;
    }

    public function setCod_servicio($cod_servicio)
    {
        $this->cod_servicio = $cod_servicio;

        return $this;
    }

    public function getCod_categoria()
    {
        return $this->cod_categoria;
    }

    public function setCod_categoria($cod_categoria)
    {
        $this->cod_categoria = $cod_categoria;

        return $this;
    }

    public function getNom_servicio()
    {
        return $this->nom_servicio;
    }

    public function setNom_servicio($nom_servicio)
    {
        $this->nom_servicio = $nom_servicio;

        return $this;
    }

    public function getDscr()
    {
        return $this->dscr;
    }

    public function setDscr($dscr)
    {
        $this->dscr = $dscr;

        return $this;
    }

    public function getTipo_gasto()
    {
        return $this->tipo_gasto;
    }

    public function setTipo_gasto($tipo_gasto)
    {
        $this->tipo_gasto = $tipo_gasto;

        return $this;
    }

    public function getProovedor()
    {
        return $this->proovedor;
    }

    public function setProovedor($proovedor)
    {
        $this->proovedor = $proovedor;

        return $this;
    }

    /**
     * Get the value of cod_subcategoria
     */ 
    public function getCod_subcategoria()
    {
        return $this->cod_subcategoria;
    }

    /**
     * Set the value of cod_subcategoria
     *
     * @return  self
     */ 
    public function setCod_subcategoria($cod_subcategoria)
    {
        $this->cod_subcategoria = $cod_subcategoria;

        return $this;
    }
}
?>