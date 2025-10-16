<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista De Productos a Producir</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Mermas</h2>
        <p class="subtitulo-general">Registra las mermas obtenidas durante las producciones</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th>TAMAÑO</th>
                        <th>CANTIDAD</th>
                        <th>FECHA</th>
                        <th>MOTIVO</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mermas as $merma) : ?>
                        <tr class="elementos">
                            <td><?php echo ($merma->getCodMerma()) ?></td>
                            <td><?php echo ($merma->getProducto()) ?></td>
                            <td><?php echo ($merma->getTamaño()) ?></td>
                            <td><?php echo ($merma->getCantidad()) ?></td>
                            <td><?php echo ($merma->getFecha()) ?></td>
                            <td><?php echo ($merma->getMotivo()) ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($merma->getCodMerma()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($merma->getCodMerma()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($mermas as $merma) : ?>
                <div class="card">
                    <h3 class="card-title"><span class="material-icons" style="color: #0869fa;">tag</span>ID: <?php echo ($merma->getCodMerma()); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">production_quantity_limits</span>
                        Producto: <?php echo ($merma->getProducto()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">format_list_numbered</span>
                        Tamaño: <?php echo ($merma->getTamaño()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">note</span>
                        Motivo: <?php echo ($merma->getMotivo()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">inventory_2</span>
                        Cantidad: <?php echo ($merma->getCantidad()); ?>   
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">calendar_today</span>
                        Fecha: <?php echo ($merma->getFecha()); ?>
                    </p>
                    <!-- <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($merma->getCodMerma()); ?>">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($merma->getCodMerma()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div> -->
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Merma
        </button>
    </div>

    <script src="../public/js/mermaView.js"></script>
</body>

</html>