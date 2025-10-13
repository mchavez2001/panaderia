<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Lista de Insumos Disponibles Estimados</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="lista_pedidos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">PEDIDO <?php echo ($cod_venta); ?></h2>
        <p class="subtitulo-general">Lista de Productos</p>

        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Tamaño</th>
                        <th>Bolsas</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                        <th></th>
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
                            <td><?php echo ('S/' . $producto->getPrecio()); ?></td>
                            <td><?php echo ('S/' . $producto->getPrecio_Tot()); ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($producto->getCod_prod()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($productos as $producto) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                        <?php echo ($producto->getCant_prod().' '.$producto->getNom_prod()).' '.$producto->getTam_prod(); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">attach_money</span>
                        Precio Unitario: S/<?php echo ($producto->getPrecio()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">monetization_on</span>
                        Precio Total: S/<?php echo ($producto->getPrecio_Tot()); ?>
                    </p>
                    <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>" onclick="event.stopPropagation();">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($producto->getCod_prod()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="event.stopPropagation();">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-id="<?php echo ($cod_venta); ?>" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Producto
        </button>
    </div>

    <script src="../public/js/productoPedidoView.js"></script>
</body>

</html>
