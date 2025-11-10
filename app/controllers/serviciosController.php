<?php
require_once __DIR__ . '/../dao/ServicioDao.php';
class ServiciosController{
    private $servicioDao;

    public function __construct()
    {
        $this->servicioDao = new ServicioDao();
    }

    public function obtenerCategorias()
    {
        return $this->servicioDao->getCategorias();
    }
    public function obtenerSubCategorias()
    {
        return $this->servicioDao->getSubCategorias();
    }
    public function agregarCategoria($categoria)
    {
        $this->servicioDao->addCategoria($categoria);
    }
    public function obtenerServicios(){
        return $this->servicioDao->getServicios();
    }
    public function obtenerCategorias_Det_1()
    {
        return $this->servicioDao->getCategorias_Det_1();
    }
    public function obtenerCategorias_Det_2()
    {
        return $this->servicioDao->getCategorias_Det_2();
    }
    public function obtenerCategorias_Det_1_Totales()
    {
        return $this->servicioDao->getCategorias_Det_1_Totales();
    }
    public function agregarServicio($servicio)
    {
        $this->servicioDao->addServicio($servicio);
    }
    public function obtenerPagos(){
        return $this->servicioDao->getPagos();
    }
    public function agregarPago($pago)
    {
        $this->servicioDao->addPago($pago);
    }
    public function eliminarPago($cod_pago)
    {
        $this->servicioDao->deletePago($cod_pago);
    }
    public function obtenerPagoDetalles($cod_pago){
        return $this->servicioDao->getPagoDetalles($cod_pago);
    }
    public function obtenerPagoDetalle($cod_pago_detalle){
        return $this->servicioDao->getPagoDetalle($cod_pago_detalle);
    }
    public function agregarPagoDetalle($pago_detalle)
    {
        $this->servicioDao->addPagoDetalle($pago_detalle);
    }
    public function editarPagoDetalle($pago_detalle)
    {
        $this->servicioDao->updatePagoDetalle($pago_detalle);
    }
    public function eliminarPagoDetalle($cod_pago_detalle)
    {
        $this->servicioDao->deletePagoDetalle($cod_pago_detalle);
    }


    public function obtenerPagoDetallesProductos($cod_pago){
        return $this->servicioDao->getPagoDetallesProductos($cod_pago);
    }
    public function obtenerPagoDetalleProducto($cod_pago_detalle_producto){
        return $this->servicioDao->getPagoDetalleProducto($cod_pago_detalle_producto);
    }
    public function agregarPagoDetalleProducto($pago_detalle_producto)
    {
        $this->servicioDao->addPagoDetalleProducto($pago_detalle_producto);
    }
    public function editarPagoDetalleProducto($pago_detalle_producto)
    {
        $this->servicioDao->updatePagoDetalleProducto($pago_detalle_producto);
    }
    public function eliminarPagoDetalleProducto($cod_pago_detalle_producto)
    {
        $this->servicioDao->deletePagoDetalleProducto($cod_pago_detalle_producto);
    }
}

?>