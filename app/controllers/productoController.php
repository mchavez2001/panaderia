<?php
require_once __DIR__ . '/../dao/ProductoDao.php';
class ProductoController{
    private $productoDao;

    public function __construct()
    {
        $this->productoDao = new ProductoDao();
    }

    public function obtenerProductosbyFechaAct()
    {
        return $this->productoDao->getInventarioProductos();
    }

    public function obtenerProductosbyVenta($cod_venta)
    {
        return $this->productoDao->getProductosbyVenta($cod_venta);
    }

    public function obtenerProductosbyID($cod_prod)
    {
        return $this->productoDao->getProductosbyID($cod_prod);
    }

    public function editarProducto($producto)
    {
        $this->productoDao->updateProducto($producto);
    }

    public function elminarProducto($cod_prod){
        $this->productoDao->deleteProducto($cod_prod);
    }

    public function agregarProductobyVenta($producto){
        return $this->productoDao->insertProductobyVenta($producto);
    }

    public function actualizarEstado($cod_prod, $est){
        return $this->productoDao->updateEstado($cod_prod, $est);
    }

    public function obtenerAbonosByCuenta($cod_venta){
        return $this->productoDao->getAbonos($cod_venta);
    }

    public function obtenerAbonosByCuentaAdelanto($cod_venta){
        return $this->productoDao->getAbonosAdelantados($cod_venta);
    }

    public function obtenerAbonosAdelantados(){
        return $this->productoDao->getAllAbonosAdelantados();
    }

    public function cambiarEstadoAbono($abono){
        return $this->productoDao->editAbonoEstado($abono);
    }

    public function obtenerAbonoByID($cod_abon){
        return $this->productoDao->getAbonobyID($cod_abon);
    }

    public function agregarAbonobyCuenta($cod_cuenta, $abono, $met_pago){
        $this->productoDao->insertAbonobyCuenta($cod_cuenta, $abono, $met_pago);
    }

    public function editarAbono($abono){
        $this->productoDao->editAbono($abono);
    }

    public function eliminarAbono($cod_abon){
        $this->productoDao->deleteAbono($cod_abon);
    }

    public function agregarAbonobyCuentaAdelanto($cod_cuenta, $abono, $met_pago){
        $this->productoDao->insertAbonobyCuentaAdelanto($cod_cuenta, $abono, $met_pago);
    }

    public function obtenerTotalAbonosbyCuenta($cod_cuenta){
        return $this->productoDao->getTotalAbonosbyCuenta($cod_cuenta);
    }

    public function obtenerUltimoAbonobyCuenta($cod_cuenta){
        return $this->productoDao->getLastAbonobyCuenta($cod_cuenta);
    }

    public function obtenerEntregasByProducto($cod_prod){
        return $this->productoDao->getEntregas($cod_prod);
    }

    public function agregarEntregabyProducto($cod_prod, $entrega){
        $this->productoDao->insertEntregabyProducto($cod_prod, $entrega);
    }

    public function editarEntregabyProducto($cod_prod, $abono){
        #$this->productoDao->insertAbonobyProducto($cod_prod, $abono);
    }

    public function eliminarEntregabyProducto($cod_prod, $abono){
        #$this->productoDao->insertAbonobyProducto($cod_prod, $abono);
    }

    public function obtenerTotalEntregasbyProducto($cod_prod){
        return $this->productoDao->getTotalEntregasbyProducto($cod_prod);
    } 
/*     public function obtenerTotalAbonosbyVenta($cod_venta){
        return $this->productoDao->getTotalAbonosbyVenta($cod_venta);
    }  */
}

?>