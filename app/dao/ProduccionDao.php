<?php
require_once '../config/dbcn.php';
require_once '../app/models/Producto.php';
require_once '../app/models/Insumo.php';
require_once '../app/models/Produccion.php';
class ProduccionDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getCocheForProduction()
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT c.cod_coche AS codigo_coche, pr.nom_prod AS producto, pr.precio AS cantidad FROM coche c INNER JOIN producto pr ON pr.cod_prod = c.cod_prod WHERE c.estado = '0'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['producto'],
                'S/D',
                'S/D',
                'S/D',
                $row['cantidad']
            );
            $producto->setCod_prod($row['codigo_coche']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function getCoche($id)
    {
        $stmt = $this->conn->prepare("SELECT c.cod_coche AS codigo_coche, pr.nom_prod AS producto, pr.precio AS cantidad FROM coche c INNER JOIN producto pr ON pr.cod_prod = c.cod_prod where c.cod_coche = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['producto'],
                'S/D',
                'S/D',
                'S/D',
                $row['cantidad']
            );
            $producto->setCod_prod($row['codigo_coche']);
        }
        return $producto;
    }

    public function insertCoche($producto)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Datos Tabla Producto
            $nom_prod = $producto->getNom_prod();
            $cant_prod = $producto->getCant_prod();

            $sql = "INSERT INTO producto (nom_prod, precio) values (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sd", $nom_prod, $cant_prod);
            $stmt->execute();
            $cod_prod = $this->conn->insert_id;

            $sql = "INSERT INTO coche (cod_prod, estado, fecha) values (?, 0, CURDATE())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $cod_prod);
            $stmt->execute();

            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function editCoche($producto)
    {
        $cod_coche = $producto->getCod_prod();
        $nom_prod = $producto->getNom_prod();
        $cant_prod = $producto->getCant_prod();
        $sql = "UPDATE producto p INNER JOIN coche c ON p.cod_prod = c.cod_prod SET p.nom_prod = ?, p.precio = ? WHERE c.cod_coche = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdi", $nom_prod, $cant_prod, $cod_coche);
        $stmt->execute();
    }

    public function deleteCoche($id)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Primero buscamos el cod_prod en la tabla coche para eliminarlo
            $stmt = $this->conn->prepare("SELECT * FROM coche WHERE cod_coche = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            #Variables de la tabla:
            #cod_coche
            #cod_prod

            $cod_prod = $row['cod_prod'];

            #Eliminar Coche
            $stmt = $this->conn->prepare("DELETE FROM coche WHERE cod_coche = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            #Eliminar Producto
            $stmt = $this->conn->prepare("DELETE FROM producto WHERE cod_prod = ?");
            $stmt->bind_param("i", $cod_prod);
            $stmt->execute();
            # Confirmar la transacción  
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function getProductosForProductionbyCoches($id){
        $productos = array();
        $stmt = $this->conn->prepare("SELECT c.cod_coche, pr.unidades, pr.cod_procc, p.nom_prod, p.dscr_prod, p.tam_prod, pr.cant_procc, pr.cant_extra from coche c inner join coche_to_produccion ctp on c.cod_coche = ctp.cod_coche inner join produccion pr on ctp.cod_procc = pr.cod_procc inner join productotoproducc ptp on pr.cod_procc = ptp.cod_procc inner join producto p on ptp.cod_prod = p.cod_prod WHERE pr.est = '0' and c.cod_coche = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['unidades'],
                $row['cant_extra'],
                $row['tam_prod'],
                $row['cant_procc']
            );
            $producto->setCod_prod($row['cod_procc']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function getProductosForProduction()
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT pr.unidades,pr.cod_procc, p.nom_prod, p.dscr_prod, pr.cant_extra, p.tam_prod, pr.cant_procc FROM productotoproducc prp INNER JOIN produccion pr ON prp.cod_procc = pr.cod_procc INNER JOIN producto p ON prp.cod_prod = p.cod_prod WHERE pr.est = '0'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['unidades'],
                $row['cant_extra'],
                $row['tam_prod'],
                $row['cant_procc']
            );
            $producto->setCod_prod($row['cod_procc']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function getProductionbyID($id)
    {
        $stmt = $this->conn->prepare("SELECT pr.cod_procc, p.nom_prod, p.dscr_prod, pr.cant_extra, p.tam_prod, pr.cant_procc FROM productotoproducc prp INNER JOIN produccion pr ON prp.cod_procc = pr.cod_procc INNER JOIN producto p ON prp.cod_prod = p.cod_prod WHERE pr.est = '0' AND pr.cod_procc = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['dscr_prod'],
                $row['cant_extra'],
                $row['tam_prod'],
                $row['cant_procc']
            );
            $producto->setCod_prod($row['cod_procc']);
        }
        return $producto;
    }
    public function insertProduccion($cod_coche, $produccion, $producto)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Datos Tabla Produccion
            $lata = $produccion->getLata();
            $cant_procc = $produccion->getCant_procc();
            $unidades = $produccion->getUnidades();
            $fech_ini = $produccion->getFech_ini();
            $est = $produccion->getEst();

            #Decidir entre produccion con unidades extras y sin unidades etras
            if ($produccion->getCant_extra() == 0) {
                $sql = "INSERT INTO produccion (lata, cant_procc, unidades, fech_ini, est) values (?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iiisi", $lata, $cant_procc, $unidades, $fech_ini, $est);
            } else {
                $sql = "INSERT INTO produccion (lata, cant_procc, cant_extra, unidades, fech_ini, est) values (?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("iiiisi", $lata, $cant_procc, $produccion->getCant_extra(), $unidades, $fech_ini, $est);
            }
            $stmt->execute();
            $cod_procc = $this->conn->insert_id;

            $sql = "INSERT INTO coche_to_produccion (cod_coche, cod_procc) values (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $cod_coche, $cod_procc);
            $stmt->execute();

            #Datos Tabla Producto
            $nom_prod = $producto->getNom_prod();
            $dscr_prod = $producto->getDscr_prod();
            $tam_prod = $producto->getTam_prod();

            $sql = "INSERT INTO producto (nom_prod, dscr_prod, tam_prod) values (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $nom_prod, $dscr_prod, $tam_prod);
            $stmt->execute();
            $cod_prod = $this->conn->insert_id;

            $sql = "INSERT INTO productotoproducc (cod_procc, cod_prod) values (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $cod_procc, $cod_prod);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }
    public function deleteProduccion($cod_coche, $id)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Primero buscamos el cod_procc en la tabla productotoproducc para ubicar el producto creado y eliminarlo
            $productos = array();
            $stmt = $this->conn->prepare("SELECT * FROM productotoproducc WHERE cod_procc = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            #Variables de la tabla:
            #cod_match_prod_procc
            #cod_procc
            #cod_prod

            $cod_prod = $row['cod_prod'];

            #Eliminar Conexion con tabla Produccion en tabla coche_to_produccion
            $stmt = $this->conn->prepare("DELETE FROM coche_to_produccion WHERE cod_procc = ? AND cod_coche = ?");
            $stmt->bind_param("ii", $id, $cod_coche);
            $stmt->execute();

            #Eliminar Conexion con tabla Produccion en tabla productotoproducc
            $stmt = $this->conn->prepare("DELETE FROM productotoproducc WHERE cod_match_prod_procc = ?");
            $stmt->bind_param("i", $row['cod_match_prod_procc']);
            $stmt->execute();

            #Eliminar Producto
            $cod_prod = $row['cod_prod'];
            $stmt = $this->conn->prepare("DELETE FROM producto WHERE cod_prod = ?");
            $stmt->bind_param("i", $cod_prod);
            $stmt->execute();
            echo ($cod_prod);

            #Eliminar La produccion finalmente
            $stmt = $this->conn->prepare("DELETE FROM produccion WHERE cod_procc = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function insertInsToProcc($cod_procc, $insumo)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Datos Tabla Insumo
            $nom_ins = $insumo->getNom_ins();
            $uni_med = $insumo->getUni_med();
            $stock = $insumo->getStock();

            $sql = "INSERT INTO insumo (nom_ins, uni_med, stock) values (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssd", $nom_ins, $uni_med, $stock);
            $stmt->execute();
            $cod_ins = $this->conn->insert_id;

            #Datos tabla Match entre el Insumo y la Produccion
            $sql = "INSERT INTO insumotoproduccion (cod_procc, cod_ins) values (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $cod_procc, $cod_ins);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }
    public function getInsumosForProduction()
    {
        $insumos = array();
        $stmt = $this->conn->prepare("SELECT i.cod_ins, p.cod_procc, i.nom_ins, i.uni_med, i.stock FROM insumotoproduccion itop INNER JOIN produccion p ON itop.cod_procc = p.cod_procc INNER JOIN insumo i ON itop.cod_ins = i.cod_ins WHERE p.est = '0'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $insumo = new Insumo(
                $row['nom_ins'],
                'S/D',
                $row['cod_procc'],
                'S/D',
                'S/D',
                'S/D',
                'S/D',
                $row['uni_med'],
                $row['stock'],
                'S/D',
                'S/D'
            );
            $insumo->setCod_ins($row['cod_ins']);
            $insumos[] = $insumo;
        }
        return $insumos;
    }

    public function deleteInsumoProduccion($id)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Eliminar Conexion con tabla Produccion en tabla insumotoproduccion
            $stmt = $this->conn->prepare("DELETE FROM insumotoproduccion WHERE cod_ins = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            #Eliminar Insumo
            $stmt = $this->conn->prepare("DELETE FROM insumo WHERE cod_ins = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function findInsumoProduccionByID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM insumo WHERE cod_ins = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function updateStockInsumoProduccion($insumo)
    {
        $cod_ins = $insumo->getCod_ins();
        $stock = $insumo->getStock();
        $sql = "UPDATE insumo SET stock = ? WHERE cod_ins = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ds", $stock, $cod_ins);
        $stmt->execute();
    }

    public function getInventarioInsumos()
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

    public function updateEstadoProductionFinish($id)
    {
        $estFinish = 1;
        $sql = "UPDATE produccion SET est = ? WHERE cod_procc = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $estFinish, $id);
        $stmt->execute();

        $sql = "UPDATE coche SET estado = 1 WHERE cod_coche = (SELECT cod_coche FROM coche_to_produccion WHERE cod_procc = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }
    public function createInvProducto()
    {
        $fech_crea = date('Y-m-d');
        $sql = "INSERT INTO inventarioproducto (fech_crea) values (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $fech_crea);
        $stmt->execute();
        $cod_inv_prod = $this->conn->insert_id;
        return $cod_inv_prod;
    }
    public function sendProductoToInv($cod_inv_producto, $producto)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Datos Tabla Producto
            $nom_prod = $producto->getNom_prod();
            $dscr_prod = $producto->getDscr_prod();
            $cant_extra = $producto->getCant_extra();
            $tam_prod = $producto->getTam_prod();
            $cant_prod = $producto->getCant_prod();

            switch ($nom_prod) {
                case 'Pan':
                    switch ($tam_prod) {
                        case 'Pequeño':
                            $stock = $cant_prod * 42 + $cant_extra;
                            break;
                        case 'Mediano':
                            $stock = $cant_prod * 21 + $cant_extra;
                            break;
                        case 'Grande':
                            $stock = $cant_prod * 18 + $cant_extra;
                            break;
                    }
                    break;
                case 'Bizcocho':
                    switch ($tam_prod) {
                        case 'Pequeño':
                            $stock = $cant_prod * 42 + $cant_extra;
                            break;
                        case 'Grande':
                            $stock = $cant_prod * 18 + $cant_extra;
                            break;
                    }
                    break;
            }

            $sql = "INSERT INTO producto (nom_prod, dscr_prod, tam_prod, cant_prod) values (?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $nom_prod, $dscr_prod, $tam_prod, $stock);
            $stmt->execute();
            $cod_prod = $this->conn->insert_id;

            #Datos tabla Match entre el Producto y el Inventario de Producto
            $fech_ing = date('Y-m-d');
            $sql = "INSERT INTO productotoinventario (cod_inv_prod, cod_prod, fech_ing) values (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iis", $cod_inv_producto, $cod_prod, $fech_ing);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }

    public function createInvInsumo()
    {
        $fech_crea = date('Y-m-d');
        $prov = 'Claire Pardo';
        $sql = "INSERT INTO inventarioinsumo (fech_crea, prov) values (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $fech_crea, $prov);
        $stmt->execute();
        $cod_inv_ins = $this->conn->insert_id;
        return $cod_inv_ins;
    }
    public function sendInsumoToInv($cod_inv_ins, $insumo)
    {
        #Iniciar Transaccion
        $this->conn->begin_transaction();

        try {
            #Datos Tabla Insumo
            $nom_ins = $insumo->getNom_ins();
            $dscr = $insumo->getDscr();
            $uni_med = $insumo->getUni_med();
            $stock = $insumo->getStock();
            $precio = $insumo->getPrecio();
            $precio_tot = $insumo->getPrecio_tot();

            $sql = "INSERT INTO insumo (nom_ins, dscr, uni_med, stock, precio, precio_tot) values (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssddd", $nom_ins, $dscr, $uni_med, $stock, $precio, $precio_tot);
            $stmt->execute();
            $cod_ins = $this->conn->insert_id;

            #Datos tabla Match entre el Insumo y el Inventario de Insumo
            $fech_ingr = date('Y-m-d');
            $sql = "INSERT INTO insumotoinventario (cod_inv_ins, cod_ins, fech_ingr) values (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iis", $cod_inv_ins, $cod_ins, $fech_ingr);
            $stmt->execute();
            # Confirmar la transacción
            $this->conn->commit();
        } catch (Exception $e) {
            # Revertir la transacción en caso de error
            $this->conn->rollback();
            throw $e;
        }
    }
    public function getInsumosConsumidosinProduccion()
    {
        $insumos = array();
        $stmt = $this->conn->prepare("SELECT i.nom_ins AS insumo, DATE(p.fech_ini) AS fecha, SUM(i.stock)/1000 AS total_stock FROM produccion p INNER JOIN insumotoproduccion itp ON p.cod_procc = itp.cod_procc INNER JOIN insumo i ON itp.cod_ins = i.cod_ins WHERE p.fech_ini >= '2025-09-01' GROUP BY i.nom_ins, DATE(p.fech_ini) ORDER BY fecha DESC;");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $insumo = new Insumo(
                $row['insumo'],
                $row['fecha'],
                '',
                '',
                '',
                '',
                '',
                '',
                $row['total_stock'],
                '',
                ''
            );
            $insumos[] = $insumo;
        }
        return $insumos;
    }
    public function getCantProductosbyVentas()
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT v.fecha as fecha, p.nom_prod AS producto, p.tam_prod AS tamaño, sum(p.cant_prod) AS cantidad FROM venta v INNER JOIN ventaproducto vp ON v.cod_venta = vp.cod_venta INNER JOIN producto p ON vp.cod_prod = p.cod_prod WHERE fecha >= '2025-09-01' AND p.nom_prod != '' GROUP BY v.fecha, p.nom_prod, p.tam_prod ORDER BY v.fecha DESC;");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['producto'],
                $row['fecha'],
                '',
                $row['tamaño'],
                $row['cantidad']
            );
            $productos[] = $producto;
        }
        return $productos;
    }
    public function getCantProductosbyProduccion()
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT pr.nom_prod as producto, pr.tam_prod as tamaño, p.cant_procc as cantidad, p.cant_extra as extra, DATE(p.fech_ini) as fecha from produccion p inner join productotoproducc ptop on p.cod_procc = ptop.cod_procc inner join producto pr on ptop.cod_prod = pr.cod_prod WHERE fech_ini >= '2025-09-01' order by p.fech_ini desc;");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['producto'],
                $row['fecha'],
                '',
                $row['tamaño'],
                $row['cantidad']
            );
            $productos[] = $producto;
        }
        return $productos;
    }
}
