<?php
session_start();
date_default_timezone_set('America/Lima');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../routes/mainRoutes.php';

$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);

// Redirigir a /login si la solicitud es la raíz
if ($request == '' || $request == '/') {
    header("Location: /panaderia/public/login");
    exit();
}
?>
