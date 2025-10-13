<?php
require_once '../app/controllers/usuariosController.php';
require_once '../app/controllers/produccionController.php';
require_once '../app/models/Empleado.php';
$usuariosController = new UsuariosController();
$produccionController = new ProduccionController();

$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/dashboard':
        if (isset($_SESSION['user_id'])) {
            $insumos = $produccionController->obtenerInsumosConsumidos();
            $productos = $produccionController->obtenerCantidadProductobyVenta();
            $productos_produccion = $produccionController->obtenerCantidadProductobyProduccion();
            // Convierte los objetos Insumo a arrays para que JSON los entienda bien
            $data_insumos = array_map(function ($insumo) {
                return [
                    'nombre' => $insumo->getNom_ins(),     // nombre del insumo
                    'fecha' => $insumo->getDscr(),        // asumimos que 'dscr' es la fecha
                    'stock' => $insumo->getStock(),       // cantidad en stock
                ];
            }, $insumos);
            $data_productos = array_map(function ($producto) {
                return [
                    'nombre' => $producto->getNom_prod(),
                    'tamano' => $producto->getTam_prod(),
                    'fecha' => $producto->getDscr_prod(),
                    'cantidad' => $producto->getCant_prod(),
                ];
            }, $productos);
            $data_productos_produccion = array_map(function ($producto) {
                return [
                    'nombre' => $producto->getNom_prod(),
                    'tamano' => $producto->getTam_prod(),
                    'fecha' => $producto->getDscr_prod(),
                    'cantidad' => $producto->getCant_prod(),
                ];
            }, $productos_produccion);
            // Enviar la variable a la vista
            $jsonData_insumos = json_encode($data_insumos);
            $jsonData_productos = json_encode($data_productos);
            $jsonData_productos_produccion = json_encode($data_productos_produccion);

            require_once '../app/views/homeView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/usuarios':
        if (isset($_SESSION['user_id'])) {
            $usuarios = $usuariosController->obtenerUsuarios();
            $rutaDelete = 'eliminar_usuario';
            require_once '../app/views/usuariosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/ventas':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuVentasView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/produccion':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuProduccionView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/insumos':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuInsumosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/productos':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuProductoView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/pagos':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuGastosCostosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/reportes':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/menuReportesAnalisis.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/crear_usuario':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/createUsuarioView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'crear') {
                    $usuariosController->agregarUsuario($_POST['user'], $_POST['clave'], $_POST['nombres'], $_POST['apellidos'], $_POST['rol'], $_POST['estado'], $_POST['correo']);
                    header("Location: /panaderia/public/usuarios");
                    exit();
                } else {
                    header("Location: /panaderia/public/usuarios");
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/editar_usuario':
        if (isset($_SESSION['user_id'])) {
            if (isset($query['id'])) {
                $usuario = $usuariosController->obtenerUsuario($query['id']);
                $usuario->setId_empleado($_GET['id']);
                require_once '../app/views/editUsuarioView.php';
            } else {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['action'] == 'update') {
                        $usuario = new Empleado($_POST['user'], $_POST['clave'], $_POST['nombres'], $_POST['apellidos'], $_POST['rol'], $_POST['estado'], $_POST['correo']);
                        $usuario->setId_empleado($_POST['id']);
                        $usuariosController->editarUsuario($usuario);
                        header("Location: /panaderia/public/usuarios");
                        exit();
                    } else {
                        header("Location: /panaderia/public/usuarios");
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
    case '/eliminar_usuario':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $usuariosController->eliminarEmpleado($_POST['id']);
                    header("Location: /panaderia/public/usuarios");
                    exit();
                } else {
                    header("Location: /panaderia/public/usuarios");
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        }
        break;
    case '/detalle':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/index.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
    case '/flower':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/flower.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
    case '/pelusa':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/index2.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
    case '/florespelusa':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/flower2.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
    case '/diaespecial':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/index3.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
    case '/diaespecialflores':
        #if (isset($_SESSION['user_id'])) {
            require_once '../app/views/detalle/flower3.html';
        #} else {
        #    header("Location: /panaderia/public/login");
        #}
        break;
}
