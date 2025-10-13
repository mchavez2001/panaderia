<?php
require_once '../config/dbcn.php';
require_once '../app/models/Consumo_Petroleo.php';

class PetroleoDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getConsumosPetroleo()
    {
        $consumos = array();
        $stmt = $this->conn->prepare("SELECT * FROM consumo_petroleo ORDER BY fecha DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $consumo = new Consumo_Petroleo(
                $row['fecha'],
                $row['altura_inicial'],
                $row['altura_final'],
                $row['variante'],
                $row['galones'],
                $row['inversion']
            );
            $consumo->setCod_consumo_petroleo($row['cod_consumo_petroleo']);
            $consumos[] = $consumo;
        }
        return $consumos;
    }
    public function getConsumoPetroleo($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM consumo_petroleo WHERE cod_consumo_petroleo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $consumo = new Consumo_Petroleo(
                $row['fecha'],
                $row['altura_inicial'],
                $row['altura_final'],
                $row['variante'],
                $row['galones'],
                $row['inversion']
            );
            $consumo->setCod_consumo_petroleo($row['cod_consumo_petroleo']);
        }
        return $consumo;
    }

    public function insertConsumo_Petroleo($consumo)
    {
        $fecha = $consumo->getFecha();
        $altura_inicial = $consumo->getAltura_inicial();
        $altura_final = $consumo->getAltura_final();
        $variante = $consumo->getVariante();
        $galones = $consumo->getGalones();
        $inversion = $consumo->getInversion();

        $sql = "INSERT INTO consumo_petroleo (fecha, altura_inicial, altura_final, variante, galones, inversion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sddddd", $fecha, $altura_inicial, $altura_final, $variante, $galones, $inversion);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function editConsumo_Petroleo($consumo)
    {
        $cod_consumo_petroleo = $consumo->getCod_consumo_petroleo();
        $fecha = $consumo->getFecha();
        $altura_inicial = $consumo->getAltura_inicial();
        $altura_final = $consumo->getAltura_final();
        $variante = $consumo->getVariante();
        $galones = $consumo->getGalones();
        $inversion = $consumo->getInversion();

        $sql = "UPDATE consumo_petroleo SET fecha = ?, altura_inicial = ?, altura_final = ?, variante = ?, galones = ?, inversion = ? WHERE cod_consumo_petroleo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdddddi", $fecha, $altura_inicial, $altura_final, $variante, $galones, $inversion, $cod_consumo_petroleo);
        $stmt->execute();
    }
    public function deleteConsumo_Petroleo($id)
    {
        $sql = "DELETE FROM consumo_petroleo WHERE cod_consumo_petroleo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
