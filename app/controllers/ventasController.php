<?php
require_once __DIR__ . '/../dao/VentaDao.php';
class VentasController{
    private $ventasDao;

    public function __construct() {
        $this->ventasDao = new VentaDao();
    }

    public function obtenerVentas(){
        return $this->ventasDao->getVentas();
    }

    public function obtenerVentasbyFecha($fecha){
        return $this->ventasDao->getVentasbyFecha($fecha);
    }

    public function obtenerVentasbyCuenta($cod_cuenta){
        return $this->ventasDao->getVentasbyCuenta($cod_cuenta);
    }

    public function obtenerVenta($cod_venta){
        return $this->ventasDao->getVenta($cod_venta);
    }
    
    public function agregarVenta($venta){
        return $this->ventasDao->insertVenta($venta);
    }

    public function editarVenta($venta){
        $this->ventasDao->editVenta($venta);
    }

    public function eliminarVenta($cod_venta){
        $this->ventasDao->deleteVenta($cod_venta);
    }

    public function unirVentaProducto($cod_prod, $cod_venta){
        $this->ventasDao->insertProductoOnVenta($cod_prod, $cod_venta);
    }

    public function unirVentaProductoPedido($cod_prod, $cod_venta){
        $this->ventasDao->insertProductoOnVentaForPedido($cod_prod, $cod_venta);
    }

    #CAMBIADO
    public function obtenerVentaPendientebyCuenta($cod_cuenta){
        return $this->ventasDao->getVentaPendientebyCuenta($cod_cuenta);
    }

    public function obtenerVentasPendientesbyCuenta($cod_cuenta){
        return $this->ventasDao->getVentasPendientebyCuenta($cod_cuenta);
    }

    public function obtenerVendedores(){
        return $this->ventasDao->getVendedores();
    }
    public function anularVenta($cod_venta){
        $this->ventasDao->anularVenta($cod_venta);
    }
    public function obtenerCuentas(){
        return $this->ventasDao->getCuentas();
    }

    public function obtenerCuentasOrdenadasbyVentas(){
        return $this->ventasDao->getCuentasOrdenadasbyVentas();
    }

    public function obtenerCuenta($cod_cuenta){
        return $this->ventasDao->getCuenta($cod_cuenta);
    }
    public function obtenerCuentabyCliente($cod_cliente){
        return $this->ventasDao->getCuentabyCliente($cod_cliente);
    }
    public function agregarCuenta($cuenta){
        $this->ventasDao->insertCuenta($cuenta);
    }
    public function editarCuenta($cuenta){
        $this->ventasDao->updateCuenta($cuenta);
    }
    public function eliminarCuenta($cod_cuenta){
        $this->ventasDao->deleteCuenta($cod_cuenta);
    }
    public function eliminarAbonosbyCuenta($cod_cuenta){
        $this->ventasDao->deleteAbonosbyCuenta($cod_cuenta);
    }
    public function obtenerPedidos(){
        return $this->ventasDao->getPedidos();
    }
    public function agregarPedido($pedido){
        return $this->ventasDao->insertPedido($pedido);
    }
    public function habilitarVenta($cod_venta){
        return $this->ventasDao->enableVenta($cod_venta);
    }
    public function finalizarVenta($cod_venta){
        return $this->ventasDao->finishVenta($cod_venta);
    }
    public function obtenerImporteProductos($cod_venta){
        return $this->ventasDao->getImporteProductos($cod_venta);
    }
    public function eliminarPedido($cod_venta){
        $this->ventasDao->deletePedido($cod_venta);
    }
    public function obtenerImporteDeudas(){
        return $this->ventasDao->getImporteDeudas();
    }
    #Rutinas
    public function obtenerCuentasNegativas(){
        return $this->ventasDao->getCuentasNegativas();
    }
    public function actualizarCuentaNegativa($cod_cuenta){
        $this->ventasDao->updateCuentaNegativa($cod_cuenta);
    }
}
?>