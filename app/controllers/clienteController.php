<?php
require_once __DIR__ . '/../dao/ClienteDao.php';
class ClienteController{
    private $clienteDao;

    public function __construct() {
        $this->clienteDao = new ClienteDao();
    }

    public function obtenerClientes(){
        return $this->clienteDao->getClientes();
    }

    public function obtenerCliente($id){
        return $this->clienteDao->findClienteByID($id);
    }

    public function agregarCliente($cliente){
        return $this->clienteDao->insertCliente($cliente);
    }

    public function editarCliente($cliente){
        $this->clienteDao->editCliente($cliente);
    }

    public function eliminarCliente($id_cliente){
        $this->clienteDao->deleteCliente($id_cliente);
    }
    /* public function editarUsuario($empleado){
        return $this->usuarioDao->updateEmpleado($empleado);
    }
    public function eliminarEmpleado($id){
        return $this->usuarioDao->deleteEmpleado($id);
    } */
}
?>