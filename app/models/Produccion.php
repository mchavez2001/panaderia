<?php

class Produccion{
    private $cod_procc;
    private $lata;
    private $cant_procc;
    private $cant_extra;
    private $unidades;
    private $fech_ini;
    private $fech_fin;
    private $est;

    public function __construct($lata, $cant_procc, $cant_extra, $unidades, $fech_ini, $fech_fin, $est) {
        $this->lata = $lata;
        $this->cant_procc = $cant_procc;
        $this->cant_extra = $cant_extra;
        $this->unidades = $unidades;
        $this->fech_ini = $fech_ini;
        $this->fech_fin = $fech_fin;
        $this->est = $est;
    }

    public function getCod_procc()
    {
        return $this->cod_procc;
    }

    public function setCod_procc($cod_procc)
    {
        $this->cod_procc = $cod_procc;

        return $this;
    }

    public function getCant_procc()
    {
        return $this->cant_procc;
    }

    public function setCant_procc($cant_procc)
    {
        $this->cant_procc = $cant_procc;

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

    public function getFech_ini()
    {
        return $this->fech_ini;
    }

    public function setFech_ini($fech_ini)
    {
        $this->fech_ini = $fech_ini;

        return $this;
    }

    public function getFech_fin()
    {
        return $this->fech_fin;
    }

    public function setFech_fin($fech_fin)
    {
        $this->fech_fin = $fech_fin;

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

    /**
     * Get the value of lata
     */ 
    public function getLata()
    {
        return $this->lata;
    }

    /**
     * Set the value of lata
     *
     * @return  self
     */ 
    public function setLata($lata)
    {
        $this->lata = $lata;

        return $this;
    }

    /**
     * Get the value of unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set the value of unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }
}

?>