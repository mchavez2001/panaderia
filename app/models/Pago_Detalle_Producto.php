<?php
class Pago_Detalle_Producto{
    private $cod_pago_detalle_producto;
    private $cod_pago;
    private $nombre;
    private $cantidad;
    private $monto;

    public function __construct($cod_pago, $nombre, $cantidad, $monto)
    {
        $this->cod_pago = $cod_pago;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->monto = $monto;
    }

    public function getCod_pago_detalle_producto()
    {
        return $this->cod_pago_detalle_producto;
    }
    public function setCod_pago_detalle_producto($cod_pago_detalle_producto)
    {
        $this->cod_pago_detalle_producto = $cod_pago_detalle_producto;

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

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}

?>