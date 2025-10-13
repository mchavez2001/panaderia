<?php
class Entrega
{
    private $cod_entr;
    private $cod_prod;
    private $cant_entr;
    private $fech_entr;

    public function __construct($cod_prod, $cant_entr, $fech_entr)
    {
        $this->cod_prod = $cod_prod;
        $this->cant_entr = $cant_entr;
        $this->fech_entr = $fech_entr;
    }

    public function getCod_entr()
    {
        return $this->cod_entr;
    }

    public function setCod_entr($cod_entr)
    {
        $this->cod_entr = $cod_entr;

        return $this;
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

    public function getCant_entr()
    {
        return $this->cant_entr;
    }

    public function setCant_entr($cant_entr)
    {
        $this->cant_entr = $cant_entr;

        return $this;
    }

    public function getFech_entr()
    {
        return $this->fech_entr;
    }

    public function setFech_entr($fech_entr)
    {
        $this->fech_entr = $fech_entr;

        return $this;
    }
}
