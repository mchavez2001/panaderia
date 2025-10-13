<?php
require_once '../config/dbcn.php';
require_once '../app/models/Insumo.php';
require_once '../app/models/Recurso.php';
class InsumoDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getInsumosbyFecha()
    {
        $insumos = array();
        $stmt = $this->conn->prepare("SELECT i.* FROM insumotoinventario t INNER JOIN insumo i ON t.cod_ins = i.cod_ins INNER JOIN inventarioinsumo a ON t.cod_inv_ins = a.cod_inv_ins WHERE a.fech_crea = (SELECT MAX(fech_crea) FROM inventarioinsumo)");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $insumo = new Insumo(
                $row['nom_ins'],
                $row['dscr'],
                $row['bloque'],
                $row['uni_bloque'],
                $row['pack'],
                $row['uni_pack'],
                $row['peso_ind'],
                $row['uni_med'],
                $row['stock'],
                $row['precio'],
                $row['precio_tot']
            );
            $insumo->setCod_ins($row['cod_ins']);
            $insumos[] = $insumo;
        }
        return $insumos;
    }

    public function insertInsumoSinPrecio($insumo)
    {
        $nom_ins = $insumo->getNom_ins();
        $dscr = $insumo->getDscr();
        $bloque = $insumo->getBloque();
        $uni_bloque = $insumo->getUni_bloque();
        $pack = $insumo->getPack();
        $uni_pack = $insumo->getUni_pack();
        $peso_ind = $insumo->getPeso_ind();
        $uni_med = $insumo->getUni_med();
        $stock = $insumo->getStock();
        #$precio = $insumo->getNom_ins();
        #$precio_tot = $insumo->getNom_ins();

        if ($pack == 'S/D' && $uni_pack = 'S/D') {
            $sql = "INSERT INTO insumo (nom_ins, dscr, bloque, uni_bloque, peso_ind, uni_med, stock) values (?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisdsd", $nom_ins, $dscr, $bloque, $uni_bloque, $peso_ind, $uni_med, $stock);
        } else {
            $sql = "INSERT INTO insumo (nom_ins, dscr, bloque, uni_bloque, pack, uni_pack, peso_ind, uni_med, stock) values (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisisdsd", $nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stock);
        }
        $stmt->execute();
    }

    public function getInsumosSinPrecio()
    {
        $insumos = array();
        $stmt = $this->conn->prepare("SELECT * FROM insumo WHERE precio_tot IS NULL AND bloque IS NOT NULL");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $insumo = new Insumo(
                $row['nom_ins'],
                $row['dscr'],
                $row['bloque'],
                $row['uni_bloque'],
                $row['pack'],
                $row['uni_pack'],
                $row['peso_ind'],
                $row['uni_med'],
                $row['stock'],
                $row['precio'],
                $row['precio_tot']
            );
            $insumo->setCod_ins($row['cod_ins']);
            $insumos[] = $insumo;
        }
        return $insumos;
    }

    public function updateInsumoSinPrecio($insumo)
    {
        $cod_ins = $insumo->getCod_ins();
        $nom_ins = $insumo->getNom_ins();
        $dscr = $insumo->getDscr();
        $bloque = $insumo->getBloque();
        $uni_bloque = $insumo->getUni_bloque();
        $pack = $insumo->getPack();
        $uni_pack = $insumo->getUni_pack();
        $peso_ind = $insumo->getPeso_ind();
        $uni_med = $insumo->getUni_med();
        $stock = $insumo->getStock();
        if ($insumo->getPack() == 'S/D') {
            $sql = "UPDATE insumo SET nom_ins = ?, dscr = ?, bloque = ?, uni_bloque = ?, peso_ind = ?, uni_med = ?, stock = ? WHERE cod_ins = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisdsdi", $nom_ins, $dscr, $bloque, $uni_bloque, $peso_ind, $uni_med, $stock, $cod_ins);
            $stmt->execute();
        } else {
            $sql = "UPDATE insumo SET nom_ins = ?, dscr = ?, bloque = ?, uni_bloque = ?, pack = ?, uni_pack = ?, peso_ind = ?, uni_med = ?, stock = ? WHERE cod_ins = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisisdsdi", $nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stock, $cod_ins);
            $stmt->execute();
        }
    }

    public function deleteInsumoSinPrecio($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM insumo WHERE cod_ins = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    public function findInsumoByID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM insumo WHERE cod_ins = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function updatePrecioInsumo($insumo)
    {
        $cod_ins = $insumo->getCod_ins();
        $precio = $insumo->getPrecio();
        #$precioTotal = $insumo->getStock();
        $sql = "UPDATE insumo SET precio = ? WHERE cod_ins = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ds", $precio, $cod_ins);
        $stmt->execute();
    }
    public function createNewInvInsumo($insumosOld, $insumosNew)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
        #Datos Tabla insumo (Insumos Nuevos)
        for ($i = 0; $i < count($insumosNew); $i++) {
            $cod_ins = $insumosNew[$i]->getCod_ins();
            $bloque = $insumosNew[$i]->getBloque();
            $pack = $insumosNew[$i]->getPack();
            $precio = $insumosNew[$i]->getPrecio();
            if (is_null($pack)) {
                $precio_tot = $bloque * $precio;
            } else {
                $precio_tot = $bloque * $pack * $precio;;
            }

            $sql = "UPDATE insumo SET precio_tot = ? WHERE cod_ins = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ds", $precio_tot, $cod_ins);
            $stmt->execute();
            $cod_ins_new[] = $cod_ins;
        }
        #Datos Tabla insumo (Insumos Pasados)
        for ($i = 0; $i < count($insumosOld); $i++) {
            for ($j = 0; $j < count($insumosNew); $j++) {
                if ($insumosOld[$i]->getNom_ins() == $insumosNew[$j]->getNom_ins()) {
                    $insumosOld[$i]->setStock($insumosOld[$i]->getStock() + $insumosNew[$j]->getStock());
                    $insumosOld[$i]->setPrecio($insumosNew[$j]->getPrecio());
                    $insumosOld[$i]->setPrecio_tot($insumosNew[$j]->getPrecio_tot());
                }
            }
            $nom_ins = $insumosOld[$i]->getNom_ins();
            $dscr = $insumosOld[$i]->getDscr();
            $bloque = $insumosOld[$i]->getBloque();
            $uni_bloque = $insumosOld[$i]->getUni_bloque();
            $pack = $insumosOld[$i]->getPack();
            $uni_pack = $insumosOld[$i]->getUni_pack();
            $peso_ind = $insumosOld[$i]->getPeso_ind();
            $uni_med = $insumosOld[$i]->getUni_med();
            $stock = $insumosOld[$i]->getStock();
            $precio = $insumosOld[$i]->getPrecio();
            $precio_tot = $insumosOld[$i]->getPrecio_tot();

            $sql = "INSERT INTO insumo (nom_ins, dscr, bloque, uni_bloque, pack, uni_pack, peso_ind, uni_med, stock, precio, precio_tot) values (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisisdsddd", $nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stock, $precio, $precio_tot);
            $stmt->execute();
            $cod_ins_old[] = $this->conn->insert_id;
        }

        #Datos Tabla inventarioInsumo
            $fech_crea = date('Y-m-d');
            $prov = 'Claire Pardo';
            $sql = "INSERT INTO inventarioinsumo (fech_crea, prov) values (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $fech_crea, $prov);
            $stmt->execute();

            #Datos Tabla insumoToInventario
            $cod_inv_ins = $this->conn->insert_id; #Se usa para la tabla insumoToInventario
            $fech_ingr = date('Y-m-d');
            #$fech_cad;
            #Llenado de Insumos Pasados
            for ($i = 0; $i < count($cod_ins_old); $i++) {
                $sql = "INSERT INTO insumotoinventario (cod_inv_ins, cod_ins, fech_ingr) values (?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iis", $cod_inv_ins, $cod_ins_old[$i], $fech_ingr);
                $stmt->execute();
            }
            #Llenado de Insumos Nuevos
            /* for ($i = 0; $i < count($cod_ins_new); $i++) {
                $sql = "INSERT INTO insumotoinventario (cod_inv_ins, cod_ins, fech_ingr) values (?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iis", $cod_inv_ins, $cod_ins_new[$i], $fech_ingr);
                $stmt->execute();
            } */
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function getInsumosbyFechaIndicada($fchini, $fchfin)
    {
        $insumos = array();
        $stmt = $this->conn->prepare("SELECT i.* FROM insumotoinventario t INNER JOIN insumo i ON t.cod_ins = i.cod_ins INNER JOIN inventarioinsumo a ON t.cod_inv_ins = a.cod_inv_ins WHERE a.fech_crea > ? and a.fech_crea < ?");
        $stmt->bind_param("ss", $fchini, $fchfin);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $insumo = new Insumo(
                $row['nom_ins'],
                $row['dscr'],
                $row['bloque'],
                $row['uni_bloque'],
                $row['pack'],
                $row['uni_pack'],
                $row['peso_ind'],
                $row['uni_med'],
                $row['stock'],
                $row['precio'],
                $row['precio_tot']
            );
            $insumo->setCod_ins($row['cod_ins']);
            $insumos[] = $insumo;
        }
        return $insumos;
    }
    public function getRecursos()
    {
        $recursos = array();
        $stmt = $this->conn->prepare("SELECT r.* FROM recurso r INNER JOIN inventario_recurso ir ON r.cod_inv_rec = ir.cod_inv_rec WHERE ir.fech_reg = CURRENT_DATE");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $recurso = new Recurso(
                $row['cod_inv_rec'],
                $row['cant_rec'],
                $row['uni_med_rec'],
                $row['precio_rec_unit'],
                $row['precio_rec_tot']
            );
            $recurso->setCod_rec($row['cod_rec']);
            $recursos[] = $recurso;
        }
        return $recursos;
    }
}
