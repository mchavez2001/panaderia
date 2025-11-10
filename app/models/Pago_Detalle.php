<?php
class Pago_Detalle
{
    private $cod_pago_detalle;
    private $cod_pago;
    private $nombre;
    private $monto;

    public function __construct($cod_pago, $nombre, $monto)
    {
        $this->cod_pago = $cod_pago;
        $this->nombre = $nombre;
        $this->monto = $monto;
    }

    public function getCod_pago_detalle()
    {
        return $this->cod_pago_detalle;
    }
    public function setCod_pago_detalle($cod_pago_detalle)
    {
        $this->cod_pago_detalle = $cod_pago_detalle;

        return $this;
    }
    public function getCod_pago()
    {
        return $this->cod_pago;
    }
    public function setCod_pago($cod_pago)
    {
        $this->cod_pago = $cod_pago;

        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function getMonto()
    {
        return $this->monto;
    }
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }
}
