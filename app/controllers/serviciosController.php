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
}

?>