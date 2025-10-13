<?php
require_once '../config/dbcn.php';
require_once '../app/models/Cliente.php';
require_once '../app/models/Venta.php';
require_once '../app/models/Cuenta.php';
class ClienteDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getClientes()
    {
        $clientes = array();
        $stmt = $this->conn->prepare("SELECT * FROM cliente");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $cliente = new Cliente(
                $row['dni'],
                $row['nom_cliente'],
                $row['apell_cliente'],
                $row['telef'],
                $row['direccion'],
                $row['sector']
            );
            $cliente->setId_cliente($row['id_cliente']);
            $clientes[] = $cliente;
        }
        return $clientes;
    }

    public function findClienteByID($id_cliente)
    {
        $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $cliente = new Cliente(
                $row['dni'], 
                $row['nom_cliente'], 
                $row['apell_cliente'], 
                $row['telef'], 
                $row['direccion'],
                $row['sector']
            );
        }
        return $cliente;
    }
    public function insertCliente($cliente)
    {
        $dni = $cliente->getDni();
        $nom_cliente = $cliente->getNom_cliente();
        $apell_cliente = $cliente->getApell_cliente();
        $telef = $cliente->getTelef();
        $direccion = $cliente->getDireccion();
        $sector = $cliente->getSector();

        $sql = "INSERT INTO cliente (dni, nom_cliente, apell_cliente, telef, direccion, sector) values (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $dni, $nom_cliente, $apell_cliente, $telef, $direccion, $sector);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function editCliente($cliente)
    {
        $id_cliente = $cliente->getId_cliente();
        $dni = $cliente->getDni();
        $nom_cliente = $cliente->getNom_cliente();
        $apell_cliente = $cliente->getApell_cliente();
        $telef = $cliente->getTelef();
        $direccion = $cliente->getDireccion();
        $sector = $cliente->getSector();

        $sql = "UPDATE cliente SET dni = ?, nom_cliente = ?, apell_cliente = ?, telef = ?, direccion = ?, sector = ? WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $dni, $nom_cliente, $apell_cliente, $telef, $direccion, $sector, $id_cliente);
        $stmt->execute();

        print_r($cliente);
    }

    public function deleteCliente($id_cliente)
    {
        $sql = "DELETE FROM cliente WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
    }
}
