<?php
require_once __DIR__ . '/../dao/EmpleadoDao.php';

class LoginController {
    private $empleadoModel;

    public function __construct() {
        $this->empleadoModel = new Usuario();
    }

    public function login($username, $password) {
        $user = $this->empleadoModel->findUser($username, $password);
        $claveUnhash = password_verify($_POST['password'], $user['clave']);
        //echo($claveUnhash);
        if ($claveUnhash) {
            $_SESSION['user_id'] = $user['id_empleado'];
            $_SESSION['rol'] = $user['rol'];
            #$_SESSION['nombre'] = $user['nombre'].' '.$user['apellido'];
            $_SESSION['nombre'] = $user['nombre'];
            //print_r($user);
            header("Location: /panaderia/public/dashboard");
        } else {
            echo ('Credenciales invalidas');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /panaderia/public/login");
    }
}
?>
