<?php

class Abono
{
    private $cod_abon;
    private $cod_cuenta;
    private $din_abon;
    private $met_pag;
    private $fech_abon;
    private $est_abon;

    public function __construct($cod_cuenta, $din_abon, $fech_abon)
    {
        $this->cod_cuenta = $cod_cuenta;
        $this->din_abon = $din_abon;
        $this->fech_abon = $fech_abon;
    }

    public function getCod_abon()
    {
        return $this->cod_abon;
    }

    public function setCod_abon($cod_abon)
    {
        $this->cod_abon = $cod_abon;

        return $this;
    }
    
    public function getCod_cuenta()
    {
        return $this->cod_cuenta;
    }

    public function setCod_cuenta($cod_cuenta)
    {
        $this->cod_cuenta = $cod_cuenta;

        return $this;
    }

    public function getDin_abon()
    {
        return $this->din_abon;
    }

    public function setDin_abon($din_abon)
    {
        $this->din_abon = $din_abon;

        return $this;
    }

    public function getFech_abon()
    {
        return $this->fech_abon;
    }

    public function setFech_abon($fech_abon)
    {
        $this->fech_abon = $fech_abon;

        return $this;
    }


    /**
     * Get the value of met_pag
     */ 
    public function getMet_pag()
    {
        return $this->met_pag;
    }

    /**
     * Set the value of met_pag
     *
     * @return  self
     */ 
    public function setMet_pag($met_pag)
    {
        $this->met_pag = $met_pag;

        return $this;
    }

    /**
     * Get the value of est_abon
     */ 
    public function getEst_abon()
    {
        return $this->est_abon;
    }

    /**
     * Set the value of est_abon
     *
     * @return  self
     */ 
    public function setEst_abon($est_abon)
    {
        $this->est_abon = $est_abon;

        return $this;
    }
}
