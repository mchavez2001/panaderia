<?php
require_once '../config/dbcn.php';
require_once '../app/models/Categoria.php';
require_once '../app/models/SubCategoria.php';
require_once '../app/models/Categoria_Det.php';
require_once '../app/models/Servicio.php';
require_once '../app/models/Pago.php';
require_once '../app/models/Pago_Detalle.php';
require_once '../app/models/Pago_Detalle_Producto.php';
class ServicioDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = db_connect();
    }

    public function getCategorias()
    {
        $categorias = array();
        $stmt = $this->conn->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria = new Categoria(
                $row['nom_categoria'],
                $row['dscr']
            );
            $categoria->setCod_categoria($row['cod_categoria']);
            $categorias[] = $categoria;
        }
        return $categorias;
    }

    public function getCategorias_Det()
    {
        $categorias_det = array();
        $stmt = $this->conn->prepare("SELECT * FROM categoria_det");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria_det = new Categoria_Det(
                $row['cod_categoria_det'],
                $row['cod_categoria'],
                $row['nom_categoria_det'],
                $row['level_det']
            );
            $categorias_det[] = $categoria_det;
        }
        return $categorias_det;
    }

    public function getCategorias_Det_1()
    {
        $categorias_det = array();
        $stmt = $this->conn->prepare("SELECT * FROM categoria_det WHERE level_det = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria_det = new Categoria_Det(
                $row['cod_categoria'],
                $row['nom_categoria_det'],
                $row['level_det']
            );
            $categoria_det->setCod_categoria_det($row['cod_categoria_det']);
            $categorias_det[] = $categoria_det;
        }
        return $categorias_det;
    }

    public function getCategorias_Det_2()
    {
        $categorias_det = array();
        $stmt = $this->conn->prepare("SELECT * FROM categoria_det WHERE level_det = '2'");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria_det = new Categoria_Det(
                $row['cod_categoria'],
                $row['nom_categoria_det'],
                $row['level_det']
            );
            $categoria_det->setCod_categoria_det($row['cod_categoria_det']);
            $categorias_det[] = $categoria_det;
        }
        return $categorias_det;
    }

    public function getCategorias_Det_1_Totales()
    {
        $categorias_det = array();
        $stmt = $this->conn->prepare("SELECT cd.cod_categoria_det, cd.nom_categoria_det,sum(pago_tot) as total FROM categoria c INNER JOIN categoria_det cd ON c.cod_categoria = cd.cod_categoria INNER JOIN servicio s ON s.tipo_gasto = cd.cod_categoria_det INNER JOIN pago p ON s.cod_servicio = p.cod_servicio GROUP BY nom_categoria_det, cod_categoria_det");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria_det = new Categoria_Det(
                $row['cod_categoria_det'],
                $row['nom_categoria_det'],
                $row['cod_categoria_det']
            );
            $categoria_det->setCod_categoria_det($row['cod_categoria_det']);
            $categoria_det->setTotal($row['total']);
            $categorias_det[] = $categoria_det;
        }
        return $categorias_det;
    }

    public function getSubCategorias()
    {
        $subcategorias = array();
        $stmt = $this->conn->prepare("SELECT * FROM subcategoria");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $subcategoria = new SubCategoria(
                $row['cod_categoria'],
                $row['nom_subcategoria']
            );
            $subcategoria->setCod_subcategoria($row['cod_subcategoria']);
            $subcategorias[] = $subcategoria;
        }
        return $subcategorias;
    }

    public function getServicios()
    {
        $servicios = array();
        $stmt = $this->conn->prepare("SELECT * FROM servicio");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $servicio = new Servicio(
                $row['cod_categoria'],
                $row['cod_subcategoria'],
                $row['nom_servicio'],
                $row['dscr'],
                $row['tipo_gasto'],
                $row['proveedor']
            );
            $servicio->setCod_servicio($row['cod_servicio']);
            $servicios[] = $servicio;
        }
        return $servicios;
    }

    public function getPagos()
    {
        $pagos = array();
        $stmt = $this->conn->prepare("SELECT * FROM pago ORDER BY fecha_pago DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $pago = new Pago(
                $row['cod_servicio'],
                $row['proveedor'],
                $row['dscr'],
                $row['cantidad'],
                $row['tip_unidad'],
                $row['met_pag'],
                $row['pago_uni'],
                $row['pago_tot'],
                $row['fecha_pago'],
                $row['detalle'],
                $row['detalle_producto']
            );
            $pago->setCod_pago($row['cod_pago']);
            $pagos[] = $pago;
        }
        return $pagos;
    }

    public function getCategorias_DetbyCategoria($cod_categoria)
    {
        $categorias_det = array();
        $stmt = $this->conn->prepare("SELECT * FROM categoria_det WHERE cod_categoria = ?");
        $stmt->bind_param("i", $cod_categoria);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $categoria_det = new Categoria_Det(
                $row['cod_categoria_det'],
                $row['cod_categoria'],
                $row['nom_categoria_det'],
                $row['level_det']
            );
            $categorias_det[] = $categoria_det;
        }
        return $categorias_det;
    }

    public function getServiciosbyCategoria($cod_categoria)
    {
        $servicios = array();
        $stmt = $this->conn->prepare("SELECT * FROM servicio WHERE cod_categoria = ?");
        $stmt->bind_param("i", $cod_categoria);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $servicio = new Servicio(
                $row['cod_servicio'],
                $row['cod_categoria'],
                $row['nom_servicio'],
                $row['dscr'],
                $row['tipo_gasto'],
                $row['proveedor'],
            );
            $servicios[] = $servicio;
        }
        return $servicios;
    }

    public function addCategoria($categoria)
    {
        $nom_categoria = $categoria->getNom_categoria();
        $dscr = $categoria->getDscr();

        $sql = "INSERT INTO categoria (nom_categoria, dscr) values (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $nom_categoria, $dscr);
        $stmt->execute();
    }

    public function addServicio($servicio)
    {
        $cod_categoria = $servicio->getCod_categoria();
        $cod_subcategoria = $servicio->getCod_subcategoria();
        $nom_servicio = $servicio->getNom_servicio();
        $dscr = $servicio->getDscr();
        $tipo_gasto = $servicio->getTipo_gasto();
        $proovedor = $servicio->getProovedor();

        $sql = "INSERT INTO servicio (cod_categoria, cod_subcategoria, nom_servicio, dscr, tipo_gasto, proveedor) values (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iissis", $cod_categoria, $cod_subcategoria, $nom_servicio, $dscr, $tipo_gasto, $proovedor);
        $stmt->execute();
    }

    public function addPago($pago)
    {
        $cod_servicio = $pago->getCod_servicio();
        $proveedor = $pago->getProveedor();
        $dscr = $pago->getDscr();
        $cantidad = $pago->getCantidad();
        $tip_unidad = $pago->getTip_unidad();
        $met_pag = $pago->getMet_pag();
        $pago_uni = $pago->getPago_uni();
        $pago_tot = $pago->getPago_tot();
        $fecha_pago = $pago->getFecha_pago();
        $detalle = $pago->getDetalle();
        $detalle_producto = $pago->getDetalle_producto();

        $sql = "INSERT INTO pago (cod_servicio, proveedor, dscr, cantidad, tip_unidad, met_pag, pago_uni, pago_tot, fecha_pago, detalle, detalle_producto) values (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issdssddsii", $cod_servicio, $proveedor, $dscr, $cantidad, $tip_unidad, $met_pag, $pago_uni, $pago_tot, $fecha_pago, $detalle, $detalle_producto);
        $stmt->execute();
    }
    public function deletePago($cod_pago)
    {
        $sql = "DELETE FROM pago WHERE cod_pago = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_pago);
        $stmt->execute();
    }
    public function getPagoDetalles($cod_pago)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pago_detalle WHERE cod_pago = ?");
        $stmt->bind_param("i", $cod_pago);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalles = array();
        while ($row = $result->fetch_assoc()) {
            $detalle = new Pago_Detalle(
                $row['cod_pago'],
                $row['nombre'],
                $row['monto'],
            );
            $detalle->setCod_pago_detalle($row['cod_pago_detalle']);
            $detalles[] = $detalle;
        }
        return $detalles;
    }
    public function getPagoDetalle($cod_pago_detalle)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pago_detalle WHERE cod_pago_detalle = ?");
        $stmt->bind_param("i", $cod_pago_detalle);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $detalle = new Pago_Detalle(
                $row['cod_pago'],
                $row['nombre'],
                $row['monto'],
            );
            $detalle->setCod_pago_detalle($row['cod_pago_detalle']);
            return $detalle;
        }
        return null;
    }
    public function addPagoDetalle($pago_detalle)
    {
        $cod_pago = $pago_detalle->getCod_pago();
        $nombre = $pago_detalle->getNombre();
        $monto = $pago_detalle->getMonto();

        $sql = "INSERT INTO pago_detalle (cod_pago, nombre, monto) values (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isd", $cod_pago, $nombre, $monto);
        $stmt->execute();
    }

    public function updatePagoDetalle($pago_detalle)
    {
        $cod_pago_detalle = $pago_detalle->getCod_pago_detalle();
        $nombre = $pago_detalle->getNombre();
        $monto = $pago_detalle->getMonto();

        $sql = "UPDATE pago_detalle SET nombre = ?, monto = ? WHERE cod_pago_detalle = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdi", $nombre, $monto, $cod_pago_detalle);
        $stmt->execute();
    }

    public function deletePagoDetalle($cod_pago)
    {
        $sql = "DELETE FROM pago_detalle WHERE cod_pago = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_pago);
        $stmt->execute();
    }

    public function getPagoDetallesProductos($cod_pago)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pago_productos WHERE cod_pago = ?");
        $stmt->bind_param("i", $cod_pago);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalles = array();
        while ($row = $result->fetch_assoc()) {
            $detalle = new Pago_Detalle_Producto(
                $row['cod_pago'],
                $row['nombre'],
                $row['cantidad'],
                $row['monto']
            );
            $detalle->setCod_pago_detalle_producto($row['cod_pago_producto']);
            $detalles[] = $detalle;
        }
        return $detalles;
    }
    public function getPagoDetalleProducto($cod_pago_detalle_producto)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pago_productos WHERE cod_pago_producto = ?");
        $stmt->bind_param("i", $cod_pago_detalle_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $detalle = new Pago_Detalle_Producto(
                $row['cod_pago'],
                $row['nombre'],
                $row['cantidad'],
                $row['monto']
            );
            $detalle->setCod_pago_detalle_producto($row['cod_pago_producto']);
            return $detalle;
        }
        return null;
    }
    public function addPagoDetalleProducto($pago_detalle_producto)
    {
        $cod_pago = $pago_detalle_producto->getCod_pago();
        $nombre = $pago_detalle_producto->getNombre();
        $cantidad = $pago_detalle_producto->getCantidad();
        $monto = $pago_detalle_producto->getMonto();

        $sql = "INSERT INTO pago_productos (cod_pago, nombre, cantidad, monto) values (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isid", $cod_pago, $nombre, $cantidad, $monto);
        $stmt->execute();
    }
    public function updatePagoDetalleProducto($pago_detalle_producto)
    {
        $cod_pago_detalle_producto = $pago_detalle_producto->getCod_pago_detalle_producto();
        $nombre = $pago_detalle_producto->getNombre();
        $cantidad = $pago_detalle_producto->getCantidad();
        $monto = $pago_detalle_producto->getMonto();

        $sql = "UPDATE pago_productos SET nombre = ?, cantidad = ?, monto = ? WHERE cod_pago_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sidi", $nombre, $cantidad, $monto, $cod_pago_detalle_producto);
        $stmt->execute();
    }
    public function deletePagoDetalleProducto($cod_pago_detalle_producto)
    {
        $sql = "DELETE FROM pago_productos WHERE cod_pago_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_pago_detalle_producto);
        $stmt->execute();
    }
}