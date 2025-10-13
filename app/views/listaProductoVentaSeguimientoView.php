<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Lista de Productos</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="seguimiento_ventas?id=<?php echo $cod_cuenta ?>">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">VENTA <?php echo ($cod_venta); ?>: LISTA PRODUCTOS</h2>

        <!-- Vista de Escritorio -->
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Tamaño</th>
                        <th>Bolsas</th>
                        <th>Bolsas Entregadas</th>
                        <th>Bolsas Faltantes</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="elementos">
                            <td style="text-align: center;"><?php echo ($producto->getCod_prod()); ?></td>
                            <td><?php echo ($producto->getNom_prod()); ?></td>
                            <td><?php echo ($producto->getDscr_prod()); ?></td>
                            <td><?php echo ($producto->getTam_prod()); ?></td>
                            <td style="text-align: center;"><?php echo ($producto->getCant_prod()); ?></td>
                            <td style="text-align: center;"><?php echo ($entregas[$producto->getCod_prod()] ?? ''); ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    if (!empty($entregas[$producto->getCod_prod()])) {
                                        echo $producto->getCant_prod() - $entregas[$producto->getCod_prod()];
                                    }
                                ?>
                            </td>
                            <td><?php echo ('S/' . $producto->getPrecio()); ?></td>
                            <td><?php echo ('S/' . $producto->getPrecio_Tot()); ?></td>
                            <td>
                                <form action="/panaderia/public/producto_venta_seguimiento" method="post">
                                    <input type="hidden" name="cod_prod" value="<?php echo $producto->getCod_prod(); ?>">
                                    <input type="hidden" name="cod_venta" value="<?php echo $cod_venta; ?>">
                                    <button class="productos" type="submit" name="action" value="entregas">
                                        <span class="material-icons" style="color: #0869fa;">local_shipping</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Vista Móvil -->
        <div class="mobile-cards">
            <?php foreach ($productos as $producto) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                        <?php echo ($producto->getCant_prod().' '.$producto->getNom_prod()).' '.$producto->getTam_prod(); ?>
                    </h3>
                    <hr />
                    <p><span class="material-icons" style="color: #0869fa;">check_circle</span> Entregadas: <?php echo $entregas[$producto->getCod_prod()] ?? '0'; ?></p>
                    <p><span class="material-icons" style="color: #0869fa;">remove_circle_outline</span> Faltantes: 
                        <?php echo !empty($entregas[$producto->getCod_prod()]) ? ($producto->getCant_prod() - $entregas[$producto->getCod_prod()]) : $producto->getCant_prod(); ?>
                    </p>
                    <div class="card-actions">
                        <form action="/panaderia/public/producto_venta_seguimiento" method="post">
                            <input type="hidden" name="cod_prod" value="<?php echo $producto->getCod_prod(); ?>">
                            <input type="hidden" name="cod_venta" value="<?php echo $cod_venta; ?>">
                            <button class="productos" type="submit" name="action" value="entregas">
                                <span class="material-icons" style="color: #0869fa;">local_shipping</span>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- <button type="button" class="create" data-id="<?php #echo ($cod_venta); ?>" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Producto
        </button> -->
    </div>

    <script src="../public/js/productoVentaView.js"></script>
</body>

</html>
