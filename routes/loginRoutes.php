<?php
require_once '../app/controllers/loginController.php';

$loginController = new LoginController();

$request = str_replace('/panaderia/public', '', $_SERVER['REQUEST_URI']);

switch ($request) {
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginController->login($_POST['username'], $_POST['password']);
        } else {
            require_once '../app/views/loginView.php';
        }
        break;
    case '/logout':
        $loginController->logout();
        break;
    case '/foryou':
        require_once '../app/views/detalleview.php';
        break;
    /*default:
        header("Location: /panaderia/public/login");
        break;*/
}
?>