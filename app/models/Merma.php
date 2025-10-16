<?php
class Merma {
    private $cod_merma;
    private $producto;
    private $tamaño;
    private $cantidad;
    private $fecha;
    private $motivo;
    private $estado;   

    public function __construct($producto, $tamaño, $cantidad, $fecha, $motivo, $estado) {
        $this->producto = $producto;
        $this->tamaño = $tamaño;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->motivo = $motivo;
        $this->estado = $estado;
    }

    public function getCodMerma() {
        return $this->cod_merma;
    }
    public function setCodMerma($cod_merma) {
        $this->cod_merma = $cod_merma;
    }
    public function getProducto() {
        return $this->producto;
    }
    public function getTamaño() {
        return $this->tamaño;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getMotivo() {
        return $this->motivo;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }

}
?>