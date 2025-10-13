<?php
require_once(__DIR__ . '/../app/controllers/ventasController.php');
require_once(__DIR__ . '/../app/models/Pedido.php');
require_once(__DIR__ . '/../app/controllers/productoController.php');
$ventasController = new VentasController();
$productoController = new ProductoController();
$pedidos = $ventasController->obtenerPedidos();
print_r($pedidos);
$fech_actual = date('Y-m-d');
foreach ($pedidos as $pedido) {
    if ($pedido->getFech_ped() == $fech_actual) {
        $ventasController->habilitarVenta($pedido->getCod_venta());
    }
}

$abonosAdelantados = $productoController->obtenerAbonosAdelantados();

foreach ($abonosAdelantados as $abonosAdelantado) {
    $cod_cuenta = $abonosAdelantado->getCod_cuenta();
    $monto = $abonosAdelantado->getDin_abon();
    $abonosAdelantado->setEst_abon('1');
    $productoController->cambiarEstadoAbono($abonosAdelantado);

    #Obteniendo cuenta y editando nuevo saldo para hacer el update
    $cuenta = $ventasController->obtenerCuenta($cod_cuenta);
    $cuenta->setCod_cuenta($cod_cuenta);
    $saldoAct = $cuenta->getSaldo() - $monto;
    $cuenta->setSaldo($saldoAct);
    $ventasController->editarCuenta($cuenta);
    #Cambiar estado de cuenta si ya se termino de abonar
    if ($cuenta->getSaldo() == 0) {
        $cuenta->setEstado(0);
        $ventasController->editarCuenta($cuenta);
        #Elimina todos los abonos registrados de esa cuenta para reiniciarla
        $ventasController->eliminarAbonosbyCuenta($cod_cuenta);
    }

    #Realizar descuento al importe de la venta con fecha mas antigua registrada en la cuenta del cliente
    /* $venta = $ventasController->obtenerVentaPendientebyCuenta($_POST['id']);
                            $importeAct = $venta->getImporte() - $_POST['monto'];
                            $venta->setImporte($importeAct);
                            $ventasController->editarVenta($venta); */
    
    $ventas = $ventasController->obtenerVentasPendientesbyCuenta($cod_cuenta);
    $sobra = 0;
    foreach ($ventas as $venta) {
        #echo '(0)-Venta: ' . $venta->getImporte() . ' Monto: ' . $_POST['monto'] . ' ';
        if ($sobra == 0) {
            if ($venta->getImporte() < $monto) {
                $sobra = $monto - $venta->getImporte();
                $monto = 0;
                $venta->setImporte(0);
                #echo '(1)-Venta: ' . $venta->getImporte() . ' Sobra: ' . $sobra . ' ';
            } else {
                $importeAct = $venta->getImporte() - $monto;
                $monto = 0;
                $venta->setImporte($importeAct);
                #echo '(1)-Venta: ' . $venta->getImporte() . ' Sobra: ' . $sobra . ' ';
            }
        } else if (($sobra > 0)) {
            if ($venta->getImporte() > $sobra) {
                $importeAct = $venta->getImporte() - $sobra;
                $sobra = 0;
                $venta->setImporte($importeAct);
                #echo '(2)-Venta: ' . $venta->getImporte() . ' Sobra: ' . $sobra . ' ';
            } else {
                $sobra = $sobra - $venta->getImporte();
                $importeAct = 0;
                $venta->setImporte($importeAct);
                #echo '(2)-Venta: ' . $venta->getImporte() . ' Sobra: ' . $sobra . ' ';
            }
        }
        $ventasController->editarVenta($venta);
    }
}
