<?php
require_once '../app/controllers/insumosController.php';
require_once '../app/models/Insumo.php';
$insumosController = new InsumoController();

$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/lista_insumos':
        if (isset($_SESSION['user_id'])) {
            $insumos = $insumosController->obtenerInsumosbyFecha();
            #$recursos = $insumosController->obtenerRecursos();
            require_once '../app/views/existenciaInsumosView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/registro_lista_insumos':
        if (isset($_SESSION['user_id'])) {
            $rutaDelete = 'eliminar_insumo';
            $insumos = $insumosController->obtenerInsumosListaDelDia();
            require_once '../app/views/registrarInsumosView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_insumo':
        if (isset($_SESSION['user_id'])) {
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
        break;
    case '/editar_insumo':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $insumo = $insumosController->obtenerInsumoListaDelDiaByID($query['id']);
                $insumo->setCod_ins($_GET['id']);
                require_once '../app/views/editInsumoDelDiaView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        if (isset($_POST['packExist'])) {
                            $insumo = new Insumo($_POST['nom_ins'], $_POST['dscr'], $_POST['bloque'], $_POST['uni_bloque'], $_POST['pack'], $_POST['uni_pack'], $_POST['peso_ind'], $_POST['uni_med'], 'S/D', 'S/D', 'S/D');
                        }else{
                            $insumo = new Insumo($_POST['nom_ins'], $_POST['dscr'], $_POST['bloque'], $_POST['uni_bloque'], 'S/D', 'S/D', $_POST['peso_ind'], $_POST['uni_med'], 'S/D', 'S/D', 'S/D');
                        }
                        $insumo->setCod_ins($_POST['id']);
                        $insumosController->editarInsumoListaDelDia($insumo);
                        header("Location: /panaderia/public/registro_lista_insumos");
                        exit();
                    } else {
                        header("Location: /panaderia/public/registro_lista_insumos");
                        exit();
                    }
                }
                header("Location: /panaderia/public/usuarios");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/eliminar_insumo':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $insumosController->eliminarInsumoListaDelDia($_POST['id']);
                    header("Location: /panaderia/public/registro_lista_insumos");
                    exit();
                } else {
                    header("Location: /panaderia/public/registro_lista_insumos");
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        }
        break;
    case '/enviar_insumos':
        if (isset($_SESSION['user_id'])) {
            $insumos = $insumosController->obtenerInsumosListaDelDia();
            require_once '../app/views/enviarPedidoView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/generarPDF':
        if (isset($_SESSION['user_id'])) {
            require_once '../config/generarPDF.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/recepcion_insumos':
        if (isset($_SESSION['user_id'])) {
            $insumos = $insumosController->obtenerInsumosListaDelDia();
            require_once '../app/views/recepcionInsumoView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_insumo_precio':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $insumo = $insumosController->obtenerInsumoListaDelDiaByID($query['id']);
                $insumo->setCod_ins($_GET['id']);
                require_once '../app/views/editInsumoPrecioView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $insumo = new Insumo('S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', $_POST['precio'], 'S/D');
                        $insumo->setCod_ins($_POST['id']);
                        $insumosController->actualizarPrecioInsumo($insumo);
                        header("Location: /panaderia/public/recepcion_insumos");
                        exit();
                    } else {
                        header("Location: /panaderia/public/recepcion_insumos");
                        exit();
                    }
                }
                header("Location: /panaderia/public/usuarios");
                exit();
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/guardar_inv_insumo':
        if (isset($_SESSION['user_id'])) {
            $insumosController->guardarInventarioInsumos();
            header("Location: /panaderia/public/insumos");
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
}
