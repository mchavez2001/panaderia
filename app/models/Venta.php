<?php

class Venta
{
    private $cod_venta;
    private $cod_cuenta;
    private $cod_empleado;
    private $fecha;
    private $importe;
    private $mont_pasaj;
    private $met_pag;
    private $estado;

    public function __construct($cod_cuenta, $cod_empleado, $fecha, $importe, $mont_pasaj, $met_pag, $estado)
    {
        $this->cod_cuenta = $cod_cuenta;
        $this->cod_empleado = $cod_empleado;
        $this->fecha = $fecha;
        $this->importe = $importe;
        $this->mont_pasaj = $mont_pasaj;
        $this->met_pag = $met_pag;
        $this->estado = $estado;
    }

    public function getCod_venta()
    {
        return $this->cod_venta;
    }

    public function setCod_venta($cod_venta)
    {
        $this->cod_venta = $cod_venta;

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

    public function getMet_pag()
    {
        return $this->met_pag;
    }

    public function setMet_pag($met_pag)
    {
        $this->met_pag = $met_pag;

        return $this;
    }

    public function getCod_empleado()
    {
        return $this->cod_empleado;
    }

    public function setCod_empleado($cod_empleado)
    {
        $this->cod_empleado = $cod_empleado;

        return $this;
    }

    public function getMont_pasaj()
    {
        return $this->mont_pasaj;
    }

    public function setMont_pasaj($mont_pasaj)
    {
        $this->mont_pasaj = $mont_pasaj;

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

    public function getImporte()
    {
        return $this->importe;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
