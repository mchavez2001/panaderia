<?php
class Pago
{
    private $cod_pago;
    private $cod_servicio;
    private $dscr;
    private $cantidad;
    private $tip_unidad;
    private $met_pag;
    private $pago_uni;
    private $pago_tot;
    private $fecha_pago;

    public function __construct($cod_servicio, $dscr, $cantidad, $tip_unidad, $met_pag, $pago_uni, $pago_tot, $fecha_pago)
    {
        $this->cod_servicio = $cod_servicio;
        $this->dscr = $dscr;
        $this->cantidad = $cantidad;
        $this->tip_unidad = $tip_unidad;
        $this->met_pag = $met_pag;
        $this->pago_uni = $pago_uni;
        $this->pago_tot = $pago_tot;
        $this->fecha_pago = $fecha_pago;
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

    public function getCod_servicio()
    {
        return $this->cod_servicio;
    }

    public function setCod_servicio($cod_servicio)
    {
        $this->cod_servicio = $cod_servicio;

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

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getTip_unidad()
    {
        return $this->tip_unidad;
    }

    public function setTip_unidad($tip_unidad)
    {
        $this->tip_unidad = $tip_unidad;

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

    public function getPago_uni()
    {
        return $this->pago_uni;
    }

    public function setPago_uni($pago_uni)
    {
        $this->pago_uni = $pago_uni;

        return $this;
    }

    public function getPago_tot()
    {
        return $this->pago_tot;
    }

    public function setPago_tot($pago_tot)
    {
        $this->pago_tot = $pago_tot;

        return $this;
    }

    public function getFecha_pago()
    {
        return $this->fecha_pago;
    }

    public function setFecha_pago($fecha_pago)
    {
        $this->fecha_pago = $fecha_pago;

        return $this;
    }
}
