<?php
require_once '../config/dbcn.php';
require_once '../app/models/Empleado.php';

class Usuario
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function findUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE user = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findUserByID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE id_empleado = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getEmpleados()
    {
        $empleados = array();
        $stmt = $this->conn->prepare("SELECT * FROM empleado");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $empleado = new Empleado(
                $row['user'],
                $row['clave'],
                $row['nombre'],
                $row['apellido'],
                $row['rol'],
                $row['estado'],
                $row['email']
            );
            $empleado->setId_empleado($row['id_empleado']);
            $empleados[] = $empleado;
        }
        return $empleados;
    }

    public function insertEmpleado($empleado)
    {
        $user = $empleado->getUser();
        $clave = password_hash($empleado->getClave(), PASSWORD_DEFAULT);
        //$clave = $empleado->getClave();
        $nombre = $empleado->getNombre();
        $apellido = $empleado->getApellido();
        $rol = $empleado->getRol();
        $estado = $empleado->getEstado();
        $email = $empleado->getEmail();
        #print_r($empleado);
        $sql = "INSERT INTO empleado (user, clave, nombre, apellido, rol, estado, email) values (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $user, $clave, $nombre, $apellido, $rol, $estado, $email);
        $stmt->execute();
        #echo "Error en la inserción: " . $stmt->error;
    }

    public function updateEmpleado($empleado)
    {
        $id = $empleado->getId_empleado();
        $user = $empleado->getUser();
        #$clave = $empleado->getClave();
        $clave = password_hash($empleado->getClave(), PASSWORD_DEFAULT);
        $nombre = $empleado->getNombre();
        $apellido = $empleado->getApellido();
        $rol = $empleado->getRol();
        $estado = $empleado->getEstado();
        $email = $empleado->getEmail();

        $sql = "UPDATE empleado SET user = ?, clave = ?, nombre = ?, apellido = ?, rol = ?, estado = ?, email = ? WHERE id_empleado = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $user, $clave, $nombre, $apellido, $rol, $estado, $email, $id);
        $stmt->execute();
    }

    public function deleteEmpleado($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM empleado WHERE id_empleado = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }
}
