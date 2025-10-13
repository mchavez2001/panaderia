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
    <a class="back" href="coches_produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Productos a Producir</h2>
        <p class="subtitulo-general">Registra las producciones que realizaras</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th class="hidden-mobile">UNIDADES</th>
                        <th>TAMAÑO</th>
                        <th>CANTIDAD</th>
                        <th>UNIDAD</th>
                        <th>ADICIONAL</th>
                        <th>UNIDAD</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="elementos">
                            <td><?php echo ($producto->getCod_prod()) ?></td>
                            <td><?php echo ($producto->getNom_prod()) ?></td>
                            <td class="hidden-mobile"><?php echo ($producto->getDscr_prod()) ?></td>
                            <td style="text-align: center;"><?php echo ($producto->getTam_prod()) ?></td>
                            <td style="text-align: center;"><?php echo ($producto->getCant_prod()) ?></td>
                            <td style="text-align: center;">BOLSAS</td>
                            <td style="text-align: center;"><?php echo ($producto->getCant_extra()) ?></td>
                            <td style="text-align: center;">UNIDADES</td>
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
                            <td style="text-align: center;">
                                <button type="button" class="calcular" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                                    <i class="fas fa-calculator"></i>
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
                    <h3 class="card-title"><span class="material-icons" style="color: #0869fa;">tag</span>ID: <?php echo ($producto->getCod_prod()); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">production_quantity_limits</span>
                        Producto: <?php echo ($producto->getNom_prod()); ?>
                    </p>
                    <p class="hidden-mobile">
                        <span class="material-icons" style="color: #0869fa;">description</span>
                        Descripción: <?php echo ($producto->getDscr_prod()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">crop_square</span>
                        Tamaño: <?php echo ($producto->getTam_prod()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">format_list_numbered</span>
                        Cantidad: <?php echo ($producto->getCant_prod()); ?> bolsas
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">add_circle_outline</span>
                        Adicional: <?php echo ($producto->getCant_extra()); ?> unidades
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">functions</span>
                        Unidades totales: <?php echo ($producto->getDscr_prod()); ?> unidades
                    </p>
                    <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($producto->getCod_prod()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                        <button type="button" class="calcular" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                            <i class="fas fa-calculator"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Producción
        </button>
    </div>

    <script src="../public/js/produccionView.js"></script>
</body>

</html>