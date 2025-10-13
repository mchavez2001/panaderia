<?php
require_once '../app/controllers/ventasController.php';
require_once '../app/controllers/clienteController.php';
require_once '../app/controllers/productoController.php';
require_once '../app/models/Producto.php';
require_once '../app/models/Venta.php';
require_once '../app/models/Abono.php';
require_once '../app/models/Entrega.php';
require_once '../app/models/Cuenta.php';
require_once '../app/models/Pedido.php';
$ventasController = new VentasController();
$clienteController = new ClienteController();
$productoController = new ProductoController();
$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/registro_ventas':
        $mensaje = '¿Estas seguro que deseas finalizar esta venta?';
        $rutaDelete = 'eliminar_venta';
        $rutaMsg = 'finalizar_venta';
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'search') {
                    $fecha = $_POST['date'];
                    $vendedores = $ventasController->obtenerVendedores();
                    $clientes = $clienteController->obtenerClientes();
                    $ventas = $ventasController->obtenerVentasbyFecha($fecha);
                    $cuentas = $ventasController->obtenerCuentas();
                    #Asignacion de nombre de cliente
                    foreach ($ventas as $venta) {
                        foreach ($cuentas as $cuenta) {
                            if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                                foreach ($clientes as $cliente) {
                                    if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                        $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                                    }
                                }
                            }
                        }
                    }
                    #Asignacion de nombre de vendedor
                    foreach ($ventas as $venta) {
                        foreach ($vendedores as $vendedor) {
                            if ($venta->getCod_empleado() == $vendedor->getId_empleado()) {
                                $venta->setCod_empleado($vendedor->getNombre() . ' ' . $vendedor->getApellido());
                            }
                        }
                    }
                    #Obtener importes en base al total de productos comprados
                    foreach ($ventas as $venta) {
                        $importes_productos[$venta->getCod_venta()] = $ventasController->obtenerImporteProductos($venta->getCod_venta());
                    }
                    #Obtener importe deudas
                    $importe_deudas = $ventasController->obtenerImporteDeudas();
                    require_once '../app/views/listaVentasView.php';
                    exit();
                } else {
                    $vendedores = $ventasController->obtenerVendedores();
                    $clientes = $clienteController->obtenerClientes();
                    $ventas = $ventasController->obtenerVentas();
                    $cuentas = $ventasController->obtenerCuentas();
                    #Asignacion de nombre de cliente
                    foreach ($ventas as $venta) {
                        foreach ($cuentas as $cuenta) {
                            if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                                foreach ($clientes as $cliente) {
                                    if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                        $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                                    }
                                }
                            }
                        }
                    }
                    #Asignacion de nombre de vendedor
                    foreach ($ventas as $venta) {
                        foreach ($vendedores as $vendedor) {
                            if ($venta->getCod_empleado() == $vendedor->getId_empleado()) {
                                $venta->setCod_empleado($vendedor->getNombre() . ' ' . $vendedor->getApellido());
                            }
                        }
                    }
                    #Obtener importes en base al total de productos comprados
                    foreach ($ventas as $venta) {
                        $importes_productos[$venta->getCod_venta()] = $ventasController->obtenerImporteProductos($venta->getCod_venta());
                    }
                    #Obtener importe deudas
                    $importe_deudas = $ventasController->obtenerImporteDeudas();
                    require_once '../app/views/listaVentasView.php';
                    exit();
                }
            }
            $vendedores = $ventasController->obtenerVendedores();
            $clientes = $clienteController->obtenerClientes();
            $ventas = $ventasController->obtenerVentas();
            $cuentas = $ventasController->obtenerCuentas();
            #Asignacion de nombre de cliente
            foreach ($ventas as $venta) {
                foreach ($cuentas as $cuenta) {
                    if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                        foreach ($clientes as $cliente) {
                            if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                            }
                        }
                    }
                }
            }
            #Asignacion de nombre de vendedor
            foreach ($ventas as $venta) {
                foreach ($vendedores as $vendedor) {
                    if ($venta->getCod_empleado() == $vendedor->getId_empleado()) {
                        $venta->setCod_empleado($vendedor->getNombre() . ' ' . $vendedor->getApellido());
                    }
                }
            }
            #Obtener importes en base al total de productos comprados
            foreach ($ventas as $venta) {
                $importes_productos[$venta->getCod_venta()] = $ventasController->obtenerImporteProductos($venta->getCod_venta());
            }
            #Obtener importe deudas
            $importe_deudas = $ventasController->obtenerImporteDeudas();
            require_once '../app/views/listaVentasView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_venta':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    if (isset($_POST['pasajeExist'])) {
                        $cod_cuenta = $_POST['cod_cuenta'];
                        $currentDate = date('Y-m-d');
                        $venta = new Venta($cod_cuenta, $_POST['cod_empleado'], $currentDate, $_POST['pasaje'], $_POST['pasaje'], $_POST['met_pag'], 1);
                        $ventasController->agregarVenta($venta);
                        header("Location: /panaderia/public/registro_ventas");
                        exit();
                    } else {
                        $cod_cuenta = $_POST['cod_cuenta'];
                        $currentDate = date('Y-m-d');
                        $venta = new Venta($cod_cuenta, $_POST['cod_empleado'], $currentDate, 0, 'S/D', $_POST['met_pag'], 1);
                        print_r($venta);
                        $ventasController->agregarVenta($venta);
                        echo 'hola';
                        header("Location: /panaderia/public/registro_ventas");
                        exit();
                    }
                }
            }
            $ventas = $ventasController->obtenerVentas();
            $cuentas = $ventasController->obtenerCuentas();
            $clientes = $clienteController->obtenerClientes();
            #Asignacion de nombre de cliente
            foreach ($ventas as $venta) {
                foreach ($cuentas as $cuenta) {
                    if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                        foreach ($clientes as $cliente) {
                            if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                            }
                        }
                    }
                }
            }
            foreach ($clientes as $cliente) {
                foreach ($cuentas as $cuenta) {
                    if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                        $cliente->setId_cliente($cuenta->getCod_cuenta());
                    }
                }
            }
            $vendedores = $ventasController->obtenerVendedores();
            require_once '../app/views/createVentaView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_venta':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cuentas = $ventasController->obtenerCuentas();
                $clientes = $clienteController->obtenerClientes();
                $ventas = $ventasController->obtenerVentas();
                foreach ($clientes as $cliente) {
                    foreach ($cuentas as $cuenta) {
                        if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                            $cliente->setId_cliente($cuenta->getCod_cuenta());
                        }
                    }
                }
                $venta = $ventasController->obtenerVenta($query['id']);
                $cuenta = $ventasController->obtenerCuenta($venta->getCod_cuenta());
                $old_importe = $venta->getImporte();
                $old_pasaje = $venta->getMont_pasaj();
                $cliente = $clienteController->obtenerCliente($cuenta->getCod_cliente());
                $vendedores = $ventasController->obtenerVendedores();
                require_once '../app/views/editVentaView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        if (isset($_POST['pasajeExist'])) {
                            $importe_sin_pasaj = $_POST['old_importe'] - $_POST['old_pasaje'];
                            $nuevoImporte = $importe_sin_pasaj + $_POST['pasaje'];
                            $cod_cliente = $_POST['cod_cliente'];
                            $venta = new Venta($cod_cliente, $_POST['cod_empleado'], 'S/D', $nuevoImporte, $_POST['pasaje'], $_POST['met_pag'], 0);
                            $venta->setCod_venta($_POST['cod_venta']);
                            $ventasController->editarVenta($venta);
                        } else {
                            $nuevoImporte = $_POST['old_importe'] - $_POST['old_pasaje'];
                            $cod_cliente = $_POST['cod_cliente'];
                            $venta = new Venta($cod_cliente, $_POST['cod_empleado'], 'S/D', $nuevoImporte, 'S/D', $_POST['met_pag'], 0);
                            $venta->setCod_venta($_POST['cod_venta']);
                            $ventasController->editarVenta($venta);
                        }
                    }
                }
                header("Location: /panaderia/public/registro_ventas");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/eliminar_venta':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $ventasController->eliminarVenta($_POST['id']);
                    /* header("Location: /panaderia/public/registro_ventas");
                    exit(); */
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_venta':
        if (isset($_SESSION['user_id'])) {
            $rutaDelete = 'eliminar_producto_venta';
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyVenta($query['id']);
                $cod_venta = $_GET['id'];
                $_SESSION['cod_ventaproducto'] = $cod_venta;
                require_once '../app/views/listaProductoVentaView.php';
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_producto_venta':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyFechaAct();
                $cod_venta = $_GET['id'];
                require_once '../app/views/createProductoVentaView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'guardar') {
                        $producto = new Producto($_POST['nombre'], $_POST['desc'], 'N/A', $_POST['tamano'], $_POST['cant']);
                        $producto->setPrecio($_POST['precio']);
                        $producto->setPrecio_tot($_POST['precio'] * $_POST['cant']);
                        $cod_prod = $productoController->agregarProductobyVenta($producto);
                        $ventasController->unirVentaProducto($cod_prod, $_POST['cod']);
                        header("Location: /panaderia/public/producto_venta?id=" . $_POST['cod']);
                        exit();
                    } else {
                        header("Location: /panaderia/public/listaVentasView");
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_producto_venta':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyFechaAct();
                $cod_prod = $_GET['id'];
                $cod_venta = $_SESSION['cod_ventaproducto'];
                $productobyID = $productoController->obtenerProductosbyID($cod_prod);
                #print_r($productobyID);
                require_once '../app/views/editProductoVentaView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $producto = new Producto($_POST['nombre'], $_POST['desc'], 'N/A', $_POST['tamano'], $_POST['cant']);
                        $producto->setPrecio($_POST['precio']);
                        $producto->setPrecio_tot($_POST['precio'] * $_POST['cant']);
                        $producto->setCod_prod($_POST['cod_prod']);
                        $productoController->editarProducto($producto);
                        header("Location: /panaderia/public/producto_venta?id=" . $_POST['cod']);
                        exit();
                    }
                }
                header("Location: /panaderia/public/registro_ventas");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/eliminar_producto_venta':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $cod_venta = $_SESSION['cod_ventaproducto'];
                    $productoController->elminarProducto($_POST['id']);
                    header("Location: /panaderia/public/producto_venta?id=" . $cod_venta);
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/seguimiento_cuentas':
        if (isset($_SESSION['user_id'])) {
            $cuentas = $ventasController->obtenerCuentasOrdenadasbyVentas();
            $abonado = [];
            $clientes = $clienteController->obtenerClientes();
            #Asignacion de nombre de cliente
            foreach ($cuentas as $cuenta) {
                foreach ($clientes as $cliente) {
                    if ($cuenta->getCod_cliente() == $cliente->getId_cliente()) {
                        $cuenta->setCod_cliente($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                    }
                }
            }
            foreach ($cuentas as $cuenta) {
                $abonado[$cuenta->getCod_cuenta()] = $productoController->obtenerUltimoAbonobyCuenta($cuenta->getCod_cuenta());
            }
            require_once '../app/views/listaCuentasView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/seguimiento_ventas':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $_SESSION['cod_cuenta'] = $query['id'];
                #$mensaje = '¿Seguro que deseas anular esta venta?';
                #$rutaMsg = 'finalizar_venta';
                $cuenta = $ventasController->obtenerCuenta($query['id']);
                $cliente = $clienteController->obtenerCliente($cuenta->getCod_cliente());
                $ventas = $ventasController->obtenerVentasbyCuenta($query['id']);
                $abono = $productoController->obtenerUltimoAbonobyCuenta($cuenta->getCod_cuenta());
                #Obtener importes en base al total de productos comprados
                foreach ($ventas as $venta) {
                    $importes_productos[$venta->getCod_venta()] = $ventasController->obtenerImporteProductos($venta->getCod_venta());
                }
                foreach ($ventas as $venta) {
                    $productos[$venta->getCod_venta()] = $productoController->obtenerProductosbyVenta($venta->getCod_venta());
                    $abonado[$venta->getCod_venta()] = $productoController->obtenerTotalAbonosbyCuenta($venta->getCod_venta());
                }
                require_once '../app/views/listaVentasSeguimientoView.php';
            }
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_venta_seguimiento':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_cuenta = $_SESSION['cod_cuenta'];
                $productos = $productoController->obtenerProductosbyVenta($query['id']);
                $entregas = [];
                foreach ($productos as $producto) {
                    $entregas[$producto->getCod_prod()] = $productoController->obtenerTotalEntregasbyProducto($producto->getCod_prod());
                }
                #print_r($abonos);
                $cod_venta = $_GET['id'];
                require_once '../app/views/listaProductoVentaSeguimientoView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'entregas') {
                        $_SESSION['cod_venta'] = $_POST['cod_venta'];
                        header("Location: /panaderia/public/producto_entrega?id=" . $_POST['cod_prod']);
                        exit();
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/cuenta_abono':
        if (isset($_SESSION['user_id'])) {
            $rutaDelete = 'eliminar_abono';
            if (isset($query['id'])) {
                $abonos = $productoController->obtenerAbonosByCuenta($query['id']);
                $cod_cuenta = $_GET['id'];
                $_SESSION['cod_cuenta'] = $cod_cuenta;
                require_once '../app/views/listaAbonosView.php';
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_abono':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_cuenta = $_GET['id'];
                require_once '../app/views/createAbonoView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'add') {
                        $productoController->agregarAbonobyCuenta($_POST['id'], $_POST['monto'], $_POST['met_pag']);
                        #Obteniendo cuenta y editando nuevo saldo para hacer el update
                        $cuenta = $ventasController->obtenerCuenta($_POST['id']);
                        $cuenta->setCod_cuenta($_POST['id']);
                        $saldoAct = $cuenta->getSaldo() - $_POST['monto'];
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

                        $ventas = $ventasController->obtenerVentasPendientesbyCuenta($_POST['id']);
                        $sobra = 0;
                        foreach ($ventas as $venta) {
                            #echo '(0)-Venta: ' . $venta->getImporte() . ' Monto: ' . $_POST['monto'] . ' ';
                            if ($sobra == 0) {
                                if ($venta->getImporte() < $_POST['monto']) {
                                    $sobra = $_POST['monto'] - $venta->getImporte();
                                    $_POST['monto'] = 0;
                                    $venta->setImporte(0);
                                    #echo '(1)-Venta: ' . $venta->getImporte() . ' Sobra: ' . $sobra . ' ';
                                } else {
                                    $importeAct = $venta->getImporte() - $_POST['monto'];
                                    $_POST['monto'] = 0;
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
                        header("Location: /panaderia/public/cuenta_abono?id=" . $_POST['id']);
                        exit();
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_abono':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_abon = $_GET['id'];
                $cod_cuenta = $_SESSION['cod_cuenta'];
                $abono = $productoController->obtenerAbonoByID($cod_abon);
                require_once '../app/views/editAbonoView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $abono = new Abono($_POST['cod_venta'], $_POST['monto'], 'S/D');
                        $abono->setCod_abon($_POST['cod_abon']);
                        $productoController->editarAbono($abono);
                        header("Location: /panaderia/public/cuenta_abono?id=" . $_POST['cod_venta']);
                        exit();
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/eliminar_abono':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $cod_cuenta = $_SESSION['cod_cuenta'];
                    $productoController->eliminarAbono($_POST['id']);
                    header("Location: /panaderia/public/cuenta_abono?id=" . $cod_cuenta);
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;

    #PARA PEDIDOS ADELANTADOS
    case '/cuenta_abono_adelanto':
        if (isset($_SESSION['user_id'])) {
            $rutaDelete = 'eliminar_abono';
            if (isset($query['id'])) {
                $abonos = $productoController->obtenerAbonosByCuentaAdelanto($query['id']);
                $cod_cuenta = $_GET['id'];
                $_SESSION['cod_cuenta'] = $cod_cuenta;
                require_once '../app/views/listaAbonosAdelantadoView.php';
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_abono_adelanto':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_cuenta = $_GET['id'];
                require_once '../app/views/createAbonoAdelantoView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'add') {
                        $productoController->agregarAbonobyCuentaAdelanto($_POST['id'], $_POST['monto'], $_POST['met_pag']);
                        header("Location: /panaderia/public/cuenta_abono_adelanto?id=" . $_POST['id']);
                        exit();
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_entrega':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_venta = $_SESSION['cod_venta'];
                $entregas = $productoController->obtenerEntregasByProducto($query['id']);
                $cod_prod = $_GET['id'];
                require_once '../app/views/listaEntregasView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'guardar') {
                        $productos = $productoController->obtenerProductosbyVenta($_POST['cod_venta']);
                        foreach ($productos as $producto) {
                            if (isset($_POST['est_' . $producto->getCod_prod()])) {
                                $productoController->actualizarEstado($producto->getCod_prod(), '1');
                            } else {
                                $productoController->actualizarEstado($producto->getCod_prod(), '0');
                            }
                        }
                        header("Location: /panaderia/public/producto_venta_seguimiento?id=" . $_POST['cod_venta']);
                        exit();
                    } else {
                        header("Location: /panaderia/public/producto_venta_seguimiento?id=" . $_POST['cod_venta']);
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_entrega':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cod_prod = $_GET['id'];
                require_once '../app/views/createEntregaView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'add') {
                        $productoController->agregarEntregabyProducto($_POST['id'], $_POST['cant']);
                        header("Location: /panaderia/public/producto_entrega?id=" . $_POST['id']);
                        exit();
                    } else {
                        header("Location: /panaderia/public/producto_entrega?id=" . $_POST['id']);
                        exit();
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/finalizar_venta':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'confirmar') {
                    #echo($_POST['id']);
                    $ventasController->finalizarVenta($_POST['id']);
                    header("Location: /panaderia/public/registro_ventas");
                    exit();
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/lista_clientes':
        $rutaDelete = 'eliminar_cliente';
        if (isset($_SESSION['user_id'])) {
            $clientes = $clienteController->obtenerClientes();
            require_once '../app/views/listaClientesView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_cliente':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/createClienteView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    $cliente = new Cliente($_POST['dni'], $_POST['nom_cliente'], $_POST['apell_cliente'], $_POST['telef'], $_POST['direccion'], $_POST['sector']);
                    $cod_cliente = $clienteController->agregarCliente($cliente);

                    #Añadido para crear la cuenta del cliente tras crearlo
                    $cuenta = new Cuenta($cod_cliente, 0, 1);
                    $ventasController->agregarCuenta($cuenta);
                    header("Location: /panaderia/public/lista_clientes");
                    exit();
                } else {
                    header("Location: /panaderia/public/lista_clientes");
                    exit();
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_cliente':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cliente = $clienteController->obtenerCliente($query['id']);
                $cliente->setId_cliente($query['id']);
                require_once '../app/views/editClienteView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $cliente = new Cliente($_POST['dni'], $_POST['nom_cliente'], $_POST['apell_cliente'], $_POST['telef'], $_POST['direccion'], $_POST['sector']);
                        $cliente->setId_cliente($_POST['cod_cliente']);
                        print_r($cliente);
                        $clienteController->editarCliente($cliente);
                    }
                }
                header("Location: /panaderia/public/lista_clientes");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/eliminar_cliente':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $cuenta = $ventasController->obtenerCuentabyCliente($_POST['id']);
                    $clienteController->eliminarCliente($_POST['id']);
                    $ventasController->eliminarCuenta($cuenta->getCod_cuenta());
                    header("Location: /panaderia/public/lista_clientes");
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/lista_pedidos':
        $rutaDelete = 'eliminar_pedido';
        if (isset($_SESSION['user_id'])) {
            $ventas = [];
            $pedidos = $ventasController->obtenerPedidos();
            foreach ($pedidos as $pedido) {
                $ventas[] = $ventasController->obtenerVenta($pedido->getCod_venta());
            }
            $vendedores = $ventasController->obtenerVendedores();
            $clientes = $clienteController->obtenerClientes();
            $cuentas = $ventasController->obtenerCuentas();

            #Asignacion de cod_cuenta al pedido
            foreach ($ventas as $venta) {
                foreach ($cuentas as $cuenta) {
                    if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                        #echo $venta->getCod_cuenta().' = '. $cuenta->getCod_cuenta().'<br>';
                        foreach ($pedidos as $pedido) {
                            if ($pedido->getCod_venta() == $venta->getCod_venta()) {
                                $pedido->setCod_pedido($cuenta->getCod_cuenta());
                            }
                        }
                    }
                }
            }
            #Asignacion de nombre de cliente
            foreach ($ventas as $venta) {
                foreach ($cuentas as $cuenta) {
                    if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                        foreach ($clientes as $cliente) {
                            if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                            }
                        }
                    }
                }
            }
            #Asignacion de nombre de vendedor
            foreach ($ventas as $venta) {
                foreach ($vendedores as $vendedor) {
                    if ($venta->getCod_empleado() == $vendedor->getId_empleado()) {
                        $venta->setCod_empleado($vendedor->getNombre() . ' ' . $vendedor->getApellido());
                    }
                }
            }

            #print_r($pedidos);
            require_once '../app/views/listaPedidosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_pedido':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    if (isset($_POST['pasajeExist'])) {
                        $cod_cuenta = $_POST['cod_cuenta'];
                        $currentDate = date('Y-m-d');
                        $fech_ped = $_POST['fech_ped'];
                        $venta = new Venta($cod_cuenta, $_POST['cod_empleado'], $fech_ped, $_POST['pasaje'], $_POST['pasaje'], $_POST['met_pag'], 0);
                        $cod_venta = $ventasController->agregarVenta($venta);
                        $pedido = new Pedido($cod_venta, $_POST['dscr'], $currentDate, $fech_ped, 1);
                        $ventasController->agregarPedido($pedido);
                        header("Location: /panaderia/public/lista_pedidos");
                        exit();
                    } else {
                        $cod_cuenta = $_POST['cod_cuenta'];
                        $currentDate = date('Y-m-d');
                        $fech_ped = $_POST['fech_ped'];
                        $venta = new Venta($cod_cuenta, $_POST['cod_empleado'], $fech_ped, 0, 'S/D', $_POST['met_pag'], 0);
                        $cod_venta = $ventasController->agregarVenta($venta);
                        $pedido = new Pedido($cod_venta, $_POST['dscr'], $currentDate, $fech_ped, 1);
                        echo ($cod_venta);
                        $ventasController->agregarPedido($pedido);
                        header("Location: /panaderia/public/lista_pedidos");
                        exit();
                    }
                }
            }
            $ventas = $ventasController->obtenerVentas();
            $cuentas = $ventasController->obtenerCuentas();
            $clientes = $clienteController->obtenerClientes();
            #Asignacion de nombre de cliente
            foreach ($ventas as $venta) {
                foreach ($cuentas as $cuenta) {
                    if ($venta->getCod_cuenta() == $cuenta->getCod_cuenta()) {
                        foreach ($clientes as $cliente) {
                            if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                                $venta->setCod_cuenta($cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente());
                            }
                        }
                    }
                }
            }
            foreach ($clientes as $cliente) {
                foreach ($cuentas as $cuenta) {
                    if ($cliente->getId_cliente() == $cuenta->getCod_cliente()) {
                        $cliente->setId_cliente($cuenta->getCod_cuenta());
                    }
                }
            }
            $vendedores = $ventasController->obtenerVendedores();
            require_once '../app/views/createPedidoView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_pedido':
        /* if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $cliente = $clienteController->obtenerCliente($query['id']);
                $cliente->setId_cliente($query['id']);
                require_once '../app/views/editClienteView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $cliente = new Cliente($_POST['dni'], $_POST['nom_cliente'], $_POST['apell_cliente'], $_POST['telef'], $_POST['direccion'], $_POST['sector']);
                        $cliente->setId_cliente($_POST['cod_cliente']);
                        print_r($cliente);
                        $clienteController->editarCliente($cliente);
                    }
                }
                header("Location: /panaderia/public/lista_clientes");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        } */
        break;
    case '/eliminar_pedido':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $ventasController->eliminarPedido($_POST['id']);
                    header("Location: /panaderia/public/lista_pedidos");
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_pedido':
        if (isset($_SESSION['user_id'])) {
            $rutaDelete = 'eliminar_producto_venta';
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyVenta($query['id']);
                $cod_venta = $_GET['id'];
                $_SESSION['cod_ventaproducto'] = $cod_venta;
                require_once '../app/views/listaProductoPedidoView.php';
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_producto_pedido':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyFechaAct();
                $cod_venta = $_GET['id'];
                require_once '../app/views/createProductoVentaPedidoView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'guardar') {
                        $producto = new Producto($_POST['nombre'], $_POST['desc'], 'N/A', $_POST['tamano'], $_POST['cant']);
                        $producto->setPrecio($_POST['precio']);
                        $producto->setPrecio_tot($_POST['precio'] * $_POST['cant']);
                        $cod_prod = $productoController->agregarProductobyVenta($producto);
                        $ventasController->unirVentaProductoPedido($cod_prod, $_POST['cod']);
                        header("Location: /panaderia/public/producto_pedido?id=" . $_POST['cod']);
                        exit();
                    } else {
                        header("Location: /panaderia/public/listaVentasView");
                    }
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
}
