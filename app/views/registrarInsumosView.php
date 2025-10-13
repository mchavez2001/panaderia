<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista De Insumos del Dia</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="insumos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Pedidos de Insumos</h2>
        <p class="subtitulo-general">Indica tu lista de pedidos para abastecer tu stock</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>INSUMO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CANTIDAD</th>
                        <th>MEDIDA</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo) : ?>
                        <tr class="elementos">
                            <td><?php echo ($insumo->getCod_ins()) ?></td>
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td><?php echo ($insumo->getDscr()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getBloque()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getUni_bloque()) ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumo->getCod_ins()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($insumo->getCod_ins()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($insumos as $insumo) : ?>
                <div class="card">
                    <h3 class="card-title">Insumo ID: <?php echo ($insumo->getCod_ins()) ?></h3>
                    <p>
                        <strong>Nombre:</strong> <?php echo ($insumo->getNom_ins()) ?><br>
                        <strong>Descripción:</strong> <?php echo ($insumo->getDscr()) ?><br>
                        <strong>Cantidad:</strong> <?php echo ($insumo->getBloque()) ?><br>
                        <strong>Medida:</strong> <?php echo ($insumo->getUni_bloque()) ?><br>
                    </p>
                    <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumo->getCod_ins()); ?>">
                            <span class="material-icons" style="color: #0869fa;">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($insumo->getCod_ins()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Insumo
        </button>
    </div>
    <script src="../public/js/registrarInsumosView.js"></script>
</body>

</html>
