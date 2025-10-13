<?php
class Consumo_Petroleo{
    private $cod_consumo_petroleo;
    private $fecha;
    private $altura_inicial;
    private $altura_final;
    private $variante;
    private $galones;
    private $inversion;

    public function __construct($fecha, $altura_inicial, $altura_final, $variante, $galones, $inversion) {
        $this->fecha = $fecha;
        $this->altura_inicial = $altura_inicial;
        $this->altura_final = $altura_final;
        $this->variante = $variante;
        $this->galones = $galones;
        $this->inversion = $inversion;
    }

    public function getCod_consumo_petroleo()
    {
        return $this->cod_consumo_petroleo;
    }

    public function setCod_consumo_petroleo($cod_consumo_petroleo)
    {
        $this->cod_consumo_petroleo = $cod_consumo_petroleo;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getGalones()
    {
        return $this->galones;
    }

    public function setGalones($galones)
    {
        $this->galones = $galones;

        return $this;
    }

    public function getInversion()
    {
        return $this->inversion;
    }

    public function setInversion($inversion)
    {
        $this->inversion = $inversion;

        return $this;
    }

    public function getAltura_inicial()
    {
        return $this->altura_inicial;
    }

    public function setAltura_inicial($altura_inicial)
    {
        $this->altura_inicial = $altura_inicial;

        return $this;
    }

    public function getAltura_final()
    {
        return $this->altura_final;
    }

    public function setAltura_final($altura_final)
    {
        $this->altura_final = $altura_final;

        return $this;
    }

    public function getVariante()
    {
        return $this->variante;
    }

    public function setVariante($variante)
    {
        $this->variante = $variante;

        return $this;
    }
}