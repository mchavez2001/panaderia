<?php
require_once(__DIR__ . '/../../config/dbcn.php');
require_once (__DIR__ . '/../../app/models/Venta.php');
require_once (__DIR__ . '/../../app/models/Empleado.php');
require_once (__DIR__ . '/../../app/models/Cuenta.php');
require_once (__DIR__ . '/../../app/models/Pedido.php');

class VentaDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getVentas()
    {
        $ventas = array();
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE estado = '1' ORDER BY fecha DESC, cod_venta DESC LIMIT 50");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
            $ventas[] = $venta;
        }
        return $ventas;
    }

    public function getVentasbyFecha($fecha)
    {
        $ventas = array();
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE estado = '1' AND fecha = ? ORDER BY fecha DESC, cod_venta DESC");
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
            $ventas[] = $venta;
        }
        return $ventas;
    }

    public function getVentasbyCuenta($cod_cuenta)
    {
        $ventas = array();
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE cod_cuenta = ? AND importe > 0 AND estado = '1' ORDER BY fecha DESC");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
            $ventas[] = $venta;
        }
        return $ventas;
    }

    public function getVentaPendientebyCuenta($cod_cuenta)
    {
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE cod_cuenta = ? AND importe > 0 ORDER BY fecha ASC LIMIT 1");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
        }
        if ($venta->getMont_pasaj() == 0) {
            $venta->setMont_pasaj('S/D');
        }
        return $venta;
    }

    public function getVentasPendientebyCuenta($cod_cuenta)
    {
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE cod_cuenta = ? AND importe > 0 ORDER BY fecha ASC");
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
            if ($venta->getMont_pasaj() == 0) {
                $venta->setMont_pasaj('S/D');
            }
            $ventas[] = $venta;
        }
        return $ventas;
    }

    public function getVenta($cod_venta)
    {
        $sql = "SELECT * FROM venta WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $venta = new Venta(
                $row['cod_cuenta'],
                $row['cod_empleado'],
                $row['fecha'],
                $row['importe'],
                $row['mont_pasaj'],
                $row['met_pag'],
                $row['estado']
            );
            $venta->setCod_venta($row['cod_venta']);
        }
        return $venta;
    }
    public function insertVenta($venta)
    {
        $cod_cuenta = $venta->getCod_cuenta();
        $cod_empleado = $venta->getCod_empleado();
        $fecha = $venta->getFecha();
        $importe = $venta->getImporte();
        $mont_pasaj = $venta->getMont_pasaj();
        $met_pag = $venta->getMet_pag();
        $estado = $venta->getEstado();


        $sql = "INSERT INTO venta (cod_cuenta, cod_empleado, fecha, importe, mont_pasaj, met_pag, estado) values (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisddsi", $cod_cuenta, $cod_empleado, $fecha, $importe, $mont_pasaj, $met_pag, $estado);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function editVenta($venta)
    {
        $cod_venta = $venta->getCod_venta();
        $cod_cuenta = $venta->getCod_cuenta();
        $cod_empleado = $venta->getCod_empleado();
        $importe = $venta->getImporte();
        $mont_pasaj = $venta->getMont_pasaj();
        $met_pag = $venta->getMet_pag();

        if ($mont_pasaj == 'S/D') {
            $sql = "UPDATE venta SET cod_cuenta = ?, cod_empleado = ?, met_pag = ?, importe = ? WHERE cod_venta = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iisdi", $cod_cuenta, $cod_empleado, $met_pag, $importe, $cod_venta);
        } else {
            $sql = "UPDATE venta SET cod_cuenta = ?, cod_empleado = ?, met_pag = ?, importe = ?, mont_pasaj = ? WHERE cod_venta = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iisddi", $cod_cuenta, $cod_empleado, $met_pag, $importe, $mont_pasaj, $cod_venta);
        }
        $stmt->execute();
    }

    public function deleteVenta($cod_venta)
    {
        $venta = $this->getVenta($cod_venta);
        $cuenta = $this->getCuenta($venta->getCod_cuenta());
        $nuevo_saldo = $cuenta->getSaldo() - $venta->getImporte();
        
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevo_saldo, $cuenta->getCod_cuenta());

        $id_productos = [];
        $sql = "SELECT * FROM ventaproducto WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $id_productos[] = $row['cod_prod'];
        }
        
        $sql = "DELETE FROM ventaproducto WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();

        foreach ($id_productos as $id_producto) {
            $sql = "DELETE FROM producto WHERE cod_prod = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
        }

        $sql = "DELETE FROM venta WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
    }

    public function insertProductoOnVenta($cod_prod, $cod_venta)
    {
        #Enlazando producto a la venta del cliente
        $sql = "INSERT INTO ventaproducto (cod_venta, cod_prod) values (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cod_venta, $cod_prod);
        $stmt->execute();
        #Obteniendo la venta para calcular el importe
        $ventaActu = $this->getVenta($cod_venta);
        #Obteniendo el producto para calcular el importe
        $sql = "SELECT * FROM producto WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $producto = new Producto($row['nom_prod'], $row['dscr_prod'], $row['cant_prod'], $row['tam_prod'], $row['cant_prod']);
            $producto->setPrecio_tot($row['precio_tot']);
        }
        #Calcular nuevo importe de la venta
        $precioUpd = $ventaActu->getImporte() + $producto->getPrecio_tot();
        #Actualizar importe de la venta
        $sql = "UPDATE venta SET importe = ? WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $precioUpd, $cod_venta);
        $stmt->execute();

        #Obteniendo la cuenta para añadir el saldo
        $cuenta = $this->getCuenta($ventaActu->getCod_cuenta());
        #Calcular saldo adicional para la cuenta
        $saldoUpd = $cuenta->getSaldo() + $producto->getPrecio_tot();
        #Actualizar saldo de la cuenta
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $saldoUpd, $cuenta->getCod_cuenta());
        $stmt->execute();
    }

    public function insertProductoOnVentaForPedido($cod_prod, $cod_venta)
    {
        #Enlazando producto a la venta del cliente
        $sql = "INSERT INTO ventaproducto (cod_venta, cod_prod) values (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cod_venta, $cod_prod);
        $stmt->execute();
        #Obteniendo la venta para calcular el importe
        $ventaActu = $this->getVenta($cod_venta);
        #Obteniendo el producto para calcular el importe
        $sql = "SELECT * FROM producto WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $producto = new Producto($row['nom_prod'], $row['dscr_prod'], $row['cant_prod'], $row['tam_prod'], $row['cant_prod']);
            $producto->setPrecio_tot($row['precio_tot']);
        }
        #Calcular nuevo importe de la venta
        $precioUpd = $ventaActu->getImporte() + $producto->getPrecio_tot();
        #Actualizar importe de la venta
        $sql = "UPDATE venta SET importe = ? WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $precioUpd, $cod_venta);
        $stmt->execute();
    }

    public function updateSaldoVentaFromPedido($cod_prod, $cod_venta)
    {
        /* #Enlazando producto a la venta del cliente
        $sql = "INSERT INTO ventaproducto (cod_venta, cod_prod) values (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cod_venta, $cod_prod);
        $stmt->execute();
        #Obteniendo la venta para calcular el importe
        $ventaActu = $this->getVenta($cod_venta);
        #Obteniendo el producto para calcular el importe
        $sql = "SELECT * FROM producto WHERE cod_prod = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_prod);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $producto = new Producto($row['nom_prod'], $row['dscr_prod'], $row['cant_prod'], $row['tam_prod'], $row['cant_prod']);
            $producto->setPrecio_tot($row['precio_tot']);
        }
        #Calcular nuevo importe de la venta
        $precioUpd = $ventaActu->getImporte() + $producto->getPrecio_tot();
        #Actualizar importe de la venta
        $sql = "UPDATE venta SET importe = ? WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $precioUpd, $cod_venta);
        $stmt->execute();

        #Obteniendo la cuenta para añadir el saldo
        $cuenta = $this->getCuenta($ventaActu->getCod_cuenta());
        #Calcular saldo adicional para la cuenta
        $saldoUpd = $cuenta->getSaldo() + $producto->getPrecio_tot();
        #Actualizar saldo de la cuenta
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $saldoUpd, $cuenta->getCod_cuenta());
        $stmt->execute(); */
    }

    public function getVendedores()
    {
        $empleados = array();
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE rol = 'estandar'");
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

    public function anularVenta($cod_venta)
    {
        echo $cod_venta;
        $sql = "UPDATE venta SET estado = '0' WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
    }

    public function getCuentas()
    {
        $cuentas = array();
        $stmt = $this->conn->prepare("SELECT * FROM cuenta");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta(
                $row['cod_cliente'],
                $row['saldo'],
                $row['estado']
            );
            $cuenta->setCod_cuenta($row['cod_cuenta']);
            $cuentas[] = $cuenta;
        }
        return $cuentas;
    }

    public function getCuentasOrdenadasbyVentas()
    {
        $cuentas = array();
        $stmt = $this->conn->prepare("WITH ventas_ordenadas AS (
            SELECT 
                cod_cuenta, 
                fecha, 
                cod_venta, 
                ROW_NUMBER() OVER (PARTITION BY cod_cuenta ORDER BY fecha DESC, cod_venta DESC) AS fila
            FROM venta
            WHERE estado = '1'
        )
        SELECT c.*, v.fecha, v.cod_venta
        FROM cuenta c
        JOIN ventas_ordenadas v ON c.cod_cuenta = v.cod_cuenta AND v.fila = 1
        ORDER BY v.fecha DESC, v.cod_venta DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta(
                $row['cod_cliente'],
                $row['saldo'],
                $row['estado']
            );
            $cuenta->setCod_cuenta($row['cod_cuenta']);
            $cuentas[] = $cuenta;
        }
        return $cuentas;
    }

    public function getCuenta($cod_cuenta)
    {
        $sql = "SELECT * FROM cuenta WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta(
                $row['cod_cliente'],
                $row['saldo'],
                $row['estado']
            );
            $cuenta->setCod_cuenta($row['cod_cuenta']);
        }
        return $cuenta;
    }

    public function getCuentabyCliente($cod_cliente)
    {
        $sql = "SELECT * FROM cuenta WHERE cod_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta(
                $row['cod_cliente'],
                $row['saldo'],
                $row['estado']
            );
            $cuenta->setCod_cuenta($row['cod_cuenta']);
        }
        return $cuenta;
    }

    public function insertCuenta($cuenta)
    {
        $cod_cliente = $cuenta->getCod_cliente();
        $saldo = $cuenta->getSaldo();
        $estado = $cuenta->getEstado();

        $sql = "INSERT INTO cuenta (cod_cliente, saldo, estado) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idi", $cod_cliente, $saldo, $estado);
        $stmt->execute();
    }
    public function updateCuenta($cuenta)
    {
        $cod_cuenta = $cuenta->getCod_cuenta();
        $cod_cliente = $cuenta->getCod_cliente();
        $saldo = $cuenta->getSaldo();
        $estado = $cuenta->getEstado();

        $sql = "UPDATE cuenta SET cod_cliente = ?, saldo = ?, estado = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idii", $cod_cliente, $saldo, $estado, $cod_cuenta);
        $stmt->execute();
    }
    public function deleteCuenta($cod_cuenta)
    {
        $sql = "DELETE FROM cuenta WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
    }
    public function deleteAbonosbyCuenta($cod_cuenta)
    {
        $sql = "DELETE FROM abono WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
    }

    public function getPedidos()
    {
        $pedidos = array();
        $stmt = $this->conn->prepare("SELECT * FROM pedido WHERE estado = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $pedido = new Pedido(
                $row['cod_venta'],
                $row['dscr'],
                $row['fech_reg'],
                $row['fech_ped'],
                $row['estado']
            );
            $pedido->setCod_pedido($row['cod_pedido']);
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

    public function insertPedido($pedido)
    {
        $cod_venta = $pedido->getCod_venta();
        $dscr = $pedido->getDscr();
        $fech_reg = $pedido->getFech_reg();
        $fech_ped = $pedido->getFech_ped();
        $estado = $pedido->getEstado();


        $sql = "INSERT INTO pedido (cod_venta, dscr, fech_reg, fech_ped, estado) values (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssi", $cod_venta, $dscr, $fech_reg, $fech_ped, $estado);
        $stmt->execute();
        #return $this->conn->insert_id;
    }

    public function enableVenta($cod_venta)
    {
        $sql = "UPDATE venta SET estado = '1' WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();

        $sql = "DELETE FROM pedido WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        
        $venta = $this->getVenta($cod_venta);
        $cod_cuenta = $venta->getCod_cuenta();
        $cuenta = $this->getCuenta($cod_cuenta);
        $nuevo_saldo = $cuenta->getSaldo() + $venta->getImporte();

        $sql = "UPDATE cuenta SET saldo = ?, estado = '1' WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $nuevo_saldo, $cod_cuenta);
        $stmt->execute();
    }
    public function finishVenta($cod_venta)
    {
        #Buscando venta
        $sql = "SELECT * FROM venta WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $venta = new Venta($row['cod_cuenta'], $row['cod_empleado'], $row['fecha'], $row['importe'], $row['mont_pasaj'], $row['met_pag'], $row['estado']);
            $venta->setCod_venta($row['cod_venta']);
        }
        $importe_venta = $venta->getImporte();
        #Actualizando nuevo importe de la venta
        $sql = "UPDATE venta SET importe = '0' WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $venta->getCod_venta());
        $stmt->execute();
        #Buscando cuenta
        $sql = "SELECT * FROM cuenta WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $venta->getCod_cuenta());
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta($row['cod_cliente'], $row['saldo'], $row['estado']);
            $cuenta->setCod_cuenta($row['cod_cuenta']);
        }
        $saldo_nuevo = $cuenta->getSaldo() - $importe_venta;
        #Actualizando nuevo saldo de la cuenta
        $sql = "UPDATE cuenta SET saldo = ? WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("di", $saldo_nuevo, $cuenta->getCod_cuenta());
        $stmt->execute();
    }
    public function getImporteProductos($cod_venta)
    {
        #Buscando productos y sumando sus importes
        $importe = 0;
        $sql = "SELECT * FROM ventaproducto WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $sql = "SELECT * FROM producto WHERE cod_prod = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $row['cod_prod']);
            $stmt->execute();
            $resultadoProducto = $stmt->get_result();
            if ($producto = $resultadoProducto->fetch_assoc()) {
                $importe = $importe + $producto['precio_tot'];
            }
        }
        return $importe;
    }
    public function deletePedido($cod_venta)
    {
        $sql = "DELETE FROM pedido WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();

        $id_productos = [];
        $sql = "SELECT * FROM ventaproducto WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $id_productos[] = $row['cod_prod'];
        }
        
        $sql = "DELETE FROM ventaproducto WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();

        foreach ($id_productos as $id_producto) {
            $sql = "DELETE FROM producto WHERE cod_prod = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
        }

        $sql = "DELETE FROM venta WHERE cod_venta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_venta);
        $stmt->execute();
    }
    public function getImporteDeudas()
    {
        $sql = "SELECT SUM(saldo) FROM cuenta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $deuda = $row['SUM(saldo)'];
        }
        return $deuda;
    }

    #RUTINAS

    public function getCuentasNegativas()
    {
        $cuentas = array();
        $stmt = $this->conn->prepare("SELECT * FROM cuenta WHERE saldo < 0");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $cuenta = new Cuenta(
                $row['cod_cliente'],
                $row['saldo'],
                $row['estado']
            );
            $cuenta->setCod_cuenta($row['cod_cuenta']);
            $cuentas[] = $cuenta;
        }
        return $cuentas;
    }

    public function updateCuentaNegativa($cod_cuenta)
    {
        $sql = "UPDATE cuenta SET saldo = 0 WHERE cod_cuenta = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_cuenta);
        $stmt->execute();
    }
}
