<?php
require_once(__DIR__ . '/../app/controllers/ventasController.php');
require_once (__DIR__ . '/../app/models/Cuenta.php');
$ventasController = new VentasController();
$cuentas = $ventasController->obtenerCuentasNegativas();
foreach ($cuentas as $cuenta) {
    #echo $cuenta->getCod_cuenta().' '. $cuenta->getSaldo().'<br>';
    $ventasController->actualizarCuentaNegativa($cuenta->getCod_cuenta());
}
