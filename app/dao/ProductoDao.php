<?php
require_once '../config/dbcn.php';
require_once '../app/models/Producto.php';
require_once '../app/models/Abono.php';
require_once '../app/models/Entrega.php';
class ProductoDao
{
    private $conn;
    private $ventasController;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getInventarioProductos()
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT p.cod_prod, p.nom_prod, p.dscr_prod, p.tipo_prod, p.tam_prod, p.cant_prod, p.precio, p.precio_tot FROM productotoinventario t INNER JOIN producto p ON t.cod_prod = p.cod_prod INNER JOIN inventarioproducto i ON t.cod_inv_prod = i.cod_inv_prod WHERE i.fech_crea = (SELECT MAX(fech_crea) FROM inventarioproducto)");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['dscr_prod'],
                $row['tipo_prod'],
                $row['tam_prod'],
                $row['cant_prod']
            );
            $producto->setPrecio($row['precio']);
            $producto->setPrecio_tot($row['precio_tot']);
            $producto->setCod_prod($row['cod_prod']);
            $productos[] = $producto;
        }
        return $productos;
    }
    public function getProductosbyVenta($cod_venta)
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT p.* FROM producto p INNER JOIN  ventaproducto vp ON p.cod_prod = vp.cod_prod INNER JOIN venta v ON v.cod_venta = vp.cod_venta WHERE v.cod_venta = ?");
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['dscr_prod'],
                $row['tipo_prod'],
                $row['tam_prod'],
                $row['cant_prod']
            );
            $producto->setPrecio($row['precio']);
            $producto->setPrecio_tot($row['precio_tot']);
            $producto->setEst($row['est']);
            $producto->setCod_prod($row['cod_prod']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function getProductosbyID($cod_prod)
    {
        $productos = array();
        $stmt = $this->conn->prepare("SELECT * FROM producto WHERE cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto(
                $row['nom_prod'],
                $row['dscr_prod'],
                $row['tipo_prod'],
                $row['tam_prod'],
                $row['cant_prod']
            );
            $producto->setPrecio($row['precio']);
            $producto->setPrecio_tot($row['precio_tot']);
            $producto->setEst($row['est']);
            $producto->setCod_prod($row['cod_prod']);
            $productos[] = $producto;
        }
        return $productos;
    }

    public function updateProducto($producto)
    {
        $cod_prod = $producto->getCod_prod();
        $nom_prod = $producto->getNom_prod();
        $dscr_prod = $producto->getDscr_prod();
        $tam_prod = $producto->getTam_prod();
        $cant_prod = $producto->getCant_prod();
        $precio = $producto->getPrecio();
        $precio_tot = $producto->getPrecio_tot();

        $this->discountImporteSaldo($cod_prod);
        $this->addImporteSaldo($cod_prod, $precio_tot);

        $sql = "UPDATE producto SET nom_prod = ?, dscr_prod = ?, tam_prod = ?, cant_prod = ?, precio = ?, precio_tot = ? WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssiddi", $nom_prod, $dscr_prod, $tam_prod, $cant_prod, $precio, $precio_tot, $cod_prod);
        $stmt->execute();
    }

    public function deleteProducto($cod_prod)
    {
        $this->discountImporteSaldo($cod_prod);

        #Eliminar producto
        $sql = "DELETE FROM ventaproducto WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();

        $sql = "DELETE FROM producto WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
    }

    public function discountImporteSaldo($cod_prod)
    {
        #Buscar relacion entre la venta y el producto
        $stmt = $this->conn->prepare("SELECT * FROM ventaproducto WHERE cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        $ventaproducto = $result->fetch_assoc();

        #Buscar venta asociada a la relacion
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE cod_venta = ?");
        $stmt->bind_param("i", $ventaproducto['cod_venta']);
        $stmt->execute();
        $result = $stmt->get_result();
        $venta = $result->fetch_assoc();

        #Buscar producto
        $stmt = $this->conn->prepare("SELECT * FROM producto WHERE cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();

        #Actualizar importe de la venta
        $nuevoImporte = $venta['importe'] - $producto['precio_tot'];
        $sql = "UPDATE venta SET importe = ? WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevoImporte, $venta['cod_venta']);
        $stmt->execute();

        #Buscar cuenta
        $stmt = $this->conn->prepare("SELECT * FROM cuenta WHERE cod_cuenta = ?");
        $stmt->bind_param("i", $venta['cod_cuenta']);
        $stmt->execute();
        $result = $stmt->get_result();
        $cuenta = $result->fetch_assoc();

        #Actualizar saldo de la cuenta
        $nuevoSaldo = $cuenta['saldo'] - $producto['precio_tot'];;
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevoSaldo, $cuenta['cod_cuenta']);
        $stmt->execute();
    }

    public function addImporteSaldo($cod_prod, $addIngreso){
        #Buscar relacion entre la venta y el producto
        $stmt = $this->conn->prepare("SELECT * FROM ventaproducto WHERE cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        $ventaproducto = $result->fetch_assoc();

        #Buscar venta asociada a la relacion
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE cod_venta = ?");
        $stmt->bind_param("i", $ventaproducto['cod_venta']);
        $stmt->execute();
        $result = $stmt->get_result();
        $venta = $result->fetch_assoc();

        #Buscar producto
        $stmt = $this->conn->prepare("SELECT * FROM producto WHERE cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();

        #Actualizar importe de la venta
        $nuevoImporte = $venta['importe'] + $addIngreso;
        $sql = "UPDATE venta SET importe = ? WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevoImporte, $venta['cod_venta']);
        $stmt->execute();

        #Buscar cuenta
        $stmt = $this->conn->prepare("SELECT * FROM cuenta WHERE cod_cuenta = ?");
        $stmt->bind_param("i", $venta['cod_cuenta']);
        $stmt->execute();
        $result = $stmt->get_result();
        $cuenta = $result->fetch_assoc();

        #Actualizar saldo de la cuenta
        $nuevoSaldo = $cuenta['saldo'] + $addIngreso;
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevoSaldo, $cuenta['cod_cuenta']);
        $stmt->execute();
    }

    public function insertProductobyVenta($producto)
    {
        $nom_prod = $producto->getNom_prod();
        $dscr_prod = $producto->getDscr_prod();
        $tam_prod = $producto->getTam_prod();
        $cant_prod = $producto->getCant_prod();
        $precio = $producto->getPrecio();
        $precio_tot = intval($precio) * intval($cant_prod);
        #echo($nom_prod. ' '.$dscr_prod. ' '.$tam_prod. ' '.$cant_prod. ' '.$precio. ' '.$precio_tot);
        $sql = "INSERT INTO producto (nom_prod, dscr_prod, tam_prod, cant_prod, precio, precio_tot) values (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssidd", $nom_prod, $dscr_prod, $tam_prod, $cant_prod, $precio, $precio_tot);
        $stmt->execute();
        return $this->conn->insert_id;
    }
    public function updateEstado($cod_prod, $est)
    {
        $sql = "UPDATE producto SET est = ? WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $est, $cod_prod);
        $stmt->execute();
    }

    public function getAbonos($cod_cuenta)
    {
        $abonos = array();
        $stmt = $this->conn->prepare("SELECT a.* FROM abono a INNER JOIN cuenta c ON a.cod_cuenta = c.cod_cuenta WHERE c.cod_cuenta = ? AND est_abon = '1' ORDER BY cod_abon DESC");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $abono = new Abono(
                $row['cod_cuenta'],
                $row['din_abon'],
                $row['fech_abon']
            );
            $abono->setCod_abon($row['cod_abon']);
            $abono->setMet_pag($row['met_pag']);
            $abonos[] = $abono;
        }
        return $abonos;
    }

    public function getAbonosAdelantados($cod_cuenta)
    {
        $abonos = array();
        $stmt = $this->conn->prepare("SELECT a.* FROM abono a INNER JOIN cuenta c ON a.cod_cuenta = c.cod_cuenta WHERE c.cod_cuenta = ? AND a.est_abon = '0' ORDER BY cod_abon DESC");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $abono = new Abono(
                $row['cod_cuenta'],
                $row['din_abon'],
                $row['fech_abon']
            );
            $abono->setCod_abon($row['cod_abon']);
            $abono->setMet_pag($row['met_pag']);
            $abonos[] = $abono;
        }
        return $abonos;
    }

    public function getAllAbonosAdelantados()
    {
        $abonos = array();
        $stmt = $this->conn->prepare("SELECT a.* FROM abono a INNER JOIN cuenta c ON a.cod_cuenta = c.cod_cuenta WHERE a.est_abon = '0' ORDER BY cod_abon DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $abono = new Abono(
                $row['cod_cuenta'],
                $row['din_abon'],
                $row['fech_abon']
            );
            $abono->setCod_abon($row['cod_abon']);
            $abono->setMet_pag($row['met_pag']);
            $abonos[] = $abono;
        }
        return $abonos;
    }

    public function getAbonobyID($cod_abon)
    {
        $stmt = $this->conn->prepare("SELECT * FROM abono WHERE cod_abon = ?");
        $stmt->bind_param("i", $cod_abon);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $abono = new Abono(
                $row['cod_cuenta'],
                $row['din_abon'],
                $row['fech_abon']
            );
            $abono->setCod_abon($row['cod_abon']);
        }
        return $abono;
    }

    public function getEntregas($cod_prod)
    {
        $entregas = array();
        $stmt = $this->conn->prepare("SELECT e.* FROM entrega e INNER JOIN producto p ON e.cod_prod = p.cod_prod WHERE p.cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $entrega = new Entrega(
                $row['cod_prod'],
                $row['cant_entr'],
                $row['fech_entr']
            );
            $entrega->setCod_entr($row['cod_entr']);
            $entregas[] = $entrega;
        }
        return $entregas;
    }
    //ABONOS
    public function insertAbonobyCuenta($cod_cuenta, $abono, $met_pago)
    {
        $fech_abon = date("Y-m-d H:i:s");
        $est_abon = '1';
        $sql = "INSERT INTO abono (cod_cuenta, din_abon, met_pag, fech_abon, est_abon) values (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idssi", $cod_cuenta, $abono, $met_pago, $fech_abon, $est_abon);
        $stmt->execute();
    }

    public function editAbono($abono)
    {
        $cod_abon = $abono->getCod_abon();
        $din_abon = $abono->getDin_abon();
        $sql = "UPDATE abono SET din_abon = ? WHERE cod_abon = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $din_abon, $cod_abon);
        $stmt->execute();
    }

    public function editAbonoEstado($abono)
    {
        $cod_abon = $abono->getCod_abon();
        $est_abon = $abono->getEst_abon();
        $sql = "UPDATE abono SET est_abon = ? WHERE cod_abon = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $est_abon, $cod_abon);
        $stmt->execute();
    }

    public function deleteAbono($cod_abon)
    {
        $sql = "DELETE FROM abono WHERE cod_abon = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_abon);
        $stmt->execute();
    }

    public function insertAbonobyCuentaAdelanto($cod_cuenta, $abono, $met_pago)
    {
        $fech_abon = date("Y-m-d H:i:s");
        $est_abon = '0';
        $sql = "INSERT INTO abono (cod_cuenta, din_abon, met_pag, fech_abon, est_abon) values (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idssi", $cod_cuenta, $abono, $met_pago, $fech_abon, $est_abon);
        $stmt->execute();
    }

    public function insertEntregabyProducto($cod_prod, $entrega)
    {
        $fech_abon = date("Y-m-d H:i:s");
        $sql = "INSERT INTO entrega (cod_prod, cant_entr, fech_entr) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $cod_prod, $entrega, $fech_abon);
        $stmt->execute();
        #return $this->conn->insert_id;
    }

    public function editEntrega($entrega)
    {
        $cod_entr = $entrega->getCod_entr();
        $cant_entr = $entrega->getCant_entr();
        $sql = "UPDATE entrega SET cant_entr = ? WHERE cod_entr = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cant_entr, $cod_entr);
        $stmt->execute();
    }

    public function deleteEntrega($cod_entr)
    {
        $sql = "DELETE FROM entrega WHERE cod_entr = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_entr);
        $stmt->execute();
    }

    public function getTotalAbonosbyCuenta($cod_cuenta)
    {
        $stmt = $this->conn->prepare("SELECT SUM(a.din_abon) FROM abono a INNER JOIN cuenta c ON a.cod_cuenta = c.cod_cuenta WHERE c.cod_cuenta = ?");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        $mont_tot = $result->fetch_assoc();
        return $mont_tot['SUM(a.din_abon)'];
    }

    public function getLastAbonobyCuenta($cod_cuenta)
    {
        $stmt = $this->conn->prepare("SELECT a.din_abon FROM abono a INNER JOIN cuenta c ON a.cod_cuenta = c.cod_cuenta WHERE c.cod_cuenta = ? AND a.est_abon = '1' ORDER BY a.cod_abon DESC LIMIT 1");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        $mont_tot = $result->fetch_assoc();
        if(!empty($mont_tot['din_abon'])){
            return $mont_tot['din_abon'];
        }else{
            return null;
        }
    }

    public function getTotalEntregasbyProducto($cod_prod)
    {
        $stmt = $this->conn->prepare("SELECT SUM(e.cant_entr) FROM entrega e INNER JOIN producto p on e.cod_prod = p.cod_prod WHERE p.cod_prod = ?");
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        $mont_tot = $result->fetch_assoc();
        return $mont_tot['SUM(e.cant_entr)'];
    }
}
