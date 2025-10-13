<?php
require_once '../app/controllers/ventasController.php';
require_once '../app/controllers/clienteController.php';
require_once '../app/controllers/productoController.php';
require_once '../app/controllers/insumosController.php';
require_once '../app/controllers/produccionController.php';
require_once '../app/models/Insumo.php';
require_once '../app/models/Producto.php';
require_once '../app/models/Venta.php';
$insumosController = new InsumoController();
$ventasController = new VentasController();
$clienteController = new ClienteController();
$productoController = new ProductoController();
$produccionController = new ProduccionController();
$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/reporte_inventario_insumos':
        if (isset($_SESSION['user_id'])) {
            $action = '/panaderia/public/reporte_inventario_insumos';
            require_once '../app/views/reportesFormulario.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'enviar') {
                    $insumos = [];
                    $insumos = $insumosController->obtenerInsumosEntreFecha($_POST['fchini'], $_POST['fchfin']);
                    $fechaIni = $_POST['fchini'];
                    $fechaFin = $_POST['fchfin'];
                    #echo($_POST['fchini'].'  '. $_POST['fchfin']);
                    require_once '../app/views/listaReporteInsumos.php';
                    #header("Location: /panaderia/public/reporte_inventario_insumos");
                    exit();
                } else {
                    echo('Hola');
                    header("Location: /panaderia/public/reporte_inventario_insumos");
                }
            }
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/reporte_producciones':
        if (isset($_SESSION['user_id'])) {
            $action = '/panaderia/public/reporte_producciones';
            require_once '../app/views/reportesFormulario.php';
            $productos = $produccionController->obtenerProductosProduccion();
            require_once '../app/views/produccionProductosView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'enviar') {
                    $insumos = [];
                    $insumos = $insumosController->obtenerInsumosEntreFecha($_POST['fchini'], $_POST['fchfin'],);
                    #echo($_POST['fchini'].'  '. $_POST['fchfin']);
                    require_once '../app/views/listaReporteInsumos.php';
                    #header("Location: /panaderia/public/reporte_inventario_insumos");
                    exit();
                } else {
                    echo('Hola');
                    header("Location: /panaderia/public/reporte_inventario_insumos");
                }
            }
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_venta':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyVenta($query['id']);
                #print_r($productos);
                $cod_venta = $_GET['id'];
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
        /* if (isset($_SESSION['user_id'])) {
            require_once '../app/views/createInsumoView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    if (isset($_POST['packExist'])) {
                        $insumosController->agregarInsumoListaDelDia($_POST['nombre'], $_POST['desc'], $_POST['bloque'], $_POST['uni_bloque'], $_POST['pack'], $_POST['uni_pack'], $_POST['peso_ind'], $_POST['uni_med'], 'S/D', 'S/D', 'S/D');
                    } else {
                        $insumosController->agregarInsumoListaDelDia($_POST['nombre'], $_POST['desc'], $_POST['bloque'], $_POST['uni_bloque'], 'S/D', 'S/D', $_POST['peso_ind'], $_POST['uni_med'], 'S/D', 'S/D', 'S/D');
                    }
                    header("Location: /panaderia/public/registro_lista_insumos");
                    exit();
                } else {
                    header("Location: /panaderia/public/registro_lista_insumos");
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break; */
    case '/seguimiento_ventas':
        if (isset($_SESSION['user_id'])) {
            $ventas = $ventasController->obtenerVentas();
            foreach ($ventas as $venta) {
                $productos[$venta->getCod_venta()] = $productoController->obtenerProductosbyVenta($venta->getCod_venta());
            }
            #print_r($productos);
            require_once '../app/views/listaVentasSeguimientoView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/producto_venta_seguimiento':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $productos = $productoController->obtenerProductosbyVenta($query['id']);
                #print_r($productos);
                $cod_venta = $_GET['id'];
                require_once '../app/views/listaProductoVentaSeguimientoView.php';
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
}
