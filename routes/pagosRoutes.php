<?php
require_once '../app/controllers/serviciosController.php';
require_once '../app/models/Categoria.php';
require_once '../app/models/Servicio.php';
require_once '../app/models/Pago.php';
$serviciosController = new ServiciosController();
$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/lista_categorias':
        if (isset($_SESSION['user_id'])) {
            $categorias = $serviciosController->obtenerCategorias();
            require_once '../app/views/listaCategoriasView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;

    case '/agregar_categoria':
        if (isset($_SESSION['user_id'])) {
            require_once '../app/views/createCategoriaView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    $categoria = new Categoria($_POST['nombre'], $_POST['dscr']);
                    $serviciosController->agregarCategoria($categoria);
                    header("Location: /panaderia/public/lista_categorias");
                    exit();
                } else {
                    header("Location: /panaderia/public/lista_categorias");
                    exit();
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/lista_servicios':
        if (isset($_SESSION['user_id'])) {
            $categorias = $serviciosController->obtenerCategorias();
            $subcategorias = $serviciosController->obtenerSubCategorias();
            $categorias_det = $serviciosController->obtenerCategorias_Det_1();
            $servicios = $serviciosController->obtenerServicios();
            foreach ($servicios as $servicio) {
                foreach ($categorias as $categoria) {
                    if ($servicio->getCod_categoria() == $categoria->getCod_categoria()) {
                        $servicio->setCod_categoria($categoria->getNom_categoria());
                    }
                }
                foreach ($categorias_det as $categoria_det) {
                    if ($servicio->getTipo_gasto() == $categoria_det->getCod_categoria_det()) {
                        $servicio->setTipo_gasto($categoria_det->getNom_categoria_det());
                    }
                }
                foreach ($subcategorias as $subcategoria) {
                    if ($servicio->getCod_subcategoria() == $subcategoria->getCod_subcategoria()) {
                        $servicio->setCod_subcategoria($subcategoria->getNom_subcategoria());
                    }
                }
            }
            require_once '../app/views/listaServiciosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_servicio':
        if (isset($_SESSION['user_id'])) {
            $categorias = $serviciosController->obtenerCategorias();
            $categorias_det = $serviciosController->obtenerCategorias_Det_1();
            $subcategorias = $serviciosController->obtenerSubCategorias();
            require_once '../app/views/createServicioView.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    $servicio = new Servicio($_POST['categoria'], $_POST['subcategoria'], ucwords(trim($_POST['nombre'])), $_POST['dscr'], $_POST['tipo_gasto'], strtoupper(trim($_POST['proveedor'])));
                    #print_r($servicio);
                    $serviciosController->agregarServicio($servicio);
                    header("Location: /panaderia/public/lista_servicios");
                    exit();
                } else {
                    header("Location: /panaderia/public/lista_servicios");
                    exit();
                }
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/lista_servicios':
        if (isset($_SESSION['user_id'])) {
            $categorias = $serviciosController->obtenerCategorias();
            $subcategorias = $serviciosController->obtenerSubCategorias();
            $categorias_det = $serviciosController->obtenerCategorias_Det_1();
            $servicios = $serviciosController->obtenerServicios();
            foreach ($servicios as $servicio) {
                foreach ($categorias as $categoria) {
                    if ($servicio->getCod_categoria() == $categoria->getCod_categoria()) {
                        $servicio->setCod_categoria($categoria->getNom_categoria());
                    }
                }
                foreach ($categorias_det as $categoria_det) {
                    if ($servicio->getTipo_gasto() == $categoria_det->getCod_categoria_det()) {
                        $servicio->setTipo_gasto($categoria_det->getNom_categoria_det());
                    }
                }
                foreach ($subcategorias as $subcategoria) {
                    if ($servicio->getCod_subcategoria() == $subcategoria->getCod_subcategoria()) {
                        $servicio->setCod_subcategoria($subcategoria->getNom_subcategoria());
                    }
                }
            }
            require_once '../app/views/listaServiciosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/lista_pagos':
        $rutaDelete = 'eliminar_pago';
        if (isset($_SESSION['user_id'])) {
            $pagos = $serviciosController->obtenerPagos();
            $servicios = $serviciosController->obtenerServicios();
            foreach ($pagos as $pago) {
                foreach ($servicios as $servicio) {
                    if ($pago->getCod_servicio() == $servicio->getCod_servicio()) {
                        $pago->setCod_servicio($servicio->getNom_servicio());
                    }
                }
            }
            require_once '../app/views/listaPagosView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/agregar_pago':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'guardar') {
                    $pago = new Pago($_POST['servicio'], $_POST['dscr'], ($_POST['cantidad']), $_POST['unidad'], $_POST['met_pago'], $_POST['pago'], ($_POST['cantidad'] * floatval($_POST['pago'])), $_POST['fecha']);
                    $serviciosController->agregarPago($pago);
                    header("Location: /panaderia/public/lista_pagos");
                    exit();
                } else {
                    header("Location: /panaderia/public/lista_pagos");
                    exit();
                }
            }
            $servicios = $serviciosController->obtenerServicios();
            require_once '../app/views/createPagoView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    /* case '/editar_pago':
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
        break; */
    case '/eliminar_pago':
        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'eliminar') {
                    $serviciosController->eliminarPago($_POST['id']);
                    header("Location: /panaderia/public/lista_pagos");
                    exit();
                }
            } else {
                header("Location: /panaderia/public/login");
            }
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/analisis_rentabilidad':
        if (isset($_SESSION['user_id'])) {
            $categorias = $serviciosController->obtenerCategorias();
            $categorias_det_1 = $serviciosController->obtenerCategorias_Det_1();
            $categorias_det_1_totales = $serviciosController->obtenerCategorias_Det_1_Totales();
            $categorias_det_2 = $serviciosController->obtenerCategorias_Det_2();
            foreach ($categorias_det_1 as $categoria_det_1) {
                foreach ($categorias_det_1_totales as $categoria_det_1_totales) {
                    if($categoria_det_1->getCod_categoria_det() == $categoria_det_1_totales->getCod_categoria_det()){
                        $categoria_det_1->setTotal($categoria_det_1_totales->getTotal());
                    }
                }
            }
            $pagos = $serviciosController->obtenerPagos();
            $servicios = $serviciosController->obtenerServicios();
            foreach ($pagos as $pago) {
                foreach ($servicios as $servicio) {
                    if ($pago->getCod_servicio() == $servicio->getCod_servicio()) {
                        $pago->setCod_servicio($servicio->getNom_servicio());
                    }
                }
            }
            require_once '../app/views/rentabilidadView.php';
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
}
