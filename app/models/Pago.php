<?php
class Pago
{
    private $cod_pago;
    private $cod_servicio;
    private $proveedor;
    private $dscr;
    private $cantidad;
    private $tip_unidad;
    private $met_pag;
    private $pago_uni;
    private $pago_tot;
    private $fecha_pago;
    private $detalle;
    private $detalle_producto;

    public function __construct($cod_servicio, $proveedor, $dscr, $cantidad, $tip_unidad, $met_pag, $pago_uni, $pago_tot, $fecha_pago, $detalle, $detalle_producto)
    {
        $this->cod_servicio = $cod_servicio;
        $this->proveedor = $proveedor;
        $this->dscr = $dscr;
        $this->cantidad = $cantidad;
        $this->tip_unidad = $tip_unidad;
        $this->met_pag = $met_pag;
        $this->pago_uni = $pago_uni;
        $this->pago_tot = $pago_tot;
        $this->fecha_pago = $fecha_pago;
        $this->detalle = $detalle;
        $this->detalle_producto = $detalle_producto;
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

    /**
     * Get the value of proveedor
     */ 
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of proveedor
     *
     * @return  self
     */ 
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get the value of detalle
     */ 
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set the value of detalle
     *
     * @return  self
     */ 
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get the value of detalle_producto
     */ 
    public function getDetalle_producto()
    {
        return $this->detalle_producto;
    }

    /**
     * Set the value of detalle_producto
     *
     * @return  self
     */ 
    public function setDetalle_producto($detalle_producto)
    {
        $this->detalle_producto = $detalle_producto;

        return $this;
    }
}
