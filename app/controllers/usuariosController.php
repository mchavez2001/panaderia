<?php
require_once __DIR__ . '/../dao/EmpleadoDao.php';
class UsuariosController{
    private $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new Usuario();
    }

    public function obtenerUsuarios(){
        return $this->usuarioDao->getEmpleados();
    }

    public function obtenerUsuario($id){
        $data = $this->usuarioDao->findUserByID($id);
        $empleado = new Empleado($data['user'], $data['clave'], $data['nombre'], $data['apellido'], $data['rol'], $data['estado'], $data['email']);
        return $empleado;
    }

    public function agregarUsuario($user, $clave, $nombre, $apellido, $rol, $estado, $email){
        $empleado = new Empleado($user, $clave, $nombre, $apellido, $rol, $estado, $email);
        return $this->usuarioDao->insertEmpleado($empleado);
    }
    public function editarUsuario($empleado){
        return $this->usuarioDao->updateEmpleado($empleado);
    }
    public function eliminarEmpleado($id){
        return $this->usuarioDao->deleteEmpleado($id);
    }
}
?>