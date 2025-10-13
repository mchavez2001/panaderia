<?php
require_once '../app/controllers/productoController.php';
require_once '../app/models/Insumo.php';
$productoController = new ProductoController();

$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);
$request = parse_url($request);
$path = $request['path'];
$query = [];
if (isset($request['query'])) {
    parse_str($request['query'], $query);
}
switch ($path) {
    case '/lista_productos':
        if (isset($_SESSION['user_id'])) {
            $productos = $productoController->obtenerProductosbyFechaAct();
            require_once '../app/views/existenciaProductosView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
    case '/catalogar_productos':
        if (isset($_SESSION['user_id'])) {
            $productos = $productoController->obtenerProductosbyFechaAct();
            require_once '../app/views/existenciaProductosView.php';
            exit();
        } else {
            header("Location: /panaderia/public/login");
        }
        break;
}
